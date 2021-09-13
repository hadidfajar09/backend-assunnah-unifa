@extends('layouts.bootstrap')

@section('title')
Halaman Peserta
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Data Peserta</h3>
            </div>
            <div class="card-body table-responsive">
                @include('alert.success')

                @if(Request::get('keyword'))
                <a href="{{ route('student.index') }}" class="btn btn-success">Back</a>
                @else
                <a href="{{ route('student.create') }}" class="btn btn-primary">Create</a>
                @endif


                <hr>
                <form method="get" action="{{ route('student.index') }}">
                    <div class="row">
                        <div class="col-2">
                            <b>Search Nama</b>
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" value="{{ Request::get('keyword') }}" id="keyword" name="keyword">
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-dafault">
                                <i class="fas fa-search"></i>
                            </button>

                        </div>
                    </div>
                </form>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Avatar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student as $row)
                        <tr>
                            <td>{{ $loop->iteration + ($student->perPage() * ($student->currentPage() - 1)  )  }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->gender }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->alamat }}</td>
                            <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->avatar) }}" width="150px" /></td>
                            <td>{{ $row->status }}</td>
                            <td>
                                <a href="{{ route('student.edit', [$row->id]) }}" class="btn btn-info btn-sm">Edit</a>
                                <form method="post" class="d-inline" action="{{ route('student.resetpassword',[$row->id]) }}" onsubmit="return confirm('Reset Password Pelajar ini?')">

                                    @csrf
                                    <input type="submit" value="Reset" class="btn btn-success btn-sm">
                                </form>
                                <form class="d-inline" action="{{ route('student.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Hapus Data Pelajar Ini?')">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                </form>

                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $student->appends(Request::all())->links() }}.
            </div>
        </div>
    </div>
</div>
@endsection