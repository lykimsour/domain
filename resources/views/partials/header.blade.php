<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="{{URL::route('dashboard.index')}}" class="logo">
    {!! Html::image('images/sabay-logo.png') !!} 
    <b>Sabay</b>Admin
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">

      <!--<ul class="nav navbar-nav">
        <li class="dropdown top-language">
          <!-- Menu Toggle Button -->
          <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {!! Helper::currentlang() !!}
          </a>
          <ul class="dropdown-menu">
            <li role="presentation">
              <a role="menuitem" href="{{route('languageChoose', 'en')}}">
                <img src="{{ asset("images/icons/england.png") }}"/>
              </a>
            </li>
            <li role="presentation">
              <a role="menuitem" href="{{route('languageChoose', 'kh')}}">
                <img src="{{ asset("images/icons/cambodia.png") }}"/>
              </a>
            </li>
            <li role="presentation">
              <a role="menuitem" href="{{route('languageChoose', 'mm')}}">
                <img src="{{ asset("images/icons/myanmar.png") }}"/>
              </a>
            </li>
            <li role="presentation">
              <a role="menuitem" href="{{route('languageChoose', 'cn')}}">
                <img src="{{ asset("images/icons/china.png") }}"/>
              </a>
            </li>
            <li role="presentation">
              <a role="menuitem" href="{{route('languageChoose', 'vn')}}">
                <img src="{{ asset("images/icons/vietnam.png") }}"/>
              </a>
            </li>
          </ul>
        </li>
      </ul>-->

      <ul class="nav navbar-nav navbar-right">
        
        <!-- Notifications Menu -->
        <li class="dropdown notifications-menu">
          <!-- Menu toggle button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            {{-- <span class="label label-danger">10</span> --}}
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have no notification</li>
            {{-- <li>
              <!-- Inner Menu: contains the notifications -->
              <ul class="menu">
                <li><!-- start notification -->
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> Notifications is comming soon!
                  </a>
                </li><!-- end notification -->                      
              </ul>
            </li> --}}
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li>
       
        <!-- Tasks Menu -->
        <li class="dropdown">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user"></i>
          </a>
          <ul class="dropdown-menu">
            <li role="presentation">
              <a role="menuitem" tabindex="-1" href="#">
                <i class="fa fa-cog"></i>
                {{trans('app.account settings')}}
              </a>
            </li>
            <li role="presentation" class="divider"></li>
            <li role="presentation">
              <a role="menuitem" href="{{ url('/auth/logout') }}">
                <i class="fa fa-sign-out"></i>
                {{trans('app.sign out')}}
              </a>
            </li>
          </ul>
        </li>
       
      </ul>
    </div>
  </nav>
</header>