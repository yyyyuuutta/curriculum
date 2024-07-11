@extends('layouts.app')

@section('content')

<div class="container">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <!-- 画像を左側に配置 -->
        <div class="header-image">
            <img src="{{ asset('images/logo4.jpg') }}" alt="Logo" style="height: 150px; width: auto;">
        </div>

        <div class="header-text text-center flex-grow-1" style="margin-left: -180px;">
            <h1>投稿詳細</h1>
        </div>
    </header>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 col-lg-8 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->memo }}</p>
                            <p class="card-text">{{ $post->amount }}円</p>
                            @if(!empty($post->image))
                            <img src="{{ asset('images/img/' . $post->image) }}" alt="Post Image" style="max-width: 100%; height: auto;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
