<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>InvestorInsight</title>
    <!-- CSS files -->
    <link href="../dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="../dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="../dist/css/demo.min.css" rel="stylesheet"/>
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
  <body  class=" border-top-wide border-primary d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js"></script>
    <div class="page page-center">
      <div class="container-tight">
        <div class="empty">
          <p class="empty-title">¡Vaya, parece que algo salió mal!</p>
          <div style="width: 450px; margin-bottom: -50px;">
            <img src="<?php echo e(asset('static/404-error.png')); ?>" alt="">
          </div>
          <p class="empty-subtitle text-muted">
            "Oops, parece que la página que estás buscando no existe. Por favor, intenta nuevamente dentro de un momento, si el problema persiste contacta al soporte técnico para que puedan solucionarlo."
          </p>
          <div class="empty-action">
            <a href="<?php echo e(route('dashboard.index')); ?>" class="btn btn-sm btn-outline-red">
              <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
              Volver
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>
  </body>
</html><?php /**PATH C:\Users\Carlos Rodriguez\Desktop\Code\InvestorInsight - experimental\resources\views/errors/404.blade.php ENDPATH**/ ?>