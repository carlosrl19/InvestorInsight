<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Investor Insight</title>
  <!-- CSS files -->
  <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
  @yield('head')
  <style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
      --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }
  </style>
</head>

<body>
  <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>
  <div class="page">
    <!-- Navbar -->
    <div class="sticky-top">
      <header class="navbar navbar-expand-md sticky-top d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a>
              <img src="{{ asset('static/logo.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
              <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Activar modo oscuro"
                data-bs-toggle="tooltip" data-bs-placement="bottom">
                <img src="{{ asset('../static/svg/moon.svg') }}" width="20" height="20">
              </a>

              <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Activar modo claro"
                data-bs-toggle="tooltip" data-bs-placement="bottom">
                <img style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(73deg) brightness(103%) contrast(103%);" src="{{ asset('../static/svg/sun.svg') }}" width="20" height="20">
              </a>
              <div class="nav-item dropdown d-none d-md-flex me-3">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                  aria-label="Show notifications">
                  <img style="filter: invert(14%) sepia(81%) saturate(3491%) hue-rotate(346deg) brightness(107%) contrast(83%);" src="{{ asset('../static/svg/bell.svg') }}" width="20" height="20">
                  <span class="badge bg-red"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                  <div class="card" style="width: 50vh;">
                    <div class="card-header">
                      <h4 class="card-title">Pendientes</h4>
                    </div>
                    @yield('notification_navbar')
                  </div>
                </div>
              </div>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(/static/avatars/avatar.png)"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>User</div>
                  <div class="mt-1 small text-muted">User rol</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="" class="dropdown-item">Configuración de usuario</a>
                <a href="" class="dropdown-item">Cerrar sesión</a>
              </div>
            </div>
          </div>
        </div>
      </header>
      <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('dashboard.index')}}">
                    <span
                      class="nav-link-icon d-md-none d-lg-inline-block">
                      <img style="filter: invert(68%) sepia(0%) saturate(0%) hue-rotate(177deg) brightness(98%) contrast(89%);" src="{{ asset('../static/svg/dashboard.svg') }}" width="20" height="20">
                    </span>
                    <span class="nav-link-title">
                      Dashboard
                    </span>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span
                      class="nav-link-icon d-md-none d-lg-inline-block">
                      <img style="filter: invert(68%) sepia(0%) saturate(0%) hue-rotate(177deg) brightness(98%) contrast(89%);" src="{{ asset('../static/svg/building-fortress.svg') }}" width="20" height="20">
                    </span>
                    <span class="nav-link-title">
                      Proyectos
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="{{ route('project.index') }}">
                          <small>->&nbsp;</small>Proyectos activos
                        </a>
                        <a class="dropdown-item" href="{{ route('termination.index') }}">
                          <small>->&nbsp;</small>Proyectos finiquitados
                        </a>
                        <a class="dropdown-item" href="{{ route('project.closed') }}">
                          <small>->&nbsp;</small>Proyectos cerrados
                        </a>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span
                      class="nav-link-icon d-md-none d-lg-inline-block">
                      <img style="filter: invert(68%) sepia(0%) saturate(0%) hue-rotate(177deg) brightness(98%) contrast(89%);" src="{{ asset('../static/svg/users-group.svg') }}" width="20" height="20">
                      </span>
                    <span class="nav-link-title">
                      Recursos humanos
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="{{ route("investor.index")}}">
                          <small>->&nbsp;</small>Inversionistas
                        </a>
                        <a class="dropdown-item" href="{{ route("commission_agent.index")}}">
                          <small>->&nbsp;</small>Comisionistas
                        </a>
                        <a class="dropdown-item" href="{{ route("provider.index")}}">
                          <small>->&nbsp;</small>Proveedores
                        </a>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span
                      class="nav-link-icon d-md-none d-lg-inline-block">
                      <img style="filter: invert(68%) sepia(0%) saturate(0%) hue-rotate(177deg) brightness(98%) contrast(89%);" src="{{ asset('../static/svg/report.svg') }}" width="20" height="20">
                      </span>
                    <span class="nav-link-title">
                      Reportes
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="{{ route('termination.index') }}">
                          <small>->&nbsp;</small>Finiquitos
                        </a>
                        <a class="dropdown-item" href="{{ route('credit_note.index') }}">
                          <small>->&nbsp;</small>Notas crédito
                        </a>
                        <a class="dropdown-item" href="{{ route('transfer.index') }}">
                          <small>->&nbsp;</small>Transferencias
                        </a>
                        <a class="dropdown-item" href="{{ route('promissory_note.index') }}">
                          <small>->&nbsp;</small>Pagarés inversionistas
                        </a>
                        <a class="dropdown-item" href="{{ route('promissory_note_commissioner.index') }}">
                          <small>->&nbsp;</small>Pagarés comisionistas
                        </a>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span
                      class="nav-link-icon d-md-none d-lg-inline-block">
                      <img style="filter: invert(68%) sepia(0%) saturate(0%) hue-rotate(177deg) brightness(98%) contrast(89%);" src="{{ asset('../static/svg/coins.svg') }}" width="20" height="20">
                      </span>
                    <span class="nav-link-title">
                      Contabilidad
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">                      
                        <a class="dropdown-item" href="{{ route('payments_investor.index') }}">
                          <small>->&nbsp;</small>Pagos inversionistas
                        </a>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span
                      class="text-red nav-link-icon d-md-none d-lg-inline-block">
                      <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="{{ asset('../static/svg/circle-letter-r.svg') }}" width="20" height="20">
                    </span>
                    <span class="nav-link-title">
                      <strong>ROBENIOR</strong>
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="">
                          <small>->&nbsp;</small>Fondos <strong style="margin-left: 8vh" class="text-success">Lps. {{ number_format($total_investor_balance,2) }}</strong>
                        </a>
                        <small></small>
                        <a class="dropdown-item" href="">
                          <small>->&nbsp;</small>Comisiones  <strong style="margin-left: 5vh" class="text-success">Lps. {{ number_format($total_commissioner_balance,2) }}</strong>
                        </a>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </header>
    </div>
    <div class="page-wrapper">
      <!-- Page header -->
      <div class="page-header d-print-none">
        <div class="container-xl">
          <div class="row g-2 align-items-center">
            <div class="col">
              <!-- Page pre-title -->
              <div class="page-pretitle">
                @yield('pretitle')
              </div>
              <h2 class="page-title">
                @yield('title')
              </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                @yield('create')
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page body -->
      <div class="page-body">
        @yield('content')
      </div>
      <footer class="footer footer-transparent d-print-none">
        <div class="container-xl">
          <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
              <ul class="list-inline list-inline-dots mb-0">
                @yield('footer_right')
              </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
              <ul class="list-inline list-inline-dots mb-0">
                <li class="list-inline-item">
                  @yield('footer_left')
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Tabler Core -->
  <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
  <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>
  @yield('scripts')
</body>

</html>