<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CommissionToCashier;
use App\Http\Controllers\Collection;
use App\Service;
use App\Cashier;
use App\UserToServicejx2Detail;
use App\UserToServicefsDetail;
use App\UserToServiceakDetail;
use App\UserToServicenagaDetail;
use App\UserToServicetournamentDetail;
use App\UserToServiceavatarDetail;

class ReportCommissionToCashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $date    = date("Y-m-d 23:59:59");
      $to_date = date("Y-m-d 23:59:59");
      if($request->segment(2) == "")
          $selected = $request->input('select_opt');
        else
          $selected = $request->segment(2);
      
        switch ($selected) {
          case 'today':
            $date = date("Y-m-d".' '.'00:00:00');
            break;
          case 'week':
            $date = date("Y-m-d".' '.'00:00:00', strtotime("-7 day"));
            break;
          case 'month':
            $date = date("Y-m-d".' '.'00:00:00', strtotime("-30 day"));
            break;
          case 'year':
            $date = date("Y-m-d".' '.'00:00:00', strtotime("-12 month"));
            break;
          case 'period':
            $startdate  = date_create($request->startdate);
            $date       = date_format($startdate, "Y-m-d 00:00:00");
            $enddate    = date_create($request->enddate);
            $to_date    = date_format($enddate, "Y-m-d 23:59:59");  
            break;
        }

      if($selected == 'all' || $selected == null) {
        $reports = CommissionToCashier::groupBy('cashier_id')->selectRaw('*,sum(amount) as total_amount')->paginate(10);
        $total   = CommissionToCashier::sum('amount');
      }
      else
      {
        $reports = CommissionToCashier::groupBy('cashier_id')
                                      ->selectRaw('*,sum(amount) as total_amount')
                                      ->where('date', '>=', $date)
                                      ->where('date', '<=', $to_date)
                                      ->paginate(10);
        $total   = CommissionToCashier::where('date', '>=', $date)->where('date', '<=', $to_date)->sum('amount');                            
      }
        
      $reports->setPath(url('commissiontocashier', $selected));
     
      return view('reportcommissiontocashier.index', ['reports' => $reports, 'total' => $total, 'selected' => $selected, 'from' => $date,'to' => $to_date]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {  
      $cashier = Cashier::where('id', $id)->first();  

      $reports = CommissionToCashier::where('cashier_id', $id)->paginate(10);
      $total   = CommissionToCashier::where('cashier_id', $id)->sum('amount');
  
      return view('reportcommissiontocashier.commission2cashierdetail', ["cashier" => $cashier, "report_details" => $reports, "total_amount" => $total]);
    }

    public function servicedetail($id)
    { 

      $service = CommissionToCashier::where('id', $id)->first(); 
      $cashier = Cashier::where('id', $service->cashier_id)->first();   
      switch ($service->service->code) {
        case 'jx2':
              $service_detail = UserToServicejx2Detail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->first();
            break;
        case 'fs':
              $service_detail = UserToServicefsDetail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->first();
              break;
        case 'ak':
              $service_detail = UserToServiceakDetail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->first();
              break;
        case 'avatar':
              $service_detail = UserToServiceavatarDetail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->first();
              break;
        case 'naga':
              $service_detail = UserToServicenagaDetail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->first();
              break;  
        case 'ykaw':
              $service_detail = UserToServiceykawDetail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->first();
              break;
        case 'tournament':
              $service_detail = UserToServicetournamentDetail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->first();
            break;
      }
      

      return view('reportcommissiontocashier.commission2cashierservicedetail', 
                    [
                      "service_detail" => $service_detail, 
                      "cashier"        => $cashier,
                      "service_code"   => $service->service->code
                    ]
                  );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
