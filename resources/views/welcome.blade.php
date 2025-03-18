<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Предпросмотр видео с YouTube</title>
</head>
<body>


    <p id="myParagraph">Текст перед ссылкой.</p>

    <script>
        // Найдем элемент <p> по id
        var pElement = document.getElementById("myParagraph");

        // Добавим ссылку внутрь тега <p>
        pElement.innerHTML += ' <a href="https://www.example.com">Перейти на сайт</a>';
    </script>


</body>

</html>
