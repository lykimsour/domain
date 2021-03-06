
@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h2>{{trans('Report:Commission_To_Reseller_Detail')}}</h2>

<div class="row">
    <div class="col-md-6">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <ul class="list-group">
        <li class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>
            <span>List / <a href="{{  route('commissiontoreseller') }}">{{ $reseller->reseller->name }}</a></span> 
        </li>
      </ul>
    <div class="table-responsive list-group-item">          
          <table class="table table-bordered table-hover table-condensed" >
            {!! $report_details->render() !!}
            <thead>  
              <tr>
                <th>ID</th>
                <th>User_name</th>
                <th>Service_Code</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Detail</th>
              </tr>
            </thead>
               <tbody>
            @foreach($report_details as $report_detail)
              <tr>
                <td>{{ $report_detail->id }}</td>
                <td>{{ $report_detail->user->name }}</td>
                <td>{{ $report_detail->service->code }}</td>
                <td>{{ $report_detail->amount }}</td>
                <td>{{ $report_detail->date }}</td>
                <td><a href="{{ route('detailservicecommissiontoreseller', 
                                [
                                  'type' => Request::segment(4), 
                                  'start_date' => Request::segment(5) , 
                                  'end_date' => Request::segment(6),
                                  'id' => $report_detail->id
                                ]) 
                              }}">Detail</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <b>Total: {{ $total_amount }}</b></span>
        </div>
    </div>
</div>
</div>
@endsection
