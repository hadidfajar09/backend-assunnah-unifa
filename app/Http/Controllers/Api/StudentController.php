<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\StudentResource;
use Validator;
use Storage;

class StudentController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->all(); //nangkep inputan  
        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'msg' => $validator->errors()
            ], 400);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $student = Student::where([
            ['email', $email],
            ['status', 'active']
        ])->first();

        if (is_null($student)) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Email atau Password tidak sesuai'
            ], 200);
        } else {
            if (password_verify($password, $student->password)) {
                return response()->json([
                    'status' => TRUE,
                    'msg' => 'Peserta Ditemukan',
                    'data' => new StudentResource($student)
                ], 200);
            } else {
                return response()->json([
                    'status' => FALSE,
                    'msg' => 'Email atau Password tidak sesuai'
                ], 200);
            }
        }
    }

    public function avatarUpdate(Request $request)
    {
        $input = $request->all();
        $student = Student::find($request->get('id'));
        if (is_null($student)) {
            return response()->json([
                'status' => FALSE,
                'msg' => 'Peserta tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($input, [
            'avatar' => 'sometimes|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'msg' => $validator->errors
            ], 400);
        }

        if ($request->hasFile('avatar')) {
            if ($request->file('avatar')->isValid()) {
                Storage::disk('upload')->delete($student->avatar);
                $avatar = $request->file('avatar');
                $extention = $avatar->getClientOriginalExtension();
                $studentAvatar = "student-avatar/" . date('YmdHis') . "." . $extention;
                $uploadPath = env('UPLOAD_PATH') . "/student-avatar";
                $request->file('avatar')->move($uploadPath, $studentAvatar);
                $input['avatar'] = $studentAvatar;
            }
        }

        $student->update($input);
        return response()->json([
            'status' => TRUE,
            'msg' => 'data avatar berhasil diupdate'
        ], 200);
    }
}
