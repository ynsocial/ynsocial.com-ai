<?php

namespace App\Http\Controllers\Admin\Contents;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Requests\PageTranslationRequest;
use App\Models\Page;
use App\Models\Slug;
use App\Models\Translations;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{

    static $alias = "pages";

    public function index(){

        /**
         * Module Generate
         */
        $module = (object)[
            'type'                  => static::$alias,
            'module_title'          => trans('admin/menu.' . static::$alias),
            'module_current_page'   => request()->get("page") ?? 1,
            'module_total_items'     => count(Page::all()),
            'breadcrumb' => (object)[
                (object)[
                    'title' => trans('admin/components.panel_title'),
                    'link' => route('admin.dashboard.index')
                ],
                (object)[
                    'title' => trans('admin/menu.' . static::$alias)
                ]
            ],
        ];

        /**
         * Queries
         */
        $query = Page::orderBy("id", "DESC");

        if ($keyword = request()->get("keyword")) {
            $module->items = $query->where('title', 'like', "%{$keyword}%")->get();
        } else {
            $offset = ($module->module_current_page - 1) * 10;
            $module->items = $query->skip($offset)->limit(10)->get();
        }

        /**
         * Response
         */
        return view("admin.modules.{$module->type}.index", compact('module'));

    }

    public function create(){

        /**
         * Module Generate
         */
        $module = (object)[
            'type'                  => static::$alias,
            'module_title'          => trans('admin/components.page_create'),
            'breadcrumb' => (object)[
                (object)[
                    "title" => trans('admin/components.panel_title'),
                    "link" => route("admin.dashboard.index")
                ],
                (object)[
                    "title" => trans('admin/menu.'.static::$alias),
                    "link" => route("admin.".static::$alias.".index")
                ],
                (object)[
                    "title" => trans('admin/components.page_create')
                ]
            ],
        ];

        /**
         * Response
         */
        return view("admin.modules.{$module->type}.create", compact('module'));

    }

    public function store(PageRequest $request){


        /**
         * Storage Featured Image is Exist
         */
        if ($image = $request->file('featured_image')) {
            $path = 'uploads/' . static::$alias;
            $imageName = $image->getClientOriginalName();
            $fullPath = $path . '/' . $imageName;

            // Check if the file already exists
            while (Storage::disk('public')->exists($fullPath)) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $fullPath = $path . '/' . $imageName;
            }

            // Store the image
            $image->storeAs($path, $imageName, 'public');
            $image_compiled_name = "storage/$fullPath";
        }

        /**
         * Store the item
         */
        $item = Page::create([
            'author_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'template' => $request->input('template'),
            'featured_image' => $image_compiled_name ?? "",
            'is_indexable' => (int) $request->input('is_indexable'),
            'is_active' => (int) $request->input('is_active'),
        ]);


        /**
         * Store the slug
         */
        Slug::create([
            'content_id' => $item->id,
            'language' => env("APP_LANG"),
            'alias' => static::$alias,
            'slug' => $request->input('slug') ?? Str::slug($request->input('title')) . '-' . $item->id,
            'method' => $request->input('controller') ?? 'index',
        ]);

        /**
         * Response
         */
        return redirect()->route("admin.".static::$alias.".index")->with([
            'message' => [
                'type' => 'success',
                'text' => trans('admin/components.alerts.created')
            ]
        ]);

    }

    public function edit($id){


        /**
         * Module Generate
         */
        $module = (object)[
            'type'                  => static::$alias,
            'module_title'          => trans('admin/components.page_update'),
            'breadcrumb' => (object)[
                (object)[
                    "title" => trans('admin/components.panel_title'),
                    "link" => route("admin.dashboard.index")
                ],
                (object)[
                    "title" => trans('admin/menu.'.static::$alias),
                    "link" => route("admin.".static::$alias.".index")
                ],
                (object)[
                    "title" => trans('admin/components.page_update')
                ]
            ],
        ];

        /**
         * Component
         */
        $page = Page::findOrFail($id);
        $page->slug = Slug::where(['alias' => $module->type, 'content_id' => $page->id])->first();


        return view("admin.modules.{$module->type}.edit", compact('module', 'page'));
    }

    public function update(PageRequest $request, $id){


        $item = Page::findOrFail($id);

        /**
         * If Featured Image is Already Exist
         */
        $image_compiled_name = $request->input("current_image");

        /**
         * Storage Featured Image is Exist
         */
        if ($image = $request->file('featured_image')) {
            $path = 'uploads/' . static::$alias;
            $imageName = $image->getClientOriginalName();
            $fullPath = $path . '/' . $imageName;

            // Check if the file already exists
            while (Storage::disk('public')->exists($fullPath)) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $fullPath = $path . '/' . $imageName;
            }

            // Store the image
            $image->storeAs($path, $imageName, 'public');
            $image_compiled_name = "storage/$fullPath";
        }

        $featured_image = $image_compiled_name;

        /**
         * Update current item
         */
        $item->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'template' => $request->input('template'),
            'featured_image' => $featured_image,
            'is_indexable' => (int) $request->input('is_indexable'),
            'is_active' => (int) $request->input('is_active'),
        ]);


        /**
         * Update current slug
         */
        $slug = Slug::where(['alias' => static::$alias, 'content_id' => $item->id, 'language' => env('APP_LANG')])->first();
        $slug->update([
            'slug' => $request->input('slug') ?? Str::slug($request->input('title')) . '-' . $item->id,
            'method' => $request->input('controller') ?? 'index',
        ]);

        /**
         * Response
         */
        return redirect()->route("admin.".static::$alias.".edit", $item->id)->with([
            'message' => [
                'type' => 'success',
                'text' => trans('admin/components.alerts.updated')
            ]
        ]);

    }

    public function translate($id, $language = NULL){


        /**
         * Module Generate
         */
        $module = (object)[
            'type'                  => static::$alias,
            'module_title'          => trans('admin/components.translate'),
            'page'                  => Page::findOrFail($id),
            'language'              => $language,
            'breadcrumb' => (object)[
                (object)[
                    "title" => trans('admin/components.panel_title'),
                    "link" => route("admin.dashboard.index")
                ],
                (object)[
                    "title" => trans('admin/menu.'.static::$alias),
                    "link" => route("admin.".static::$alias.".index")
                ],
                (object)[
                    "title" => trans('admin/components.translate')
                ]
            ],
        ];


        /**
         * Translation is Exist
         */
        if($language){

            if($translations = Translations::where(['alias' => static::$alias, 'language' => $language, 'content_id' => $id])->first()){
                $module->translations = $translations;
            }

            if($translations_slug = Slug::where(['alias' => static::$alias, 'language' => $language, 'content_id' => $id])->first()){
                 $module->translations->slug = $translations_slug;
            }
        }


        /**
         * Response
         */
        return view("admin.modules.{$module->type}.translate", compact('module'));

    }

    public function convert(PageTranslationRequest $request, $language, $id){


        /**
         * Before Convertion
         */
        $parent_slug = Slug::where(['alias' => static::$alias, 'content_id' => $id, 'language' => env('APP_LANG')])->first();
        $where = ['alias' => static::$alias, 'content_id' => $id, 'language' => $language];
        Translations::where($where)->delete();
        Slug::where($where)->delete();

        /**
         * If Featured Image is Already Exist
         */
        $image_compiled_name = $request->input("current_image");


        /**
         * Validation
         */
        $validated = $request->validate([
            'slug' => Rule::unique('slugs', 'slug')->where(function ($query) use ($id, $language) {
                return $query->whereNot(["alias" => static::$alias, "content_id" => $id, "language" => $language]);
            }),
        ]);

        /**
         * Storage Featured Image is Exist
         */
        if ($image = $request->file('featured_image')) {
            $path = 'uploads/' . static::$alias;
            $imageName = $image->getClientOriginalName();
            $fullPath = $path . '/' . $imageName;

            // Check if the file already exists
            while (Storage::disk('public')->exists($fullPath)) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $fullPath = $path . '/' . $imageName;
            }

            // Store the image
            $image->storeAs($path, $imageName, 'public');
            $image_compiled_name = "storage/$fullPath";
        }

        $featured_image = $image_compiled_name ?: $request->input("current_image");


        /**
         * Store the item
         */
        $item = Translations::create([
            'content_id' => $id,
            'language' => $language,
            'alias' => static::$alias,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'featured_image' => $featured_image ?? "",
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'author_id' => auth()->user()->id,
            'is_indexable' => (int) $request->input('is_indexable'),
            'is_active' => (int) $request->input('is_active'),
        ]);

        /**
         * Store the slug
         */
        Slug::create([
            'content_id' => $id,
            'language' => $language,
            'alias' => static::$alias,
            'slug' => $request->input('slug') ?? Str::slug($request->input('title')) . '-' . $item->id,
            'method' => $parent_slug->method,
        ]);

        /**
         * Response
         */
        return redirect()->route("admin.".static::$alias.".translate", [$id, $language])->with([
            'message' => [
                'type' => 'success',
                'text' => trans('admin/components.alerts.converted')
            ]
        ]);

    }


    public function destroy($id)
    {
        Page::destroy($id);

        $where = ["alias" => static::$alias, "content_id" => $id];

        Translations::where($where)->delete();

        Slug::where($where)->delete();

        /**
         * Response
         */
        return redirect()->route("admin.".static::$alias.".index")->with([
            'message' => [
                'type' => 'success',
                'text' => trans('admin/components.alerts.destroyed')
            ]
        ]);
    }

    public function bulk_destroy($id)
    {
        Page::destroy($id);

        $where = ["alias" => static::$alias, "content_id" => $id];

        Translations::where($where)->delete();

        Slug::where($where)->delete();

    }
}
