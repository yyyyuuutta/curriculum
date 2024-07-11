@extends('layouts.app')

@section('content')
<div class="container">
    <div class='d-flex justify-content-between'>
        <a href="{{ route('account.delete') }}">
            <button class='btn btn-danger'>退会</button>
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                @if(empty(Auth::user()->image))
                <div class="rounded-circle bg-secondary text-white text-center" style="width: 200px; height: 200px; line-height: 200px; font-size: 32px;">
                    NO ICON
                </div>
                @elseif(!empty(Auth::user()->image))
                <img src="{{ asset('images/img/' . Auth::user()->id . '/' . Auth::user()->image) }}" style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%;">
                @endif
                    <div class="text-center mt-3 font-weight-bold">
                    <div class="mb-2">ユーザーネーム: {{ Auth::user()->name }}</div>
                    <div class="mb-2">メールアドレス: {{ Auth::user()->email }}</div>
                    <div>自己紹介: {{ Auth::user()->profile_text }}</div>
        </div>

        <div class="text-center mt-3 font-weight-bold">
            &nbsp;&nbsp;&nbsp; <!-- スペースを挿入 -->
            <a href="{{ route('edit.myacount', ['id' => Auth::user()->id]) }}">プロフィール編集</a>
            &nbsp;&nbsp;&nbsp; <!-- スペースを挿入 -->
            <a href="{{ route('newpost') }}">新規投稿</a>
            &nbsp;&nbsp;&nbsp; <!-- スペースを挿入 -->
        </div>


            <div class="row justify-content-center mt-4">
                @foreach($posts as $post)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->amount }}円</p>
                                <a href="{{ route('details.post', ['post' => $post->id]) }}" class="btn btn-primary">詳細</a>
                                <a href="{{ route('edit.post', ['posts' => $post['id']]) }}" class="btn btn-primary">編集</a>
                                <a href="{{ route('delete.post', ['posts' => $post['id']]) }}" class="btn btn-danger">削除</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <a href="{{ route('offer.post') }}">
                <button class="btn btn-primary text-nowrap">依頼を受けた投稿</button>
            </a>        
        </div>
    </div>
</div>
@endsection