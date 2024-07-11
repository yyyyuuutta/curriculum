@extends('layouts.app')

@section('content')
<div class="container">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <div class="header-image">
            <img src="{{ asset('images/logo5.jpeg') }}" alt="Logo" style="height: 150px; width: auto;">
        </div>
        <div class="header-text text-center flex-grow-1" style="margin-left: -180px;">
            <h1>違反フォーム</h1>
        </div>
    </header>

    <form action="{{ route('violation.form', ['id' => $post->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="report">内容</label>
            <input type="text" class="form-control" id="report" name="report" required>
        </div>
        <button type="submit" class="btn btn-primary">違反報告</button>
    </form>
</div>
@endsection
