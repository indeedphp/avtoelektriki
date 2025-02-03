<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    @php 
 header ('Content-Type: image/png');

$im = @imagecreatetruecolor(120, 20)
      or die('Невозможно инициализировать GD-поток');

$text_color = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 1, 5, 5,  'A Simple Text String', $text_color);
imagepng($im);
    @endphp



</body>
</html>

 
