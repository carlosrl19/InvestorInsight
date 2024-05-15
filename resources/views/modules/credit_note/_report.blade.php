<div class="title-note mt-center">
	NOTA CREDITO POR LPS {{ number_format($creditNote->creditNote_amount,2 ) }}
</div>

<div class="mt-4">
   Por la presente, se emite la siguiente nota de crédito a favor del inversionista <strong>{{ $creditNote->investor->investor_name }}</strong>, identificado con su número de identidad 
   <strong>{{ $creditNote->investor->investor_dni }}</strong>, número de teléfono <strong>{{ $creditNote->investor->investor_phone }}</strong>, quien fue recomendado por 
   <strong>{{ $creditNote->investor->investor_reference }}</strong>, una nota de crédito con un valor total de Lps. <strong>{{ number_format($creditNote->creditNote_amount,2) }}</strong>.
</div>

<div class="reason-note-title mt-4 mb-2">
	Motivo de emisión
</div>

<div class="reason-note-body">
	{{ $creditNote->creditNote_description }}
</div>

<div class="footer mt-6 ml-center">
	&nbsp;&nbsp;<img src="static/Firma-ejemplo.jpg" alt="Logo" height="80px" style="border-bottom: 2px solid #000;"><br>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma gerente
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
  		margin-left: 35% !important;
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
</style>