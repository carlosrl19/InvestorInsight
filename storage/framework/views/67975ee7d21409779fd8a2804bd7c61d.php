<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Investor Insight</title>
  <!-- CSS files -->
  <link href="<?php echo e(asset('dist/css/tabler.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('dist/css/tabler-vendors.min.css')); ?>" rel="stylesheet" />
  <link href="<?php echo e(asset('dist/css/demo.min.css')); ?>" rel="stylesheet" />
  <?php echo $__env->yieldContent('head'); ?>
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
  <script src="<?php echo e(asset('dist/js/demo-theme.min.js')); ?>"></script>
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
              <img src="<?php echo e(asset('static/logo.png')); ?>" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
              <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Activar modo oscuro"
                data-bs-toggle="tooltip" data-bs-placement="bottom">
                <img src="<?php echo e(asset('../static/svg/moon.svg')); ?>" width="20" height="20">
              </a>
              <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Activar modo claro"
                data-bs-toggle="tooltip" data-bs-placement="bottom">
                <img style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(73deg) brightness(103%) contrast(103%);" src="<?php echo e(asset('../static/svg/sun.svg')); ?>" width="20" height="20">
              </a>
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
                  <a class="nav-link" href="<?php echo e(route('dashboard.index')); ?>">
                    <span
                      class="nav-link-icon d-md-none d-lg-inline-block">
                      <img style="filter: invert(68%) sepia(0%) saturate(0%) hue-rotate(177deg) brightness(98%) contrast(89%);" src="<?php echo e(asset('../static/svg/dashboard.svg')); ?>" width="20" height="20">
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
                      <img style="filter: invert(68%) sepia(0%) saturate(0%) hue-rotate(177deg) brightness(98%) contrast(89%);" src="<?php echo e(asset('../static/svg/building-fortress.svg')); ?>" width="20" height="20">
                    </span>
                    <span class="nav-link-title">
                      Proyectos
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="<?php echo e(route('project.index')); ?>">
                          <small>->&nbsp;</small>Proyectos activos
                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('termination.index')); ?>">
                          <small>->&nbsp;</small>Proyectos finiquitados
                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('project.closed')); ?>">
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
                      <img style="filter: invert(68%) sepia(0%) saturate(0%) hue-rotate(177deg) brightness(98%) contrast(89%);" src="<?php echo e(asset('../static/svg/users-group.svg')); ?>" width="20" height="20">
                      </span>
                    <span class="nav-link-title">
                      Recursos humanos
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="<?php echo e(route("investor.index")); ?>">
                          <small>->&nbsp;</small>Inversionistas
                        </a>
                        <a class="dropdown-item" href="<?php echo e(route("commission_agent.index")); ?>">
                          <small>->&nbsp;</small>Comisionistas
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
                      <img style="filter: invert(68%) sepia(0%) saturate(0%) hue-rotate(177deg) brightness(98%) contrast(89%);" src="<?php echo e(asset('../static/svg/report.svg')); ?>" width="20" height="20">
                      </span>
                    <span class="nav-link-title">
                      Reportes
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="<?php echo e(route('credit_note.index')); ?>">
                          <small>->&nbsp;</small>Notas crédito
                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('transfer.index')); ?>">
                          <small>->&nbsp;</small>Transferencias
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
                      <img style="filter: invert(68%) sepia(0%) saturate(0%) hue-rotate(177deg) brightness(98%) contrast(89%);" src="<?php echo e(asset('../static/svg/coins.svg')); ?>" width="20" height="20">
                      </span>
                    <span class="nav-link-title">
                      Contabilidad
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo e(route('moneylender.index')); ?>">
                      <small>->&nbsp;</small>Prestamistas
                    </a>
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">     
                        <div class="dropend">
                          <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            -> Pago de comisiones
                          </a>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo e(route('payments_investor.index')); ?>">
                              <small>->&nbsp;</small>Comisión inversionistas
                            </a>
                            <a class="dropdown-item" href="<?php echo e(route('payments_commissioner.index')); ?>">
                              <small>->&nbsp;</small>Comisión  comisionistas
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span
                      class="text-red nav-link-icon d-md-none d-lg-inline-block">
                      <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="<?php echo e(asset('../static/svg/circle-letter-r.svg')); ?>" width="20" height="20">
                    </span>
                    <span class="nav-link-title">
                      <strong>ROBENIOR</strong>
                    </span>
                  </a>
                  <div class="dropdown-menu" style="width: 20.5vw">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item">
                          <strong style="margin: auto;">
                            <img style="filter: brightness(0) saturate(100%) invert(36%) sepia(89%) saturate(3039%) hue-rotate(135deg) brightness(92%) contrast(84%);" src="<?php echo e(asset('../static/svg/arrows-up.svg')); ?>" width="20" height="20" alt="">
                              MOVIMIENTOS ACTIVOS
                          </strong>
                        </a>
                        <table class="table table-bordered" style="margin-left: 0.3vw; width: 19.9vw">
                          <thead>
                            <tr>
                              <th style="border-left: 1px solid green;">DESCRIPCIÓN</th>
                              <th>MONTO</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td style="border-left: 1px solid green; font-size: clamp(0.6rem, 3vw, 0.62rem)">Pago a inversionistas</td>
                              <td style="font-size: clamp(0.6rem, 3vw, 0.62rem)">Lps. <?php echo e(number_format($total_investor_profit_payment,2)); ?></td>
                            </tr>
                            <tr>
                              <td style="border-left: 1px solid green; font-size: clamp(0.6rem, 3vw, 0.62rem)">Pago a comisionistas</td>
                              <td style="font-size: clamp(0.6rem, 3vw, 0.62rem)">Lps. <?php echo e(number_format($total_commissioner_commission_payment,2)); ?></td>
                            </tr>
                            <tr>
                              <td style="border-left: 1px solid green; font-size: clamp(0.6rem, 3vw, 0.62rem)">Inversión de proyectos en proceso</td>
                              <td style="font-size: clamp(0.6rem, 3vw, 0.62rem)">Lps. <?php echo e(number_format($total_project_investment,2)); ?></td>
                            </tr>
                          </tbody>
                        </table>
                        <a class="dropdown-item">
                          <strong style="margin: auto;">
                            <img style="filter: brightness(0) saturate(100%) invert(28%) sepia(35%) saturate(4731%) hue-rotate(334deg) brightness(89%) contrast(95%);" src="<?php echo e(asset('../static/svg/arrows-up.svg')); ?>" width="20" height="20" alt="">
                              MOVIMIENTOS PASADOS
                          </strong>
                        </a>
                        <table class="table table-bordered" style="margin-left: 0.3vw; width: 19.9vw">
                          <thead>
                            <tr>
                              <th style="border-left: 1px solid red;">DESCRIPCIÓN</th>
                              <th>MONTO</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td style="border-left: 1px solid red; font-size: clamp(0.6rem, 3vw, 0.62rem)">Pagos a inversionistas</td>
                              <td style="font-size: clamp(0.6rem, 3vw, 0.62rem)">Lps. <?php echo e(number_format($total_investor_profit_paid,2)); ?></td>
                            </tr>
                            <tr>
                              <td style="border-left: 1px solid red; font-size: clamp(0.6rem, 3vw, 0.62rem)">Pagos a comisionistas</td>
                              <td style="font-size: clamp(0.6rem, 3vw, 0.62rem)">Lps. <?php echo e(number_format($total_commissioner_commission_paid,2)); ?></td>
                            </tr>
                            <tr>
                              <td style="border-left: 1px solid red; font-size: clamp(0.6rem, 3vw, 0.62rem)">Inversión de proyectos finalizados</td>
                              <td style="font-size: clamp(0.6rem, 3vw, 0.62rem)">Lps. <?php echo e(number_format($total_project_investment_terminated,2)); ?></td>
                            </tr>
                          </tbody>
                        </table>
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
                <?php echo $__env->yieldContent('pretitle'); ?>
              </div>
              <h2 class="page-title">
                <?php echo $__env->yieldContent('title'); ?>
              </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                <?php echo $__env->yieldContent('create'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page body -->
      <div class="page-body">
        <?php echo $__env->yieldContent('content'); ?>
      </div>
      <footer class="footer footer-transparent d-print-none">
        <div class="container-xl">
          <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
              <ul class="list-inline list-inline-dots mb-0">
                <?php echo $__env->yieldContent('footer_right'); ?>
              </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
              <ul class="list-inline list-inline-dots mb-0">
                <li class="list-inline-item">
                  <?php echo $__env->yieldContent('footer_left'); ?>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Tabler Core -->
  <script src="<?php echo e(asset('dist/js/tabler.min.js')); ?>" defer></script>
  <script src="<?php echo e(asset('dist/js/demo.min.js')); ?>" defer></script>
  <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH /home/carlos/Code/InvestorInsight (Copiar)/resources/views/layout/admin.blade.php ENDPATH**/ ?>