<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait OptimizedQueries
{
    /**
     * Cache duration in seconds (1 hour)
     */
    protected static int $cacheDuration = 3600;

    /**
     * Get cached query results
     */
    public function scopeCached(Builder $query, string $key = null): Builder
    {
        $key = $key ?? static::class . ':' . serialize($query->getBindings());
        
        return Cache::remember($key, static::$cacheDuration, function () use ($query) {
            return $query->get();
        });
    }

    /**
     * Apply common eager loading relationships
     */
    public function scopeWithCommonRelations(Builder $query): Builder
    {
        if (property_exists($this, 'commonRelations')) {
            return $query->with($this->commonRelations);
        }
        return $query;
    }

    /**
     * Apply common scopes and constraints
     */
    public function scopeWithCommonScopes(Builder $query): Builder
    {
        if (property_exists($this, 'commonScopes')) {
            foreach ($this->commonScopes as $scope) {
                $query->{$scope}();
            }
        }
        return $query;
    }

    /**
     * Optimize query by selecting only needed columns
     */
    public function scopeSelectOptimized(Builder $query, array $columns = ['*']): Builder
    {
        if ($columns === ['*'] && property_exists($this, 'optimizedColumns')) {
            $columns = $this->optimizedColumns;
        }
        return $query->select($columns);
    }

    /**
     * Apply indexing hints for better performance
     */
    public function scopeUseIndex(Builder $query, string $index): Builder
    {
        return $query->from(DB::raw("`{$this->getTable()}` USE INDEX ({$index})"));
    }

    /**
     * Get records with efficient pagination
     */
    public function scopeEfficientPagination(Builder $query, int $perPage = 15, array $columns = ['*']): Builder
    {
        $primaryKey = $this->getKeyName();
        
        return $query->selectOptimized($columns)
            ->orderBy($primaryKey)
            ->simplePaginate($perPage);
    }

    /**
     * Apply search across multiple columns efficiently
     */
    public function scopeEfficientSearch(Builder $query, string $term, array $columns): Builder
    {
        return $query->where(function ($query) use ($term, $columns) {
            foreach ($columns as $column) {
                if (Schema::hasColumn($this->getTable(), $column)) {
                    $query->orWhere($column, 'LIKE', "%{$term}%");
                }
            }
        });
    }

    /**
     * Get records with efficient ordering
     */
    public function scopeEfficientOrderBy(Builder $query, string $column, string $direction = 'asc'): Builder
    {
        if (Schema::hasColumn($this->getTable(), $column)) {
            return $query->orderBy($column, $direction);
        }
        return $query;
    }

    /**
     * Clear model cache
     */
    public static function clearModelCache(): void
    {
        $cacheKey = static::class . ':*';
        Cache::tags($cacheKey)->flush();
    }

    /**
     * Get query execution plan
     */
    public static function getQueryPlan(Builder $query): array
    {
        $sql = $query->toSql();
        $bindings = $query->getBindings();
        
        return DB::select("EXPLAIN FORMAT=JSON " . static::replaceBindings($sql, $bindings));
    }

    /**
     * Replace query bindings
     */
    private static function replaceBindings(string $sql, array $bindings): string
    {
        $needle = '?';
        foreach ($bindings as $replace) {
            $pos = strpos($sql, $needle);
            if ($pos !== false) {
                if (is_string($replace)) {
                    $replace = "'" . addslashes($replace) . "'";
                }
                $sql = substr_replace($sql, $replace, $pos, strlen($needle));
            }
        }
        return $sql;
    }

    /**
     * Check if query will use proper indexes
     */
    public static function willUseIndex(Builder $query, string $expectedIndex): bool
    {
        $plan = static::getQueryPlan($query);
        $usedIndexes = array_column($plan, 'key');
        
        return in_array($expectedIndex, $usedIndexes);
    }

    /**
     * Get query statistics
     */
    public static function getQueryStats(Builder $query): array
    {
        DB::enableQueryLog();
        $result = $query->get();
        $queryLog = DB::getQueryLog();
        DB::disableQueryLog();

        return [
            'query' => end($queryLog)['query'],
            'bindings' => end($queryLog)['bindings'],
            'time' => end($queryLog)['time'],
            'result_count' => $result->count(),
            'memory_usage' => memory_get_usage(true),
        ];
    }
} 