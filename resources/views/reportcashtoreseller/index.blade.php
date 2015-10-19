
@extends('layouts.app')

@section('content')
<?php 
  //init array
  $data  = []; 
  $label = [];

?>
<div class="container-fluid">

<h2>{{trans('Report:Cashier_To_Reseller')}}</h2>
<div class="row">
<form method="post" action="{{route('queryreport')}}">
  {!! csrf_field() !!}
 <div class="table-responsive list-group-item">  
      <div class="col-md-2">
          <div class="form-group">
             <label for="name">{{trans('Cashier Types')}}</label>
                <?php $types=["all"=>"All","human"=>"Human","agent"=>"Agent"]; ?>
               {!! Form::select('type',$types,$type,['class'=>'form-control']) !!}
          </div> 
           <button type="submmit" class="btn btn-md btn btn-danger">Show</button>
  </div>
   <div class="col-md-2">
          <div class="form-group">
             <label for="name">{{trans('Time')}}</label>
                <?php $times=["all"=>"All","today"=>"Today","week"=>"Week","month"=>"Month","year"=>"Year","period"=>"Period"]; ?>
               {!! Form::select('time',$times,$time,['class'=>'form-control','id'=>'time']) !!}
          </div>
  </div> 
  <div class="col-md-3" id="sdate">
          <div class="form-group">
              <label for="name" >{{trans('Start_Date')}}</label><br/>
                <div class='input-group date' data-date-format="MM-dd-yyyy" id="startdate" >
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
                <div class='input-group date' data-date-format="MM-dd-yyyy" id='enddate'>
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
<!--<div class="row">
    <div class="col-md-6">
     <form>
      <label>Time: </label>
       <div class="form-group">
                <div class='input-group date' id='datetimepicker1' data-date-format="MM-dd-yyyy">
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
    </form>
    </div>
      <div class="col-md-6">
     <form>
      <label>Time: </label>
       <div class="form-group">
                <div class='input-group date' id='datetimepicker2' data-date-format="MM-dd-yyyy">
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
    </form>
    </div>
</div>-->
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
                  <th>Cashier_Name</th>
                  <!--<th>Reseller_name</th>-->
                  <th>Total</th>
                  <th>Status</th>
                  @if($time!='all')
                 <!--<th>Date</th>-->
                  @endif
                  <th>Detail</th>
                </tr>
            </thead>
               <tbody>
            <?php $total = 0 ?>
            
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
                    <td>{{$report->cashier->name}}</td>
                    <td>{{$report->total}}</td>
                    <td>{{$report->status}}</td>
                    @if($time!='all')
                    <!--<td>{{$report->date}}</td>-->
                    @endif
                    <td><a href="{{route('detail',['id'=>$report->id,'time'=>$time,'startdate'=>$from,'enddate'=>$to])}}">Detail</a></td>
                    <?php $total = $report->total + $total  ?>
              </tr>

          @endforeach
      </li>
            </tbody>
       
          </table>
      <div class="table-responsive list-group-item">    
          <table class="table table-bordered table-hover table-condensed" >
             <tr><td><li class="list-group-item"><b>Sub_Total: {{$total}} COIN</b></li></span></td></tr>
          <tr><td> <li class="list-group-item"><b>Total:  {{$totalall}} COIN</b></li></span></td></tr>
          </table>
      </div>
    </ul>
      
    </div>
</div><br/>
</div>
<div id="from">{{$from}}</div>
<div id="to">{{$to}}</div>
<script type="text/javascript">
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
</script>
  
@endsection

