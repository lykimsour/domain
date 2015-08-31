<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <div class="user-panel">
      <div class="pull-left info">
        <p>{{Auth::user()->name}}</p>
        <!-- Status -->
        <!--<a href="#">{{trans('user.id')}}: {{Auth::user()->id}}</a>-->
      </div>
    </div>
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li {{ Helper::activeMenu("/") }}>
        <a href="{{URL::route('dashboard.index')}}">
          <i class="fa fa-dashboard"></i> 
          <span>{{trans('menu.dashboard')}}</span>
          <div class="clear"></div>
        </a>
      </li>
       <li {{ Helper::activeMenu("createuser") }}>
        <a href="{{URL::route('createuser')}}">
          <i class="glyphicon glyphicon-user"></i> 
          <span>{{trans('Users')}}</span>
          <div class="clear"></div>
        </a>
      </li>

      <li {{ Helper::activeMenu("showcashier") }}>
        <a href="{{URL::route('showcashier')}}">
          <i class="glyphicon glyphicon-usd"></i> 
          <span>{{trans('Cashier Management')}}</span>
          <div class="clear"></div>
        </a>
      </li>
      
      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-cog"></i>{{trans('Services Management')}}<span class="caret"></span></a>
          <ul class="dropdown-menu" style="background:black">
            <li><a href="{{route('service')}}"><i class="glyphicon glyphicon-cog"></i><span>{{trans('Service')}}</span></a></li>
            <li><a href="{{route('servicetype')}}"><i class="glyphicon glyphicon-cog"></i><span>{{trans('Service_Type')}}</span></a></li>
            <li><a href="{{route('serviceclass')}}"><i class="glyphicon glyphicon-cog"></i><span>{{trans('Service_Class')}}</span></a></li>                        
          </ul>
        </li>

      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-shopping-cart"></i>{{trans('Online_Shop Management')}}<span class="caret"></span></a>
          <ul class="dropdown-menu" style="background:black">
            <li><a href="{{route('onlineshop')}}"><i class="glyphicon glyphicon-shopping-cart"></i><span>{{trans('Online_shops')}}</span></a></li>
            <li><a href="{{route('onlineshopitem')}}"><i class="glyphicon glyphicon-shopping-cart"></i><span>{{trans('Online_shops_items')}}</span></a></li>
          </ul>
        </li>

    </ul><!-- /.sidebar-menu -->

  </section>
  <!-- /.sidebar -->
</aside>