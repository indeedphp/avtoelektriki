<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>test</title>
</head>
<body>
<form class="m-5"  action="{{ route('draft_post_create') }}" method="post" enctype="multipart/form-data">
@csrf
<input type="file" name="image">
<button type="submit" class="btn btn-primary">Отправить</button>
</form>
</body>
</html>