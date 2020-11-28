<div class="top_nav">
  <div class="nav_menu">
    <h4 class="product_name"><span>@lang('common.welcome to') - </span>{{ env('APP_NAME') }}</h4>
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>       
      </div>
      <ul class="nav navbar-nav navbar-right">
        
        <li>
          <a  href="{{ route('local','en') }}" class="">@lang('common.LOCAL_EN')</a>
        </li>
        <li>
          <a href="{{ route('local','bd') }}" class="">@lang('common.LOCAL_BD')</a>
        </li>
        <li class="">
          <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('public/image/farahman.jpg') }}" title="{{ auth()->user()->name }}" alt="{{ auth()->user()->name }}">
            @auth{{ auth()->user()->name }}@endauth @guest {{ ' (Guest)' }}@endguest 
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li>
              <a href="{{ $users_logout }}"><i class="fa fa-sign-out pull-right text-danger"></i> @lang('common.logout')</a>
            </li>
            <li>
              <a><i class="fa fa-envelope pull-right text-success"></i> @auth{{ auth()->user()->email }}@endauth</a>
            </li>
            <li>
              <img src="{{ asset('public/image/farahman.jpg') }}" title="{{ auth()->user()->name }}" alt="{{ auth()->user()->name }}">
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>