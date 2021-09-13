@extends('layouts.bootstrap')

@section('title')
    Detail Pelajaran - {{ $course->title }}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Detail Pelajaran - {{ $course->title }}</h3>
        </div>
        <div class="card-body table-responsive">
            <a href="{{ route('course.index') }}" class="btn btn-info">Back</a>
            <hr>
            <table class="table table-bordered">
		 <tr>
             <td>Judul</td>
             <td>:</td>
             <td>{{ $course->title }}</td>
         </tr>

         <tr>
            <td>Kategori</td>
            <td>:</td>
            <td>{{ $course->category->name }}</td>
        </tr>

        <tr>
            <td>Pengajar</td>
            <td>:</td>
            <td>{{ $course->user->name }}</td>
        </tr>

        <tr>
            <td>Deskripsi</td>
            <td>:</td>
            <td>{{ $course->description }}</td>
        </tr>

        <tr>
            <td>Group</td>
            <td>:</td>
            <td>{{ $course->group }}</td>
        </tr>

        <tr>
            <td>Thumbnail</td>
            <td>:</td>
            <td><img class="img-thumbnail" src="{{ asset('uploads/'.$course->thumbnail) }}" width="150px"></td>
        </tr>

            </table>
        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>
  </div>




  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Detail Pelajaran - {{ $course->title }}<h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
		<thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Module Type</th>
                    <th>Module</th>
                    <th>View</th>
                    <th>Status</th>
                </tr>
		</thead>
                <tbody>
                    @foreach($module as $row)
                <tr>
                    <td>{{ $row->title }}</td>
                    <td>{!! $row->description !!}</td>
                    <td>{{ $row->module_type }}
                        @if($row->module_type == "file")
                            /{{$row->file_type}}
                        @endif

                    </td>
                    <td>
                        @if($row->module_type == "file")
                            <a href="{{ route('course.download',[$row->id]) }}" class="btn btn-info btn-sm">Download</a>
                        @else
                        <iframe width="200" height="100" src="https://www.youtube.com/embed/{{ $row->youtube }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @endif
                    </td>

                    <td>{{ $row->view }}</td>
                    <td>{{ $row->status }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>
  </div>
@endsection