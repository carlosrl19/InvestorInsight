<div class="main">
    <!-- Credit's note title -->
    <div class="title-note mt-center">PAGARE LPS. {{ number_format($promissoryNote->promissoryNote_amount,2 ) }}</div>
    <!-- Credit's note body -->
    <div class="body-note mt-4 mb-4">Yo <strong>{{ $promissoryNote->investor->investor_name }}</strong>, mayor de edad, hondureño y con documento nacional de identificación número<strong>{{ $promissoryNote->investor->investor_dni }}</strong>, con domicilio en la ciudad de San Pedro Sula,
        departamento de Cortés, Honduras, <strong>PAGARÉ INCONDICIONALMENTE</strong> la cantidad de <strong>{{ $promissoryNote->promissoryNote_amount }}</strong> (L. Lempiras en texto) a favor del señor <strong>JUNIOR ALEXIS AYALA GUERRERO</strong>, mayor
        de edad, hondureño, soltero y comerciante, con documento nacional de identificación número <strong>0801199907469</strong>, pago que se hará efectivo el día <strong>{{ $promissoryNote->promissoryNote_date }} ({{ $promissoryNote->promissoryNote_date }})</strong>.
        <br>
        <br>
        En fe de lo anterior, firmo el presente <strong>PAGARÉ</strong> en la ciudad de San Pedro Sula, del departamento de Cortés a los X días del mes de X del año X año en letras X (X/XX/XXXX)
    </div>
  
    <!-- Credit's note Robenior signature -->
    <div class="mt-6 ml-center">&nbsp;&nbsp;<img src="static/Firma-ejemplo.png" alt="Logo" height="80px" style="position: absolute; margin-top: -25px">
        <br>&nbsp;&nbsp;<img src="static/sello-ejemplo.png" alt="Logo" height="80px" style="position: absolute; margin-top: -35px; margin-left: 30px">
        <br>_________________
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma
        <br>_________________
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DNI
    </div>
</div>
<style>
    * {
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        text-align: justify;
    }
    .body-note {
        font-size: 16px;
    }
    .mt-2 {
        margin-top: 0.5rem !important;
    }
    .mt-4 {
        margin-top: 1.5rem !important;
    }
    .mt-6 {
        margin-top: 4.5rem !important;
    }
    .mt-center {
        margin-top: 35% !important;
    }
    .mb-2 {
        margin-bottom: 0.5rem !important;
    }
    .mb-4 {
        margin-bottom: 1.5rem !important;
    }
    .ml-center {
        margin-left: 37% !important;
    }
    .header-note {
        margin-left: 65% !important;
        text-align: end;
    }
    .title-note {
        font-size: 22px;
        font-weight: bolder;
        margin-bottom: 20px;
        text-align: center;
        text-decoration: underline;
    }
    .reason-note-title {
        font-size: 18px;
        font-weight: bolder;
        margin-bottom: 20px;
        text-align: center;
    }
    .footer {
        font-size: 10px;
    }
</style>