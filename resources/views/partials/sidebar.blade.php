<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <div class="user-panel">
      <div class="pull-left info">
        <p>{{Auth::user()->name}}</p> 
        <p>{{Auth::user()->email}}</p>
        <a href="{{route('edituser')}}">(Change My Profile)</a>

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

      <li class="treeview">
              <a href="#">
                 <i class="glyphicon glyphicon-user"></i> 
                <span>{{trans('Users Management')}}</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{URL::route('users')}}"><i class="fa fa-circle-o"></i>Admin_Users</a></li>
                <li><a href="{{URL::route('role')}}"><i class="fa fa-circle-o"></i>Role</a></li>
                <li><a href="{{URL::route('permission')}}"><i class="fa fa-circle-o"></i>Permission</a></li>
                <li><a href="{{URL::route('permissionrole')}}"><i class="fa fa-circle-o"></i>Assigned_role</a></li>
              </ul>
            </li>
      <li {{ Helper::activeMenu("cashier") }}>
        <a href="{{URL::route('showcashier')}}">
          <i class="glyphicon glyphicon-usd"></i> 
          <span>{{trans('Cashier Management')}}</span>
          <div class="clear"></div>
        </a>
      </li>
      <li class="treeview">
              <a href="#">
                <i class="fa fa-car"></i>
                <span>{{trans('Services Management')}}</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{route('service')}}"><i class="fa fa-circle-o"></i><span>{{trans('Service')}}</span></a></li>
                <li {{ Helper::activeMenu("servicetype") }}><a href="{{route('servicetype')}}"><i class="fa fa-circle-o"></i><span>{{trans('Service_Type')}}</span></a></li>
               <li {{ Helper::activeMenu("serviceclass") }}><a href="{{route('serviceclass')}}"><i class="fa fa-circle-o"></i><span>{{trans('Service_Class')}}</span></a></li>                        
              </ul>
            </li>
      <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>{{trans('Online_Shop_Management')}}</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li {{ Helper::activeMenu("onlineshop") }}><a href="{{route('onlineshop')}}"><i class="fa fa-circle-o"></i><span>{{trans('Online_shops')}}</span></a></li>
                  <li {{ Helper::activeMenu("onlineshopitem") }}><a href="{{route('onlineshopitem')}}"><i class="fa fa-circle-o"></i><span>{{trans('Online_shops_items')}}</span></a></li>
              </ul>
            </li>
    
         <li {{ Helper::activeMenu("promotion") }}>
        <a href="{{URL::route('promotion')}}">
          <i class="fa fa-calculator"></i> 
          <span>{{trans('Promotion Management')}}</span>
          <div class="clear"></div>
        </a>
      </li>
          <li {{ Helper::activeMenu("merchant") }}>
         <a href="{{URL::route('merchant')}}">
          <i class="fa fa-user"></i> 
          <span>{{trans('Merchants Management')}}</span>
          <div class="clear"></div>
        </a>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-car"></i>
          <span>{{trans('Report')}}</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{route('cashiertoreseller')}}"><i class="fa fa-circle-o"></i><span>{{trans('Cashier_To_Reseller')}}</span></a></li>
          <li {{ Helper::activeMenu("commissiontocashier") }}><a href="{{route('commissiontocashier')}}"><i class="fa fa-circle-o"></i><span>{{trans('Commission_To_Cashier')}}</span></a></li>
          <li {{ Helper::activeMenu("commissiontoreseller") }}><a href="{{route('commissiontoreseller')}}"><i class="fa fa-circle-o"></i><span>{{trans('Commission_To_Reseller')}}</span></a></li>
          <li {{ Helper::activeMenu("usertoservicelog") }}><a href="{{route('usertoservicelog')}}"><i class="fa fa-circle-o"></i><span>{{trans('User_To_Service_Log')}}</span></a></li>                        
        </ul>
      </li>


        <!--<li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Layout Options</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>
            </li>-->
    </ul><!-- /.sidebar-menu -->

  </section>
  <!-- /.sidebar -->
</aside>