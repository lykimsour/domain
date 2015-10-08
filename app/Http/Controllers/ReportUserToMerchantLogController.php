<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserToMerchant;

class ReportUserToMerchantLogController extends Controller
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
        if($selected == 'all' || $selected == null) 
        {
            $reports = UserToMerchant::groupBy('user_id')->selectRaw('*,sum(amount) as total_amount')->paginate(10);
            $total   = UserToMerchant::sum('amount');
        }
        else
        {
            $reports = UserToMerchant::groupBy('user_id')
                                          ->selectRaw('*,sum(amount) as total_amount')
                                          ->where('date', '>=', $date)
                                          ->where('date', '<=', $to_date)
                                          ->paginate(10);
            $total   = UserToMerchant::where('date', '>=', $date)->where('date', '<=', $to_date)->sum('amount');                            
        }
       
        $reports->setPath(url('usertomerchantlog', $selected));
        return view('reportusertomerchantlog.index', ['reports' => $reports, 'total' => $total, 'selected' => $selected]);
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
