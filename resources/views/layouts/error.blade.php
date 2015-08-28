<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Error - @yield('title')</title>
	{!! Html::style('css/bootstrap.min.css') !!}
	<style type="text/css">
	body{
		padding-top: 50px;
	}
	.error-area{
		border: 1px solid #EC9794;
		background: #FEEBE7;
		color: #222222;
		text-align: center;
		max-width: 400px;
		margin: 0 auto;
	}
	.error-area h1{
		font-size: 20px;
	}
	</style>
</head>
<body>
<div class="container">
   @yield('content')
</div>
</body>
</html> 