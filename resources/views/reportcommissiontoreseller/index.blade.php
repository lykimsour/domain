
@extends('layouts.app')

@section('content')
<?php 
  //init array
  $data  = []; 
  $label = [];
?>
<div class="container-fluid">

<h2>{{trans('Report:Commission_To_Reseller')}}</h2>

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
        {!! Form::open(array('action' => array('ReportCommissionToResellerController@index'), 'method' => 'POST', 'class' => 'form-inline')) !!}
          {!! Form::select('select_opt', 
            [
             'all' => 'All',
             'today' => 'Today',
             'week' => 'Week',
             'month' => 'Month',
             'year' => 'year',
             'period' => 'Period'
             ], $selected,
             ['class' => 'form-control']
              ) 
          !!}
          {!! Form::submit('Show', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        </li>
      </ul>
    <div class="table-responsive list-group-item">
        @if(count($reports) > 0)       
          <table class="table table-bordered table-hover table-condensed" >
          {!! $reports->render() !!}
            <thead>  
              <tr>
                <th>ID</th>
                <th>Reseller_Name</th>
                <th>Total</th>
                <th>Date</th>
                <th>Detail</th>
              </tr>
            </thead>
            <tbody>
            @foreach($reports as $report)
              <?php  
                array_push($data, $report->total_amount); 
                $date = strtotime($report->date);
                array_push($label, date('F', $date));
              ?>
              <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->reseller->name }}</td>
                <td>{{ $report->total_amount }}</td>
                <td>{{ $report->date }}</td>
                <td><a href="{{ route('detailcommissiontoreseller', ['id' => $report->reseller_id]) }}">Detail</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <b>Total: {{ $total }}</b></span>
          <div style="width:100%">
            <div>
              <canvas id="canvas" height="250" width="900"></canvas>
            </div>
          </div>
        @else
          <div class="alert alert-info">
            <strong>No Result</strong>
          </div>
        @endif
        </div>
    </div>
</div>
</div>

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
