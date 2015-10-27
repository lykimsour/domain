<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CashtoUserLog;
use DateTime;
use App\Cashier;
use App\CashtoUsermpu;
use DB;
use App\CashtoUserwing;
use App\CashtoUsersabay;
use App\CashtoUsermycard;
use App\CashtoUserpayngo;
use App\CashtoUserogmgc;
use App\CashtoUsersrc;
use Redirect;
class ReportCashtoUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
      public function chartdata($id,$type,$time,$from,$to){
        if($id ==0){
            if(strcasecmp($type,"all")==0 && strcasecmp($time,"all") == 0){
                $chart = DB::table('transfer_cash2user_log')
                        ->select('date',DB::raw('YEAR(date) as groupdate,SUM(amount) as total'))
                        ->where('status','=',1)->groupBy('groupdate')
                        ->get();
                
            }
             //agent or HUMAN 
            elseif(strcasecmp($type,"all")!=0 && strcasecmp($time,"all") == 0){
             $chart = DB::table('transfer_cash2user_log')->join('cashier','transfer_cash2user_log.cashier_id','=','cashier.id')
                        ->select('date',DB::raw('YEAR(transfer_cash2user_log.date) as groupdate,SUM(transfer_cash2user_log.amount) as total'))
                        ->where(['transfer_cash2user_log.status'=>1,'cashier.type'=>$type])->groupBy('groupdate')
                        ->get();
            }

            elseif(strcasecmp($type,"all")==0 && strcasecmp($time,"all") != 0){
                if(strcasecmp($time,"year") ==0){
                 $chart = DB::table('transfer_cash2user_log')
                        ->select('date',DB::raw('MONTHNAME(date) as groupdate,SUM(amount) as total'))
                        ->where('status','=',1)
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                       
                }
                elseif(strcasecmp($time,"period") ==0){
                 $chart = DB::table('transfer_cash2user_log')
                        ->select('date',DB::raw('cast(date as DATE) as groupdate,SUM(amount) as total'))
                        ->where('status','=',1)
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                }
                else{
                  $chart = DB::table('transfer_cash2user_log')
                        ->select('date',DB::raw('DAY(date) as groupdate,SUM(amount) as total'))
                        ->where('status','=',1)
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                   
                }
            }
            else{
                    if(strcasecmp($time,"year") ==0){
                        $chart = DB::table('transfer_cash2user_log')->join('cashier','transfer_cash2user_log.cashier_id','=','cashier.id')
                        ->select('date',DB::raw('MONTHNAME(transfer_cash2user_log.date) as groupdate,SUM(transfer_cash2user_log.amount) as total'))
                        ->where(['transfer_cash2user_log.status'=>1,'cashier.type'=>$type])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                    }
                     elseif(strcasecmp($time,"period") ==0){
                        $chart = DB::table('transfer_cash2user_log')->join('cashier','transfer_cash2user_log.cashier_id','=','cashier.id')
                        ->select('date',DB::raw('cast(transfer_cash2user_log.date as DATE) as groupdate,SUM(transfer_cash2user_log.amount) as total'))
                        ->where(['transfer_cash2user_log.status'=>1,'cashier.type'=>$type])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                }
                 else{
                    $chart = DB::table('transfer_cash2user_log')->join('cashier','transfer_cash2user_log.cashier_id','=','cashier.id')
                        ->select('date',DB::raw('DAY(transfer_cash2user_log.date) as groupdate,SUM(transfer_cash2user_log.amount) as total'))
                        ->where(['transfer_cash2user_log.status'=>1,'cashier.type'=>$type])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get(); 
                }
            }
            }
        else{
                 if(strcasecmp($time,"all") == 0){
                         $chart = DB::table('transfer_cash2user_log')
                        ->select('date',DB::raw('YEAR(date) as groupdate,SUM(amount) as total'))
                        ->where(['status'=>1,'cashier_id'=>$id])->groupBy('groupdate')
                        ->get();

                }
                 elseif(strcasecmp($time,"year") == 0){
                 $chart = DB::table('transfer_cash2user_log')
                        ->select('date',DB::raw('MONTHNAME(date) as groupdate,SUM(amount) as total'))
                        ->where(['status'=>1,'cashier_id'=>$id])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                       
                }
                 elseif(strcasecmp($time,"period") == 0){
                      $chart = DB::table('transfer_cash2user_log')
                        ->select('date',DB::raw('cast(date as DATE) as groupdate,SUM(amount) as total'))
                        ->where(['status'=>1,'cashier_id'=>$id])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                }
                else{
                      $chart = DB::table('transfer_cash2user_log')
                        ->select('date',DB::raw('DAY(date) as groupdate,SUM(amount) as total'))
                        ->where(['status'=>1,'cashier_id'=>$id])
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
        //return url();
        
       
        $type = $request->type;
        $time = $request->time;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $start = $request->startdate;
        $end = $request->enddate;

        if(strcasecmp($type,"all")==0 && strcasecmp($time,"all") == 0){

                        $report = CashtoUserLog::groupBy('cashier_id')
                                                    ->selectRaw('*,sum(amount) as total')->where('status','=',1)
                                                    ->orderBy('id','asc')
                                                    ->paginate(env('page'));

                       

                       //dd($chart);
                        $totalall = CashtoUserLog::where('status',1)->sum('amount');
                        $type = "all";
                        $from = "0";
                        $to = "0";

        }
        //Human or Agent 
        elseif(strcasecmp($type,"all")!=0 && strcasecmp($time,"all") == 0){
                         $from = "0";
                         $to = "0";
                         $report = CashtoUserLog::join('cashier','transfer_cash2user_log.cashier_id','=','cashier.id')
                                                    ->groupBy('transfer_cash2user_log.cashier_id')
                                                    ->where(['transfer_cash2user_log.status'=>1,'cashier.type'=>$type])
                                                    ->selectRaw('transfer_cash2user_log.id,transfer_cash2user_log.cashier_id,transfer_cash2user_log.user_id,transfer_cash2user_log.status,sum(transfer_cash2user_log.amount) as total,transfer_cash2user_log.date')
                                                    ->orderBy('id','asc')
                                                    ->paginate(env('page'));
            
                        $totalall =  CashtoUserLog::join('cashier','transfer_cash2user_log.cashier_id','=','cashier.id')
                                                     ->where(['transfer_cash2user_log.status'=>1,'cashier.type'=>$type])
                                                     ->sum('transfer_cash2user_log.amount');
    
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
                            //dd($from.' '.$to);                          
            }
            elseif(strcasecmp($time,"month") ==0){
                            $premonth = time() - (30 * 24 * 60 * 60);
                            $from = date('Y-m-d'.' '.'00:00:00', $premonth);
                            $to = date('Y-m-d 23:59:59',time()); 
                            //dd($from.' '.$to);      
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
       
             $report = CashtoUserLog::groupBy('cashier_id')->selectRaw('*,sum(amount) as total')
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->where(['status'=>'1'])
                                        ->orderBy('date','ASC')
                                        ->paginate(env('page'));

            $totalall = CashtoUserLog::where('date','>=',$from)
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
                $report = CashtoUserLog::join('cashier','transfer_cash2user_log.cashier_id','=','cashier.id')
                                            ->groupBy('transfer_cash2user_log.cashier_id')
                                            ->where(['transfer_cash2user_log.status'=>1,'cashier.type'=>$type])
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->orderBy('date','ASC')
                                            ->selectRaw('transfer_cash2user_log.id,transfer_cash2user_log.cashier_id,transfer_cash2user_log.user_id,transfer_cash2user_log.status,sum(transfer_cash2user_log.amount) as total,transfer_cash2user_log.date')
                                            ->paginate(env('page'));

                $totalall = CashtoUserLog::join('cashier','transfer_cash2user_log.cashier_id','=','cashier.id')
                                            ->where(['transfer_cash2user_log.status'=>1,'cashier.type'=>$type])
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->sum('transfer_cash2user_log.amount');
            }
        $chart = $this->chartdata(0,$type,$time,$from,$to);
        $report->setPath(url('/cashtouser/type/'.$type.'/'.$time.'/'.$start.'/'.$end)); 
        return view('reportcashtouser.index',['reports'=>$report,'totalall'=>$totalall,'type'=>$type,'time'=>$time,'from'=>$start,'to'=>$end,'chart'=>$chart]);
    }
    public function index()
    {
                $from = date('Y-m-d'.' '.'00:00:00' ,time()); 
                $to = date('Y-m-d 23:59:59',time());          
                $report = CashtoUserLog::groupBy('cashier_id')
                                            ->selectRaw('*,sum(amount) as total')
                                            ->where('status','=',1)
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->orderBy('id','DESC')
                                            ->paginate(env('page'));
                $report->setPath('cashtouser');
                $totalall = CashtoUserLog::where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->where(['status'=>'1'])
                                        ->sum('amount'); 
                $type = "all";
                $time = "today";
                $chart = $this->chartdata(0,$type,$time,$from,$to);
                return view('reportcashtouser.index',['reports'=>$report,'totalall'=>$totalall,'type'=>$type,'time'=>$time,'from'=>$from,'to'=>$to,'chart'=>$chart]);

    }





    public function details($id,Request $request){

        return $this->detail($id,$request->time,$request->startdate,$request->enddate);
    }

    public function detail($id,$time,$startdate,$enddate)
    {
        $reportctor = CashtoUserLog::findOrFail($id);
        $cashiername = $reportctor->cashier->name;

        if(strcasecmp($time,"all") == 0){
           $report = CashtoUserLog::where(['status'=>1,'cashier_id'=>$reportctor->cashier_id])
                                    ->orderBy('id','DESC')->paginate(env('page'));
            $totalall = CashtoUserLog::where(['status'=>1,'cashier_id'=>$reportctor->cashier_id])->sum('amount');      
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
            $report = CashtoUserLog::where(['status'=>1,'cashier_id'=>$reportctor->cashier_id])
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->paginate(env('page'));

            $totalall = CashtoUserLog::where(['status'=>1,'cashier_id'=>$reportctor->cashier_id])
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->sum('amount');

                                        
        }
        
        $chart = $this->chartdata($reportctor->cashier_id,"all",$time,$from,$to);
        $report->setPath(url('/cashtouser/detail/'.$id.'/'.$time.'/'.$startdate.'/'.$enddate));
        return view('reportcashtouser.detail',['reports'=>$report,'totalall'=>$totalall,'time'=>$time,'from'=>$startdate,'to'=>$enddate,'reportid'=>$id,'chart'=>$chart,'cashiername'=>$cashiername]);
    }
   


     public function recorddetail($id)
    {
        $reportlog = CashtoUserLog::findOrFail($id);
        $cashier = Cashier::findOrFail($reportlog->cashier_id);
        $type;
        if(strcasecmp($cashier->type,"human") == 0){
            $reports = CashtoUsersabay::where('transfer_cash2user_log_id',$id)->firstOrFail();
            $type = "human";
        }
        else{
                if(strcasecmp($cashier->name,"mpu")==0){
                    $reports = CashtoUsermpu::where('transfer_cash2user_log_id',$id)->firstOrFail();
                }
                 elseif(strcasecmp($cashier->name,"wing")==0){
                    $reports = CashtoUserwing::where('transfer_cash2user_log_id',$id)->firstOrFail();
                }
                 elseif(strcasecmp($cashier->name,"mycard")==0){
                    $reports = CashtoUsermycard::where('transfer_cash2user_log_id',$id)->firstOrFail();
                }
                elseif(strcasecmp($cashier->name,"payngo")==0){
                    $reports = CashtoUserpayngo::where('transfer_cash2user_log_id',$id)->firstOrFail();
                }
                elseif(strcasecmp($cashier->name,"ogmgc")==0){
                    $reports = CashtoUserogmgc::where('transfer_cash2user_log_id',$id)->firstOrFail();
                }
                elseif(strcasecmp($cashier->name,"scr")==0){
                    //return $cashier->name;
                    $reports = CashtoUsersrc::where('transfer_cash2user_log_id',$id)->firstOrFail();
                }
                $type =  $cashier->name;
           } 
        return view('reportcashtouser.recorddetail',['report'=>$reports,'type'=>$type]);    
       
  
       
    }
}
