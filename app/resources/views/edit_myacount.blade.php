<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー編集画面</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
            <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
                <div class="header-image">
                    <img src="{{ asset('images/logo7.jpg') }}" alt="Logo" style="height: 250px; width: auto;">
                </div>
            </div>  
        <form action="{{ route('edit.myacount', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">ユーザーアイコン</label>
                <input type="file" class="form-control-file" name="image" accept="image/*">
            </div>

            <div class="form-group">
                <label for="name">ユーザー名</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}"/>
            </div>

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <textarea class="form-control" name="email">{{ $user->email }}</textarea>
            </div>

            <div class="form-group">
                <label for="profile_text">プロフィール</label>
                <textarea class="form-control" name="profile_text">{{ $user->profile_text }}</textarea>
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
