
<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes/headermeta')
    @yield('custom-css')
  </head>
  <body>
  @include('includes/menu')
    @yield('content')
    
    @include('includes/footer')
    @include('includes/footerscripts')
    @yield('custom-js')
  </body>
</html> 
