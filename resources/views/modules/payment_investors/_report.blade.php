<title>PAGO DE COMISIÓN - #PI-{{ $paymentInvestor->payment_code }}</title>

<div class="main">

	<!-- Date container  -->
	<div class="code-container-left">
		<span class="text-uppercase">{{ $dia }} de {{ $mes }} de {{ $anio }}</span><br>
		<span class="text-bold text-uppercase">INVERSIONES ROBENIOR</span><br>
		<span class="text-uppercase">San Pedro Sula, Honduras, CA</span>
	</div>

	<!-- Code container -->
	<div class="code-container-right">
		<span class="text-bold">#PI-{{ $paymentInvestor->payment_code }}</span>
	</div>
	
	<!-- Payment title -->
	<div class="title-note mt-center">
		REPORTE DE PAGO DE COMISIÓN
	</div>

	<!-- Payment body -->
	<div class="body-note mt-4 mb-4">
		Por la presente, se emite el siguiente reporte de pago de comisión a favor del inversionista <strong>{{ $paymentInvestor->investor->investor_name }}</strong>, identificado con su número de identidad 
		<strong>{{ $paymentInvestor->investor->investor_dni }}</strong>, número de teléfono <strong>{{ $paymentInvestor->investor->investor_phone }}</strong>, con un valor total de Lps. 
        <strong>{{ number_format($projectInvestor->investor_final_profit, 2) }}</strong> por concepto del proyecto <strong>{{ $project->project_name }}</strong> con fecha de inicio el día <strong>{{ $project->project_start_date }}</strong> y fecha de finalización <strong>{{ $project->project_end_date }}</strong>.
        <br>
        <br>
		Así mismo se hace el retorno de la inversión por un valor de <strong>L. {{ number_format($project->project_investment,2) }}</strong>.
		@if($paymentInvestor->investor->investor_balance < 0)
            Posterior a este pago, el inversionista mencionado presenta un saldo negativo de Lps. <strong class="text-red">{{ number_format($paymentInvestor->investor->investor_balance,2 )}}</strong>.
        @else
            Posterior a este pago, el inversionista cuenta con un fondo disponible de Lps. <strong>{{ number_format($paymentInvestor->investor->investor_balance,2 )}}</strong>.
        @endif
		<br>
		<br>
		<br>
	</div>

	<!-- Payment Robenior signature -->
	<div class="mt-6 ml-center">
		&nbsp;&nbsp;<img src="static/Firma-ejemplo.png" alt="Logo" height="80px"
			style="position: absolute; margin-top: -45px; transform: scale(1.4)">
			<img src="static/sello-ejemplo.png" alt="Sello" height="80px"
			style="position: absolute; margin-top: -70px; margin-left: 160px; transform: scale(1.3)">
		<span style="margin-left: -30px">__________________________</span><br>
		<strong>Junior Alexis Ayala Guerrero</strong><br>
	</div>

	<!-- Legal footer -->
	<div class="footer mt-6">
		Este documento contiene la firma y sello oficial de la empresa Inversiones ROBENIOR. Cualquier uso no autorizado, reproducción, alteración o falsificación de esta firma o sello constituirá una violación de los derechos de propiedad intelectual de la empresa y será sujeto a acciones legales.
		Se advierte a toda persona que tenga acceso a este documento que el uso indebido de la firma o sello de la empresa será considerado como un acto ilícito y se procederá legalmente en consecuencia.
		Por favor, respete la integridad y autenticidad de los elementos de identificación de la empresa contenidos en este documento.
	</div>
</div>

<style>
	* {
		font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		text-align: justify;
	}

	.code-container-left{
		padding-top: 2%;
		opacity: 1;
		float: left;
		padding-bottom: 3px;
		font-size: 12px;
		color: black;
	}

	.code-container-right{
		padding-top: 2%;
		opacity: 1;
		float: right;
		padding-bottom: 3px;
		font-size: 12px;
		color: black;
	}

	.text-bold{
		font-weight: bolder;
	}

    
	.title-note{
		font-size: 22px;
		font-weight: bolder;
		margin-bottom: 20px;
		text-align: center;
		text-decoration: underline;
	}

	.body-note{
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
		margin-top: 15% !important;
	}

	.mb-2 {
		margin-bottom: 0.5rem !important;
	}

	.mb-4 {
		margin-bottom: 1.5rem !important;
	}

	.ml-center {
  		margin-left: 35% !important;
	}

	.header-note{
		margin-left: 65% !important;
		text-align: end;
	}

	.footer{
		font-size: 10px;
	}

	.text-uppercase{
		text-transform: uppercase;
	}

	.text-red{
		color: red;
	}
</style>