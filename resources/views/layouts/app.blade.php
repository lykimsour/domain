<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>@yield('title') - Sabay Chashier</title>

	{!! Html::style('css/bootstrap.min.css') !!}
	{!! Html::style('css/font-awesome.min.css') !!}
	{!! Html::style('css/core.css') !!}
	{!! Html::style('css/skin-mysabay.css') !!}
  {!! Html::style('css/styles.css') !!}
  

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->

</head>
<body class="skin-mysabay">
  <div class="wrapper">
    <!-- Header -->
    @include('partials.header')

    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->       
      <!-- Your Page Content Here -->
      @yield('content')
	    
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('partials.footer')

  </div><!-- ./wrapper -->

{!! Html::script('js/jquery-1.11.2.min.js') !!}
{!! Html::script('js/bootstrap.min.js') !!}
{!! Html::script('js/jquery.validate.min.js') !!}
{!! Html::script('js/jquery.validate.bootstrap.js') !!}
{!! Html::script('js/lib/moment.min.js') !!}
{!! Html::script('js/lib/highcharts_4.1.5.js') !!}
{!! Html::script('js/core.js') !!}
{!! Html::script('js/jQuery.print.js') !!}
{!! Html::script('js/scripts.js') !!}
{!! Html::script('js/Chart.js') !!}
{!! Html::script('js/bootstrap-datepicker.js') !!}
<script type="text/javascript">
  
$(document).ready(function() {

  $(function () {
  $("#startdate").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());

   $("#enddate").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
  
  $("#time").click(function(){

        if($("#time").val() == 'period'){
            $('#sdate').css("visibility","visible");
            $('#edate ').css("visibility","visible");
        }
        else{
          $('#sdate').css("visibility","hidden");
          $('#edate ').css("visibility","hidden");
        }
      });
    });
});
</script>
@yield('script')

</body>
</html> 

