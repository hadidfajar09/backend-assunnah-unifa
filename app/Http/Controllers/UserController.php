<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-users')) return $next($request);
            abort(403);
        });
    }

    public function index(Request $request)
    {
        $filterKey = $request->get('keyword');
        $filterLevel = $request->get('level');
        $data['users'] = User::paginate(5);
        if ($filterKey) {
            $data['users'] = User::where('name', 'LIKE', "%$filterKey%")
                ->where('level', $filterLevel)->paginate(5);
        }

        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users', //email harus uniq tidak boleh ada yg sama
            'password' => 'required|min:6',
            'name' => 'required|max:255',
            'level' => 'required',
            'gender' => 'required',
            'phone' => 'required|digits_between:10,12',
            'address' => 'required|max:255',
            'avatar' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]); //mendapatkan sluruh form dari tmbh user

        //jika validasi ada kesalahn
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        if ($request->file('avatar')->isValid()) {

            $avatarFile = $request->file('avatar');
            $extention = $avatarFile->getClientOriginalExtension();
            $fileName = "user-avatar/" . date('YmdHis') . "." . $extention;
            $uploadPath = env('UPLOAD_PATH') . "/user-avatar";
            $request->file('avatar')->move($uploadPath, $fileName);
            $input['avatar'] = $fileName;
        }

        $input['password'] = \Hash::make($request->get('password'));
        User::create($input);
        return redirect()->route('users.index')->with('status', 'User Berhasil Dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['users'] = User::findOrFail($id);
        return view('users.edit', $data);
    }

    /** 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataUser = User::findOrFail($id); //menyimpan data exixting sblm diupdate
        $validator = Validator::make($request->all(), [
            //email harus uniq tidak boleh ada yg sama
            'name' => 'required|max:255',
            'level' => 'required',
            'gender' => 'required',
            'phone' => 'required|digits_between:10,12',
            'address' => 'required|max:255',
            'avatar' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]); //mendapatkan sluruh form dari tmbh user

        //jika validasi ada kesalahn
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        //validasi avatar apakah di hapus atau tdk
        $input = $request->all();
        if ($request->hasFile('avatar')) {
            if ($request->file('avatar')->isValid()) {
                Storage::disk('upload')->delete($dataUser->avatar);
                $avatarFile = $request->file('avatar');
                $extention = $avatarFile->getClientOriginalExtension();
                $fileName = "user-avatar/" . date('YmdHis') . "." . $extention;
                $uploadPath = env('UPLOAD_PATH') . "/user-avatar";
                $request->file('avatar')->move($uploadPath, $fileName);
                $input['avatar'] = $fileName;
            }
        }

        //jika update pass maka diubah keypass
        if ($request->input('password')) {
            $input['password'] = \Hash::make($input['password']); //generate pass dgn hash smcam replace
        } else {
            $input = Arr::except($input, ['password']); //menghilngkan pass pd array input
        }

        $dataUser->update($input);
        return redirect()->route('users.index')->with('status', 'User Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //menghpus file yg sdh d upload sblny
        $dataUser = User::findOrFail($id);
        $dataUser->delete();
        Storage::disk('upload')->delete($dataUser->avatar);
        return redirect()->back()->with('status', 'User Berhasil Dihapus!');
    }
}
