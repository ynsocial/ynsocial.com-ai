<?php

namespace App\Http\Controllers\Admin\Tools;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoneRequest;
use App\Models\Gone;
use Illuminate\Http\Request;

class GonesController extends Controller
{
    static $alias = "gones";

    public function index(){

        /**
         * Module Generate
         */
        $module = (object)[
            'type'                  => static::$alias,
            'module_title'          => trans('admin/menu.' . static::$alias),
            'module_current_page'   => request()->get("page") ?? 1,
            'module_total_items'     => count(Gone::all()),
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
        $query = Gone::orderBy("id", "DESC");

        if ($keyword = request()->get("keyword")) {
            $module->items = $query->where('source', 'like', "%{$keyword}%")->get();
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
            'module_title'          => trans('admin/components.gones_create'),
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
                    "title" => trans('admin/components.gones_create')
                ]
            ],
        ];

        /**
         * Response
         */
        return view("admin.modules.{$module->type}.create", compact('module'));

    }

    public function store(GoneRequest $request){

        /**
         * Store the item
         */
        $item = Gone::create([
            'author_id' => auth()->user()->id,
            'source' => $request->input('source')
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
            'module_title'          => trans('admin/components.gones_update'),
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
                    "title" => trans('admin/components.gones_update')
                ]
            ],
        ];

        /**
         * Component
         */
        $gone = Gone::findOrFail($id);


        return view("admin.modules.{$module->type}.edit", compact('module', 'gone'));
    }

    public function update(GoneRequest $request, $id){


        $item = Gone::findOrFail($id);


        /**
         * Update current item
         */
        $item->update([
            'source' => $request->input('source')
        ]);

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
        Gone::destroy($id);

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
        Gone::destroy($id);
    }
}
