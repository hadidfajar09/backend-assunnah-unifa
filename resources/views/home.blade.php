@extends('layouts.bootstrap')

@section('title')

Home

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <h3>Dashboard</h3>
        <hr>
    </div>


    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $pengajar }}</h3>
                <p>Pengajar</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $course }}</h3>
                <p>Pelajaran</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
        </div>
    </div>
 
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $module }}</h3>
                <p>Modul</p>
            </div>
            <div class="icon">
                <i class="fas fa-bookmark"></i>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $student }}</h3>
                <p>Peserta</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-alt"></i>
            </div>
        </div>
    </div>





</div>

@endsection