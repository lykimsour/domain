
@extends('layouts.app')

@section('content')
<?php 
  //init array
  $data  = []; 
  $label = [];
?>
<div class="container-fluid">

<h2>{{trans('Report:User_To_Service_Log')}}</h2>

<div class="row">
    <div class="col-md-6">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <ul class="list-group">
        <li class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>
            <span>List</span> 
        </li>
      </ul>
      <ul class="list-group">
        <li class="list-group-item">
      
        {!! Form::open(array('action' => array('ReportUserToServiceLogController@index'), 'method' => 'POST', 'class' => 'form-inline')) !!}
          {!! Form::select('select_opt', 
            [
             'all' => 'All',
             'today' => 'Today',
             'week' => 'Week',
             'month' => 'Month',
             'year' => 'year',
             'period' => 'Period'
             ], $selected,
             ['class' => 'form-control', 'id' => 'time']
              ) 
          !!}
          <span  id="sdate">
            <label for="name" >{{trans('Start_Date')}}</label>
              <span class='input-group date' data-date-format="MM-dd-yyyy" id="startdate" >
                  <input type='text' class="form-control"  name="startdate" id="sdateid"  />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </span>
          </span>
          <span  id="edate">
            <label for="name">{{trans('End_Date')}}</label>
              <span class='input-group date' data-date-format="MM-dd-yyyy" id='enddate'>
                <input type='text' class="form-control" name="enddate" id="edateid"/>
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </span>
          </span> 
          {!! Form::submit('Show', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </li>
      </ul>
      <ul class="list-group">
        <li class="list-group-item">
          <div style="width:100%">
            <div>
              <canvas id="canvas" height="250" width="900"></canvas>
            </div>
          </div>
        </li>
      </ul>
    <div class="table-responsive list-group-item"> 
        @if(count($reports) > 0)         
          <table class="table table-bordered table-hover table-condensed" >
          {!! $reports->render() !!}
            <thead>  
                <tr>
                  <th>ID</th>
                  <th>User_Name</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Detail</th>
                </tr>
            </thead>
            <tbody>
            <?php
              if($selected == 'period')
              {
                $start_date = $from;
                $end_date   = $to;
                $get_type   = 'period';
              }
              else
              {
                $start_date = '';
                $end_date   = '';
                $get_type   = $selected != ""? $selected : 'today'; 
              }
            ?>
            @foreach($reports as $report)
              <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->user->name }}</td>
                <td>{{ $report->total_amount }}</td>
                <td>{{ $report->date }}</td>
                <td><a href="{{ route('detailusertoservicelog', 
                                [
                                  'id' => $report->user_id, 
                                  'type' => $get_type, 
                                  'start_date' => $start_date, 
                                  'end_date' => $end_date
                                ]) 
                                }}">
                      Detail
                    </a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <b>Total: {{ $total }}</b></span>
        @else
          <div class="alert alert-info">
            <strong>No Result</strong>
          </div>
        @endif
        </div>
    </div>
</div>
</div>

<?php 
  foreach ($chart_reports as $chart_report) 
  {
    array_push($data, $chart_report->total_amount); 
    $date = strtotime($chart_report->date);
    array_push($label, date($type, $date));
  }
?>

<p id="from">{{ $from }}</p>
<p id="to">{{ $to }}</p>

<script>
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
