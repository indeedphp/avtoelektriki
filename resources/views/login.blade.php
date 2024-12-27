<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon"href="images/myicon.ico">
  <meta charset="utf-8">
  <title>toSenior_PHP</title>
  <link href="bootstrap.css" rel="stylesheet">
</head>
<body></body>

<form method="POST" action="{{ route('authentication') }}">
@csrf
  <div class="mb-3">

  @error('email')
<div>ошибка {{ $message }}</div>
@enderror



    <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    
  </div>
  <div class="mb-3">

  @error('password')
<div>ошибка {{ $message }}</div>
@enderror



    <label for="exampleInputPassword1" class="form-label">Пароль</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" >
  </div>

  <button type="submit" class="btn btn-primary">Отправить</button>
</form>

</body>
</html>



<div id='wrapper'>
  <button id='like1' value="22"> 0</button>
  <button id='like2' value="23"> 0</button>
  <button id='like3' value="24"> 0</button>
  <button id='like4' value="25"> 0</button>
</div>

<script>
const wrapper = document.getElementById('wrapper');
wrapper.addEventListener('click', (event) => {
  let like = event.target.textContent;  
            like++;
            
            event.target.textContent = ' ' +like;
          
})
</script>



