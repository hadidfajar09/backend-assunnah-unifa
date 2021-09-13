<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Http\Resources\ModuleResource;

class ModuleController extends Controller
{
    public function ModuleById(Request $request)
    {
        $id = $request->get('id');
        $module = Module::find($id);

        if (is_null($module)) {
            return response()->json([
                "status" => FALSE,
                "msg" => 'Data Modul tidak ditemukan'
            ], 404);
        }

        $view = $module->view + 1;
        $module->update(['view' => $view]);

        return new ModuleResource($module);
    }
}
