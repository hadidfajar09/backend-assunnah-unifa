@extends('layouts.bootstrap')

@section('title')
Kategori Sampah
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3>Kategori Sampah</h3>
            </div>
            <div class="card-body table-responsive">

                <div class="row">
                    <div class="col-3">
                        <a class="btn btn-outline-primary" href="{{ route('category.index') }}">Published</a>
                        <a class="btn bg-gradient-primary" href="{{ route('category.trash') }}">Trash</a>

                    </div>
                </div>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Thumbnail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category as $row)
                        <tr>
                            <td>{{ $loop->iteration + ($category->perPage() * ($category->currentPage() - 1)  )  }}</td>
                            <td>{{ $row->name }}</td>
                            <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->thumbnail) }}" alt="" width="150px"></td>
                            <td>
                                <a href="{{ route('category.restore',[$row->id]) }}" class="btn btn-success btn-sm">Restore</a>
                                <form class="d-inline" action="{{ route('category.delete-permanen', [$row->id]) }}" method="post" onsubmit="return confirm('Hapus Kategori ini PERMANEN ?')">
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
                {{ $category->links() }}
            </div>
        </div>
    </div>
</div>

@endsection