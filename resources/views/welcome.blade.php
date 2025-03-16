@extends('layouts/main') 

@section('posts')  

{{-- <div class="ratio ratio-16x9">
    <iframe src="https://www.youtube.com/embed/{{$video_id_youtube}}" title="YouTube video" allowfullscreen></iframe>
  </div> --}}

  {{-- <iframe width="560" height="315" src="https://www.youtube.com/embed/kwqLf41nsF0?si=w71nuBReYYpQH-jC" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}
{{-- @php
    $string = "привет https://example.com вот ссылка";
    $formattedString = preg_replace_callback(
        '/https?\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', 
        function ($matches) {
            return '<a href="' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
        },
        $string
    );
@endphp
{!! $formattedString !!} --}}



{{-- <script>
let text = "привет http://example.com вот ссertretrterылка";
let formattedText = text.replace(
  /https?\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/g, 
  function(url) {
    return `<a href="${url}" target="_blank">${url}</a>`;
  }
);
document.body.innerHTML = formattedText;
</script> --}}


{{-- https://youtu.be/kwqLf41nsF0?si=pHDVrk0w74Zw8Gah --}}
{{-- https://www.youtube.com/watch?v=kwqLf41nsF0 --}}

@endsection 

 

             {{-- <div class="card-text pt-2">
                    <div id="span_text_post" class="px-1">выводим текст под фото</div>
                    <div class="text-end pb-1 pe-1"> <a id="a_collapse_post" class="link-underline-light p-0 user-select-none"
                            href="#collapseExample1" data-bs-toggle="collapse" data-bs-target="js collapse"
                            aria-expanded="false" aria-controls="collapseExample"></a>
                    </div>
                </div> --}}