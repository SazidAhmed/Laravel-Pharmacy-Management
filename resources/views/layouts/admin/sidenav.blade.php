 <!-- Sidebar -->
<nav id="sidebar" aria-label="Main Navigation">
  <!-- Side Header -->
  <div class="content-header bg-white-5">
      <!-- Logo -->
      <a class="font-w600 text-dual" href="index.html">
          <span class="smini-visible">
              <i class="fa fa-circle-notch text-primary"></i>
          </span>
          <span class="smini-hide font-size-h5 tracking-wider">
              Admin <span class="font-w400">Panel</span>
          </span>
      </a>
      <!-- END Logo -->

      <!-- Extra -->
      <div>
          <!-- Close Sidebar, Visible only on mobile screens -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <a class="d-lg-none btn btn-sm btn-dual ml-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
              <i class="fa fa-fw fa-times"></i>
          </a>
          <!-- END Close Sidebar -->
      </div>
      <!-- END Extra -->
  </div>
  <!-- END Side Header -->

  <!-- Sidebar Scrolling -->
  <div class="js-sidebar-scroll">
      <!-- Side Navigation -->
      <div class="content-side">
          <ul class="nav-main">
              <li class="nav-main-item">
                  <a class="nav-main-link" href="{{ route('dashboard') }}">
                      <i class="nav-main-link-icon fa fa-jedi"></i>
                      <span class="nav-main-link-name">Dashboard</span>
                  </a>
              </li>

                <li class="nav-main-heading">Applications</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                      <i class="nav-main-link-icon fab fa-opencart"></i>
                      <span class="nav-main-link-name">Point Of Sale</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                          <a class="nav-main-link" href="{{ route('pospage') }}">
                              <span class="nav-main-link-name">Launch POS</span>
                          </a>
                        </li>
                        <li class="nav-main-item">
                          <a class="nav-main-link" href="{{ route('invoicepage') }}">
                              <span class="nav-main-link-name">Recent Invoice</span>
                          </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('customerpage') }}">
                                <span class="nav-main-link-name">Customer Details</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-heading">Product Section</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-hand-holding-medical"></i>
                        <span class="nav-main-link-name">Medicines</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('categorypage') }}">
                                <span class="nav-main-link-name">Categories</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('manufacturpage') }}">
                                <span class="nav-main-link-name">Menufaturers</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('unitspage') }}">
                                <span class="nav-main-link-name">Price Units</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('productpage') }}">
                                <span class="nav-main-link-name">Medicines</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-heading">Reports Section</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-calculator"></i>
                        <span class="nav-main-link-name">Sales & Invoice</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('invoiceRecordspage') }}">
                                <span class="nav-main-link-name">Sales Record</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('soldItems') }}">
                                <span class="nav-main-link-name">Sold Items</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon far fa-chart-bar"></i>
                        <span class="nav-main-link-name">Filtered Report</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('reportDailySales') }}">
                                <span class="nav-main-link-name">Sales Today</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('reportWeeklySales') }}">
                                <span class="nav-main-link-name">Sales Weekly</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('reportMonthlySales') }}">
                                <span class="nav-main-link-name">Sales Monthly</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('reportYearlySales') }}">
                                <span class="nav-main-link-name">Sales Yearly</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-heading">Settings Section</li>
                <li class="nav-main-item">
                  <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                      <i class="nav-main-link-icon fa fa-user-cog"></i>
                      <span class="nav-main-link-name">User Management</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('userList') }}">
                                <span class="nav-main-link-name">User List</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('userProfile') }}">
                                <span class="nav-main-link-name">Profile Setting</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-heading">Exit Section</li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                        <i class="nav-main-link-icon si si-logout"></i>
                        <span class="nav-main-link-name">Log Out</span>
                    </a>
                </li>
          </ul>
      </div>
      <!-- END Side Navigation -->
  </div>
  <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->