<nav id="navbar-main" class="navbar navbar-main navbar-expand-lg bg-white navbar-light position-sticky top-0 shadow py-2">
    <div class="container">
      <a class="navbar-brand mr-lg-5" href="{{ url('/home') }}">
          <!-- <img src="./assets/img/brand/blue.png"> -->
          {{ config('app.name') }}
      </a>

      <!--Search-->
      <form method="get" action="{{ route('search') }}">
        <div class="nav-item search">
          <div class="form-group">
            <div class="input-group ">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-search"></i></span>
              </div>
              <input placeholder="Search for..." class="form-control" name="query" type="search" aria-label="Search" value="{{ isset($query) ? $query : '' }}">
            </div>
          </div>
          <button class="btn btn-primary btn-neutral btn-fab btn-icon btn-round" type="submit">
            <i class="fa fa-search"></i>
          </button> 
        </div>
      </form> 
      <!--End search header-->

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse justify-content-lg-end" id="navbar_global">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="{{ url('/home') }}">
               {{ config('app.name') }}
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              <span class="navbar-toggler-icon"></span>
              </button>
            </div>
          </div>
        </div>

        <ul class="navbar-nav navbar-nav-hover align-items-lg-center ml-lg-auto">
          <li class="nav-item dropdown">
            <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
              <span class="h6 text-default pt-2"><i class="ni ni-single-copy-04"></i>Category</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg">
              <div class="dropdown-menu-inner">

                <a href="" class="media d-flex align-items-center">
                  <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                    <i class="ni ni-spaceship"></i>
                  </div>
                  <div class="media-body ml-3">
                    <h6 class="heading text-primary mb-md-1">Getting started</h6>
                  </div>
                </a>

              </div>
            </div>
          </li>
        </ul>

        <!--Post btn-->
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item">
            <div class="dropdown">
              <button class="btn btn-primary btn-block" type="button" id="multiDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Posting article
              <div class="ripple-container"></div>
              </button>
              <div class="dropdown-menu" aria-labelledby="multiDropdownMenu">
                <a class="dropdown-item" href="{{ route('user.post.create') }}"><i class="far fa-file-alt"></i><span>Posting article</span></a>
                <a class="dropdown-item" href=""><i class="far fa-question-circle"></i><span>Set question</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="">Another action</a>
              </div>
            </div>
          </li>
        </ul>

        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
        <!-- Authentication Links -->
        @guest
          <li class="nav-item d-lg-block">
            <div class="dropdown">
              <button class="btn btn-link btn-block" type="button" id="multiDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="h6 text-default">Sign in</span>
              <div class="ripple-container"></div>
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="multiDropdownMenu">
                <a class="dropdown-item" href="{{ route('login') }}">
                  Sign in  <span class="text-primary"><i class="fas fa-sign-in-alt"></i></span>
                </a>
                <div class="dropdown-divider"></div>
                @if (Route::has('register'))
                  <a class="dropdown-item" href="{{ route('register') }}" target="_blank">
                    Register  <span class="text-primary"><i class="fas fa-plus-circle"></i></span>
                  </a>
                @endif
              </div>
            </div>
          </li>
          @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <!-- Avatar -->
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{ asset('storage/profiles/'. Auth::user()->image) }}">
                </span>
                <!-- User name -->
                <div class="media-body ml-2 d-lg-block">
                  <span class="mb-0 text-lg font-weight-bold">{{ Auth::user()->name }}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="navbarDropdown">
              <div class="dropdown-header py-1">
                <h6 class="text-muted m-0 mr-1">Welcome</h6>
                <span class="text-center h6 text-primary">{{ Auth::user()->name }} </span>
              </div>
              <a href="{{ route('user.personal.profile') }}" class="dropdown-item"><i class="ni ni-single-02 text-primary"></i><span>My profile</span></a>
              <a href="#" class="dropdown-item"><i class="ni ni-settings text-primary"></i><span>Settings</span></a>
              <a href="#" class="dropdown-item"><i class="ni ni-calendar-grid-58 text-primary"></i><span>Activity</span></a>
              <a href="#" class="dropdown-item"><i class="ni ni-support-16 text-primary"></i><span>Support</span></a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item" 
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt text-primary"></i><span>Log out</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
            </div>
          </li>
        @endguest
        </ul>
      </div>
    </div>
  </nav>