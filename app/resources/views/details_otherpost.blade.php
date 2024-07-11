@extends('layouts.app')

@section('content')
<div class="container">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <!-- 画像を左側に配置 -->
        <div class="header-image">
            <img src="{{ asset('images/logo5.jpeg') }}" alt="Logo" style="height: 150px; width: auto;">
        </div>

        <div class="header-text text-center flex-grow-1" style="margin-left: -180px;">
            <h1>投稿詳細</h1>
        </div>
    </header>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">タイトル：{{ $post->title }}</h5>
                    <p class="card-text">投稿者：{{ $post->user->name }}</p>
                    <p class="card-text">内容：{{ $post->memo }}</p>
                    <p class="card-text">金額：{{ $post->amount }}円</p>
                    <p class="card-text">画像：{{ $post->image }}</p>
                    <p class="card-text">
                        ステータス:
                        @if($post->status == 0)
                            <span class="badge badge-success">掲載中</span>
                        @elseif($post->status == 1)
                            <span class="badge badge-warning">進行中</span>
                        @endif
                    </p>
                    <a href="{{ route('request.form', ['id' => $post->id]) }}" class="btn btn-primary">依頼する</a>
                    <a href="{{ route('vaiolation.form', ['id' => $post->id]) }}" class="btn btn-danger">違反報告</a>
                    @if($like_model->like_exist(Auth::user()->id,$post->id))
                        <p class="favorite-marke">
                        <a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart fa-2x"></i></a>
                        <span class="likesCount">{{$post->likes_count}}</span>
                        </p>
                    @else
                        <p class="favorite-marke">
                        <a class="js-like-toggle" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart fa-2x"></i></a>
                        <span class="likesCount">{{$post->likes_count}}</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
