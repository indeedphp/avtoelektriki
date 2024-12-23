<form method="POST" action="{{ route('registerCreate') }}">
@csrf
<label>name</label>
<input type="text" name="name" value="">
<label>Email</label>
<input type="email" name="email" value="">
<label>Пароль</label>
<input type="password" name="password" value="">
<button type="submit">отправить</button>
</form>



