<title>{{ $project->project_name }} - #LQ-{{ $project->project_code }}</title>

<div class="main">

	<!-- Date container  -->
	<div class="code-container-left">
		<span class="text-uppercase">{{ now()->day }} de {{ now()->monthName }} de {{ now()->year }}</span><br>
		<span class="text-bold text-uppercase">INVERSIONES ROBENIOR</span><br>
		<span class="text-uppercase">San Pedro Sula, Honduras, CA</span>
	</div>
	
	<!-- Code container -->
	<div class="code-container-right">
		<span class="text-bold">#LQ-{{ $project->project_code }}</span>
	</div>

	<!-- Liquidation title -->
	<div class="title-note title-top-margin ml-4">
		LIQUIDACIÓN {{ $project->project_name }} (L. {{ number_format($project->project_investment + $project->investors->sum('pivot.investor_final_profit'),2) }})
	</div>

	<!-- Liquidation body -->
	<div class="body-note mb-4">
		Por medio del presente documento, @foreach($project->investors as $investor) <strong>{{ $investor->investor_name }}</strong> @endforeach y <strong>JUNIOR ALEXIS AYALA GUERRERO</strong>, 
		formalizan la finalización y liquidación del proyecto denominado <strong class="text-uppercase">"{{ $project->project_name }}"</strong> con una fecha inicial el día <strong>{{ $day }}/{{ $month }}/{{ $year }}</strong>,
		y final el día <strong>{{ $endDay }}/{{ $endMonth }}/{{ $endYear }}</strong>, con un valor total de <strong>{{ $amountLetras }} LEMPIRAS</strong> (L. {{ number_format($project->project_investment + $project->investors->sum('pivot.investor_final_profit'),2) }}).
		<br><br>
		
        Conforme a lo señalado previamente, @foreach($project->investors as $investor) <strong>{{ $investor->investor_name }}</strong> @endforeach y <strong>JUNIOR ALEXIS AYALA GUERRERO</strong>, acuerdan que el proyecto 
        <strong class="text-uppercase">"{{ $project->project_name }}"</strong> ha sido finalizado, y mediante el documento presente, liquidado satisfactoriamente. Todos los pagos correspondientes al proyecto han sido realizados, dejando un saldo de 
        Lps. 0.00 pendiente. Las partes confirman que no existen reclamaciones, deudas u obligaciones pendientes relacionadas con este proyecto. 
	</div>

	<!-- Liquidation signatures -->
	<div class="mt-6 ml-center mt-center">
		&nbsp;&nbsp;<img src="static/Firma-ejemplo.png" alt="Logo" height="80px"
			style="position: absolute; margin-top: -47px; transform: scale(1.4)">
			<img src="static/sello-ejemplo.png" alt="Sello" height="80px"
			style="position: absolute; margin-top: -70px; margin-left: 160px; transform: scale(1.3)">
		<span style="margin-left: -30px">__________________________</span><br>
		<strong>Junior Alexis Ayala Guerrero</strong><br>
	</div>

	<!-- Legal footer -->
	<div class="footer">
		Este documento contiene la firma de las partes involucradas. Cualquier uso no autorizado,
		reproducción, alteración o falsificación de esta firma o sello constituirá una violación de los derechos de
		propiedad intelectual y será sujeto a acciones legales.
		Se advierte a toda persona que tenga acceso a este documento que el uso indebido de la firma o sello de las
		partes será considerado como un acto ilícito y se procederá legalmente en consecuencia.
		Por favor, respete la integridad y autenticidad de los elementos de identificación de las partes contenidos en
		este documento.
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

	.body-note {
		font-size: 16px;
		margin-top: 9%;
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
		margin-top: 20% !important;
	}

	.mb-2 {
		margin-bottom: 0.5rem !important;
	}

	.mb-4 {
		margin-bottom: 1.5rem !important;
	}

	.title-top-margin {
		margin-top: 23% !important;
	}

	.ml-center {
		margin-left: 35% !important;
	}

	.title-note {
		font-size: 22px;
		font-weight: bolder;
		margin-bottom: 20px;
		text-align: center;
		text-decoration: underline;
	}

	.footer {
		font-size: 10px;
		margin-top: 40%;
	}

	.text-uppercase{
		text-transform: uppercase;
	}

</style>