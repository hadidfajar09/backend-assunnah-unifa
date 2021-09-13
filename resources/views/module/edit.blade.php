@extends('layouts.bootstrap')

@section('title')
    Edit Data Modul
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
            <h3>Edit Materi</h3>
        </div>
        <div class="card-body">
          <a href="{{ route('module.detail',[$module->course_id]) }}" class="btn btn-info">Back</a>
            <form method="post" action="{{ route('module.update',[$module->id]) }}" enctype="multipart/form-data">
                <input type="hidden" name="course_id" value="{{ $module->course_id }}">
                @csrf
                {{ method_field('PUT') }}
                <div class="card-body">
                  
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active" @if($module->status == "active") selected @endif>Active</option>
                            <option value="inactive" @if($module->status == "inactive") selected @endif>InActive</option>
                        </select>
                        <span class="error invalid-feedback">{{$errors->first('status')}}</span>
                    </div>
                  
                    <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control {{$errors->first('title') ? 'is-invalid' : ''}}" name="title" id="title"  value="{{ $module->title }}">
                    <span class="error invalid-feedback">{{$errors->first('title')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control {{$errors->first('description') ? 'is-invalid' : ''}}" name="description" id="description">{{ $module->description }}</textarea>
                    <span class="error invalid-feedback">{{$errors->first('description')}}</span>
                  </div>

                  <div class="form-group">
                            <label for="module_type">Module Type</label>
                            <select name="module_type" id="module_type" class="form-control">
                                <option value="file" @if($module->module_type == "file") selected @endif>File</option>
                                <option value="youtube" @if($module->module_type == "youtube") selected @endif>Youtube</option>
                            </select>
                            <span class="error invalid-feedback">{{$errors->first('module_type')}}</span>
                        </div>

                  <div class="form-group" id="input-youtube">
                    <label for="youtube">Youtube</label>
                    <input type="text" class="form-control {{$errors->first('youtube') ? 'is-invalid' : ''}}" name="youtube" id="youtube"  value="{{ $module->youtube }}">
                    <span class="error invalid-feedback">{{$errors->first('youtube')}}</span>
                  </div>

                  <div class="form-group" id="input-document">
                    <label for="document">Dokumen</label>
                    <input type="file" class="form-control {{$errors->first('document') ? 'is-invalid' : ''}}" name="document" id="document">   
                    <span class="error invalid-feedback">{{$errors->first('document')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="order">Order</label>
                    <select name="order" id="order" class="form-control">
                        @for($i = 1; $i < 100; $i++)
                            <option value="{{ $i }}" @if($module->order == $i) selected @endif>{{ $i }}</option>
                        @endfor
                    </select>
                    <span class="error invalid-feedback">{{$errors->first('order')}}</span>
                  </div>


                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('costum-script')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.css') }}">
    <script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function(){
$("#description").summernote({
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
});

if($("#module_type").val() == "file"){
    $("#input-document").show();
    $("#input-youtube").hide();
}
else{
    $("#input-document").hide();
    $("#input-youtube").show();
}

$("#module_type").on('change',function(){
    if(this.value == "file"){
        $("#input-youtube").hide();
        $("#input-document").show();
    }
    else{
        $("#input-youtube").show();
        $("#input-document").hide();
    }
});

        });
        </script>

@endsection