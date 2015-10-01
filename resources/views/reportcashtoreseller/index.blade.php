
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
          <span>List</span> 
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
            @foreach($reports as $report)
              <tr>
                    <td>{{$report->id}}</td>
                    <td>{{$report->cashier_id}}</td>
                    <td>{{$report->reseller_id}}</td>
                    <td>{{$report->total}}</td>
                    <td>{{$report->status}}</td>
                    <td>{{$report->date}}</td>
                    <td><a href="#">Detail</a></td>
              </tr>
          @endforeach

      </li>
            </tbody>
       
          </table>
           <ul class="list-group">
          <li class="list-group-item"><b>Total:{{$totalall}}</b></span>
        
        </div>

    </ul>
    </div>
</div><br/>
</div>


@endsection
