<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CommissionToReseller;
use App\Service;
use App\Reseller;
use App\UserToServicejx2Detail;
use App\UserToServicefsDetail;
use App\UserToServiceakDetail;
use App\UserToServicenagaDetail;
use App\UserToServicetournamentDetail;
use App\UserToServiceavatarDetail;

class ReportCommissionToResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
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
          default:
            $date = date("Y-m-d".' '.'00:00:00');
            break;
        }

      $to_date = date("Y-m-d 23:59:59");

      if($selected == 'all' || $selected == null) {
        $reports = CommissionToReseller::groupBy('reseller_id')->selectRaw('*,sum(amount) as total_amount')->paginate(10);
        $total   = CommissionToReseller::sum('amount');
      }
      else
      {
        $reports = CommissionToReseller::groupBy('reseller_id')
                                        ->selectRaw('*,sum(amount) as total_amount')
                                        ->where('date', '>=', $date)
                                        ->where('date', '<=', $to_date)
                                        ->paginate(10);
        $total   = CommissionToReseller::where('date', '>=', $date)->where('date', '<=', $to_date)->sum('amount');                            
      }
        
      $reports->setPath(url('commissiontoreseller', $selected));

      return view('reportcommissiontoreseller.index', ['reports' => $reports, 'total' => $total, 'selected' => $selected]);
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
        $reseller = CommissionToReseller::where('reseller_id', $id)->first();  
        $reports  = CommissionToReseller::where('reseller_id', $id)->get();
        $total    = CommissionToReseller::where('reseller_id', $id)->sum('amount');
        return view('reportcommissiontoreseller.commission2resellerdetail', ['report_details' => $reports, 'total_amount' => $total, 'reseller' => $reseller]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function servicedetail($id)
    {
      $service = CommissionToReseller::where('id', $id)->firstOrFail(); 

      $reseller = Reseller::where('id', $service->reseller_id)->firstOrFail();   
      switch ($service->service->code) {
        case 'jx2':
              $service_detail = UserToServicejx2Detail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->firstOrFail();
            break;
        case 'fs':
              $service_detail = UserToServicefsDetail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->firstOrFail();
              break;
        case 'ak':
              $service_detail = UserToServiceakDetail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->firstOrFail();
              break;
        case 'avatar':
              $service_detail = UserToServiceavatarDetail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->firstOrFail();
              break;
        case 'naga':
              $service_detail = UserToServicenagaDetail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->firstOrFail();
              break;  
        case 'ykaw':
              $service_detail = UserToServiceykawDetail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->firstOrFail();
              break;
        case 'tournament':
              $service_detail = UserToServicetournamentDetail::where('transfer_user2service_log_id', $service->transfer_log_id)
                                                ->firstOrFail();
            break;
      }
        return view('reportcommissiontoreseller.commission2resellerservicedetail',
                    [
                      "service_detail" => $service_detail, 
                      "reseller"        => $reseller,
                      "service_code"   => $service->service->code
                    ]
                    );
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
