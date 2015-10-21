<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CommissionToReseller;
use App\Http\Controllers\Collection;
use App\Service;
use App\ServiceType;
use App\Reseller;
use DB;
use DateTime;
class ReportCommissionToResellerController extends Controller
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
          $group = 'DAY';
          $type  = 'D';
          $date  = date("Y-m-d 00:00:00");
          break;
        case 'week':
          $group = 'DAY';
          $type  = 'D';
          $date  = date("Y-m-d 00:00:00", strtotime("-7 day"));
          break;
        case 'month':
          $group = 'DAY';
          $type  = 'D';
          $date  = date("Y-m-d 00:00:00", strtotime("-30 day"));
          break;
        case 'year':
          $group = 'MONTH';
          $type  = 'F';
          $date  = date("Y-m-d 00:00:00", strtotime("-12 month"));
          break;
        case 'period':
          $startdate = DateTime::createFromFormat("F-d-Y", $request->startdate);
          $date      = $startdate->format('Y-m-d 00:00:00');
          $enddate   = DateTime::createFromFormat("F-d-Y", $request->enddate);
          $to_date   = $enddate->format('Y-m-d 23:59:59'); 
          $group     = 'DAY';
          $type      = 'D';
          break;
        default:
          $group = 'YEAR';
          $type  = 'Y';
          break;
      }

      if($selected == 'all' || $selected == null) {
        $reports = CommissionToReseller::groupBy('reseller_id')->orderBy('date', 'DESC')->selectRaw('*,sum(amount) as total_amount')->paginate(10);
        $total   = CommissionToReseller::sum('amount');
        $chart_reports = CommissionToReseller::selectRaw('*,sum(amount) as total_amount')
                                              ->groupBy(DB::raw('YEAR(date)'))
                                              ->get();  
                                              
      }
      else
      {
        $reports = CommissionToReseller::groupBy('reseller_id')
                                        ->orderBy('date', 'DESC')
                                        ->selectRaw('*,sum(amount) as total_amount')
                                        ->where('date', '>=', $date)
                                        ->where('date', '<=', $to_date)
                                        ->paginate(10);
        // Chart Report
        $chart_reports =  CommissionToReseller::selectRaw('*,sum(amount) as total_amount')
                                                ->where('date', '>=', $date)
                                                ->where('date', '<=', $to_date)
                                                ->groupBy(DB::raw(''.$group.'(date)'))
                                                ->get();
                                              
                                              

        $total   = CommissionToReseller::where('date', '>=', $date)->where('date', '<=', $to_date)->sum('amount');                            
      }

      $reports->setPath(url('commissiontoreseller', $selected));

      return view('reportcommissiontoreseller.index', 
                                                ['reports' => $reports, 
                                                'total' => $total, 
                                                'selected' => $selected, 
                                                'from' => $request->startdate,
                                                'to' => $request->enddate,  
                                                'chart_reports' => $chart_reports, 
                                                'type' => $type
                                                ]);
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
        $reports  = CommissionToReseller::where('reseller_id', $id)->orderBy('date', 'DESC')->paginate(10);
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
      $service     = CommissionToReseller::where('id', $id)->firstOrFail();
      $service_type = ServiceType::where('id', $service->service->service_type_id)->firstOrFail();
      $reseller    = Reseller::where('id', $service->reseller_id)->firstOrFail();

      $service_detail = DB::table('transfer_user2'.$service_type->name.'_'.$service->service->code.'_d')
                        ->where('transfer_user2'.$service_type->name.'_log_id', $service->transfer_log_id)
                        ->first();
            
      return view('reportcommissiontoreseller.commission2resellerservicedetail',
                    [
                      "service_detail" => $service_detail, 
                      "reseller"       => $reseller,
                      "service_code"   => $service->service->code,
                      "service_type"   => $service_type->name
                    ]
                    );
      
    }

}
