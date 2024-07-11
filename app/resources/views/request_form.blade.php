@extends('layouts.app')

@section('content')
<div class="container">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <div class="header-image">
            <img src="{{ asset('images/IMG_1.jpg') }}" alt="Logo" style="height: 150px; width: auto;">
        </div>
        <div class="header-text text-center flex-grow-1" style="margin-left: -180px;">
            <h1>依頼フォーム</h1>
        </div>
    </header>

    <form action="{{ route('request.confirm' ,['id'=> $id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tel">電話番号</label>
            <input type="text" class="form-control" id="tel" name="tel" required>
        </div>
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="deadline">希望納期</label>
            <input type="date" class="form-control" id="deadline" name="deadline" required>
        </div>
        <div class="form-group">
            <label for="memo">内容</label>
            <textarea class="form-control" id="memo" name="memo" rows="4" required></textarea>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('request.confirm', ['id'=> $id]) }}">
                <button class="btn btn-primary text-nowrap">依頼</button>
            </a>   
        </div>     
    </form>
</div>
@endsection






