@extends('layouts.bootstrap')

@section('title')
    Error 403
@endsection

@section('content')
<div class="error-page">
    <h2 class="headline text-danger">403</h2>
    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-danger"></i>Kamu tidak diberi akses ke menu ini</h3>
        <a href="{{ route('home') }}" class="btn btn-info">Back</a>
    </div>
</div>
@endsection