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
            <a href="{{ route('logout') }}" data-bs-toggle="tooltip" title="Sign out" id="signOut" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i data-feather="log-out"></i>
            </a>
          </div>
        </div>
        <div class="aside-loggedin-user">
          <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-bs-toggle="collapse">
            <h6 class="tx-semibold mg-b-0">{{Auth::user()->person->nama ?? '-'}}</h6>
            <i data-feather="chevron-down"></i>
          </a>
          <p class="tx-color-03 tx-12 mg-b-0">{{Auth::user()->roles()->first()->name}}</p>
        </div>
        <div class="collapse" id="loggedinMenu">
          <ul class="nav nav-aside mg-b-0">
            <li class="nav-item"><a href="{{ route('adm.person.edit',Auth::user()->person->id) }}" class="nav-link"><i data-feather="edit"></i> <span>Edit Profile</span></a></li>
            <li class="nav-item"><a href="{{ route('adm.person.show', Auth::user()->person->id) }}" class="nav-link"><i data-feather="user"></i> <span>View Profile</span></a></li>
            {{-- <li class="nav-item"><a href="#" class="nav-link"><i data-feather="settings"></i> <span>Account Settings</span></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i data-feather="help-circle"></i> <span>Help Center</span></a></li> --}}
          </ul>
        </div>
      </div>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>

      @php
          $menus = generateMenu();
      @endphp
        <ul class="nav nav-aside">
        @foreach ($menus as $category => $items)
            <li class="nav-label">{{ $items['label']}}</li>
            @foreach ($items['submenus'] as $item)
                @php
                @endphp
                <li class="nav-item">
                    <a href="{{ 
                        isset($item['route']) 
                        ? (
                            str_contains(strtolower($items['label']), 'home') || str_contains(strtolower($items['label']), 'settings') 
                            ? $item['route'] 
                            : $item['route'] {{-- . '?jenis=' . urlencode($item['label'] ?? '') --}}
                        ) 
                        : '#' 
                        }}" class="nav-link">
                        <i data-feather="{{ $item['icon'] ?? '' }}"></i>
                        <span>{{ $item['label'] ?? '' }}</span>
                    </a>
                    {{-- Check if there are submenus --}}
                    @if (isset($item['subMenus']) && count($item['subMenus']) > 0)
                        <ul class="nav nav-submenu">
                            @foreach ($item['subMenus'] as $subMenu)
                                <li class="nav-item">
                                    <a href="{{ $subMenu['route'] ?? '#'.'?jenis='.urlencode($subMenu['name'] ?? '') }}" class="nav-link">
                                        <i data-feather="{{ $subMenu['icon'] ?? '' }}"></i>
                                        <span>{{ $subMenu['label'] ?? '' }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
            <hr />
        @endforeach
        </ul>
  @php
    $roleName = auth()->user()->getRoleNames()->first(); 
    $menus = generateSidebarMenu($roleName); // Get the accessible menu for this role
  @endphp

  {{-- <ul class="nav nav-aside">
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
  </ul> --}}
</aside>
