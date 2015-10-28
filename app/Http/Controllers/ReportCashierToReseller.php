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
use DateTime;
class ReportCashierToReseller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    //time = all type=all
    public function chartdata($id,$type,$time,$from,$to){
        if($id ==0){
        if(strcasecmp($type,"all")==0 && strcasecmp($time,"all") == 0){
          $chart = DB::table('transfer_cash2reseller_log')
                        ->select('date',DB::raw('YEAR(date) as groupdate,SUM(amount) as total'))
                        ->where('status','=',1)->groupBy('groupdate')
                        ->get();
                
        }
        //agent or HUMAN 
        elseif(strcasecmp($type,"all")!=0 && strcasecmp($time,"all") == 0){
             $chart = DB::table('transfer_cash2reseller_log')->join('cashier','transfer_cash2reseller_log.cashier_id','=','cashier.id')
                        ->select('date',DB::raw('YEAR(transfer_cash2reseller_log.date) as groupdate,SUM(transfer_cash2reseller_log.amount) as total'))
                        ->where(['transfer_cash2reseller_log.status'=>1,'cashier.type'=>$type])->groupBy('groupdate')
                        ->get();
        }
        //period
        elseif(strcasecmp($type,"all")==0 && strcasecmp($time,"all") != 0){
            if(strcasecmp($time,"year") ==0){
                 $chart = DB::table('transfer_cash2reseller_log')
                        ->select('date',DB::raw('MONTHNAME(date) as groupdate,SUM(amount) as total'))
                        ->where('status','=',1)
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                       
            }
            elseif(strcasecmp($time,"period") ==0){
                 $chart = DB::table('transfer_cash2reseller_log')
                        ->select('date',DB::raw('cast(date as DATE) as groupdate,SUM(amount) as total'))
                        ->where('status','=',1)
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
            }
            else{
                  $chart = DB::table('transfer_cash2reseller_log')
                        ->select('date',DB::raw('DAY(date) as groupdate,SUM(amount) as total'))
                        ->where('status','=',1)
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                   
            }
        }

        //time $ type not all
        else{
                 if(strcasecmp($time,"year") ==0){
                    $chart = DB::table('transfer_cash2reseller_log')->join('cashier','transfer_cash2reseller_log.cashier_id','=','cashier.id')
                        ->select('date',DB::raw('MONTHNAME(transfer_cash2reseller_log.date) as groupdate,SUM(transfer_cash2reseller_log.amount) as total'))
                        ->where(['transfer_cash2reseller_log.status'=>1,'cashier.type'=>$type])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                }
                elseif(strcasecmp($time,"period") ==0){
                     $chart = DB::table('transfer_cash2reseller_log')->join('cashier','transfer_cash2reseller_log.cashier_id','=','cashier.id')
                        ->select('date',DB::raw('cast(transfer_cash2reseller_log.date as DATE) as groupdate,SUM(transfer_cash2reseller_log.amount) as total'))
                        ->where(['transfer_cash2reseller_log.status'=>1,'cashier.type'=>$type])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                }
                else{
                    $chart = DB::table('transfer_cash2reseller_log')->join('cashier','transfer_cash2reseller_log.cashier_id','=','cashier.id')
                        ->select('date',DB::raw('DAY(transfer_cash2reseller_log.date) as groupdate,SUM(transfer_cash2reseller_log.amount) as total'))
                        ->where(['transfer_cash2reseller_log.status'=>1,'cashier.type'=>$type])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get(); 
            }
        }
        }
        else{
                 if(strcasecmp($time,"all") == 0){
                         $chart = DB::table('transfer_cash2reseller_log')
                        ->select('date',DB::raw('YEAR(date) as groupdate,SUM(amount) as total'))
                        ->where(['status'=>1,'cashier_id'=>$id])->groupBy('groupdate')
                        ->get();

                }
                 elseif(strcasecmp($time,"year") == 0){
                 $chart = DB::table('transfer_cash2reseller_log')
                        ->select('date',DB::raw('MONTHNAME(date) as groupdate,SUM(amount) as total'))
                        ->where(['status'=>1,'cashier_id'=>$id])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                       
                }
                 elseif(strcasecmp($time,"period") == 0){
                      $chart = DB::table('transfer_cash2reseller_log')
                        ->select('date',DB::raw('cast(date as DATE) as groupdate,SUM(amount) as total'))
                        ->where(['status'=>1,'cashier_id'=>$id])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                }
                else{
                      $chart = DB::table('transfer_cash2reseller_log')
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


    public function index()
    {   
                $from = date('Y-m-d'.' '.'00:00:00' ,time()); 
                $to = date('Y-m-d 23:59:59',time());          
                $report = CashierToReseller::groupBy('cashier_id')
                                            ->selectRaw('*,sum(amount) as total')
                                            ->where('status','=',1)
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->orderBy('id','DESC')
                                            ->paginate(env('PAGINATION'));
                $totalall = CashierToReseller::where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->where(['status'=>'1'])
                                        ->sum('amount'); 
                $report->setPath('cashiertoreseller');
                $type = "all";
                $time = "today";
                $chart = $this->chartdata(0,$type,$time,$from,$to);
                return view('reportcashtoreseller.index',['reports'=>$report,'totalall'=>$totalall,'type'=>$type,'time'=>$time,'from'=>$from,'to'=>$to,'chart'=>$chart]);
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
                        $report = CashierToReseller::groupBy('cashier_id')
                                                    ->selectRaw('*,sum(amount) as total')->where('status','=',1)
                                                    ->orderBy('id','asc')
                                                    ->paginate(env('PAGINATION'));
                        $totalall = CashierToReseller::where('status',1)->sum('amount');
                        $type = "all";
                        $from = "0";
                        $to = "0";

        }
        //Human or Agent 
        elseif(strcasecmp($type,"all")!=0 && strcasecmp($time,"all") == 0){
                         $from = "0";
                         $to = "0";
                         $report = CashierToReseller::join('cashier','transfer_cash2reseller_log.cashier_id','=','cashier.id')
                                                    ->groupBy('transfer_cash2reseller_log.cashier_id')
                                                    ->where(['transfer_cash2reseller_log.status'=>1,'cashier.type'=>$type])
                                                    ->selectRaw('transfer_cash2reseller_log.id,transfer_cash2reseller_log.cashier_id,transfer_cash2reseller_log.reseller_id,transfer_cash2reseller_log.status,sum(transfer_cash2reseller_log.amount) as total,transfer_cash2reseller_log.date')
                                                    ->orderBy('id','asc')
                                                    ->paginate(env('PAGINATION'));
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
            $report = CashierToReseller::groupBy('cashier_id')->selectRaw('*,sum(amount) as total')
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->where(['status'=>'1'])
                                        ->orderBy('date','ASC')
                                        ->paginate(env('PAGINATION'));

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
                $report = CashierToReseller::join('cashier','transfer_cash2reseller_log.cashier_id','=','cashier.id')
                                            ->groupBy('transfer_cash2reseller_log.cashier_id')
                                            ->where(['transfer_cash2reseller_log.status'=>1,'cashier.type'=>$type])
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->orderBy('date','ASC')
                                            ->selectRaw('transfer_cash2reseller_log.id,transfer_cash2reseller_log.cashier_id,transfer_cash2reseller_log.reseller_id,transfer_cash2reseller_log.status,sum(transfer_cash2reseller_log.amount) as total,transfer_cash2reseller_log.date')
                                            ->paginate(env('PAGINATION'));

                $totalall = CashierToReseller::join('cashier','transfer_cash2reseller_log.cashier_id','=','cashier.id')
                                            ->where(['transfer_cash2reseller_log.status'=>1,'cashier.type'=>$type])
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->sum('transfer_cash2reseller_log.amount');
            }

            $chart = $this->chartdata(0,$type,$time,$from,$to);
            $report->setPath(url('/cashiertoreseller/type/'.$type.'/'.$time.'/'.$start.'/'.$end)); 
            return view('reportcashtoreseller.index',['reports'=>$report,'totalall'=>$totalall,'type'=>$type,'time'=>$time,'from'=>$start,'to'=>$end,'chart'=>$chart]);
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function details($id,Request $request){
        return $this->detail($id,$request->time,$request->startdate,$request->enddate);
    }

    public function detail($id,$time,$startdate,$enddate)
    {
        $reportctor = CashierToReseller::findOrFail($id);
        $cashiername = $reportctor->cashier->name;

        if(strcasecmp($time,"all") == 0){
           $report = CashierToReseller::where(['status'=>1,'cashier_id'=>$reportctor->cashier_id])
                                        ->orderBy('id','DESC')->paginate(env('PAGINATION'));
            $totalall = CashierToReseller::where(['status'=>1,'cashier_id'=>$reportctor->cashier_id])->sum('amount');      
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
            $report = CashierToReseller::where(['status'=>1,'cashier_id'=>$reportctor->cashier_id])
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->paginate(env('PAGINATION'));

            $totalall=CashierToReseller::where(['status'=>1,'cashier_id'=>$reportctor->cashier_id])
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->sum('amount');

                                        
        }
        //dd($reportctor->cashier_id);
        $chart = $this->chartdata($reportctor->cashier_id,"all",$time,$from,$to);
        $report->setPath(url('/cashiertoreseller/detail/'.$id.'/'.$time.'/'.$startdate.'/'.$enddate));
        return view('reportcashtoreseller.detail',['reports'=>$report,'totalall'=>$totalall,'time'=>$time,'from'=>$startdate,'to'=>$enddate,'reportid'=>$id,'chart'=>$chart,'cashiername'=>$cashiername]);
    }

  
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
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
  
   

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
