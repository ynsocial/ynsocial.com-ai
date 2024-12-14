<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

// System Health Commands
Artisan::command('system:health', function () {
    $this->info('Checking system health...');
    
    // Check PHP version
    $this->line('PHP Version: ' . PHP_VERSION);
    
    // Check memory usage
    $memoryUsage = memory_get_usage(true) / 1024 / 1024;
    $this->line(sprintf('Memory Usage: %.2f MB', $memoryUsage));
    
    // Check disk space
    $diskFree = disk_free_space('/') / 1024 / 1024 / 1024;
    $diskTotal = disk_total_space('/') / 1024 / 1024 / 1024;
    $this->line(sprintf('Disk Space: %.2f GB free of %.2f GB', $diskFree, $diskTotal));
    
    // Check database connection
    try {
        DB::connection()->getPdo();
        $this->info('Database connection: OK');
    } catch (\Exception $e) {
        $this->error('Database connection: Failed - ' . $e->getMessage());
    }
    
    // Check Redis connection
    try {
        $redis = Redis::connection();
        $redis->ping();
        $this->info('Redis connection: OK');
    } catch (\Exception $e) {
        $this->error('Redis connection: Failed - ' . $e->getMessage());
    }
    
    // Check storage permissions
    $storagePath = storage_path();
    if (is_writable($storagePath)) {
        $this->info('Storage permissions: OK');
    } else {
        $this->error('Storage permissions: Failed - Directory not writable');
    }
})->purpose('Check system health status');

// Cache Management Commands
Artisan::command('cache:all', function () {
    $this->info('Clearing all caches...');
    
    $this->call('view:clear');
    $this->call('cache:clear');
    $this->call('config:clear');
    $this->call('route:clear');
    $this->call('event:clear');
    
    $this->info('All caches cleared successfully!');
})->purpose('Clear all application caches');

Artisan::command('cache:warm', function () {
    $this->info('Warming up caches...');
    
    $this->call('config:cache');
    $this->call('route:cache');
    $this->call('view:cache');
    $this->call('event:cache');
    
    $this->info('Cache warming completed successfully!');
})->purpose('Warm up application caches for production');

// Database Management Commands
Artisan::command('db:status', function () {
    try {
        DB::connection()->getPdo();
        $this->info('Database connection successful!');
        
        // Get database size
        $size = DB::select('SELECT pg_size_pretty(pg_database_size(current_database()))')[0]->pg_size_pretty;
        $this->line("Database Size: {$size}");
        
        // Get table statistics
        $tables = ['portfolios', 'services', 'blogs', 'users', 'contacts', 'newsletters'];
        foreach ($tables as $table) {
            $count = DB::table($table)->count();
            $this->line("{$table}: {$count} records");
        }
        
        // Get index statistics
        $this->line("\nIndex Statistics:");
        $indexStats = DB::select("SELECT schemaname, tablename, indexname, idx_scan, idx_tup_read, idx_tup_fetch 
            FROM pg_stat_all_indexes WHERE schemaname = 'public'");
        foreach ($indexStats as $stat) {
            $this->line("{$stat->tablename}.{$stat->indexname}: {$stat->idx_scan} scans");
        }
    } catch (\Exception $e) {
        $this->error('Database connection failed: ' . $e->getMessage());
    }
})->purpose('Check database status and statistics');

// Maintenance Commands
Artisan::command('maintenance:check', function () {
    if (app()->isDownForMaintenance()) {
        $this->error('Application is in maintenance mode!');
        $this->line('Maintenance file: ' . storage_path('framework/down'));
    } else {
        $this->info('Application is running normally.');
    }
})->purpose('Check application maintenance status');

// Cleanup Commands
Artisan::command('cleanup:logs', function () {
    $this->info('Cleaning up old log files...');
    
    $logPath = storage_path('logs');
    $files = glob($logPath . '/*.log');
    $deleted = 0;
    
    foreach ($files as $file) {
        if (filemtime($file) < strtotime('-30 days')) {
            unlink($file);
            $deleted++;
        }
    }
    
    $this->info("Deleted {$deleted} old log files.");
})->purpose('Clean up old log files');

Artisan::command('cleanup:temp', function () {
    $this->info('Cleaning up temporary files...');
    
    Storage::disk('local')->delete(Storage::disk('local')->allFiles('temp'));
    
    $this->info('Temporary files cleaned up successfully.');
})->purpose('Clean up temporary files');

// Schedule Definition
$schedule->command('backup:run')->daily()->at('01:00')
    ->appendOutputTo(storage_path('logs/backup.log'));

$schedule->command('horizon:snapshot')->everyFiveMinutes();

$schedule->command('queue:work --stop-when-empty')->everyMinute()
    ->withoutOverlapping();

$schedule->command('sitemap:generate')->daily()->at('03:00');

$schedule->command('telescope:prune')->daily();

// Cleanup Tasks
$schedule->command('auth:clear-resets')->daily(); // Clear expired password reset tokens

$schedule->command('cleanup:logs')->weekly();
$schedule->command('cleanup:temp')->daily();

// Data Maintenance Tasks
$schedule->call(function () {
    DB::table('contacts')->where('created_at', '<', now()->subMonths(6))->delete();
})->monthly()->name('clean_old_contacts');

$schedule->call(function () {
    DB::table('activity_log')->where('created_at', '<', now()->subMonths(3))->delete();
})->weekly()->name('clean_old_activity_logs');

// Monitoring Tasks
$schedule->command('system:health')
    ->hourly()
    ->appendOutputTo(storage_path('logs/health-check.log'));

$schedule->call(function () {
    Log::info('Scheduler heartbeat', [
        'memory' => memory_get_usage(true),
        'queue_size' => \Queue::size(),
        'failed_jobs' => DB::table('failed_jobs')->count()
    ]);
})->everyFiveMinutes();

// Performance Monitoring
$schedule->call(function () {
    $metrics = [
        'database_size' => DB::select('SELECT pg_database_size(current_database())')[0]->pg_database_size,
        'cache_size' => Cache::size(),
        'storage_usage' => disk_free_space('/'),
        'memory_usage' => memory_get_usage(true),
        'php_workers' => shell_exec('ps aux | grep php-fpm | wc -l')
    ];
    
    Log::channel('monitoring')->info('Performance metrics', $metrics);
})->everyThirtyMinutes();
