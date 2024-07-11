@extends('layouts.app')

@section('content')
<div class="container">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <div class="header-image">
            <img src="{{ asset('images/logo5.jpeg') }}" alt="Logo" style="height: 150px; width: auto;">
        </div>
        <div class="header-text text-center flex-grow-1" style="margin-left: -180px;">
            <h1>依頼確認</h1>
        </div>
    </header>
@dd($data);
    <div class="form-group">
        <label>電話番号:</label>
        <p>{{ $data['tel'] }}</p>
    </div>
    <div class="form-group">
        <label>メールアドレス:</label>
        <p>{{ $data['email'] }}</p>
    </div>
    <div class="form-group">
        <label>希望納期:</label>
        <p>{{ $data['deadline'] }}</p>
    </div>
    <div class="form-group">
        <label>内容:</label>
        <p>{{ $data['memo'] }}</p>
    </div>
    <form action="{{ route('request.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="tel" value="{{ $data['tel'] }}">
        <input type="hidden" name="email" value="{{ $data['email'] }}">
        <input type="hidden" name="deadline" value="{{ $data['deadline'] }}">
        <input type="hidden" name="memo" value="{{ $data['memo'] }}">
        <button type="submit" class="btn btn-primary">依頼送信</button>
    </form>
</div>
@endsection
