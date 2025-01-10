<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resizable Textarea</title>


</head>
<body>

 
  
  <span class="smile">😀</span>
  <span class="smile">👍</span>
  <span class="smile">👌</span>
  <span class="smile">😂</span>
  <span class="smile">😎</span>
  <div>
    <span class="smile">👎</span>
    <span class="smile">💩</span>
    <span class="smile">😈</span>
    <span class="smile">☠</span>
    <span class="smile">😪</span>
    </div>



  <form name="form1" method="post" action="">
    <input type="text" name="textfield" class = 'edit'>
  </form>

  <script>
    window.addEventListener('click', function(event){
      if (event.target.classList.contains('smile'))
      {
     
        let edit = document.querySelector('.edit');
        edit.value += event.target.textContent;
      }
    });

    </script>

</body>
</html>
<span class="">'😀'</span>

<code class="  language-javascript"><span class="token punctuation">[</span><span class="">'😀'</span><span class="token punctuation">,</span> <span class="">'😁'</span><span class="token punctuation">,</span> <span class="">'😂'</span><span class="token punctuation">,</span> <span class="">'😃'</span><span class="token punctuation">,</span> <span class="">'😄'</span><span class="token punctuation">,</span> <span class="">'😅'</span><span class="token punctuation">,</span> <span class="">'😆'</span><span class="token punctuation">,</span> <span class="">'😇'</span><span class="token punctuation">,</span> <span class="">'😈'</span><span class="token punctuation">,</span>
  <span class="">'😉'</span><span class="token punctuation">,</span> <span class="">'😊'</span><span class="token punctuation">,</span> <span class="">'😋'</span><span class="token punctuation">,</span> <span class="">'😌'</span><span class="token punctuation">,</span> <span class="">'😍'</span><span class="token punctuation">,</span> <span class="">'😎'</span><span class="token punctuation">,</span> <span class="">'😏'</span><span class="token punctuation">,</span> <span class="">'😐'</span><span class="token punctuation">,</span> <span class="">'😑'</span><span class="token punctuation">,</span>
  <span class="">'😒'</span><span class="token punctuation">,</span> <span class="">'😓'</span><span class="token punctuation">,</span> <span class="">'😔'</span><span class="token punctuation">,</span> <span class="">'😕'</span><span class="token punctuation">,</span> <span class="">'😖'</span><span class="token punctuation">,</span> <span class="">'😗'</span><span class="token punctuation">,</span> <span class="">'😘'</span><span class="token punctuation">,</span> <span class="">'😙'</span><span class="token punctuation">,</span> <span class="">'😚'</span><span class="token punctuation">,</span>
  <span class="">'😛'</span><span class="token punctuation">,</span> <span class="">'😜'</span><span class="token punctuation">,</span> <span class="">'😝'</span><span class="token punctuation">,</span> <span class="">'😞'</span><span class="token punctuation">,</span> <span class="">'😟'</span><span class="token punctuation">,</span> <span class="">'😠'</span><span class="token punctuation">,</span> <span class="">'😡'</span><span class="token punctuation">,</span> <span class="">'😢'</span><span class="token punctuation">,</span> <span class="">'😣'</span><span class="token punctuation">,</span>
  <span class="">'😤'</span><span class="token punctuation">,</span> <span class="">'😥'</span><span class="token punctuation">,</span> <span class="">'😦'</span><span class="token punctuation">,</span> <span class="">'😧'</span><span class="token punctuation">,</span> <span class="">'😨'</span><span class="token punctuation">,</span> <span class="">'😩'</span><span class="token punctuation">,</span> <span class="">'😪'</span><span class="token punctuation">,</span> <span class="">'😫'</span><span class="token punctuation">,</span> <span class="">'😬'</span><span class="token punctuation">,</span>
  <span class="">'😭'</span><span class="token punctuation">,</span> <span class="">'😮'</span><span class="token punctuation">,</span> <span class="">'😯'</span><span class="token punctuation">,</span> <span class="">'😰'</span><span class="token punctuation">,</span> <span class="">'😱'</span><span class="token punctuation">,</span> <span class="">'😲'</span><span class="token punctuation">,</span> <span class="">'😳'</span><span class="token punctuation">,</span> <span class="">'😴'</span><span class="token punctuation">,</span> <span class="">'😵'</span><span class="token punctuation">,</span>
  <span class="">'😶'</span><span class="token punctuation">,</span> <span class="">'😷'</span><span class="token punctuation">,</span> <span class="">'😸'</span><span class="token punctuation">,</span> <span class="">'😹'</span><span class="token punctuation">,</span> <span class="">'😺'</span><span class="token punctuation">,</span> <span class="">'😻'</span><span class="token punctuation">,</span> <span class="">'😼'</span><span class="token punctuation">,</span> <span class="">'😽'</span><span class="token punctuation">,</span> <span class="">'😾'</span><span class="token punctuation">,</span> <span class="">'😿'</span><span class="token punctuation">,</span>
  <span class="">'🙀'</span><span class="token punctuation">,</span> <span class="">'💩'</span><span class="token punctuation">,</span> <span class="">'☠'</span><span class="token punctuation">,</span> <span class="">'👌'</span><span class="token punctuation">,</span> <span class="">'👍'</span><span class="token punctuation">,</span> <span class="">'👎'</span><span class="token punctuation">,</span> <span class="">'🙈'</span><span class="token punctuation">,</span> <span class="">'🙉'</span><span class="token punctuation">,</span> <span class="">'🙊'</span><span class="token punctuation">]</span></code>
