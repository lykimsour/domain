<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CommissionToCashier;
use App\Http\Controllers\Collection;
use App\Service;
use App\Cashier;
use App\ServiceType;
use Carbon\Carbon;  
use DB;
use DateTime;
class ReportCommissionToCashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $date    = date("Y-m-d 00:00:00");
      $to_date = date("Y-m-d 23:59:59");
      $from    = date("Y-m-d 00:00:00");
      $to      = date("Y-m-d 23:59:59");

      // Get Type Select Option
      if($request->segment(2) == "") {
        $selected = $request->input('select_opt');
        if($selected == null)
          $selected = 'today';
      }
      else
        $selected = $request->segment(2);

      // Get date
      if($request->startdate == null)
      {
        $format_stdate = $request->segment(3);
        $format_endate = $request->segment(4);
      }
      else
      {
        $format_stdate = $request->startdate;
        $format_endate = $request->enddate;
      }
      
      switch ($selected) {
        case 'today':
          $group = 'DAY';
          $type  = 'Y-M-d';
          $date  = date("Y-m-d 00:00:00");
          break;
        case 'week':
          $group = 'DAY';
          $type  = 'Y-M-d';
          $date  = date("Y-m-d 00:00:00", strtotime("-7 day"));
          break;
        case 'month':
          $group = 'DAY';
          $type  = 'Y-M-d';
          $date  = date("Y-m-d 00:00:00", strtotime("-30 day"));
          break;
        case 'year':
          $group = 'MONTH';
          $type  = 'Y-M';
          $date  = date("Y-m-d 00:00:00", strtotime("-12 month"));
          break;
        case 'period':
          $startdate = DateTime::createFromFormat("F-d-Y", $format_stdate);
          $date      = $startdate->format('Y-m-d 00:00:00');
          $from      = $startdate->format('F-d-Y');
          $enddate   = DateTime::createFromFormat("F-d-Y", $format_endate);
          $to_date   = $enddate->format('Y-m-d 23:59:59'); 
          $to        = $enddate->format('F-d-Y');
          $group     = 'DAY';
          $type      = 'Y-M-d';
          break;
        default:
          $group = 'YEAR';
          $type  = 'Y';
          break;
      }

      if($selected == 'all') {
        $reports = CommissionToCashier::groupBy('cashier_id')->orderBy('date', 'DESC')->selectRaw('*,sum(amount) as total_amount')->paginate(env('PAGINATION'));
        $total   = CommissionToCashier::sum('amount');
        $chart_reports = CommissionToCashier::selectRaw('*,sum(amount) as total_amount')
                                              ->groupBy(DB::raw('YEAR(date)'))
                                              ->get();  
                                              
      }
      else
      {
        $reports = CommissionToCashier::groupBy('cashier_id')
                                      ->orderBy('date', 'DESC')
                                      ->selectRaw('*,sum(amount) as total_amount')
                                      ->where('date', '>=', $date)
                                      ->where('date', '<=', $to_date)
                                      ->paginate(env('PAGINATION'));
        // Chart Report
        $chart_reports =  CommissionToCashier::selectRaw('*,sum(amount) as total_amount')
                                              ->where('date', '>=', $date)
                                              ->where('date', '<=', $to_date)
                                              ->groupBy(DB::raw(''.$group.'(date)'))
                                              ->get();
                                              
                                              

        $total   = CommissionToCashier::where('date', '>=', $date)->where('date', '<=', $to_date)->sum('amount');                            
      }

      // Set Path Pagination
      if($selected == 'period')
        $reports->setPath(url('commissiontocashier', [$selected, $format_stdate, $format_endate]));
      else  
        $reports->setPath(url('commissiontocashier', $selected));
     
      return view('reportcommissiontocashier.index', 
                  [
                    'reports' => $reports, 
                    'total' => $total, 
                    'selected' => $selected, 
                    'from' => $from,
                    'to' => $to,  
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
    public function show($id, $get_type, $start_date = "", $to_end_date = "")
    {  
      $date     = date("Y-m-d 00:00:00");
      $to_date  = date("Y-m-d 23:59:59");
      $from     = date("Y-m-d 00:00:00");
      $to       = date("Y-m-d 23:59:59");
      switch ($get_type) {
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
          $startdate = DateTime::createFromFormat("F-d-Y", $start_date);
          $date      = $startdate->format('Y-m-d 00:00:00');
          $from      = $startdate->format('F-d-Y');
          $enddate   = DateTime::createFromFormat("F-d-Y", $to_end_date);
          $to_date   = $enddate->format('Y-m-d 23:59:59'); 
          $to        = $enddate->format('F-d-Y');
          $group     = 'DAY';
          $type      = 'D';
          break;
        default:
          $group = 'YEAR';
          $type  = 'Y';
          break;
      }

      //======== Get Cashier
      $cashier = Cashier::where('id', $id)->first(); 

      if($get_type == 'all' || $get_type == null) {
        $reports = CommissionToCashier::where('cashier_id', $id)->orderBy('date', 'DESC')->paginate(env('PAGINATION'));
        $total   = CommissionToCashier::where('cashier_id', $id)->sum('amount');
      }
      else
      {
        $reports = CommissionToCashier::where('cashier_id', $id)
                                        ->where('date', '>=', $date)
                                        ->where('date', '<=', $to_date)
                                        ->orderBy('date', 'DESC')
                                        ->paginate(env('PAGINATION'));
        $total   = CommissionToCashier::where('cashier_id', $id)
                                        ->where('date', '>=', $date)
                                        ->where('date', '<=', $to_date)
                                        ->sum('amount');
        
      }
       

      
  
      return view('reportcommissiontocashier.commission2cashierdetail', ["cashier" => $cashier, "report_details" => $reports, "total_amount" => $total]);
    }

    public function servicedetail($id)
    { 

      $service      = CommissionToCashier::where('id', $id)->firstOrFail();
      $service_type = ServiceType::where('id', $service->service->service_type_id)->firstOrFail(); 
      $cashier      = Cashier::where('id', $service->cashier_id)->first();
  
      if ($service_type->name == 'service') {
        
        if($service->service->code == 'tournament') {
          $service_detail = DB::table('transfer_user2service_tournament_d')
                            ->join('tournament', 'tournament.id', '=', 'transfer_user2service_tournament_d.tournament_id')
                            ->join('team', 'team.id', '=', 'transfer_user2service_tournament_d.team_id')
                            ->where('transfer_user2service_log_id', $id)
                            ->first();
        }  
        else {
          $service_detail = DB::table('transfer_user2'.$service_type->name.'_'.$service->service->code.'_d')
                            ->join('subscription_'.$service->service->code, 'transfer_user2'.$service_type->name.'_'.$service->service->code.'_d.account_id', '=', 'subscription_'.$service->service->code.'.id')
                            ->leftJoin('cashier', 'transfer_user2'.$service_type->name.'_'.$service->service->code.'_d.cashier_id', '=', 'cashier.id')
                            ->where('transfer_user2'.$service_type->name.'_log_id', $service->transfer_log_id)
                            ->first();
        }
      }
      else if ($service_type->name == 'shop') {
        $service_detail = DB::table('transfer_user2'.$service_type->name.'_'.$service->service->code.'_d')
                            ->where('transfer_user2'.$service_type->name.'_log_id', $service->transfer_log_id)
                            ->first();
      }

      else if ($service_type->name == 'merchant') {
        $service_detail = DB::table('transfer_user2'.$service_type->name.'_'.$service->service->code.'_d')
                            ->where('transfer_user2'.$service_type->name.'_log_id', $service->transfer_log_id)
                            ->first();
      }
       
      return view('reportcommissiontocashier.commission2cashierservicedetail', 
                    [
                      "service_detail" => $service_detail, 
                      "cashier"        => $cashier,
                      "service_code"   => $service->service->code,
                      "service_type"   => $service_type->name
                    ]
                  );
    }

}
