<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Предпросмотр видео с YouTube</title>
</head>
<body>
    <h1>Предпросмотр видео с YouTube</h1>
    <label for="youtube-url">Вставьте ссылку на видео YouTube:</label>
    <input type="text" id="youtube-url" placeholder="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
    
    <div id="video-preview">
        <iframe id="preview-iframe" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <script src="script.js"></script>
</body>



<script>
document.getElementById('youtube-url').addEventListener('input', showPreview);

function showPreview() {
    // Получаем URL из поля ввода
    const url = document.getElementById('youtube-url').value;
    
    // Обновленное регулярное выражение для поддержания обоих форматов ссылок
    const regex = /(?:https?:\/\/(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*\?v=))([\w-]+)|(?:https?:\/\/youtu\.be\/)([\w-]+)/;
    const match = url.match(regex);
    
    if (match) {
        // Если ссылка обычного формата youtube.com
        const videoId = match[1] || match[2];
        const iframe = document.getElementById('preview-iframe');
        iframe.src = `https://www.youtube.com/embed/${videoId}`;
    } else {
        // Если ссылка некорректная, очищаем iframe
        document.getElementById('preview-iframe').src = '';
    }
}

</script>



</html>
