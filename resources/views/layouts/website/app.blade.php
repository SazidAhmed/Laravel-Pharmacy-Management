@include('layouts.website.header')

@include('layouts.website.topnav')

<!-- Main Container -->
<main id="main-container">
  @yield('content')
</main>
<!-- END Main Container -->

@include('layouts.website.footer')
