<div class="main">

	<!-- Date cantainer  -->
	<div class="code-container-left">
		<span class="text-uppercase">{{ $dia }} de {{ $mes }} de {{ $anio }}</span><br>
		<span class="text-bold text-uppercase">INVERSIONES ROBENIOR</span><br>
		<span class="text-uppercase">San Pedro Sula, Honduras, CA</span>
	</div>

	<!-- Code container -->
	<div class="code-container-right">
		<span class="text-bold">#{{ $creditNote->creditNote_code }}</span>
	</div>
	
	<!-- Credit's note title -->
	<div class="title-note mt-center">
		NOTA CREDITO POR LPS {{ number_format($creditNote->creditNote_amount,2 ) }}
	</div>

	<!-- Credit's note body -->
	<div class="body-note mt-4 mb-4">
		Por la presente, se emite la siguiente nota de crédito a favor del inversionista <strong>{{ $creditNote->investor->investor_name }}</strong>, identificado con su número de identidad 
		<strong>{{ $creditNote->investor->investor_dni }}</strong>, número de teléfono <strong>{{ $creditNote->investor->investor_phone }}</strong>, con un valor total de Lps. <strong>{{ number_format($creditNote->creditNote_amount,2) }}</strong>.
		<br>
		<br>
		@if($creditNote->investor->investor_balance < 0)
			Mediante el presente documento, el inversionista mencionado anteriormente pasa a tener un fondo en negativo de Lps. <strong class="text-red">{{ number_format($creditNote->investor->investor_balance,2 )}}</strong>.
		@else
			Mediante el presente documento, el inversionista mencionado anteriormente queda con un fondo disponible de Lps. <strong>{{ number_format($creditNote->investor->investor_balance,2 )}}</strong>.
		@endif
	</div>

	<!-- Credit's note reason title -->
	<div class="reason-note-title mt-4 mb-2">
		Motivo de emisión
	</div>

	<!-- Credit's note readon body -->
	<div class="reason-note-body">
		{{ $creditNote->creditNote_description }}
	</div>

	<!-- Credit's note Robenior signature -->
	<div class="mt-6 ml-center">
		&nbsp;&nbsp;<img src="static/Firma-ejemplo.png" alt="Logo" height="80px"
			style="position: absolute; margin-top: -45px; transform: rotate(35deg)">
			<img src="static/sello-ejemplo.png" alt="Sello" height="80px"
			style="position: absolute; margin-top: -60px; margin-left: 100px">
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

	.title-note{
		font-size: 22px;
		font-weight: bolder;
		margin-bottom: 20px;
		text-align: center;
		text-decoration: underline;
	}

	.reason-note-title{
		font-size: 18px;
		font-weight: bolder;
		margin-bottom: 20px;
		text-align: center;
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