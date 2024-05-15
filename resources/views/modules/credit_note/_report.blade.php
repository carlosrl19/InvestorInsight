<div class="main">
	<div class="title-note mt-center">
		NOTA CREDITO POR LPS {{ number_format($creditNote->creditNote_amount,2 ) }}
	</div>

	<div class="mt-4">
		Por la presente, se emite la siguiente nota de crédito a favor del inversionista <strong>{{ $creditNote->investor->investor_name }}</strong>, identificado con su número de identidad 
		<strong>{{ $creditNote->investor->investor_dni }}</strong>, número de teléfono <strong>{{ $creditNote->investor->investor_phone }}</strong>, una nota de crédito con un valor total de Lps. <strong>{{ number_format($creditNote->creditNote_amount,2) }}</strong>.
	</div>

	<div class="reason-note-title mt-4 mb-2">
		Motivo de emisión
	</div>

	<div class="reason-note-body">
		{{ $creditNote->creditNote_description }}
	</div>

	<div class="mt-6">
		Emitido por Inversiones ROBENIOR en San Pedro Sula, Cortés, Honduras, a los {{ $dia }} días del mes de {{ $mes }} del año {{ $anio }}.
	</div>

	<div class="mt-6 ml-center">
		&nbsp;&nbsp;<img src="static/Firma-ejemplo.png" alt="Logo" height="80px" style="position: absolute; margin-top: -25px"><br>
		_________________<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dariel Moncada<br>
		&nbsp;<strong>Gerente ROBENIOR</strong>
	</div>

	<div class="footer mt-6">
		Este documento contiene la firma y sello oficial de la empresa <i>ROBENIOR</i>. Cualquier uso no autorizado, reproducción, alteración o falsificación de esta firma o sello constituirá una violación de los derechos de propiedad intelectual de la empresa y será sujeto a acciones legales.
		Se advierte a toda persona que tenga acceso a este documento que el uso indebido de la firma o sello de la empresa será considerado como un acto ilícito y se procederá legalmente en consecuencia.
		Por favor, respete la integridad y autenticidad de los elementos de identificación de la empresa contenidos en este documento.
	</div>
</div>

<style>
	* {
		font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		text-align: justify;
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
</style>