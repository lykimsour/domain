
@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h2>{{trans('Report:Cashier_To_Reseller')}}</h2>

<div class="row">
    <div class="col-md-6">
    </div>
</div><br/>
<div class="row">

    <div class="col-md-12">
       <ul class="list-group">
      <li class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>
          <span>Report</span> 
      </li>
    <div class="table-responsive list-group-item">          
          <table class="table table-bordered table-hover table-condensed" >
            <thead>
             {!! $reports->render()!!}
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
            <?php $total = 0; ?>
            @foreach($reports as $report)
              <tr>
                    <td>{{$report->id}}</td>
                    <td>{{$report->cashier->name}}</td>
                    <td>{{$report->reseller->name}}</td>
                    <td>{{$report->amount}}</td>
                    <td>{{$report->status}}</td>
                    <td>{{$report->date}}</td>
                    <td><a href="{{route('recorddetail',['id'=>$report->id])}}">Detail</a></td>
                   <?php
                    $total= $report->amount + $total;
                   ?>
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
        
        </div>

    </ul>
    </div>
</div><br/>
</div>


@endsection
