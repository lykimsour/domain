
  
$(document).ready(function() {
$(function () {
  var barChartData = {
    labels :<?php echo json_encode($label); ?>,
    datasets : [
      {
        label: "My dataset",
        fillColor : "rgba(151,187,205,0.2)",
        strokeColor : "rgba(151,187,205,1)",
        pointColor : "rgba(151,187,205,1)",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(151,187,205,1)",
        data : <?php echo json_encode($data); ?>
      }
    ]
  }
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
        if($("#time").val() != "period"){
            $("#sdate").hide(1);
          $("#edate").hide(1);
        }
        else{
           $("#sdate").show(1);
            $("#edate").show(1);
         
        }
      });

    });
});