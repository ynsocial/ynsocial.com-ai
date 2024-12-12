<?php

namespace App\Http\Controllers\Admin\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExtrasController extends Controller
{
    public function index(){

        /**
         * Module Generate
         */
        $module = (object)[];

        /**
         * Module Type
         */
        $module->type = "extras";

        /**
         * Module Title
         */
        $module->module_title = trans('admin/menu.'.$module->type);

        /**
         * Module Breadcrumb
         */
        $module->breadcrumb = (object)[
            0 => (object)[
                "title" => trans('admin/components.panel_title'),
                "link" => route("admin.dashboard.index")
            ],
            1 => (object)[
                "title" => $module->module_title
            ]
        ];

        return view("admin.modules.".$module->type.".index", ["module"=>$module]);
    }
}
