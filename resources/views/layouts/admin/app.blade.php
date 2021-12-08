@include('layouts.admin.header')
@include('layouts.admin.asidenav')
@include('layouts.admin.sidenav')

@include('layouts.admin.topnav')

<!-- Main Container -->
<main id="main-container">
  <div id="app">
    @yield('content')
  </div>
</main>
<!-- END Main Container -->

@include('layouts.admin.footer')
