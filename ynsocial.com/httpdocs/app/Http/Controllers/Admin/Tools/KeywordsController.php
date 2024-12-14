<?php

namespace App\Http\Controllers\Admin\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class KeywordsController extends Controller
{
    static $alias = "keywords";

    public function index(){

        /**
         * Module Generate
         */
        $module = (object)[
            'type'                  => static::$alias,
            'module_title'          => trans('admin/menu.' . static::$alias),
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
         * Get Translatable Files with Arrays
         */
        $module->translations = [];

        if(request()->get("language")){
            $current_lang = request()->get("language");
            $files = File::files(resource_path("lang/$current_lang/frontend"));
            foreach ($files as $file) {
                $fileName = $file->getFilenameWithoutExtension();
                $module->translations[$fileName] = include $file->getPathname();
            }
        }

        /**
         * Response
         */
        return view("admin.modules.{$module->type}.index", compact('module'));
    }

    public function update(Request $request, $language){


        $translations = $request->except('_token');


        foreach ($translations as $fileName => $content) {

            $output = "<?php\n\nreturn [\n" . $this->formatArray($content) . "\n];\n";

            file_put_contents(resource_path("lang/$language/frontend/{$fileName}.php"), $output);
        }

        /**
         * Response
         */
        return redirect()->route("admin.".static::$alias.".index", ['language' => $language])->with([
            'message' => [
                'type' => 'success',
                'text' => trans('admin/components.alerts.updated')
            ]
        ]);
    }

    private function formatArray($array, $level = 1)
    {
        $formatted = '';

        //Düzgün boşluklar için
        $indent = str_repeat('    ', $level);

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                // Eğer iç içe bir array ise recursive olarak çağır
                $formatted .= $indent . "'" . $key . "' => [\n" . $this->formatArray($value, $level + 1) . $indent . "],\n";
            } else {
                // Değer string ise, string formatında yaz
                $formatted .= $indent . "'" . $key . "' => '" . addslashes($value) . "',\n";
            }
        }

        return $formatted;
    }
}
