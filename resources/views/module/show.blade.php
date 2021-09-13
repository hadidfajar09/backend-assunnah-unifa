@extends('layouts.bootstrap')

@section('title')
    Detail Modul
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Detail Modul - {{ $module->title }}</h3>
        </div>
        <div class="card-body table-responsive">
            <a href="{{ route('module.detail',[$module->course_id]) }}" class="btn btn-info">Back</a>
            <hr>
            <table class="table table-bordered">

		        <tr>
                    <td>Judul</td>
                    <td>:</td>
                    <td>{{ $module->title }}</td>
                </tr>

                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td>{!!$module->description!!}</td>
                </tr>

                <tr>
                    <td>Modul Type</td>
                    <td>:</td>
                    <td>
                        {{ $module->module_type }}
                        @if($module->module_type == "file")
                        / {{ $module->file_type }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>Modul</td>
                    <td>:</td>
                    <td>
                        @if($module->module_type == "file")
                        <a href="{{ route('module.download',[$module->id]) }}" class="btn btn-info btn-sm" >Download</a>
                        @else
                        <iframe width="720" height="480" src="https://www.youtube.com/embed/{{ $module->youtube }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @endif
                    </td>
                </tr>


            </table>
        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>
  </div>
@endsection