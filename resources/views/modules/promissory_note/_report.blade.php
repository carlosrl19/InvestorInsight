<div class="main">

	<!-- Code container -->
	<div class="code-container">
		<span>#{{ $promissoryNote->promissoryNote_code }}</span>
	</div>

    <!-- Credit's note title -->
    <div class="title-note mt-center">PAGARE L {{ number_format($promissoryNote->promissoryNote_amount, 2) }}</div>
    <!-- Credit's note body -->
    <div class="body-note mt-4 mb-4">Yo: <strong class="text-underline">JUNIOR ALEXIS AYALA GUERRERO</strong>, mayor de edad, hondureño, soltero y
        comerciante, con documento Nacional de identificación número <strong
            class="text-underline">0801199907469</strong>,
        con domicilio en la ciudad de San Pedro Sula, departamento de Cortés, Honduras, <strong>PAGARÉ
            INCONDICIONALMENTE</strong> la cantidad de <strong class="text-underline">{{$amountLetras}} EXACTO</strong>
        (<strong class="text-underline">L. {{ number_format($promissoryNote->promissoryNote_amount, 0) }}</strong>)
        a favor del señor <strong class="text-uppercase text-underline">{{ $promissoryNote->investor->investor_name }}</strong>, mayor de
        edad, hondureño y con documento Nacional de identificación número <strong
            class="text-underline">{{ $promissoryNote->investor->investor_dni }}</strong>, pago que haré efectivo el día <strong
            class="text-uppercase text-underline">{{ \Carbon\Carbon::parse($promissoryNote->promissoryNote_final_date)->translatedFormat('d F Y') }}</strong>
        (<strong
            class="text-underline">{{ \Carbon\Carbon::parse($promissoryNote->promissoryNote_final_date)->translatedFormat('d/m/Y') }}</strong>).

        <br>
        <br>
        En fe de lo anterior, firmo el presente <strong>PAGARÉ</strong> en la ciudad de San Pedro Sula, del departamento
        de Cortés a los {{ $dia }} días del mes de {{ $mes }} del año {{ $anio }}.
    </div>
    <br>

    <!-- Credit's note Robenior signature -->
    <div class="mt-6 ml-center">&nbsp;&nbsp;<img src="static/Firma-ejemplo.png" alt="Logo" height="90px"
            style="position: absolute; margin-top: 10px; transform: rotate(25deg)">
        <br>_________________
        <br><span>DNI: <strong class="text-underline">0801199907469</strong></span>
    </div>
</div>

<style>
    * {
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        text-align: justify;
        line-height: 2;
    }

    .code-container{
		background-color: darkgrey;
		border-radius: 5px;
		padding-left: 15px;
		padding-right: 15px;
		padding-top: 3px;
		opacity: 0.3;
		float: right;
		padding-bottom: 3px;
		font-size: 10px;
		color: black;
		font-style: italic;
	}

    .text-uppercase {
        text-transform: uppercase;
    }

    .text-underline {
        text-decoration: underline;
        border-bottom: 1.3px solid black;
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
        margin-top: 5% !important;
    }

    .mb-2 {
        margin-bottom: 0.5rem !important;
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    .ml-2 {
        margin-left: 12% !important;
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