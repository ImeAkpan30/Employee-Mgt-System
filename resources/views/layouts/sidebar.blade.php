  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar sidenav">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->username}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      {{-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> --}}
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="/"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
        @if(Auth::user()->role=='admin')
            <li><a href="{{ url('employee-management') }}"><i class="fa fa-users"></i> <span>Employee Management</span></a></li>
        @endif
        @if(Auth::user()->role=='admin')
            <li class="treeview">
            <a href="#"><i class="fa fa-sliders"></i> <span>System Management</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('system-management/department') }}">Department</a></li>
                <li><a href="{{ url('system-management/division') }}">Division</a></li>
                <li><a href="{{route('designation')}}">Designation</a></li>
                <li><a href="{{ url('system-management/country') }}">Country</a></li>
                <li><a href="{{ url('system-management/state') }}">State</a></li>
                <li><a href="{{ url('system-management/city') }}">City</a></li>
                <li><a href="{{route('salary')}}">Salary</a></li>
                <li><a href="{{ url('system-management/report') }}">Report</a></li>
            </ul>
            </li>
        @endif
        <li class="treeview">
            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-paper-plane" aria-hidden="true"></i> <span class="hide-menu">Leave management</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul aria-expanded="false" class="treeview-menu">
                @if(Auth::user()->role=='employee')
                <li><a href="{{route('leave.create')}}"><i class="fa fa-link"></i><span class="hide-menu">Apply Leave</span></a></li>
                @endif
                <li><a href="{{url('leave')}}"><i class="fa fa-link"></i><span class="hide-menu">Leave list</span></a></li>
                {{--<li class="sidebar-item"><a href="{{route('total-leave')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Total leave list</span></a></li>--}}
            </ul>
        </li>
        @if(Auth::user()->role=='admin')
            <li><a href="{{ route('company-management.index') }}"><i class="fa fa-briefcase"></i> <span>Company Management</span></a></li>
        @endif
        {{-- @if(Auth::user()->role=='admin') --}}
            <li><a href="{{ route('user-management.index') }}"><i class="fa fa-user"></i> <span>User Management</span></a></li>
        {{-- @endif --}}
        @if(Auth::user()->role=='admin')
            <li class="treeview">
            <a href="javascript:void(0)"><i class="fa fa-usd"></i> <span>Payroll management</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul aria-expanded="false" class="treeview-menu">

                <li><a href="{{route('managesalary.salarylist')}}"><span class="hide-menu">Employee salary list</span></a></li>

            </ul>

        @endif
        {{-- <li class="treeview">
            <a href="mailbox.html">
              <i class="fa fa-envelope"></i> <span>Mailbox</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="{{ url('mailbox/inbox') }}">Inbox
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right">13</span>
                  </span>
                </a>
              </li>
              <li><a href="{{ url('mailbox/compose') }}">Compose</a></li>
              <li><a href="{{ url('mailbox/read-mail') }}">Read</a></li>
            </ul>
          </li> --}}


        <li class="treeview">
            <a href="javascript:void(0)"><i class="fa fa-cog"></i> <span>Settings</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
              <li><a href="{{ route('profile') }}">Profile</a></li>
              <li><a href="{{ route('mailbox.compose') }}">Mail <i class="fa fa-envelope" style="margin-left: 5px;"></i></a></li>
              <li><a href="{{ route('logout') }}">Logout <i class="fa fa-power-off" style="color: red; margin-left: 5px;"></i></a></li>
            </ul>
          </li>
      </ul>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
     </form>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
    {{-- <div class="text-center display" id="load">
        <div class="lds-roller "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div> --}}
  </aside>

  {{-- <script>
      function loader() {
    let load = document.getElementById("load");
    load.style.display = "block";
}
  </script> --}}
