<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CashierToReseller;
use App\CashToResellermpu;
use App\CashToResellersabay;
use App\Cashier;
use App\CashToResellerwing;
use DB;
use Redirect;
class ReportCashierToReseller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {   
                $report = CashierToReseller::groupBy('cashier_id','reseller_id')->selectRaw('*,sum(amount) as total')->where('status','=',1)->paginate(10);
                $report->setPath('cashiertoreseller');
                $totalall = CashierToReseller::where('status',1)->sum('amount');
                $type = "All";
                $time = "all";
                return view('reportcashtoreseller.index',['reports'=>$report,'totalall'=>$totalall,'type'=>$type,'time'=>$time]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function detail($id,$time)
    {
        $reportctor = CashierToReseller::findOrFail($id);
        if(strcasecmp($time,"all") == 0){
           $report = CashierToReseller::where(['status'=>1,'cashier_id'=>$reportctor->cashier_id,'reseller_id'=>$reportctor->reseller_id])->paginate(10);
            $totalall = CashierToReseller::where(['status'=>1,'cashier_id'=>$reportctor->cashier_id,'reseller_id'=>$reportctor->reseller_id])->sum('amount');      
       }
        else{
                if(strcasecmp($time,"today") == 0){
                $from = date('Y-m-d'.' '.'00:00:00' ,time()); 
                $to = date('Y-m-d 23:59:59',time());          
                }
                elseif(strcasecmp($time,"week") ==0){
                            $preweek = time() - (7 * 24 * 60 * 60);
                            $from = date('Y-m-d'.' '.'00:00:00', $preweek);
                            $to = date('Y-m-d 23:59:59',time());                           
                }
                elseif(strcasecmp($time,"month") ==0){
                            $premonth = time() - (30 * 24 * 60 * 60);
                            $from = date('Y-m-d'.' '.'00:00:00', $premonth);
                            $to = date('Y-m-d 23:59:59',time());      
                }
                 elseif(strcasecmp($time,"year") ==0){
                            $preyear = time() - (364 * 24 * 60 * 60);
                            $from = date('Y-m-d'.' '.'00:00:00', $preyear);
                            $to = date('Y-m-d 23:59:59',time());
                }
            $report = CashierToReseller::where(['status'=>1,'cashier_id'=>$reportctor->cashier_id,'reseller_id'=>$reportctor->reseller_id])
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->paginate(10);

            $totalall=CashierToReseller::where(['status'=>1,'cashier_id'=>$reportctor->cashier_id,'reseller_id'=>$reportctor->reseller_id])
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->sum('amount');
                                        
        }
        
        $report->setPath(url('/cashiertoreseller/detail/'.$id.'/'.$time));
        return view('reportcashtoreseller.detail',['reports'=>$report,'totalall'=>$totalall]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function recorddetail($id)
    {
        //return $id;
        $reportlog = CashierToReseller::findOrFail($id);
        $cashier = Cashier::findOrFail($reportlog->cashier_id);
        $type;
        if(strcasecmp($cashier->type,"human") == 0){
            $reports = CashToResellersabay::where('transfer_cash2reseller_log_id',$id)->firstOrFail();
            $type = "human";
        }
        else{
           if(strcasecmp($cashier->name,"MPU")==0 || strcasecmp($cashier->username,"MPU")==0){
                $reports = CashToResellermpu::where('transfer_cash2reseller_log_id',$id)->firstOrFail();
                $type = "mpu";
           }
           else{
                $reports = CashToResellerwing::where('transfer_cash2reseller_log__id',$id)->firstOrFail();
                $type = "wing";
           }
        } 
        return view('reportcashtoreseller.recorddetail',['report'=>$reports,'type'=>$type]);    
  
       
    }
    public function dd(){
        return 'hi';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
  
    public function queryreport(Request $request)
    {
       
        $type = $request->type;
        $time = $request->time;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        if(strcasecmp($type,"all")==0 && strcasecmp($time,"all") == 0){
                        $report = CashierToReseller::groupBy('cashier_id','reseller_id')->selectRaw('*,sum(amount) as total')->where('status','=',1)->paginate(10);
                        $totalall = CashierToReseller::where('status',1)->sum('amount');

        }
        //Human or Agent 
        elseif(strcasecmp($type,"all")!=0 && strcasecmp($time,"all") == 0){
                        $report = CashierToReseller::join('cashier','transfer_cash2reseller_log.cashier_id','=','cashier.id')
                                                    ->groupBy('transfer_cash2reseller_log.cashier_id','transfer_cash2reseller_log.reseller_id')
                                                    ->where(['transfer_cash2reseller_log.status'=>1,'cashier.type'=>$type])
                                                    ->selectRaw('transfer_cash2reseller_log.id,transfer_cash2reseller_log.cashier_id,transfer_cash2reseller_log.reseller_id,transfer_cash2reseller_log.status,sum(transfer_cash2reseller_log.amount) as total,transfer_cash2reseller_log.date')
                                                    ->paginate(10);
            
                        $totalall =  CashierToReseller::join('cashier','transfer_cash2reseller_log.cashier_id','=','cashier.id')
                                                     ->where(['transfer_cash2reseller_log.status'=>1,'cashier.type'=>$type])
                                                     ->sum('transfer_cash2reseller_log.amount');
        }
        //Period
        elseif(strcasecmp($type,"all")==0 && strcasecmp($time,"all") != 0){
            if(strcasecmp($time,"today") ==0){
                        $from = date('Y-m-d'.' '.'00:00:00' ,time()); 
                        $to = date('Y-m-d 23:59:59',time());          
            }
            elseif(strcasecmp($time,"week") ==0){
                            $preweek = time() - (7 * 24 * 60 * 60);
                            $from = date('Y-m-d'.' '.'00:00:00', $preweek);
                            $to = date('Y-m-d 23:59:59',time());                           
            }
            elseif(strcasecmp($time,"month") ==0){
                            $premonth = time() - (30 * 24 * 60 * 60);
                            $from = date('Y-m-d'.' '.'00:00:00', $premonth);
                            $to = date('Y-m-d 23:59:59',time());      
            }
            elseif(strcasecmp($time,"year") ==0){
                            $preyear = time() - (364 * 24 * 60 * 60);
                            $from = date('Y-m-d'.' '.'00:00:00', $preyear);
                            $to = date('Y-m-d 23:59:59',time());
            }
            elseif(strcasecmp($time,"period") ==0){
                            $startdate1 = date_create($request->startdate);
                            $from = date_format($startdate1,"Y/m/d 00:00:00");
                            $enddate1 = date_create($request->enddate);
                            $to = date_format($enddate1,"Y/m/d 23:59:59");
                            $report = CashierToReseller::groupBy('cashier_id','reseller_id')->selectRaw('*,sum(amount) as total')
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->where(['status'=>'1'])
                                        ->paginate(10);

                            $totalall = CashierToReseller::where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->where(['status'=>'1'])
                                        ->sum('amount'); 
                            $report->setPath(url('/cashiertoreseller/type/'.$type.'/'.$time.'/'.$startdate.'/'.$enddate));
                            return view('reportcashtoreseller.index',['reports'=>$report,'totalall'=>$totalall,'type'=>$type,'time'=>$time]);

            }
            $report = CashierToReseller::groupBy('cashier_id','reseller_id')->selectRaw('*,sum(amount) as total')
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->where(['status'=>'1'])
                                        ->paginate(10);

            $totalall = CashierToReseller::where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->where(['status'=>'1'])
                                        ->sum('amount'); 
           
        }
               
        else{
                if(strcasecmp($time,"today") ==0){
                        $from = date('Y-m-d'.' '.'00:00:00' ,time()); 
                        $to = date('Y-m-d 23:59:59',time());
                       
                }
                elseif(strcasecmp($time,"week") ==0){
                            $preweek = time() - (7 * 24 * 60 * 60);
                            $from = date('Y-m-d'.' '.'00:00:00', $preweek);
                            $to = date('Y-m-d 23:59:59',time());                           
                }
                elseif(strcasecmp($time,"month") ==0){
                            $premonth = time() - (30 * 24 * 60 * 60);
                            $from = date('Y-m-d'.' '.'00:00:00', $premonth);
                            $to = date('Y-m-d 23:59:59',time());      
                }
                 elseif(strcasecmp($time,"year") ==0){
                            $preyear = time() - (364 * 24 * 60 * 60);
                            $from = date('Y-m-d'.' '.'00:00:00', $preyear);
                            $to = date('Y-m-d 23:59:59',time());
                }
                elseif(strcasecmp($time,"period") ==0){
                            $startdate1 = date_create($request->startdate);
                            $from = date_format($startdate1,"Y/m/d 00:00:00");
                            $enddate1 = date_create($request->enddate);
                            $to = date_format($enddate1,"Y/m/d 23:59:59");

                            $report = CashierToReseller::join('cashier','transfer_cash2reseller_log.cashier_id','=','cashier.id')
                                            ->groupBy('transfer_cash2reseller_log.cashier_id','transfer_cash2reseller_log.reseller_id')
                                            ->where(['transfer_cash2reseller_log.status'=>1,'cashier.type'=>$type])
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->selectRaw('transfer_cash2reseller_log.id,transfer_cash2reseller_log.cashier_id,transfer_cash2reseller_log.reseller_id,transfer_cash2reseller_log.status,sum(transfer_cash2reseller_log.amount) as total,transfer_cash2reseller_log.date')
                                            ->paginate(1);


                            $totalall = CashierToReseller::join('cashier','transfer_cash2reseller_log.cashier_id','=','cashier.id')
                                            ->where(['transfer_cash2reseller_log.status'=>1,'cashier.type'=>$type])
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->sum('transfer_cash2reseller_log.amount');


                            $report->setPath(url('/cashiertoreseller/type/'.$type.'/'.$time.'/'.$startdate.'/'.$enddate));
                            return view('reportcashtoreseller.index',['reports'=>$report,'totalall'=>$totalall,'type'=>$type,'time'=>$time]);

            }
                $report = CashierToReseller::join('cashier','transfer_cash2reseller_log.cashier_id','=','cashier.id')
                                            ->groupBy('transfer_cash2reseller_log.cashier_id','transfer_cash2reseller_log.reseller_id')
                                            ->where(['transfer_cash2reseller_log.status'=>1,'cashier.type'=>$type])
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->selectRaw('transfer_cash2reseller_log.id,transfer_cash2reseller_log.cashier_id,transfer_cash2reseller_log.reseller_id,transfer_cash2reseller_log.status,sum(transfer_cash2reseller_log.amount) as total,transfer_cash2reseller_log.date')
                                            ->paginate(1);

                $totalall = CashierToReseller::join('cashier','transfer_cash2reseller_log.cashier_id','=','cashier.id')
                                            ->where(['transfer_cash2reseller_log.status'=>1,'cashier.type'=>$type])
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->sum('transfer_cash2reseller_log.amount');
            }
              
            $report->setPath(url('/cashiertoreseller/type/'.$type.'/'.$time.'/period/period')); 
            return view('reportcashtoreseller.index',['reports'=>$report,'totalall'=>$totalall,'type'=>$type,'time'=>$time]);
           
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

   

  
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
