<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;
use Validator;
use Storage;
use Illuminate\Support\Facades\Gate;

class ModuleController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-modules')) return $next($request);
            abort(403);
        });
    }

    public function index()
    {
        $data['course'] = Course::where('user_id', Auth::user()->id)->paginate(5);
        return view('module.index', $data);
    }

    public function detail($id)
    {
        $data['course_id'] = $id;
        $data['course'] = Course::findOrFail($id);
        $data['module'] = Module::where('course_id', $id)->orderBy('order', 'asc')->paginate(10);
        return view('module.detail', $data);
    }

    public function create($id)
    {
        $data['course_id'] = $id;
        $data['course'] = Course::findOrFail($id);
        return view('module.create', $data);
    }

    public function store(Request $request)
    {
        $standartRule = [
            'title' => 'required|max:255',
            'description' => 'required',
            'module_type' => 'required'

        ];

        if ($request->get('module_type') == "file") {
            $standartRule['document'] = "required|mimes:mp4,pdf,mp3|max:62000";
        }
        if ($request->get('module_type') == "youtube") {
            $standartRule['youtube'] = "required|max:255";
        }

        $validator = Validator::make($request->all(), $standartRule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        if ($request->get('module_type') == "file") {
            if ($request->file('document')->isValid()) {
                $documentFile = $request->file('document');
                $extention = $documentFile->getClientOriginalExtension();
                $slug = \Str::slug($request->get('title')); //simpan hasil konversi 
                $fileName = "document-module/" . date('YmdHis') . "-" . $slug . "." . $extention;
                $uploadPath = env('UPLOAD_PATH') . "/document-module";
                $request->file('document')->move($uploadPath, $fileName);
                $input['file_type'] = $documentFile->getClientOriginalExtension();
                $input['document'] = $fileName;
            }
        }

        Module::create($input);
        $course_id = $request->get('course_id');
        return redirect()->route('module.detail', [$course_id])->with('status', 'Sukses menambahkan modul');
    }

    public function edit($id)
    {
        $data['module'] = Module::findOrFail($id);
        return view('module.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $dataModule = Module::findOrFail($id);
        $standartRule = [
            'title' => 'required|max:255',
            'description' => 'required',
            'module_type' => 'required'

        ];

        if ($request->get('module_type') == "file") {
            $standartRule['document'] = "sometimes|nullable|mimes:mp4,pdf,mp3|max:62000";
        }
        if ($request->get('module_type') == "youtube") {
            $standartRule['youtube'] = "required|max:255";
        }

        $validator = Validator::make($request->all(), $standartRule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        if ($request->get('module_type') == "file") {
            if ($request->hasFile('document')) {
                if ($request->file('document')->isValid()) {
                    $documentFile = $request->file('document');
                    $extention = $documentFile->getClientOriginalExtension();
                    $slug = \Str::slug($request->get('title'));
                    $fileName = "document-module/" . date('YmdHis') . "-" . $slug . "." . $extention;
                    $uploadPath = env('UPLOAD_PATH') . "/document-module";
                    $request->file('document')->move($uploadPath, $fileName);
                    $input['file_type'] = $documentFile->getClientOriginalExtension();
                    $input['document'] = $fileName;

                    if ($dataModule->module_type == "file") {
                        Storage::disk('upload')->delete($dataModule->document);
                    }
                }
            }
        }

        if ($request->get('module_type') == "youtube") {
            $input['document'] = "";
            $input['file_type'] = "";
        }

        if ($request->get('module_type') == "file") {
            $input['youtube'] = "";
        }

        $dataModule->update($input);
        $course_id = $request->get('course_id');

        return redirect()->route('module.detail', $course_id)->with('status', 'Modul Pelajaran berhasil diUpdate');
    }

    public function download($id)
    {
        $module = Module::findOrFail($id);
        $filePath = env('UPLOAD_PATH') . "/" . $module->document;
        return response()->download($filePath);
    }

    public function show($id)
    {
        $data['module'] = Module::findOrFail($id);
        return view('module.show', $data);
    }

    public function destroy($id)
    {

        $module = Module::findOrFail($id);
        if ($module->module_type == "file") {
            Storage::disk('upload')->delete($module->document);
        }
        $module->delete();
        return redirect()->route('module.detail', [$module->course_id])->with('status', 'Modul berhasil di Hapus');
    }
}
