@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">退会確認</div>

                <div class="card-body">
                    <p>本当に退会しますか？</p>

                    <form action="{{ route('account.destroy') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">退会する</button>
                        <a href="{{ route('mypage') }}" class="btn btn-secondary">キャンセル</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
