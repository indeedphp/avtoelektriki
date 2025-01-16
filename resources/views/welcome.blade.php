<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resizable Textarea</title>


</head>
<body>

 
<form id="myForm">
  <input type="text" name="username" placeholder="Username">
  <input type="password" name="password" placeholder="Password">
  <button type="submit">Submit</button>
</form>

<script>
  const form = document.getElementById('myForm');

  form.addEventListener('submit', function(event) {
    event.preventDefault(); // Предотвращаем отправку формы
const formData = new FormData(event.target);
    {{-- const formData = new FormData(form); --}}
    console.log(formData);
    {{-- console.log('Password:', formData.get('password')); --}}
  });
</script>

</body>
</html>
