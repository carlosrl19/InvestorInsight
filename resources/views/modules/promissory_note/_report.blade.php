<title>#PG-{{ $promissoryNote->promissoryNote_code }}</title>

<div class="main">

	<!-- Code container -->
	<div class="code-container-right">
		<span class="text-bold">#PG-{{ $promissoryNote->promissoryNote_code }}</span>
	</div>

    <!-- Promissory note title -->
    <div class="title-note title-top-margin">PAGARE L. {{ number_format($promissoryNote->promissoryNote_amount,2)}}</div>

    <!-- Promissory note body -->
    <div class="body-note mt-6 mb-4">Yo: <strong class="text-underline">JUNIOR ALEXIS AYALA GUERRERO</strong>, mayor de edad, hondureño, soltero y
        comerciante, con documento Nacional de identificación número <strong
            class="text-underline">0801199907469</strong>,
        con domicilio en la ciudad de San Pedro Sula, departamento de Cortés, Honduras, <strong>PAGARÉ
            INCONDICIONALMENTE</strong> la cantidad de <strong class="text-underline">{{$amountLetras}} EXACTO</strong>
        (<strong class="text-underline">L. {{ number_format($promissoryNote->promissoryNote_amount, 0) }}</strong>)
        a favor de <strong class="text-uppercase text-underline">{{ $promissoryNote->investor->investor_name }}</strong>, mayor de
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

    <!-- Promissory note Robenior signature -->
    <div class="mt-6 ml-center">
        &nbsp;&nbsp;<img src="static/Firma-ejemplo.png" alt="Logo" height="80px"
			style="position: absolute; margin-top: -5px; transform: scale(1.4)">
			<img src="static/sello-ejemplo.png" alt="Sello" height="80px"
			style="position: absolute; margin-top: -30px; margin-left: 160px; transform: scale(1.3)">
        <br>_______________________
        <br><span>DNI: <strong class="text-underline">0801199907469</strong></span>
    </div>
</div>

<style>
    * {
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        text-align: justify;
        line-height: 2;
    }

    .code-container-right{
		padding-top: 2%;
		opacity: 1;
		float: right;
		padding-bottom: 3px;
		font-size: 12px;
		color: black;
	}

    .text-uppercase {
        text-transform: uppercase;
    }

    .text-underline {
        text-decoration: underline;
        border-bottom: 1.3px solid black;
    }

	.text-bold{
		font-weight: bolder;
	}

    .body-note {
        font-size: 16px;
        margin-top: 11%;
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
        margin-top: 25% !important;
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
    
	.title-top-margin {
		margin-top: 13% !important;
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