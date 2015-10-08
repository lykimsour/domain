
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
          @if(strcasecmp($type,"MPU")==0)
            <thead>
                <tr>
                  <th>Transfer_cash2reseller_log_id</th>
                  <th>RESP_code</th>
                  <th>Pan</th>
                  <th>Amount</th>
                  <th>Invoice_No</th>
                  <th>Tran_ref</th>
                  <th>Approval_Code</th>
                  <th>RESP_status</th>
                  <th>Fail_reason</th>
                  <th>Detail</th>
                  <th>Remote_Address</th>
                </tr>
            </thead>
               <tbody>
              <tr>
                    <td>{{$report->transfer_cash2reseller_log_id}}</td>
                    <td>{{$report->resp_code}}</td>
                    <td>{{$report->pan}}</td>
                    <td>{{$report->amount}}</td>
                    <td>{{$report->invoice_no}}</td>
                    <td>{{$report->tran_ref}}</td>
                    <td>{{$report->approval_code}}</td>
                    <td>{{$report->resp_status}}</td>
                    <td>{{$report->fail_reason}}</td>
                    <td>{{$report->detail}}</td>
                    <td>{{$report->remote_address}}</td>
              </tr>
      </li>
            </tbody>
      @elseif(strcasecmp($type,"wing")==0)
           <thead>
                <tr>
                  <th>Transfer_cash2reseller_log_id</th>
                  <th>Token</th>
                  <th>Wing_Transaction_Id</th>
                  <th>Wing_Account</th>
                  <th>Currency</th>
                  <th>Amount</th>
                  <th>Remote_Adress</th>
                </tr>
            </thead>
               <tbody>
              <tr>
                    <td>{{$report->transfer_cash2reseller_log__id}}</td>
                    <td>{{$report->token}}</td>
                    <td>{{$report->wing_transaction__id}}</td>
                    <td>{{$report->wing_account}}</td>
                    <td>{{$report->currency}}</td>
                    <td>{{$report->amount}}</td>
                    <td>{{$report->remote_address}}</td>  
              </tr>
      </li>
            </tbody>
      @else
          <thead>
                <tr>
                  <th>Transfer_cash2reseller_log_id</th>
                  <th>IP</th>
                 
                </tr>
            </thead>
               <tbody>
              <tr>
                    <td>{{$report->transfer_cash2reseller_log_id}}</td>
                    <td>{{$report->ip}}</td>
              </tr>
      </li>
            </tbody>


      @endif

          </table> 
        </div>

    </ul>
    </div>
</div><br/>
</div>


@endsection
