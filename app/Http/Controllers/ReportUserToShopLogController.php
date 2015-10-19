<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserToShopLog;
class ReportUserToShopLogController extends Controller
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
          $selected = $request->select_opt;
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
          $reports = UserToShopLog::groupBy('user_id')->selectRaw('*,sum(amount) as total_amount')->paginate(10);
          $total   = UserToShopLog::sum('amount');
    
          $chart_reports = UserToShopLog::selectRaw('*,sum(amount) as total_amount')
                                              ->groupBy(DB::raw('YEAR(date)'))
                                              ->get();
        }
        else
        {
          $reports = UserToShopLog::groupBy('user_id')
                                      ->selectRaw('*,sum(amount) as total_amount')
                                      ->where('date', '>=', $date)
                                      ->where('date', '<=', $to_date)
                                      ->paginate(10);
          // Chart Report
          $chart_reports =  UserToShopLog::selectRaw('*,sum(amount) as total_amount')
                                              ->where('date', '>=', $date)
                                              ->where('date', '<=', $to_date)
                                              ->groupBy(DB::raw(''.$group.'(date)'))
                                              ->get();
          $total   = UserToShopLog::where('date', '>=', $date)->where('date', '<=', $to_date)->sum('amount');                            
        }
        
        $reports->setPath(url('usertoshoplog', $selected));
        
      
        return view('reportusertoshoplog.index',
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
        //
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
