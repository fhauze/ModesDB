<aside class="aside aside-fixed">
  <div class="aside-header">
      <a href="#" class="aside-logo">dash<span>forge</span></a>
      <a href="#" class="aside-menu-link">
          <i data-feather="menu"></i>
          <i data-feather="x"></i>
      </a>
  </div>
  <div class="aside-body">
      <div class="aside-loggedin">
        <div class="d-flex align-items-center justify-content-start">
          <a href="" class="avatar"><img src="https://placehold.co/387" class="rounded-circle" alt=""></a>
          <div class="aside-alert-link">
            {{-- <a href="" class="new" data-bs-toggle="tooltip" title="You have 2 unread messages"><i data-feather="message-square"></i></a>
            <a href="" class="new" data-bs-toggle="tooltip" title="You have 4 new notifications"><i data-feather="bell"></i></a> --}}
            <a href="{{route('logout')}}" data-bs-toggle="tooltip" title="Sign out" id="signOut" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i data-feather="log-out"></i></a>
          </div>
        </div>
        <div class="aside-loggedin-user">
          <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-bs-toggle="collapse">
            <h6 class="tx-semibold mg-b-0">Katherine Pechon</h6>
            <i data-feather="chevron-down"></i>
          </a>
          <p class="tx-color-03 tx-12 mg-b-0">Administrator</p>
        </div>
        <div class="collapse" id="loggedinMenu">
          <ul class="nav nav-aside mg-b-0">
            <li class="nav-item"><a href="#" class="nav-link"><i data-feather="edit"></i> <span>Edit Profile</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i data-feather="user"></i> <span>View Profile</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i data-feather="settings"></i> <span>Account Settings</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i data-feather="help-circle"></i> <span>Help Center</span></a></li>
          </ul>
        </div>
      </div>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
      <ul class="nav nav-aside">
        @php
            $menus = generateMenu();
            $homeCategory = collect($menus)->pull('Home');
        @endphp
        @foreach ($menus as $category => $items)
          <li class="nav-label">{{ $category }}</li>
          @foreach ($items as $item)
              <li class="nav-item">
                  <a href="{{ route($item['route']) ?? ''}}" class="nav-link">
                      <i data-feather="{{ $item['icon'] }}"></i>
                      <span>{{ $item['label'] }}</span>
                  </a>
                  {{-- Periksa jika ada submenu --}}
                  @if (isset($item['subMenus']) && count($item['subMenus']) > 0)
                      <ul class="nav nav-submenu">
                          @foreach ($item['subMenus'] as $subMenu)
                              <li class="nav-item">
                                  <a href="{{ route($subMenu['route']) ?? '' }}" class="nav-link">
                                      <i data-feather="{{ $subMenu['icon'] }}"></i>
                                      <span>{{ $subMenu['label'] }}</span>
                                  </a>
                              </li>
                          @endforeach
                      </ul>
                  @endif
              </li>
          @endforeach
        <hr/>
        @endforeach
      </ul>
  </div>

  @php
    $roleName = auth()->user()->getRoleNames()->first(); 
    $menus = generateSidebarMenu($roleName); // Ambil menu yang bisa diakses oleh role ini
  @endphp
  <ul class="nav nav-aside">
      @foreach($menus as $menu)
          <li class="menu-item">
              <a href="#">{{ $menu->display_name }}</a>
              @if($menu->subMenus->count() > 0)
                  <ul class="submenu">
                      @foreach($menu->subMenus as $subMenu)
                          <li>
                              <a href="#">
                                  {{ $subMenu->display_name }}
                              </a>
                          </li>
                      @endforeach
                  </ul>
              @endif
          </li>
      @endforeach
  </ul>

</aside>
