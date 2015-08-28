<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Sabay Chashier</title>
	{!! Html::style('css/bootstrap.min.css') !!}
	{!! Html::style('css/font-awesome.min.css') !!}
	{!! Html::style('css/login.css') !!}
</head>
<body>
<div class="container">
   @yield('content')
</div>
	{!! Html::script('js/jquery-1.11.2.min.js') !!}
	{!! Html::script('js/bootstrap.min.js') !!}
	{!! Html::script('js/jquery.validate.min.js') !!}
	{!! Html::script('js/jquery.validate.bootstrap.js') !!}
@yield('script')
</body>
</html> 