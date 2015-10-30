<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserToServiceLog;
use App\Http\Controllers\Input;
use App\ServiceType;
use App\Service;
use DB;
use DateTime;

class ReportUserToServiceLogController extends Controller
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
          $startdate = DateTime::createFromFormat("F-d-Y", $format_stdate);
          $date      = $startdate->format('Y-m-d 00:00:00');
          $from      = $startdate->format('F-d-Y');
          $enddate   = DateTime::createFromFormat("F-d-Y", $format_endate);
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
       
      if($selected == 'all') {
        $reports = UserToServiceLog::groupBy('service_code')->selectRaw('*,sum(amount) as total_amount')->where('status', 1)->paginate(env('PAGINATION'));
        $total   = UserToServiceLog::where('status', 1)->sum('amount');
  
        $chart_reports = UserToServiceLog::selectRaw('*,sum(amount) as total_amount')
                                            ->where('status', 1)
                                            ->groupBy(DB::raw('YEAR(date)'))
                                            ->get();
      }
      else
      {

        $reports = UserToServiceLog::groupBy('service_code')
                                    ->selectRaw('*,sum(amount) as total_amount')
                                    ->where('status', 1)
                                    ->where('date', '>=', $date)
                                    ->where('date', '<=', $to_date)
                                    ->paginate(env('PAGINATION'));
        // Chart Report
        $chart_reports =  UserToServiceLog::selectRaw('*,sum(amount) as total_amount')
                                            ->where('status', 1)
                                            ->where('date', '>=', $date)
                                            ->where('date', '<=', $to_date)
                                            ->groupBy(DB::raw(''.$group.'(date)'))
                                            ->get();
        $total = UserToServiceLog::where('status', 1)->where('date', '>=', $date)->where('date', '<=', $to_date)->sum('amount');                            
      }
      
      // Set Path Pagination
      if($selected == 'period')
        $reports->setPath(url('usertoservicelog', [$selected, $format_stdate, $format_endate]));
      else  
        $reports->setPath(url('usertoservicelog', $selected));
   
      return view('reportusertoservicelog.index',
                    [
                      'reports' => $reports, 
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

      $user     = UserToServiceLog::where('user_id', $id)->first();  

      if($get_type == 'all' || $get_type == null) {
        $reports = UserToServiceLog::where('user_id', $id)
                                    ->where('status', 1)
                                    ->paginate(env('PAGINATION'));

        $total   = UserToServiceLog::where('user_id', $id)
                                    ->where('status', 1)
                                    ->sum('amount');
      }
      else
      {
        $reports = UserToServiceLog::where('user_id', $id)
                                    ->where('status', 1)
                                    ->where('date', '>=', $date)
                                    ->where('date', '<=', $to_date)
                                    ->paginate(env('PAGINATION'));

        $total   = UserToServiceLog::where('user_id', $id)
                                    ->where('status', 1)
                                    ->where('date', '>=', $date)
                                    ->where('date', '<=', $to_date)
                                    ->sum('amount');
      }
     
      return view('reportusertoservicelog.user2servicelogdetail', 
                  [
                    'report_details' => $reports, 
                    'total_amount' => $total, 
                    'user' => $user, 
                    'from' => $from, 
                    'to' => $to
                  ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function servicedetail($id, $type, $startdate = "", $enddate = "")
    {

      $user_service = UserToServiceLog::where('id', $id)->firstOrFail();
      $user         = UserToServiceLog::where('user_id', $user_service->user_id)->first();

      $service      = Service::where('code', $user_service->service_code)->firstOrFail(); 
      $service_type = ServiceType::where('id', $service->service_type_id)->first();
     
      if ($service_type->name == 'service') {
        if ($user_service->service_code == 'tournament') {
          $service_detail = DB::table('transfer_user2service_'.$user_service->service_code.'_d')
                            ->join('tournament', 'tournament.id', '=', 'transfer_user2service_tournament_d.tournament_id')
                            ->join('team', 'team.id', '=', 'transfer_user2service_tournament_d.team_id')
                            ->where('transfer_user2service_log_id', $id)
                            ->first();
        }
        else {
          $service_detail = DB::table('transfer_user2service_'.$user_service->service_code.'_d')
                              ->join('subscription_'.$user_service->service_code, 'transfer_user2service_'.$user_service->service_code.'_d.account_id', '=', 'subscription_'.$user_service->service_code.'.id')
                              ->leftJoin('cashier', 'transfer_user2service_'.$user_service->service_code.'_d.cashier_id', '=', 'cashier.id')
                              ->where('transfer_user2service_log_id', $id)
                              ->first();
        }
      }
      else if ($service_type->name == 'shop') {
        $service_detail = DB::table('transfer_user2shop_'.$user_service->service_code.'_d')
                              ->where('transfer_user2shop_log_id', $id)
                              ->first();
      }
      else if ($service_type->name == 'merchant') {
        $service_detail = DB::table('transfer_user2merchant_'.$user_service->service_code.'_d')
                              ->where('transfer_user2merchant_log_id', $id)
                              ->first();
      }
      

      return view('reportusertoservicelog.user2servicelogservicedetail', 
                    [
                      "service_detail" => $service_detail, 
                      "service_code"   => $user_service->service_code,
                      "service_type"   => $service_type->name,
                      "user"           => $user
                    ]
                  );
    }
}
