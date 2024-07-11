<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>新規投稿画面</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
                <div class="header-image">
                    <img src="{{ asset('images/logo3.jpeg') }}" alt="Logo" style="height: 250px; width: auto;">
                </div>
            </div>  

            <div class="header-text ml-3">
                <h1 class="text-center">新規投稿</h1>
            </div>

            <form action="{{ route('create.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="タイトルを入力">
                </div>
                <div class="form-group">
                    <label for="amount">金額</label>
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="金額を入力">
                </div>
                <div class="form-group">
                    <label for="memo">内容</label>
                    <textarea class="form-control" id="memo" name="memo" rows="5" placeholder="内容を入力"></textarea>
                </div>
                <div class="form-group">
                    <label for="image1">画像1</label>
                    <input type="file" class="form-control-file" id="image1" name="image1">
                </div>
                <div class="form-group">
                    <label for="image2">画像2</label>
                    <input type="file" class="form-control-file" id="image2" name="image2">
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary">投稿</button>
                </div>
            </form>
        </div>
    </body>
</html>
