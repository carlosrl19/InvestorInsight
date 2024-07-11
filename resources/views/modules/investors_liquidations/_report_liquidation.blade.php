<title>{{ $investor->investor_name }} - #LQ-{{ $investorLiquidation->liquidation_code }}</title>

<div class="main">

	<!-- Date container  -->
	<div class="code-container-left">
		<span class="text-uppercase">{{ now()->day }} de {{ now()->monthName }} de {{ now()->year }}</span><br>
		<span class="text-bold text-uppercase">INVERSIONES ROBENIOR</span><br>
		<span class="text-uppercase">San Pedro Sula, Honduras, CA</span>
	</div>
	
	<!-- Code container -->
	<div class="code-container-right">
		<span class="text-bold">#LQ-{{ $investorLiquidation->liquidation_code }}</span>
	</div>

	<!-- Liquidation title -->
	<div class="title-note title-top-margin ml-4">
		LIQUIDACIÓN DE FONDOS
	</div>

	<!-- Liquidation body -->
	<div class="body-note mb-4">
		Por medio de este documento, <strong>JUNIOR ALEXIS AYALA GUERRERO</strong> formaliza la liquidación de la cuenta del inversionista <strong class="text-uppercase">{{ $investor->investor_name }}</strong>, 
		en San Pedro Sula, Cortés, Honduras, con fecha <strong>{{ $day }}/{{ $month }}/{{ $year }}</strong>, por un monto total de Lps. <strong>{{ number_format($investorLiquidation->investor_liquidation_amount,2) }}</strong>. 
		
		@if($investorLiquidation->liquidation_payment_mode == "VARIOS MÉTODOS/TRANSFERENCIAS")
			Los pagos realizados para la liquidación fueron los siguientes:
		@else
			El pago se realizó a través de <strong>{{ $investorLiquidation->liquidation_payment_mode }}</strong> siendo detallado de la siguiente manera:
		@endif

		<table class="table mt-4 mb-4">
			<thead>
				<tr>
					<th style="text-align: center;">Nº</th>
					<th style="text-align: left;">INFORMACIÓN DE PAGOS EFECTUADOS</th>
				</tr>
			</thead>
			<tbody>
				@php
					$i = 1;
				@endphp
				@foreach(explode("\n", $investorLiquidation->liquidation_payment_comment) as $line)
					<tr>
						<td style="font-size: 12px; text-align: center;">{{ $i++ }}</td>
						<td style="font-size: 12px; text-align: left;">{{ $line }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<p class="mt-2">
		Según lo acordado, el inversionista ha sido liquidado de manera satisfactoria. En consecuencia, todos los pagos correspondientes a la liquidación han sido efectuados, dejando un saldo pendiente de Lps. 0.00, 
		lo que confirma que no existen reclamaciones, deudas u obligaciones pendientes entre ambas partes a futuro.
		</p>
	</div>

	<!-- Liquidation signatures -->
	<div class="mt-2 ml-center mt-center">
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

	table {
		width: 100%;
		border-collapse: collapse;
		font-family: Arial, sans-serif;
		border: 1px solid #ddd;
	}

	th, td {
		padding: 10px;
		text-align: left;
		border-bottom: 1px solid #ddd;
		font-size: 14px;
	}

	th {
		background-color: #f2f2f2;
		border-right: 1px solid #ddd;
	}

	td {
		border-right: 1px solid #ddd;
	}

	tr:nth-child(even) {
		background-color: #f2f2f2;
	}

	tr:hover {
		background-color: #e6e6e6;
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
		margin-top: 15% !important;
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
		margin-top: 10%;
	}

	.text-uppercase{
		text-transform: uppercase;
	}

</style>