<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Classes\Flash;
use App\Classes\Helper;
use Auth;
use Carbon\Carbon;

use App\Reseller;
use App\ResellerLog;
use App\ResellerLogDetail;
use App\Invoice;

use PDF;


class TransfersController extends Controller
{

    private $max_log_list = 10;

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        return view('transfers.index');   
    }

    public function send(Request $send)
    {
    	$result = '';
      $invoice_id = null;

     	$reseller = Reseller::find($send->id);

      if($reseller)
      {
        $log = new ResellerLog;
        $log->cashier_id = Auth::user()->id;
        $log->reseller__id = $send->id;
        $log->amount = $send->amount;
        $log->status = false;
        $log->date = Carbon::now()->toDateTimeString();

        if($log->save())
        {
          $log_detail = new ResellerLogDetail;
          $log_detail->log_id = $log->id;
          $log_detail->ip = $send->ip();
          $log_detail->save();

          $reseller->coin = $reseller->coin + $send->amount;
          if($reseller->save())
          {
            $log->status = true;
            $log->save();

            $invoice_id = $log->id;

            Flash::success('Transfer successful.');
          }
        }
        else
        {
          Flash::error('Transfer error.');
        }
      }
      else
      {
        Flash::error('Reseller not found.');
      }
      


			return redirect()->back()->with('invoice_id', $invoice_id);

    }


    public function transfersHistory()
    {
      $reseller_logs = Auth::user()->transfer_reseller_logs()->orderBy('date', 'DESC')->take($this->max_log_list)->skip(0)->get();

      $reseller_next_list = (count(Auth::user()->transfer_reseller_logs) <= $this->max_log_list) ? false : true;


      return view('transfers.history', ['reseller_logs' => $reseller_logs, 'reseller_next_list' => $reseller_next_list]);
    }


    public function load_resller_history($page)
    {
      $skip = ($page - 1) * $this->max_log_list;

      $reseller_logs = Auth::user()->transfer_reseller_logs()->orderBy('date', 'DESC')->take($this->max_log_list)->skip($skip)->get();

      $reseller_next_list = (count(Auth::user()->transfer_reseller_logs) <= $this->max_log_list * $page) ? false : true;

      $data = '';
      foreach ($reseller_logs as $log) {
        $data .= '<tr>';
          $data .= '<td>'.Helper::humanDate($log->date).'</td>';
          $data .= '<td>'.$log->id.'</td>';
          $data .= '<td>'.$log->reseller__id.'</td>';
          $data .= '<td>'.$log->amount.'</td>';
          $data .= '<td>'.$log->status.'</td>';
        $data .= '</tr>';
      }

      return response()->json(['data' => $data, 'next' => $reseller_next_list]);
    }

    public function invoice($id)
    {
      $log = ResellerLog::find($id);

      if($log)
      {
        return view('transfers.invoice', ['log' => $log]);
      }

      return view('errors.404');

    }

    // public function pdf($id)
    // {
    //   $log = ResellerLog::find($id);

    //   if($log)
    //   {
    //     $pdf = PDF::loadView('pdf.invoice', ['log' => $log]);
    //     $name = "invoice-"+date("n-j-Y", strtotime($log->date))+"-"+$id;
    //     return $pdf->download($name+'.pdf');
    //   }

    //   return redirect()->back();

    // }


}