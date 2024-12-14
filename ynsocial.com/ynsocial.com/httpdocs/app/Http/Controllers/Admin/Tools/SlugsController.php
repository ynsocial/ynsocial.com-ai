<?php

namespace App\Http\Controllers\Admin\Tools;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlugsRequest;
use App\Models\Slug;
use Illuminate\Http\Request;

class SlugsController extends Controller
{
    static $alias = "slugs";

    public function index(){

        /**
         * Module Generate
         */
        $module = (object)[
            'type'                  => static::$alias,
            'module_title'          => trans('admin/menu.' . static::$alias),
            'module_current_page'   => request()->get("page") ?? 1,
            'module_total_items'     => count(Slug::all()),
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
        $query = Slug::orderBy("id", "DESC");

        if ($keyword = request()->get("keyword")) {
            $module->items = $query->where('slug', 'like', "%{$keyword}%")->get();
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
            'module_title'          => trans('admin/components.slug_create'),
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
                    "title" => trans('admin/components.slug_create')
                ]
            ],
        ];

        /**
         * Response
         */
        return view("admin.modules.{$module->type}.create", compact('module'));

    }

    public function store(SlugsRequest $request){

        /**
         * Validate slugs
         */
        $validated = $request->validated();

        /**
         * Store the slug
         */
        foreach ($request->input("slugs") as $key => $item){
            if($item){
                Slug::create([
                    'content_id' => time(),
                    'language' => $key,
                    'alias' => $request->input("alias") ?? "pages",
                    'slug' => $item,
                    'method' => $request->input('method') ?? 'index',
                ]);
            }
        }


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
            'module_title'          => trans('admin/components.slug_update'),
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
                    "title" => trans('admin/components.slug_update')
                ]
            ],
        ];

        /**
         * Component
         */
        $slug = Slug::findOrFail($id);

        /**
         * Group Items
         */
        $slug->group = Slug::where("content_id", $slug->content_id)->get();


        return view("admin.modules.{$module->type}.edit", compact('module', 'slug'));
    }

    public function update(SlugsRequest $request, $id){

        /**
         * Validate slugs
         */
        $validated = $request->validated();

        $current_slug_group_id = Slug::findorfail($id)->content_id;

        $slugs = Slug::where("content_id", $current_slug_group_id)->get();

        /**
         * Update if is Exist or Create Slugs
         */
        foreach ($request->input("slugs") as $key => $item){

            $exist_slug = $slugs->where("language", $key)->first();

            if($exist_slug){

                $exist_slug->update([
                    'alias' => $request->input("alias") ?? "pages",
                    'slug' => $item,
                    'method' => $request->input('method') ?? 'index',
                ]);

            }elseif($item) {

                Slug::create([
                    'content_id' => $current_slug_group_id,
                    'language' => $key,
                    'alias' => $request->input("alias") ?? "pages",
                    'slug' => $item,
                    'method' => $request->input('method') ?? 'index',
                ]);
            }
        }


        /**
         * Response
         */
        return redirect()->route("admin.".static::$alias.".index")->with([
            'message' => [
                'type' => 'success',
                'text' => trans('admin/components.alerts.updated')
            ]
        ]);

    }

    public function destroy($id)
    {
        Slug::destroy($id);

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
        Slug::destroy($id);
    }
}
