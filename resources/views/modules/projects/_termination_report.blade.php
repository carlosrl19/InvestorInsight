<div class="main">

	<!-- Code container -->
	<div class="code-container">
		<span>#FQ-{{ $project->project_code }}</span>
	</div>

	<!-- Finiquito title -->
	<div class="title-note ml-2 mt-center">
		FINIQUITO DE PROYECTO
	</div>

	<!-- Finiquito body -->
	<div class="body-note mt-4 mb-4">
		Por medio del presente documento, @foreach($project->investors as $investor) <strong>{{ $investor->investor_name }}</strong> @endforeach y <strong>JUNIOR ALEXIS AYALA GUERRERO</strong>, dejan constancia de la finalización del proyecto denominado <strong class="text-uppercase">"{{ $project->project_name }}"</strong> en la fecha {{ $day }}/{{ $month }}/{{ $year }}. <br><br>
		
		En virtud de lo anterior, @foreach($project->investors as $investor) <strong>{{ $investor->investor_name }}</strong> @endforeach y el señor <strong>JUNIOR ALEXIS AYALA GUERRERO</strong>. acuerdan dar por concluido el proyecto <strong class="text-uppercase">"{{ $project->project_name }}"</strong> de mutuo acuerdo, sin pendientes o reclamaciones entre ellas, así como alguna acción presente o futura relacionada con el proyecto.
	</div>

	<!-- Finiquito issue date -->
	<div class="mt-4">
		Documento extendido en la ciudad de San Pedro Sula, departamento de Cortés, Honduras, a los {{ now()->day }} días del mes de {{ now()->monthName }} del año {{ now()->year }}. 
	</div>

	<!-- Finiquito signatures -->
	<div class="mt-6 ml-center">
		&nbsp;&nbsp;<img src="static/Firma-ejemplo.png" alt="Logo" height="80px"
			style="position: absolute; margin-top: -35px; transform: rotate(20deg)">
		<span style="margin-left: -30px">__________________________</span><br>
		Junior Alexis Ayala Guerrero<br>
	</div>

	<!-- Legal footer -->
	<div class="footer mt-4">
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

	.code-container{
		padding-top: 20%;
		opacity: 1;
		float: right;
		padding-bottom: 3px;
		font-size: 12px;
		color: black;
		font-style: italic;
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
		margin-top: 25% !important;
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

	.title-note {
		font-size: 22px;
		font-weight: bolder;
		margin-bottom: 20px;
		text-align: center;
		text-decoration: underline;
	}

	.footer {
		font-size: 10px;
	}

	.text-uppercase{
		text-transform: uppercase;
	}
</style>