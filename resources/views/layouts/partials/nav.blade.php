<!-- Sidebar -->
<div class="sidebar" style="width:160px;">
    <!-- <div class="sidebar-dropdown"><a href="#"><i class="fa fa-bars" aria-hidden="true"></i> Menu</a></div> -->
    <ul id="nav">
      <li><a href="{{ env('APP_URL') }}compose"><i class="fa fa-plus" aria-hidden="true"></i> Compose</a></li>
      @if(!empty(Session::get('admin')) && Session::get('admin')['type'] == 1) 
      <li><a href="{{ env('APP_URL') }}groups"><i class="fa fa-first-order" aria-hidden="true"></i>Mail List</a></li>
      <li><a href="{{ env('APP_URL') }}group-members"><i class="fa fa-address-book" aria-hidden="true"></i> Admin </a></li>
      @endif
      <li><a href="{{ env('APP_URL') }}group-users"><i class="fa fa-users" aria-hidden="true"></i> All Contacts</a></li>
      <li><a href="{{ env('APP_URL') }}sentbox"><i class="fa fa-inbox" aria-hidden="true"></i> Sentbox</a></li>
    </ul>
  </div>
  <!-- Sidebar ends -->