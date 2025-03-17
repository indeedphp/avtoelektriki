<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\View\View;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| TestController
|--------------------------------------------------------------------------
|
| тесты не из ларавел и пр.
|
*/

class TestController extends Controller
{
    public function index()
    {

        // Embed::make($data->links)->parseUrl()->getIframe();
//         $qq = 0;

// $qqq = 'https://www.youtube.com/embed/PlQObFkF5VI?si=RX21EZDiXIa7MR2t';
//         $qq = '<iframe width="560" height="315" src="https://www.youtube.com/embed/PlQObFkF5VI?si=RX21EZDiXIa7MR2t" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
// info(strstr($qq, '<iframe'));

// https://youtu.be/Q_YR_n7-rCE?t=3358

// $ww = 'https://www.youtube.com/watch?v=kwqLf41nsF0';


// https://www.youtube.com/watch?v=Q_YR_n7-rCE&t=3356s

// info(parse_url($ww));

// https://youtu.be/Q_YR_n7-rCE?si=r9515jRrB3ufE0I7

// https://youtu.be/Q_YR_n7-rCE?si=KEMkqs5a2m2x39ul


// $qqq = explode(' ', $qq);
//       info($qq);https://www.youtube.com/watch?v=PlQObFkF5VI
//       info($qqq[3]);


// $string = "Вот ссылка на сайт https://example.com и другая ссылка http://example.org";

// Регулярное выражение для поиска URL
// preg_match('/https?\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', $qq, $match);
// info($matches[0]);
// $matches теперь содержит массив всех найденных URL
//  echo $match[0];


//  $string = '<iframe width="560" height="315" src="https://www.youtube.com/embed/PlQObFkF5VI?si=kiJI0pXNbPzInXEm" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
// $qqq = explode(' ', $qq);

 // Регулярное выражение для поиска первого URL
//  preg_match('/https?\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', $qq, $match);
 
 // $match[0] будет содержать первый найденный URL
//  echo $match[0];
//  echo $match[1];

// print_r($match);


// $eee = 'https://youtu.be/YvqU3OJm0yw?si=D-px4biNQDUvEXOQ';
// $video_url = parse_url($eee);
// $video_id_youtube = trim($video_url['path'],'/');
// return view('welcome', compact('video_id_youtube'));


function getYouTubeVideoId($url) {
    $pattern = '#(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/]+\/[^\/]+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})#';
    preg_match($pattern, $url, $matches);
    
    return isset($matches[1]) ? $matches[1] : null;
}

// Пример использования
$url = "https://www.youtube.com/watch?v=oV7SPX9FS1c";
$videoId = getYouTubeVideoId($url);

echo "ID видео: " . $videoId;


info($videoId);




    }
}
