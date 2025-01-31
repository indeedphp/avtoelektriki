<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление смайлов</title>
    <style>
        /* Стили для кнопки, чтобы она не была видна */
        button {
            all: unset; /* Убираем все стили кнопки */
            cursor: pointer; /* Добавляем указатель, чтобы был виден клик */
            color: #007bff; /* Цвет текста, можно изменить */
            font-size: 18px; /* Размер текста */
        }
        button:hover {
            color: #0056b3; /* Цвет текста при наведении */
        }
    </style>
</head>
<body>
    ytyu
    <div contenteditable="true" id="editable" style="border: 1px solid #ccc; padding: 10px; min-height: 100px;">
        Напишите что-то здесь...
    </div>
    <!-- Кнопка для вставки смайлика -->
    <button onclick="insertEmoji3('😊')">😊</button>

    <script>
        function insertEmoji3(eji) {

            const element = document.elementFromPoint(event.clientX, event.clientY);
            console.log(element);
// document.addEventListener('mousemove', function(event) {
//     const element = document.elementFromPoint(event.clientX, event.clientY);
//     console.log(element);  // Выводим элемент в консоль
// });

    
        }

        
function SetCursorAfterElement(element)
{
    var selection = window.getSelection();
    selection.removeAllRanges();
    var range = document.createRange();
    range.setStartAfter(element);
    selection.addRange(range);
} 




    </script>
 </body>
 </html>


{{-- <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление смайлов</title>
    <style>
        /* Стили для кнопки, чтобы она не была видна */
        button {
            all: unset; /* Убираем все стили кнопки */
            cursor: pointer; /* Добавляем указатель, чтобы был виден клик */
            color: #007bff; /* Цвет текста */
            font-size: 18px; /* Размер текста */
        }
        button:hover {
            color: #0056b3; /* Цвет текста при наведении */
        }
    </style>
</head>
<body>
<p>123456789</p>
    <div contenteditable="true" id="editable" style="border: 1px solid #ccc; padding: 10px; min-height: 100px;">
        Напишите что-то здесь...
    </div>
    <!-- Кнопка для вставки смайлика -->
    <button onclick="insertEmoji('😊')">Добавить смайлик 😊</button>

    <script>
        function insertEmoji(emoji) {
            const editableDiv = document.getElementById('editable');
            const selection = window.getSelection();
            const range = selection.getRangeAt(0); // Получаем текущий диапазон выделения

            // Проверяем, если курсор не в конце текста (пустое выделение), вставляем смайлик в текущую позицию
            if (range.collapsed) {
                const emojiNode = document.createTextNode(emoji); // Создаем текстовый узел со смайликом
                range.insertNode(emojiNode); // Вставляем смайлик в текущую позицию курсора

                // После вставки смайлика восстанавливаем курсор сразу после него
                range.setStartAfter(emojiNode);
                range.setEndAfter(emojiNode);
            } else {
                // Если выделен текст, заменяем его на смайлик
                range.deleteContents(); // Удаляем выделенный текст
                const emojiNode = document.createTextNode(emoji);
                range.insertNode(emojiNode); // Вставляем смайлик на место выделенного текста
            }

            // Восстанавливаем курсор после вставки смайлика
            selection.removeAllRanges();
            selection.addRange(range);

            // Чтобы текст был снова виден, прокручиваем вниз, если необходимо
            editableDiv.scrollTop = editableDiv.scrollHeight;
        }
    </script>
</body>
</html> --}}




{{-- <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Определение положения курсора</title>
</head>
<body>

    <button id="startButton">Нажмите, чтобы отслеживать курсор</button>

    <script>
        const button = document.getElementById('startButton');
        let isTracking = false;

        // Функция для начала отслеживания курсора
        button.addEventListener('click', function() {
            isTracking = true;
            console.log('Отслеживание курсора включено!');
            
            // Добавляем обработчик для отслеживания положения курсора
            document.addEventListener('mousemove', trackCursor);
        });

        // Функция для отслеживания положения курсора
        function trackCursor(event) {
            if (isTracking) {
                const element = document.elementFromPoint(event.clientX, event.clientY);
                console.log(element);  // Выводим элемент в консоль
            }
        }
    </script>

</body>
</html> --}}



{{-- <span class="btn p-0 " style="user-select: none" onclick="insertEmoji('😊')">😊</span>
                                        <span class="btn p-0 " style="user-select: none" onclick="insertEmoji('👍')">👍</span>
                                        <span class="btn p-0 " style="user-select: none" onclick="insertEmoji('👌')">👌</span>
                                        <span class="btn p-0 " style="user-select: none" onclick="insertEmoji('😂')">😂</span> --}}


                                        {{-- function insertEmoji(emoji) {
                                            const editableDiv = document.getElementById('post_url');
                                            const selection = window.getSelection();
                                            const range = selection.getRangeAt(0); // Получаем текущий диапазон выделения
                                        
                                            const emojiNode = document.createTextNode(emoji); // Создаем текстовый узел со смайликом
                                            range.insertNode(emojiNode); // Вставляем смайлик в текущую позицию курсора
                                        
                                            // После вставки смайлика восстанавливаем курсор после него
                                            range.setStartAfter(emojiNode);
                                            range.setEndAfter(emojiNode);
                                            selection.removeAllRanges();
                                            selection.addRange(range);
                                        } --}}
                                                                           