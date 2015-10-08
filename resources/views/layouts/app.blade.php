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
  {!! Html::style('css/bootstrap-datetimepicker.min.css') !!}
  {!! Helper::langStylesheet() !!}

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
{!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
{!! Html::script('js/lib/highcharts_4.1.5.js') !!}
{!! Html::script('js/core.js') !!}
{!! Html::script('js/jQuery.print.js') !!}
{!! Html::script('js/Chart.js') !!}
{!! Html::script('js/scripts.js') !!}

<script type="text/javascript">
  
$(document).ready(function() {
$(function () {
  window.onload = function(){
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx).Bar(barChartData, {
      responsive: true
    });

    var gettime = document.getElementById("time");
    var time = gettime.options[gettime.selectedIndex].text;
      $("#sdate").hide();
      $("#edate").hide();
      $("#from").hide();
      $("#to").hide();
    if(time == "Period"){
      $("#sdate").show();
      $("#edate").show();
     document.getElementById("sdateid").value = document.getElementById("from").innerHTML;
     document.getElementById("edateid").value = document.getElementById("to").innerHTML;
    }
  }
  
  $("#startdate").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());

   $("#enddate").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());

  $("#time").change(function(){
        if($("#time").val() == "period"){
             $("#sdate").show();
             $("#edate").show();
        }
        else{
          $("#sdate").hide();
          $("#edate").hide();
        }
      });

    });
});
</script>

<script type="text/javascript">
  
  $('.form_date').datetimepicker({
    language:  'en',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
</script>

@yield('script')

</body>
</html> 

