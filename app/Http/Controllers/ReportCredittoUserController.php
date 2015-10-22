<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CredittoUserLog;
use DB;
use App\CredittoUserDetail;
use DateTime;
class ReportCredittoUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     public function chartdata($id,$type,$time,$from,$to){
        if($id ==0){
           if(strcasecmp($time,"all") == 0){
                $chart = DB::table('transfer_credit2user_log')
                        ->select('date',DB::raw('YEAR(date) as groupdate,SUM(amount) as total'))
                        ->groupBy('groupdate')
                        ->get();
                
            }
            elseif(strcasecmp($time,"year") ==0){
                 $chart = DB::table('transfer_credit2user_log')
                        ->select('date',DB::raw('MONTHNAME(date) as groupdate,SUM(amount) as total'))
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                       
                }
            elseif(strcasecmp($time,"period") ==0){
                 $chart = DB::table('transfer_credit2user_log')
                        ->select('date',DB::raw('cast(date as DATE) as groupdate,SUM(amount) as total'))
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                }
            else{
                  $chart = DB::table('transfer_credit2user_log')
                        ->select('date',DB::raw('DAY(date) as groupdate,SUM(amount) as total'))
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                   
                }
            
           
            }
             else{
                if(strcasecmp($time,"all") == 0){
                         $chart = DB::table('transfer_credit2user_log')
                        ->select('date',DB::raw('YEAR(date) as groupdate,SUM(amount) as total'))
                        ->where(['reseller_id'=>$id])->groupBy('groupdate')
                        ->get();

                }
                 elseif(strcasecmp($time,"year") == 0){
                 $chart = DB::table('transfer_credit2user_log')
                        ->select('date',DB::raw('MONTHNAME(date) as groupdate,SUM(amount) as total'))
                        ->where(['reseller_id'=>$id])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                       
                }
                 elseif(strcasecmp($time,"period") == 0){
                      $chart = DB::table('transfer_credit2user_log')
                        ->select('date',DB::raw('cast(date as DATE) as groupdate,SUM(amount) as total'))
                        ->where(['reseller_id'=>$id])
                        ->where('date','>=',$from)
                        ->where('date','<=',$to)
                        ->groupBy('groupdate')
                        ->get();
                }
                else{
                      $chart = DB::table('transfer_credit2user_log')
                        ->select('date',DB::raw('DAY(date) as groupdate,SUM(amount) as total'))
                        ->where(['reseller_id'=>$id])
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
        $report = CredittoUserLog::groupBy('reseller_id')
                                            ->selectRaw('*,sum(amount) as total')
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->orderBy('id','DESC')
                                            ->paginate(env('page'));
         $totalall = CredittoUserLog::groupBy('reseller_id')
                                            ->selectRaw('*,sum(amount) as total')
                                            ->where('date','>=',$from)
                                            ->where('date','<=',$to)
                                            ->sum('amount');
        $report->setPath('credittouser');
        $type = "all";
        $time = "today";
        $chart = $this->chartdata(0,$type,$time,$from,$to);
        return view('reportcredittouser.index',['type'=>$type,'time'=>$time,'reports'=>$report,'chart'=>$chart,'from'=>$from,'to'=>$to,'totalall'=>$totalall]);
    }

    public function queryreport(Request $request)
    {
       
        $type = $request->type;
        $time = $request->time;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $start = $request->startdate;
        $end = $request->enddate;
         if(strcasecmp($time,"all") == 0){
                        $report = CredittoUserLog::groupBy('reseller_id')
                                                    ->selectRaw('*,sum(amount) as total')
                                                    ->orderBy('id','asc')
                                                    ->paginate(env('page'));
                        $totalall = CredittoUserLog::sum('amount');
                        $type = "all";
                        $from = "0";
                        $to = "0";

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
        

        $report = CredittoUserLog::groupBy('reseller_id')->selectRaw('*,sum(amount) as total')
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->orderBy('date','ASC')
                                        ->paginate(env('page'));

        $totalall = CredittoUserLog::where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->sum('amount'); 
        }
        $chart = $this->chartdata(0,$type,$time,$from,$to);
        $report->setPath(url('/credittouser/type'.'/'.$time.'/'.$start.'/'.$end)); 
        return view('reportcredittouser.index',['reports'=>$report,'totalall'=>$totalall,'type'=>$type,'time'=>$time,'from'=>$start,'to'=>$end,'chart'=>$chart]);

    }
     public function details($id,Request $request){
        return $this->detail($id,$request->time,$request->startdate,$request->enddate);
    }

    public function detail($id,$time,$startdate,$enddate)
    {
        $reportctor = CredittoUserLog::findOrFail($id);
    
        if(strcasecmp($time,"all") == 0){
           $report = CredittoUserLog::where(['reseller_id'=>$reportctor->reseller_id])
                                    ->orderBy('id','DESC')->paginate(50);
            $totalall = CredittoUserLog::where(['reseller_id'=>$reportctor->reseller_id])->sum('amount');      
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
            $report = CredittoUserLog::where(['reseller_id'=>$reportctor->reseller_id])
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->paginate(50);

            $totalall = CredittoUserLog::where(['reseller_id'=>$reportctor->reseller_id])
                                        ->where('date','>=',$from)
                                        ->where('date','<=',$to)
                                        ->sum('amount');

                                        
        }

        $chart = $this->chartdata($reportctor->reseller_id,"all",$time,$from,$to);
        $report->setPath(url('/credittouser/detail/'.$id.'/'.$time.'/'.$startdate.'/'.$enddate));
        return view('reportcredittouser.detail',['reports'=>$report,'totalall'=>$totalall,'time'=>$time,'from'=>$startdate,'to'=>$enddate,'reportid'=>$id,'chart'=>$chart]);
    }
     public function recorddetail($id)
    {
        $reportlog = CredittoUserDetail::where('transfer_credit2user_id',$id)->firstOrFail();
       return view('reportcredittouser.recorddetail',['report'=>$reportlog]);
    }
}
