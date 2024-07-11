@extends('layouts.app')

@section('content')
<div class="container">
    <header class="d-flex justify-content-between align-items-center">
        <!-- 画像を左側に配置 -->
        <div class="header-image">
            <img src="{{ asset('images/logo2.jpg') }}" alt="Logo" style="height: 150px; width: auto;">
        </div>

        <div class="header-text ml-3">
            <h1>スキルシェア投稿一覧</h1>
        </div>
        
        <div class="header-links">
            <div class="d-flex justify-content-end">
                <a href="{{ route('mypage') }}" class="btn btn-primary ml-2">マイページ</a>
            </div>  
        </div>
    </header>
</div>

<div class="row mt-3 justify-content-center">
    <div class="col-md-1 col-lg-5">
        <form id="searchForm" action="{{ route('home') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="ワード検索欄" value="{{ request('search') }}">
            </div>

            <div class="row mt-1 justify-content-center">
                <div class="col-md-8 col-lg-12">            
                    <label for="amount">{{ __('金額範囲指定') }}</label>
                    <select class="form-control" id="amount" name="amount">
                        <option value="0">{{ __('指定なし') }}</option>
                        <option value="1">1~999</option>
                        <option value="2">1,000~9,999</option>
                        <option value="3">10,000~49,999</option>
                        <option value="4">50,000~99,999</option>
                        <option value="5">100,000~</option>
                    </select>
                </div>
            </div>
    
            <div class="row mt-4 justify-content-center">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary" style="background-color: white; color: black;">検索</button>
                </div>
            </div>
            
        </form>
    </div>

        <div class="row justify-content-center mt-4">
            @foreach($posts as $post)
                <div class="col-6 col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->amount }}円</p>
                            <a href="{{ route('details.otherPost', $post->id) }}" class="btn btn-primary">詳細</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
</div>

<script>
    function searchPosts() {
        var query = document.getElementById('search').value;
        window.location.href = ""; 
    }
</script>
@endsection
