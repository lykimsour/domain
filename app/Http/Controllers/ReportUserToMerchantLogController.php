<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserToMerchant;
use DateTime;
use DB;
class ReportUserToMerchantLogController extends Controller
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

      if($selected == 'all') 
      {
        $reports = UserToMerchant::groupBy('user_id')->selectRaw('*,sum(amount) as total_amount')->where('status', 1)->paginate(env('page'));
        $total   = UserToMerchant::sum('amount');
        $chart_reports = UserToMerchant::selectRaw('*,sum(amount) as total_amount')
                                          ->where('status', 1)
                                          ->groupBy(DB::raw('YEAR(date)'))
                                          ->get(); 
      }
      else
      {
        $reports = UserToMerchant::groupBy('user_id')
                                      ->selectRaw('*,sum(amount) as total_amount')
                                      ->where('status', 1)
                                      ->where('date', '>=', $date)
                                      ->where('date', '<=', $to_date)
                                      ->paginate(env('page'));
        // Chart Report
        $chart_reports =  UserToMerchant::selectRaw('*,sum(amount) as total_amount')
                                          ->where('status', 1)
                                          ->where('date', '>=', $date)
                                          ->where('date', '<=', $to_date)
                                          ->groupBy(DB::raw(''.$group.'(date)'))
                                          ->get();
        $total   = UserToMerchant::where('status', 1)->where('date', '>=', $date)->where('date', '<=', $to_date)->sum('amount');                            
      }
       
      // Set Path Pagination
      if($selected == 'period')
        $reports->setPath(url('usertomerchantlog', [$selected, $format_stdate, $format_endate]));
      else  
        $reports->setPath(url('usertomerchantlog', $selected));

      return view('reportusertomerchantlog.index', 
                                                ['reports' => $reports, 
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

      // Get User  
      $user     = UserToMerchant::where('user_id', $id)->first();  
        
      if($get_type == 'all' || $get_type == null) {
        $reports  = UserToMerchant::where('status', 1)->where('user_id', $id)->orderBy('date', 'DESC')->paginate(env('page'));
        $total    = UserToMerchant::where('status', 1)->where('user_id', $id)->sum('amount');
      }
      else
      {
        $reports = UserToMerchant::where('user_id', $id)
                                        ->where('date', '>=', $date)
                                        ->where('date', '<=', $to_date)
                                        ->orderBy('date', 'DESC')
                                        ->paginate(env('page'));
        $total   = UserToMerchant::where('user_id', $id)
                                        ->where('date', '>=', $date)
                                        ->where('date', '<=', $to_date)
                                        ->sum('amount');
        
      }
      return view('reportusertomerchantlog.user2merchantlogdetail', ['report_details' => $reports, 'total_amount' => $total, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function servicedetail($id)
    {
      $service      = UserToMerchant::where('id', $id)->firstOrFail();
  
      $service_detail = DB::table('transfer_user2merchant_'.$service->service_code.'_d')
                        ->where('transfer_user2merchant_log_id', $id)
                        ->first();
    
      return view('reportusertomerchantlog.user2merchantlogservicedetail',
                    [
                      "service_detail" => $service_detail,
                      "service"        => $service
                    ]);
    }
}
