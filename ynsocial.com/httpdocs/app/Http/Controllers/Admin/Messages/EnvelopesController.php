<?php

namespace App\Http\Controllers\Admin\Messages;

use App\Http\Controllers\Controller;
use App\Models\Envelope;
use Illuminate\Http\Request;

class EnvelopesController extends Controller
{
    static $alias = "envelopes";

    public function index(){

        /**
         * Module Generate
         */
        $module = (object)[
            'type'                  => static::$alias,
            'module_title'          => trans('admin/menu.' . static::$alias),
            'module_current_page'   => request()->get("page") ?? 1,
            'module_total_items'     => count(Envelope::all()),
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
        $query = Envelope::orderBy("id", "DESC");

        if ($keyword = request()->get("keyword")) {
            $module->items = $query->where('name', 'like', "%{$keyword}%")->get();
        } else {
            $offset = ($module->module_current_page - 1) * 10;
            $module->items = $query->skip($offset)->limit(10)->get();
        }

        /**
         * Response
         */
        return view("admin.modules.{$module->type}.index", compact('module'));
    }

    public function read($id){


        /**
         * Module Generate
         */
        $module = (object)[
            'type'                  => static::$alias,
            'module_title'          => trans('admin/components.envelope_read'),
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
                    "title" => trans('admin/components.envelope_read')
                ]
            ],
        ];

        /**
         * Component
         */
        $envelope = Envelope::findOrFail($id);

        $envelope->update([
            "unread" => 0
        ]);


        return view("admin.modules.{$module->type}.read", compact('module', 'envelope'));
    }

    public function destroy($id)
    {
        Envelope::destroy($id);

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
        Envelope::destroy($id);
    }
}
