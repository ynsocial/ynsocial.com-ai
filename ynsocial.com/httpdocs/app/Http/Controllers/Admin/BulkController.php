<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class BulkController extends Controller
{
    public function delete($table){

        /**
         * Requested Items
         */
        $ids = explode(",", request()->get("ids"));

        /**
         * Response
         */
        foreach ($ids as $item){
            Route::dispatch(
                Request::create(route('admin.'.$table.'.bulk_destroy', $item), 'GET')
            );
        }


        /**
         * Response
         */
        return redirect()->route("admin.".$table.".index")->with([
            'message' => [
                'type' => 'success',
                'text' => trans('admin/components.alerts.all_destroyed')
            ]
        ]);
    }

}
