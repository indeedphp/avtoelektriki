<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Скрытие/Показ элемента через hidden</title>
</head>
<body>
    <h2>Используйте чекбокс для управления видимостью через hidden</h2>
    
    <!-- Чекбокс -->
    <label>
        <input type="checkbox" id="toggleCheckbox"> Показать/скрыть блок
    </label>
    <br><br>
    
    <!-- Элемент, видимость которого будет изменяться -->
    <div id="myDiv" hidden>
        Это скрываемый блок
    </div>

    <script>
        const checkbox = document.getElementById('toggleCheckbox');
        const div = document.getElementById('myDiv');
        
        // Обработчик события для чекбокса
        checkbox.addEventListener('change', function() {
            // Если чекбокс выбран, убираем атрибут hidden, показываем блок
            if (checkbox.checked) {
                div.removeAttribute('hidden');
            } else {
                div.setAttribute('hidden', true); // Добавляем атрибут hidden, скрываем блок
            }
        });
    </script>
</body>
</html>



 
