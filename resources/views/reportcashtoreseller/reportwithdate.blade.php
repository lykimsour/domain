
@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h2>{{trans('Report:Cashier_To_Reseller')}}</h2>
<div class="row">
<form method="post" action="{{route('queryreport')}}">
  {!! csrf_field() !!}
 <div class="table-responsive list-group-item">  
      <div class="col-md-2">
          <div class="form-group">
             <label for="name">{{trans('Cashier Types')}}</label>
                <?php $types=["all"=>"All","Human"=>"Human","Agent"=>"Agent"]; ?>
    
               {!! Form::select('type',$types,$type,['class'=>'form-control']) !!}
          </div> 
           <button type="submmit" class="btn btn-md btn btn-danger">Show</button>
  </div>
   <div class="col-md-2">
          <div class="form-group">
             <label for="name">{{trans('Time')}}</label>
                <?php $times=["All"=>"All","Today"=>"Today","Week"=>"Week","Month"=>"Month","Year"=>"Year","Period"=>"Period"]; ?>
               {!! Form::select('time',$times,$time,['class'=>'form-control','id'=>'time']) !!}
          </div>
  </div> 
  <div class="col-md-3" id="sdate" style="visibility:hidden">
          <div class="form-group">
              <label for="name" >{{trans('Start_Date')}}</label><br/>
                <div class='input-group date' data-date-format="MM-dd-yyyy" id="startdate" >
                    <input type='text' class="form-control" name="startdate"  />
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
          </div>
  </div> 
   <div class="col-md-3" id="edate" style="visibility:hidden">
          <div class="form-group">
              <label for="name">{{trans('End_Date')}}</label><br/>
                <div class='input-group date' data-date-format="MM-dd-yyyy" id='enddate'>
                    <input type='text' class="form-control" name="enddate" />
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
                  <th>Reseller_name</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th>Detail</th>
                </tr>
            </thead>
               <tbody>
            <?php $total = 0 ?>
            @foreach($reports as $report)
              <tr>
                    <td>{{$report->id}}</td>
                    <td>{{$report->cashier->name}}</td>
                    <td>{{$report->reseller->name}}</td>
                    <td>{{$report->total}}</td>
                    <td>{{$report->status}}</td>
                    <td>{{$report->date}}</td>
                    <td><a href="{{route('detail',['id'=>$report->id])}}">Detail</a></td>
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

@endsection

