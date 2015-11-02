
@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h2>{{trans('Report:Cashier_To_Reseller')}}</h2>

<div class="row">
    <div class="col-md-6">
         <a class="btn btn-md btn btn-info" href="{{Redirect::back()}}"><i class="glyphicon glyphicon-backward"></i> Back</a>
    </div>
</div>
<div class="row">

    <div class="col-md-12">
     </br>
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
                  <th>Mpu_Amount</th>
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
                    <td>{{$report->transfer_cash2user_log_id}}</td>
                    <td>{{$report->resp_code}}</td>
                    <td>{{$report->pan}}</td>
                    <td>{{number_format($report->mpu_amount,2)}}</td>
                    <td>{{$report->invoice_no}}</td>
                    <td>{{$report->tran_ref}}</td>
                    <td>{{$report->approval_code}}</td>
                    <td>{{$report->resp_status}}</td>
                    <td>{{$report->fail_reason}}</td>
                    <td>{{$report->detail}}</td>
                    <td>{{$report->remote_address}}</td>
              </tr>
    
            </tbody>
            </table>
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
                    <td>{{$report->transfer_cash2user_log_id}}</td>
                    <td>{{$report->token}}</td>
                    <td>{{$report->wing_transaction__id}}</td>
                    <td>{{$report->wing_account}}</td>
                    <td>{{$report->currency}}</td>
                    <td>{{number_format($report->amount,2)}}</td>
                    <td>{{$report->remote_address}}</td>  
              </tr>
      
            </tbody>
            </table>
        @elseif(strcasecmp($type,"human")==0)
          <thead>
                <tr>
                  <th>Transfer_cash2user_log_id</th>
                  <th>IP</th>
                 
                </tr>
            </thead>
               <tbody>
              <tr>
                    <td>{{$report->transfer_cash2user_log_id}}</td>
                    <td>{{$report->ip}}</td>
              </tr>
      
            </tbody>
    
          </table> 
       @elseif(strcasecmp($type,"mycard")==0)
         <thead>
                <tr>
                  <th>Transfer_cash2reseller_log_id</th>
                  <th>Gamefacid</th>
                  <th>Game_No</th>
                  <th>Mycard_id</th>
                  <th>Mycard_password</th>
                  <th>Amount</th>
                  <th>Sabay_Coin</th>
                  <th>Detail</th>
                  <th>Remote_Address</th>
                </tr>
            </thead>
               <tbody>
              <tr>
                    <td>{{$report->transfer_cash2user_log_id}}</td>
                    <td>{{$report->gamefacid}}</td>
                    <td>{{$report->game_no}}</td>
                    <td>{{$report->mycard_id}}</td>
                    <td>{{$report->mycard_password}}</td>
                    <td>{{number_format($report->amount,2)}}</td>
                    <td>{{$report->sabay_coin}}</td>
                    <td>{{$report->detail}}</td>
                    <td>{{$report->remote_address}}</td>
              </tr>
            </tbody>
            </table>
       @elseif(strcasecmp($type,"payngo")==0)
         <thead>
                <tr>
                  <th>Transfer_cash2reseller_log_id</th>
                  <th>Transaction_Id</th>
                  <th>Topup_code</th>
                  <th>coin</th>
                  <th>Remote_address</th>
                </tr>
            </thead>
               <tbody>
              <tr>
                    <td>{{$report->transfer_cash2user_log_id}}</td>
                    <td>{{$report->transaction_id}}</td>
                    <td>{{$report->topup_code}}</td>
                    <td>{{number_format($report->coin,2)}}</td>
                    <td>{{$report->remote_address}}</td>
              </tr>
            </tbody>
            </table>
          @elseif(strcasecmp($type,"ogmgc")==0)
         <thead>
                <tr>
                  <th>Transfer_cash2reseller_log_id</th>
                  <th>Reference_ID</th>
                  <th>Payment_ID</th>
                  <th>Account_ID</th>
                  <th>Amount</th>
                  <th>Sabay_Coins</th>
                  <th>Message</th>
                  <th>Remote_address</th>
                </tr>
            </thead>
               <tbody>
             
            </table> <tr>
                    <td>{{$report->transfer_cash2user_log_id}}</td>
                    <td>{{$report->reference_id}}</td>
                    <td>{{$report->payment_id}}</td>
                    <td>{{$report->account_id}}</td>
                    <td>{{number_format($report->amount,2)}}</td>
                    <td>{{$report->sabay_coins}}</td>
                    <td>{{$report->message}}</td>
                    <td>{{$report->remote_address}}</td>
              </tr>
            </tbody>
          @elseif(strcasecmp($type,"scr")==0)
              <thead>
                <tr>
                  <th>Transfer_cash2reseller_log_id</th>
                  <th>From_User_Id</th>
                  <th>To_User_Id</th>
                  <th>Coin</th>
                  <th>Date</th>
                  <th>Sabay_Coin</th>
                  <th>IP</th>
                </tr>
            </thead>
               <tbody>
                 </table> <tr>
                    <td>{{$report->transfer_cash2user_log_id}}</td>
                    <td>{{$report->from_user_id}}</td>
                    <td>{{$report->to_user_id}}</td>
                    <td>{{number_format($report->coin,2)}}</td>
                    <td>{{$report->date}}</td>
                    <td>{{$report->sabay_coin}}</td>
                    <td>{{$report->IP}}</td>
              </tr>
            </tbody>
          @endif
      

        </div>

    </ul>
    </div>
</div><br/>
</div>


@endsection
