@extends('layouts.bootstrap')

@section('title')
Daftar Trash
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Daftar Trash</h3>
            </div>
            <div class="card-body table-responsive">

                <hr>
                <div class="row">
                    <div class="col-3">
                        <a class="btn btn-outline-primary" href="{{ route('course.index') }}">Published</a>
                        <a class="btn bg-gradient-primary" href="{{ route('course.trash') }}">Trash</a>
                    </div>
                </div>

                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Pengajar</th>
                            <th>Judul</th>
                            <th>Thumbnail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course as $row)
                        <tr>
                            <td>{{ $loop->iteration + ($course->perPage() * ($course->currentPage() - 1)  )  }}</td>
                            <td>{{ $row->category->name }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->title }}</td>
                            <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->thumbnail) }}" width="150px"></td>
                            <td>
                                <a href="{{ route('course.restore',[$row->id]) }}" class="btn btn-success btn-sm">Restore</a>
                                <form class="d-inline" action="{{ route('course.delete-permanen',[$row->id]) }}" method="post" onsubmit="return confirm('Hapus permanen Pelajaran ini?')">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$course->links()}}
            </div>
        </div>
    </div>
</div>
@endsection