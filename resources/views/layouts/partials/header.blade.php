<header>
    <div class="navbar navbar-fixed-top bs-docs-nav" role="banner">

      <div class="container">
        <div class="navbar-header">
          <a href="{{ env('APP_URL') }}" class="navbar-brand">
          <img src="{{ env('APP_URL') }}assets/images/logo.png" />
          <!-- ACMA Email Dissemination -->
          </a>
        </div>
        @if(session()->has('admin'))
        <div class="pull-right">
          <a href="{{ env('APP_URL') }}logout" class="navbar-brand"><span>Logout</span> <i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </div>
        @endif
        
      </div>
    </div>
</header>