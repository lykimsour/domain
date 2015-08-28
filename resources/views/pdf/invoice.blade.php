<section class="content" id="invoice">
		<div class="row">
			<section class="invoice">
		    <!-- title row -->
		    <div class="row">
		      <div class="col-xs-12">
		        <h2 class="page-header">
		          {!! Html::image('images/footer-logo.png', '', []) !!} 

		          <small class="pull-right">Date: {{date("n/j/Y", strtotime($log->date))}}</small>
		        </h2>
		      </div><!-- /.col -->
		    </div>
		    <!-- info row -->
		    <div class="row invoice-info">
		      <div class="col-sm-4 invoice-col">
		        From
		        <address>
		          <strong>Sabay Digital Corp.</strong><br>
		          #308, Preah Monivong Blvd, <br>
		          Phnom Penh<br>
		          Phone: (855) 23 228 000
		        </address>
		      </div><!-- /.col -->
		      <div class="col-sm-4 invoice-col">
		        To
		        <address>
		          <strong>{{$log->reseller->name}}</strong><br>
		          @if($log->reseller->location)
		          	{{$log->reseller->location->address}}<br>
		          @endif
		          Phone: {{$log->reseller->phone}}<br>
		          Email: {{$log->reseller->email}}
		        </address>
		      </div><!-- /.col -->
		      <div class="col-sm-4 invoice-col">
		        <b>Invoice #007612</b><br>
		        <br>
		        <b>Account ID:</b> {{$log->reseller->id}}
		      </div><!-- /.col -->
		    </div><!-- /.row -->

		    <!-- Table row -->
		    <div class="row">
		      <div class="col-xs-12 table-responsive">
		        <table class="table table-striped">
		          <thead>
		            <tr>
		              <th>Qty</th>
		              <th>Service</th>
		              <th>Transfer #</th>
		              <th>Subtotal</th>
		            </tr>
		          </thead>
		          <tbody>
		            <tr>
		              <td>1</td>
		              <td>Transfer coins</td>
		              <td>{{$log->id}}</td>
		              <td>{{intval($log->amount)}} SBC</td>
		            </tr>
		          </tbody>
		        </table>
		      </div><!-- /.col -->
		    </div><!-- /.row -->

		    <div class="row">
		      <!-- accepted payments column -->
		      <div class="col-xs-6">
		        <p class="lead">Payment Methods: </p>
		        <h3>
		        	<i class="fa fa-money"></i> Cash
		        </h3>

		        
		      </div><!-- /.col -->
		      <div class="col-xs-6">
		        <p class="lead">Amount Due:</p>
		        <div class="table-responsive">
		          <table class="table">
		            <tbody><tr>
		              <th style="width:50%">Subtotal:</th>
		              <td> {{intval($log->amount)}} SBC </td>
		            </tr>
		            <tr>
		              <th>Tax (%)</th>
		              <td> 0 </td>
		            </tr>
		            <tr>
		              <th>Total:</th>
		              <td> <strong>{{intval($log->amount)}} SBC</strong> </td>
		            </tr>
		          </tbody></table>
		        </div>
		      </div><!-- /.col -->
		    </div><!-- /.row -->
		    
			</section>
		</div>
	</section>