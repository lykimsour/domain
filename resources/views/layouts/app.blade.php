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
{!! Html::script('js/bootstrap-datepicker.js') !!}

{!! Html::script('js/jquery.datetimepicker.js') !!}

{!! Html::script('js/lib/highcharts_4.1.5.js') !!}
{!! Html::script('js/core.js') !!}
{!! Html::script('js/jQuery.print.js') !!}
{!! Html::script('js/Chart.js') !!}
{!! Html::script('js/scripts.js') !!}

<script type="text/javascript">
  
$(document).ready(function() {
  window.onload = function(){
    $("#duration").hide();
    if($("#datevalue").val() == 'null'){
       $("#dateadded1").val(null);
    }
    else{
      $("#dateadded").val($("#datevalue").val());
    }
      $("#sdate").hide();
      $("#edate").hide();
      $("#sdate1").hide();
      $("#edate1").hide();
      $("#from").hide();
      $("#to").hide();

    if(time == "Period"){
      $("#sdate").show();
      $("#edate").show();
      var from = $("#from").text();
      var to = $("#to").text();
      $("#sdateid").val(from);
      $("#edateid").val(to);
    }
    if($("#itemtype").val() == "periodic"){
       $("#duration").show();
    }
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx).Bar(barChartData, {responsive: true});
    var gettime = document.getElementById("time");
    var time = gettime.options[gettime.selectedIndex].text;
  }
  $("#dateadded").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
  
  $("#startdate").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());

   $("#enddate").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());

  $("#time").change(function(){
        if($("#time").val() != "period"){
            $("#sdate").hide(1);
            $("#edate").hide(1);

        }
        else{
            $("#sdate").show(1);
            $("#edate").show(1);
        }
      });
  $("#roleid").change(function(){
          var url = "{{URL::to('/permissionrole/create')}}" + "/" + $("#roleid").val();
          $("#method").val("GET");
          $("#createform").attr("action",url);
          $("#createform").submit();
  });

  $("#gametype").change(function(){
          var url = "{{URL::to('/item/game')}}" + "/" + $("#gametype").val();
          $("#getgametype").attr("action",url);
          $("#getgametype").submit();
  });

$("#newgametype").change(function(){
          var url = "{{URL::to('/item/create')}}" + "/" + $("#newgametype").val();
          $("#method1").val("GET");
          $("#additem").attr("action",url);
          $("#additem").submit();
  });

 $("#gametypeforgroup").change(function(){
          var url = "{{URL::to('/itemgroup/game')}}" + "/" + $("#gametypeforgroup").val();
          $("#getgametypeforgroup").attr("action",url);
          $("#getgametypeforgroup").submit();
  });
 $("#gametypefortype").change(function(){
          var url = "{{URL::to('/itemtype/game')}}" + "/" + $("#gametypefortype").val();
          $("#getgametypefortype").attr("action",url);
          $("#getgametypefortype").submit();
  });

  $("#back").click(function(){
     window.history.back();
  });
  
   $("#itemtype").change(function(){
        if($("#itemtype").val() == "3"){
          $("#duration").show();
        }
        else{
            $("#duration").hide();
        }
       
      });
});

</script>
@yield('script')

</body>
</html> 

