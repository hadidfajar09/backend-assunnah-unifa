<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Http\Resources\ModuleResource;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    function getByCategory(Request $request)
    {
        $id = $request->input('category_id');
        $course = Course::where([
            ['category_id', $id]
        ])->get();
        if ($course->isEmpty()) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Pelajaran tidak ditemukan dengan kategori tersebut'
            ], 200);
        }

        return CourseResource::collection($course);
    }

    function getById(Request $request)
    {
        $id = $request->input('id');
        $course = Course::find($id);
        if (is_null($course)) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Pelajaran tidak ditemukan'
            ], 404);
        }

        $module = Module::where([
            ['course_id', $id],
            ['status', 'active'],

        ])->get();

        return response()->json([
            "status" => TRUE,
            "data" => [
                "course" => new CourseResource($course),
                "detail" => ModuleResource::collection($module)
            ]
        ]);
    }

    public function index(Request $request)
    {
        $filterKey = $request->get('keyword');
        $course = Course::all();

        if ($filterKey) {
            $course = Course::where('title', 'LIKE', "%$filterKey%")->get();
        }
        return CourseResource::collection($course);
    }

    public function pupulerAndLatest()
    {
        $latest = Course::orderBy('created_at', 'DESC')->limit(2)->get();
        $populer = Course::select('*')
            ->join('vw_course_modules as b', 'course_id', '=', 'b.course_id')
            ->orderBy('b.total', 'DESC')
            ->limit(2)
            ->get();

        return response()->json([
            "status" => TRUE,
            "data" => [
                "latest" => CourseResource::collection($latest),
                "populer" => CourseResource::collection($populer)
            ]
        ]);
    }
}
