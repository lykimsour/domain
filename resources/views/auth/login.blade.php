
@extends('layouts.login')

@section('content')
    <div style="margin-top:70px;">
	  <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
	    <div class="panel member_signin">
	      <div class="panel-body">
	        <div class="fa_logo">
	        {!! Html::image('images/sabay-logo.png') !!}
	        <p>Admin Login</p>
	        </div>
	        <form id="login" role="form" method="POST" action="{{ url('/auth/login') }}">
	        
	        @if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					{!! csrf_field() !!}

	        <div class="form-group">

	            <label for="exampleInputEmail1" class="sr-only">User name</label>
	            <div class="input-group">
							  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
							  <input type="email" name="email" class="form-control" autocomplete="off" placeholder="User name" required autofocus value="{{ old('email') }}" >
							</div>
	        </div>
	        <div class="form-group">
	            <label for="exampleInputPassword1" class="sr-only">Password</label>
	            <div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
						  <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Password" required>
						</div>
	        </div>
	          <button type="submit" class="btn btn-sabay btn-md login">LOG IN</button>
	        <div class="checkbox" style="text-align:center;">
			    <label>
			      <input name="remember" type="checkbox" /> Remember me
			    </label>
			 </div>
			</form>
	      </div>
	    </div>
	  </div>
	</div>

@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			 $('form#login').validate({
				rules: {
					username: {
						minlength: 4
					},
					password: {
						minlength: 6
					}
				}
			});
		});
	</script>
@endsection