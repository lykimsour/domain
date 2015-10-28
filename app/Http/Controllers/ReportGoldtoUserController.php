<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GoldtoUserLog;
use DateTime;
use DB;
use App\GoldtoUserSabayDetail;
use App\Cashier;
class ReportGoldtoUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
            $from = date('Y-m-d'.' '.'00:00:00' ,time()); 
                $to = date('Y-m-d 23:59:59',time());          
                $report = GoldtoUserLog::groupBy('cashier_id')
                                            ->selectRaw('*,sum(amount) as total')
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->orderBy('id','DESC')
                                            ->paginate(env('page'));
                $totalall =  GoldtoUserLog::where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->sum('amount'); 
                $report->setPath('goldtouser');
                $type = "all";
                $time = "today";
                $chart = $this->chartdata(0,$type,$time,$from,$to);
                return view('reportgoldtouser.index',['reports'=>$report,'totalall'=>$totalall,'type'=>$type,'time'=>$time,'from'=>$from,'to'=>$to,'chart'=>$chart]);
                //return view('reportgoldtouser.index',['reports'=>$report,'totalall'=>$totalall,'type'=>$type,'time'=>$time,'from'=>$from,'to'=>$to]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
     public function chartdata($id,$type,$time,$from,$to){
        if($id ==0){
        if(strcasecmp($type,"all")==0 && strcasecmp($time,"all") == 0){
          $chart = DB::table('transfer_gold2user_log')
                        ->select('date',DB::raw('YEAR(date) as groupdate,SUM(amount) as total'))
                        ->groupBy('groupdate')
                        ->get();
                
        }
        //agent or HUMAN 
        elseif(strcasecmp($type,"all")!=0 && strcasecmp($time,"all") == 0){
             $chart = DB::table('transfer_gold2user_log')->join('cashier','transfer_gold2user_log.cashier_id','=','cashier.id')
                        ->select('date',DB::raw('YEAR(transfer_gold2user_log.date) as groupdate,SUM(transfer_gold2user_log.amount) as total'))
                        ->where(['cashier.type'=>$type])->groupBy('groupdate')
                        ->get();
        }
        //period
        elseif(strcasecmp($type,"all")==0 && strcasecmp($time,"all") != 0){
            if(strcasecmp($time,"year") ==0){
                 $chart = DB::table('transfer_gold2user_log')
                        ->select('date',DB::raw('MONTHNAME(date) as groupdate,SUM(amount) as total'))
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                       
            }
            elseif(strcasecmp($time,"period") ==0){
                 $chart = DB::table('transfer_gold2user_log')
                        ->select('date',DB::raw('cast(date as DATE) as groupdate,SUM(amount) as total'))
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
            }
            else{
                  $chart = DB::table('transfer_gold2user_log')
                        ->select('date',DB::raw('DAY(date) as groupdate,SUM(amount) as total'))
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                   
            }
        }

        //time $ type not all
        else{
                 if(strcasecmp($time,"year") ==0){
                    $chart = DB::table('transfer_gold2user_log')->join('cashier','transfer_gold2user_log.cashier_id','=','cashier.id')
                        ->select('date',DB::raw('MONTHNAME(transfer_gold2user_log.date) as groupdate,SUM(transfer_gold2user_log.amount) as total'))
                        ->where(['cashier.type'=>$type])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                }
                elseif(strcasecmp($time,"period") ==0){
                     $chart = DB::table('transfer_gold2user_log')->join('cashier','transfer_gold2user_log.cashier_id','=','cashier.id')
                        ->select('date',DB::raw('cast(transfer_gold2user_log.date as DATE) as groupdate,SUM(transfer_gold2user_log.amount) as total'))
                        ->where(['cashier.type'=>$type])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                }
                else{
                    $chart = DB::table('transfer_gold2user_log')->join('cashier','transfer_gold2user_log.cashier_id','=','cashier.id')
                        ->select('date',DB::raw('DAY(transfer_gold2user_log.date) as groupdate,SUM(transfer_gold2user_log.amount) as total'))
                        ->where(['cashier.type'=>$type])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get(); 
            }
        }
        }
        else{
                 if(strcasecmp($time,"all") == 0){
                         $chart = DB::table('transfer_gold2user_log')
                        ->select('date',DB::raw('YEAR(date) as groupdate,SUM(amount) as total'))
                        ->where(['cashier_id'=>$id])->groupBy('groupdate')
                        ->get();

                }
                 elseif(strcasecmp($time,"year") == 0){
                 $chart = DB::table('transfer_gold2user_log')
                        ->select('date',DB::raw('MONTHNAME(date) as groupdate,SUM(amount) as total'))
                        ->where(['cashier_id'=>$id])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                       
                }
                 elseif(strcasecmp($time,"period") == 0){
                      $chart = DB::table('transfer_gold2user_log')
                        ->select('date',DB::raw('cast(date as DATE) as groupdate,SUM(amount) as total'))
                        ->where(['cashier_id'=>$id])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                }
                else{
                      $chart = DB::table('transfer_gold2user_log')
                        ->select('date',DB::raw('DAY(date) as groupdate,SUM(amount) as total'))
                        ->where(['cashier_id'=>$id])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                }
             
        } 
        return $chart;
    }

    public function queryreport(Request $request)
    {
       
        $type = $request->type;
        $time = $request->time;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $start = $request->startdate;
        $end = $request->enddate;
        if(strcasecmp($type,"all")==0 && strcasecmp($time,"all") == 0){
                        $report = GoldtoUserLog::groupBy('cashier_id')
                                                    ->selectRaw('*,sum(amount) as total')
                                                    ->orderBy('id','asc')
                                                    ->paginate(env('page'));
                        $totalall = GoldtoUserLog::sum('amount');
                        $type = "all";
                        $from = "0";
                        $to = "0";

        }
         elseif(strcasecmp($type,"all")!=0 && strcasecmp($time,"all") == 0){
                         $from = "0";
                         $to = "0";
                         $report = GoldtoUserLog::join('cashier','transfer_gold2user_log.cashier_id','=','cashier.id')
                                                    ->groupBy('transfer_gold2user_log.cashier_id')
                                                    ->where(['cashier.type'=>$type])
                                                    ->selectRaw('transfer_gold2user_log.id,transfer_gold2user_log.cashier_id,transfer_gold2user_log.user_id,sum(transfer_gold2user_log.amount) as total,transfer_gold2user_log.date')
                                                    ->orderBy('id','asc')
                                                    ->paginate(env('page'));
                        $totalall =  GoldtoUserLog::join('cashier','transfer_gold2user_log.cashier_id','=','cashier.id')
                                                     ->where(['cashier.type'=>$type])
                                                     ->sum('transfer_gold2user_log.amount');
        }
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
                            $preyear = time() - (365 * 24 * 60 * 60);
                            $from = date('Y-m-d'.' '.'00:00:00', $preyear);
                            $to = date('Y-m-d 23:59:59',time());


            }
            elseif(strcasecmp($time,"period") ==0){

                    $startd= DateTime::createFromFormat("F-d-Y", $request->startdate);
                    $from  = $startd->format('Y-m-d 00:00:00');
                    $endd  = DateTime::createFromFormat("F-d-Y", $request->enddate);
                    $to   = $endd->format('Y-m-d 23:59:59');
                            
            }
            $report = GoldtoUserLog::groupBy('cashier_id')->selectRaw('*,sum(amount) as total')
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->orderBy('date','ASC')
                                        ->paginate(env('page'));

            $totalall = GoldtoUserLog::where('date','>=',$from)
                                        ->where('date','<=',$to)
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
                            $preyear = time() - (365 * 24 * 60 * 60);
                            $from = date('Y-m-d'.' '.'00:00:00', $preyear);
                            $to = date('Y-m-d 23:59:59',time());
                }
                elseif(strcasecmp($time,"period") ==0){
                        $startd= DateTime::createFromFormat("F-d-Y", $request->startdate);
                        $from  = $startd->format('Y-m-d 00:00:00');
                        $endd  = DateTime::createFromFormat("F-d-Y", $request->enddate);
                        $to   = $endd->format('Y-m-d 23:59:59');

            }
                $report = GoldtoUserLog::join('cashier','transfer_gold2user_log.cashier_id','=','cashier.id')
                                            ->groupBy('transfer_gold2user_log.cashier_id')
                                            ->where(['cashier.type'=>$type])
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->orderBy('date','ASC')
                                            ->selectRaw('transfer_gold2user_log.id,transfer_gold2user_log.cashier_id,transfer_gold2user_log.user_id,sum(transfer_gold2user_log.amount) as total,transfer_gold2user_log.date')
                                            ->paginate(env('page'));

                $totalall = GoldtoUserLog::join('cashier','transfer_gold2user_log.cashier_id','=','cashier.id')
                                            ->where(['cashier.type'=>$type])
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->sum('transfer_gold2user_log.amount');

        }
        $chart = $this->chartdata(0,$type,$time,$from,$to);
        $report->setPath(url('/goldtouser/type/'.$type.'/'.$time.'/'.$start.'/'.$end)); 
        return view('reportgoldtouser.index',['reports'=>$report,'totalall'=>$totalall,'type'=>$type,'time'=>$time,'from'=>$start,'to'=>$end,'chart'=>$chart]);
        //return view('reportgoldtouser.index',['reports'=>$report,'totalall'=>$totalall,'type'=>$type,'time'=>$time,'from'=>$start,'to'=>$end]);

    }
      public function details($id,Request $request){
        return $this->detail($id,$request->time,$request->startdate,$request->enddate);
    }

    public function detail($id,$time,$startdate,$enddate)
    {
        $reportctor = GoldtoUserLog::findOrFail($id);
        $cashiername = $reportctor->cashier->name;

        if(strcasecmp($time,"all") == 0){
           $report = GoldtoUserLog::where(['cashier_id'=>$reportctor->cashier_id])
                                        ->orderBy('id','DESC')->paginate(env('page'));
            $totalall = GoldtoUserLog::where(['cashier_id'=>$reportctor->cashier_id])->sum('amount');      
            $from = $startdate;
            $to = $enddate;
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
                            $preyear = time() - (365 * 24 * 60 * 60);
                            $from = date('Y-m-d'.' '.'00:00:00', $preyear);
                            $to = date('Y-m-d 23:59:59',time());
                }
                elseif(strcasecmp($time,"period") ==0){

                    $startd= DateTime::createFromFormat("F-d-Y", $startdate);
                    $from  = $startd->format('Y-m-d 00:00:00');
                    $endd  = DateTime::createFromFormat("F-d-Y", $enddate);
                    $to   = $endd->format('Y-m-d 23:59:59');


                }
            $report = GoldtoUserLog::where(['cashier_id'=>$reportctor->cashier_id])
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->paginate(env('page'));

            $totalall=GoldtoUserLog::where(['cashier_id'=>$reportctor->cashier_id])
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->sum('amount');

                                        
        }
        //dd($reportctor->cashier_id);
        $chart = $this->chartdata($reportctor->cashier_id,"all",$time,$from,$to);
        $report->setPath(url('/goldtouser/detail/'.$id.'/'.$time.'/'.$startdate.'/'.$enddate));
        return view('reportgoldtouser.detail',['reports'=>$report,'totalall'=>$totalall,'time'=>$time,'from'=>$startdate,'to'=>$enddate,'reportid'=>$id,'chart'=>$chart,'cashiername'=>$cashiername]);
    }
     public function recorddetail($id)
    {
        //return $id;
        $reportlog = GoldtoUserLog::findOrFail($id);
        $cashier = Cashier::findOrFail($reportlog->cashier_id);
        $type;
        if(strcasecmp($cashier->type,"human") == 0){
            $reports = GoldtoUserSabayDetail::where('transfer_gold2user_log_id',$id)->firstOrFail();
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
        return view('reportgoldtouser.recorddetail',['report'=>$reports,'type'=>$type]);    
  
       
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
