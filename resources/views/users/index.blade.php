@extends('layouts.bootstrap')

@section('title')

Data Pengguna

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Data Pengguna</h3>
            </div>
            <div class="card-body table-responsive">
                @include('alert.success')
                <br>

                @if(Request::get('keyword'))
                <a href="{{ route('users.index') }}" class="btn btn-success">Kembali</a>
                @else
                <a href="{{ route('users.create') }}" class="btn btn-primary">Create</a>

                @endif

                <hr>
                <form method="get" action="{{route('users.index')}}">

                    <div class="row">
                        <div class="col-2">
                            <b>Cari Nama</b>
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" value="{{ Request::get('keyword') }}" id="keyword" name="keyword">
                        </div>
                        <div class="col-3">
                            <select name="level" id="level" class="form-control">
                                <option value="admin" @if(Request::get('level')=="admin" ) selected @endif>Admin</option>
                                <option value="mentor" @if(Request::get('level')=="mentor" ) selected @endif>Mentor</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <hr>

                </form>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Gender</th>
                            <th>Avatar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $row)
                        <tr>
                            <td>{{ $loop->iteration + ($users->perPage() * ($users->currentPage() - 1)  )  }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->level }}</td>
                            <td>{{ $row->gender }}</td>
                            <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->avatar) }}" width="150px" /></td>
                            <td>
                                <a href="{{ route('users.edit',[$row->id]) }}" class="btn btn-info btn-sm">Edit</a>
                                <form class="d-inline" action="{{ route('users.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Hapus User ini?')">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $users->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection