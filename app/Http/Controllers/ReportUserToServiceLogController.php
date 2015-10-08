<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserToServiceLog;
use App\Http\Controllers\Input;
class ReportUserToServiceLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->segment(2) == "")
          $selected = $request->select_opt;
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
          $reports  = UserToServiceLog::groupBy('user_id')->selectRaw('*,sum(amount) as total_amount')->paginate(5);
          $total   = UserToServiceLog::sum('amount');
        }
        else
        {
          $reports = UserToServiceLog::groupBy('user_id')
                                      ->selectRaw('*,sum(amount) as total_amount')
                                      ->where('date', '>=', $date)
                                      ->where('date', '<=', $to_date)
                                      ->paginate(5);
          $total   = UserToServiceLog::where('date', '>=', $date)->where('date', '<=', $to_date)->sum('amount');                            
        }
        
        $reports->setPath(url('usertoservicelog', $selected));
        
      
        return view('reportusertoservicelog.index', compact('reports', 'total', 'selected'));
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
        $user     = UserToServiceLog::where('user_id', $id)->first();  
        $reports  = UserToServiceLog::where('user_id', $id)->paginate(5);
        $total    = UserToServiceLog::where('user_id', $id)->sum('amount');
        return view('reportusertoservicelog.user2servicelogdetail', ['report_details' => $reports, 'total_amount' => $total, 'user' => $user]);
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
