<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Investor Insight</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet"/>
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
  <body >
    <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>
    <div class="page">
      <!-- Navbar -->
      <div class="sticky-top">
        <header class="navbar navbar-expand-md sticky-top d-print-none" >
          <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
              <a href=".">
                <img src="{{ asset('static/logo.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
              </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">
              <div class="d-none d-md-flex">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Activar modo oscuro" data-bs-toggle="tooltip" data-bs-placement="bottom" onclick="changeTheme('dark')">
                  <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
                </a>

                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Activar modo claro" data-bs-toggle="tooltip"  data-bs-placement="bottom" onclick="changeTheme('light')">
                  <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
                </a>
              </div>
              <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                  <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.webp)"></span>
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
                      <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                      </span>
                      <span class="nav-link-title">
                        Dashboard
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route("project.index")}}">
                      <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-building-fortress"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 21h1a1 1 0 0 0 1 -1v-1h0a3 3 0 0 1 6 0m3 2h1a1 1 0 0 0 1 -1v-15l-3 -2l-3 2v6h-4v-6l-3 -2l-3 2v15a1 1 0 0 0 1 1h2m8 -2v1a1 1 0 0 0 1 1h2" /><path d="M7 7h0v.01" /><path d="M7 10h0v.01" /><path d="M7 13h0v.01" /><path d="M17 7h0v.01" /><path d="M17 10h0v.01" /><path d="M17 13h0v.01" /></svg>                      </span>
                      <span class="nav-link-title">
                        Proyectos
                      </span>
                    </a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-group"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>                      </span>
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
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                      <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-coins"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" /><path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" /><path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" /><path d="M3 6v10c0 .888 .772 1.45 2 2" /><path d="M3 11c0 .888 .772 1.45 2 2" /></svg>                      </span>
                      <span class="nav-link-title">
                        Contabilidad
                      </span>
                    </a>
                    <div class="dropdown-menu">
                      <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                          <a class="dropdown-item" href="./empty.html">
                            <small>->&nbsp;</small>Transferencias
                          </a>
                          <a class="dropdown-item" href="./cookie-banner.html">
                            <small>->&nbsp;</small>Pagarés
                          </a>                         
                          <a class="dropdown-item" href="./pricing-table.html">
                            <small>->&nbsp;</small>Notas crédito
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
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New report</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" name="example-text-input" placeholder="Your report name">
            </div>
            <label class="form-label">Report type</label>
            <div class="form-selectgroup-boxes row mb-3">
              <div class="col-lg-6">
                <label class="form-selectgroup-item">
                  <input type="radio" name="report-type" value="1" class="form-selectgroup-input" checked>
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Simple</span>
                      <span class="d-block text-muted">Provide only basic data needed for the report</span>
                    </span>
                  </span>
                </label>
              </div>
              <div class="col-lg-6">
                <label class="form-selectgroup-item">
                  <input type="radio" name="report-type" value="1" class="form-selectgroup-input">
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Advanced</span>
                      <span class="d-block text-muted">Insert charts and additional advanced analyses to be inserted in the report</span>
                    </span>
                  </span>
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-8">
                <div class="mb-3">
                  <label class="form-label">Report url</label>
                  <div class="input-group input-group-flat">
                    <span class="input-group-text">
                      https://tabler.io/reports/
                    </span>
                    <input type="text" class="form-control ps-0"  value="report-01" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label">Visibility</label>
                  <select class="form-select">
                    <option value="1" selected>Private</option>
                    <option value="2">Public</option>
                    <option value="3">Hidden</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Client name</label>
                  <input type="text" class="form-control">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Reporting period</label>
                  <input type="date" class="form-control">
                </div>
              </div>
              <div class="col-lg-12">
                <div>
                  <label class="form-label">Additional information</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              Create new report
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>
    @yield('scripts')
  </body>
</html>
