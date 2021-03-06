
@extends('layouts.app')
<?php
 $data  = []; 
  $label = [];
?>
@section('content')

<div class="container-fluid">

<h2>{{trans('Report:Credit_To_Reseller')}}</h2>
<div class="row">
<form method="post" action="{{route('queryreportcredittoreseller')}}">
  {!! csrf_field() !!}
 <div class="table-responsive list-group-item">  
   <div class="col-md-2">
          <div class="form-group">
             <label for="name">{{trans('Time')}}</label>
                <?php $times=["all"=>"All","today"=>"Today","week"=>"Week","month"=>"Month","year"=>"Year","period"=>"Period"]; ?>
               {!! Form::select('time',$times,$time,['class'=>'form-control','id'=>'time']) !!}
          </div>
           <button type="submmit" class="btn btn-md btn btn-danger">Show</button>
  </div> 
  <div class="col-md-3" id="sdate">
          <div class="form-group">
              <label for="name" >{{trans('Start_Date')}}</label><br/>
                <div class="input-group date" data-date-format="MM-dd-yyyy" id="startdate"  >
                    <input type='text' class="form-control" name="startdate" id="sdateid"  />
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
          </div>
  </div>
   <div class="col-md-3" id="edate">
          <div class="form-group">
              <label for="name">{{trans('End_Date')}}</label><br/>
                <div class="input-group date" data-date-format="MM-dd-yyyy" id='enddate'>
                    <input type='text' class="form-control" name="enddate" id="edateid"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
          </div>
  </div>  
</div>
</form>
</div><br/>
 <div style="width:100%">
            <div>
              <canvas id="canvas" height="250" width="900"></canvas>
            </div>
  </div>


<div class="row">
    <div class="col-md-12">
       <ul class="list-group">
      <li class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>
          <span>Report</span> 
      </li>
    <div class="table-responsive list-group-item"> 
      <table class="table table-bordered table-hover table-condensed" >
               <thead>
                {!! $reports->render() !!}
                <tr>
                  <th>ID</th>
                  <th>From_Reseller_Id</th>
                  <th>Record_Count</th>
                  <th>Amount</th>
                </tr>
            </thead>
             <tbody>
             <?php $total = 0;?>
               @foreach($chart as $chart)
                <?php  
                array_push($data, $chart->total); 
                $date = strtotime($chart->date);
                if($time == 'all') $date = date('Y',$date);
                elseif($time == 'year') $date = date('Y-M',$date);
                else $date = date('Y-M-d',$date);
                array_push($label,$date);
              ?>
              @endforeach
              @foreach($reports as $report)
              <tr>
                  <td>{{$report->id}}</td>
                  <td>{{$report->fromreseller->name}}</td>
                  <td>{{$report->recordcount}}</td>
                  <td>{{$report->total}}</td>
                    <td><a href="{{route('detailcredittoreseller',['id'=>$report->id,'time'=>$time,'startdate'=>$from,'enddate'=>$to])}}">Detail</a></td>
                    <?php 
                    $total = $report->total + $total  ?>
              </tr>

          @endforeach
            </tbody>
          </table>
      <div class="table-responsive list-group-item">    
          <table class="table table-bordered table-hover table-condensed" >
             <tr><td><li class="list-group-item"><b>Sub_Total: {{$total}} COIN</b></li></span></td></tr>
          <tr><td> <li class="list-group-item"><b>Total:  {{$totalall}} COIN</b></li></span></td></tr>
          </table>
      </div>

    </div>

</ul>

</div>
</div>

  </div>
<div id="from">{{$from}}</div>
<div id="to">{{$to}}</div>
<script type="text/javascript">
 
var barChartData = {
   
    labels: <?php echo json_encode($label); ?>,
      datasets : [
      {
        label: "My dataset",
        fillColor : "rgba(151,187,205,0.2)",
        strokeColor : "rgba(151,187,205,1)",
        pointColor : "rgba(151,187,205,1)",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(151,187,205,1)",
        data: <?php echo json_encode($data); ?>,
       
      }
    ]
  }
</script>
@endsection