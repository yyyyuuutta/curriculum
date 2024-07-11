@extends('layouts.app')

@section('content')
<div class="container">
    <h1>依頼一覧</h1>
    @if($posts->isEmpty())
        <p>依頼がありません。</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>タイトル</th>
                    <th>金額</th>
                    <th>メモ</th>
                    <th>ステータス</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->amount }}</td>
                    <td>{{ $post->memo }}</td>
                    <td><a href="{{ route('complete.post', ['post' => $post['id']]) }}">完了にする</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
            <a href="{{ url('/mypage') }}">
                <button class="btn btn-primary text-nowrap">マイページへ</button>
            </a>  
</div>
 
@endsection
