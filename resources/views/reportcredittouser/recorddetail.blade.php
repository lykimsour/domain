
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
                <tr>
                  <th>Transfer_Credit_To_User_id</th>
                  <th>Reseller_user_id</th>
                  <th>Ip</th>
                </tr>
            </thead>
               <tbody>
              <tr>
                  <td>{{$report->transfer_credit2user_id}}</td>
                  <td>{{$report->reseller_user_id}}</td>
                  <td>{{$report->ip}}</td>
              </tr>
    
            </tbody>
            </table>
        </div>

    </ul>
    </div>
</div><br/>
</div>


@endsection
