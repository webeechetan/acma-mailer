<!DOCTYPE html>
<html lang="en">
 <head>
   @include('layouts.partials.head')
 </head>
 <body>
 @include('layouts.partials.header')
 @if(session()->has('admin'))
    @include('layouts.partials.nav')
 @endif
    
    @yield('content')
    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')
 </body>
</html>