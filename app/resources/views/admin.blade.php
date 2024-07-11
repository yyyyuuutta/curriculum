@extends('layouts.app')

@section('content')
<div class="container">
    <header class="d-flex justify-content-between align-items-center position-relative">
        <!-- 画像を左側に配置 -->
        <div class="header-image">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="height: 150px; width: auto;">
        </div>
        <div class="header-text text-center position-absolute w-100">
            <h1 class="m-0">管理者ページ</h1>
        </div>
    </header>


    <div class="row mt-4">
        <!-- ユーザーリスト -->
        <div class="col-md-6">
            <h2>ユーザーリスト</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>表示停止件数</th>
                        <th>ユーザー名</th>
                        <th>アクション</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->disabled_post_count }}件</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <form action="" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <a href="{{ route('delete.account', ['users' => $user['id']]) }}" class="btn btn-danger">利用停止</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- 投稿リスト -->
        <div class="col-md-6">
            <h2>投稿リスト</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>違反報告件数</th>
                        <th>投稿タイトル</th>
                        <th>アクション</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->spam_count }}件</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <form action="{{ route('softdelete.post', ['post' => $post->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-danger">表示停止</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
