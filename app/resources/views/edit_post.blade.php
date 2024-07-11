<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿編集画面</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
            <div class="header-image">
                <img src="{{ asset('images/logo6.jpg') }}" alt="Logo" style="height: 250px; width: auto;">
            </div>
        </div>  

        <div class="header-text ml-3">
            <h1 class="text-center">投稿編集</h1>
        </div>

        <form action="{{ route('edit.post', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" name="title" value="{{ $post->title }}"/>
            </div>

            <div class="form-group">
                <label for="amount">金額</label>
                <input type="text" class="form-control" name="amount" value="{{ $post->amount }}"/>
            </div>

            <div class="form-group">
                <label for="memo">内容</label>
                <textarea class="form-control" name="memo">{{ $post->memo }}</textarea>
            </div>

            <div class="form-group">
                <label for="image1">画像1</label>
                <input type="file" class="form-control-file" id="image1" name="image1">
                @if ($post->image1)
                    <img src="{{ asset('storage/' . $post->image1) }}" style="width: 200px; height: 200px; object-fit: cover;">
                @endif
            </div>

            <div class="form-group">
                <label for="image2">画像2</label>
                <input type="file" class="form-control-file" id="image2" name="image2">
                @if ($post->image2)
                    <img src="{{ asset('storage/' . $post->image2) }}" style="width: 200px; height: 200px; object-fit: cover;">
                @endif
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary">更新</button>
            </div>
            
        </form>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
</body>
</html>
