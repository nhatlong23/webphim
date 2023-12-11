<!DOCTYPE html>
<html>

<head>
    <title>Thông báo phim mới</title>
</head>

<body>
    <h1>Thông báo phim mới</h1>
    <p>Có một số phim mới được cập nhật:</p>

    @foreach ($movies as $movie)
        <p>Tên phim: {{ $movie->title }}</p>
        <p>Năm: {{ $movie->year }}</p>
        <!-- Thêm các thông tin khác về phim -->
    @endforeach
</body>

</html>
