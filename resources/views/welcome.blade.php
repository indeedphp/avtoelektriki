<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resizable Textarea</title>
    {{-- <style>
        /* textarea {
            width: 100%;
            min-height: 50px; /* минимальная высота */
            max-width: 100%;
            resize: none; /* отключение стандартного изменения размера */
            overflow: hidden; /* скрывает полосу прокрутки */
            padding: 8px;
            box-sizing: border-box;
        } */
    </style> --}}
    {{-- <style>
    textarea {
     
      height: 5vh; /* Адаптивная высота */
    }
</style>  --}}

</head>
<body>

  <div contenteditable="true">gffgfdg</div>
    




    <textarea id="textarea" height="255"; >пррпорпорпопо
      лрлорлор
      гшщгщшгщзг
      ролрлррлоролрл
      олрлрлдо
    </textarea>

    <script>
        const textarea = document.getElementById('textarea');
        function adjustHeight() {
            textarea.style.height = 'auto'; // сброс высоты
            textarea.style.height = textarea.scrollHeight + 'px'; // установка новой высоты
            console.log(textarea.scrollHeight);
        }
        textarea.addEventListener('input', adjustHeight);
        adjustHeight();
    </script>

</body>
</html>
