{{-- @extends('layouts/main') 

@section('posts')  



<x-posts :posts="$posts"/>

@section('hidden') 
<x-hidden-comment />
<x-hidden-reply />
@endsection 

 @endsection  --}}


 <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сделать элемент ссылкой</title>
</head>
<body>

<!-- Элемент, который будет ссылкой -->
<div id="myElement">Нажми на меня, чтобы перейти на Google</div>

<script>
    // Получаем элемент по ID
    var element = document.getElementById("myElement");

    // Добавляем обработчик клика
    element.addEventListener("click", function() {
        window.open("https://www.google.com", "_blank");  // Переход на Google в новом окне или вкладке
    });

    // Или можно изменить сам элемент в ссылку, если это нужно
    // element.innerHTML = '<a href="https://www.google.com" target="_blank">Перейти на Google</a>';
</script>

</body>
</html>
