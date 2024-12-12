<?php

namespace App\Http\Controllers\Admin\Tools;

use App\Http\Controllers\Controller;
use App\Http\Requests\RedirectionRequest;
use App\Models\Redirection;
use Illuminate\Http\Request;

class RedirectionsController extends Controller
{
    static $alias = "redirections";

    public function index(){

        /**
         * Module Generate
         */
        $module = (object)[
            'type'                  => static::$alias,
            'module_title'          => trans('admin/menu.' . static::$alias),
            'module_current_page'   => request()->get("page") ?? 1,
            'module_total_items'     => count(Redirection::all()),
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
        $query = Redirection::orderBy("id", "DESC");

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
            'module_title'          => trans('admin/components.redirections_create'),
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
                    "title" => trans('admin/components.redirections_create')
                ]
            ],
        ];

        /**
         * Response
         */
        return view("admin.modules.{$module->type}.create", compact('module'));

    }

    public function store(RedirectionRequest $request){

        /**
         * Store the item
         */
        $item = Redirection::create([
            'author_id' => auth()->user()->id,
            'source' => $request->input('source'),
            'target' => $request->input('target')
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
            'module_title'          => trans('admin/components.redirections_update'),
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
                    "title" => trans('admin/components.redirections_update')
                ]
            ],
        ];

        /**
         * Component
         */
        $redirection = Redirection::findOrFail($id);


        return view("admin.modules.{$module->type}.edit", compact('module', 'redirection'));
    }

    public function update(RedirectionRequest $request, $id){


        $item = Redirection::findOrFail($id);


        /**
         * Update current item
         */
        $item->update([
            'source' => $request->input('source'),
            'target' => $request->input('target')
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
        Redirection::destroy($id);

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
        Redirection::destroy($id);

    }
}
