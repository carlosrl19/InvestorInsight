@extends('layout.admin')

@section('head')
<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">

<!-- Apexchart -->
<link href="{{ asset('dist/libs/apexcharts/dist/apexcharts.css') }}" rel="stylesheet">

@endsection

@section('pretitle')
Panel principal <small>({{ number_format($loadTime, 2) }} segundos)</small>
@endsection

@section('title')
Dashboard
@endsection

@section('content')
<div class="container-xl">
	<div class="row row-deck row-cards">
		<div class="col-12">
			<div class="row row-cards">
				<div class="col-sm-3 col-lg-3">
					<div class="card card-sm">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-auto">
									<span
										class="bg-primary text-white avatar">
											<img style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(158deg) brightness(103%) contrast(103%);" src="{{ asset('../static/svg/users-group.svg') }}" width="20" height="20">
										</span>
								</div>
								<div class="col">
									<div class="font-weight-medium">
										@if($investor = 1)
											{{ $investors }} inversionista<br>
										@else
											{{ $investors }} inversionistas<br>
										@endif
									</div>
									<div class="text-muted">
										{{ $commissioner }} comisionistas
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-lg-3">
					<div class="card card-sm">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-auto">
									<span
										class="bg-cyan text-white avatar">
										<img style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(158deg) brightness(103%) contrast(103%);" src="{{ asset('../static/svg/building-skyscraper.svg') }}" width="20" height="20">
								</div>
								<div class="col">
									<div class="font-weight-medium">
										{{ $activeProjectsCount }}
									</div>
									<div class="text-muted">
										Nº proyectos activos
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-lg-3">
					<div class="card card-sm">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-auto">
									<span
										class="bg-success text-white avatar">
										<img style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(158deg) brightness(103%) contrast(103%);" src="{{ asset('../static/svg/clock-check.svg') }}" width="20" height="20">
								</div>
								<div class="col">
									<div class="font-weight-medium">
										{{ $completedProjectsCount }}
									</div>
									<div class="text-muted">
										Nº proyectos completados
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-lg-3">
					<div class="card card-sm">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-auto">
									<span
										class="bg-red text-white avatar">
										<img style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(158deg) brightness(103%) contrast(103%);" src="{{ asset('../static/svg/clock-off.svg') }}" width="20" height="20">
								</div>
								<div class="col">
									<div class="font-weight-medium">
										{{ $closedProjectsCount }}
									</div>
									<div class="text-muted">
										Nº proyectos cerrados
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- General Reports -->
				<div class="col-sm-6 col-lg-6">
					<div class="card card-sm">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-auto">
									<span class="bg-orange text-white avatar">
										<img style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(158deg) brightness(103%) contrast(103%);" src="{{ asset('../static/svg/report.svg') }}" width="20" height="20">
									</span>
								</div>
								<div class="col">
									<div class="font-weight-medium">
										Reporte general 
									</div>
									<div class="text-muted">
										Reporte de todos los movimientos realizados en el sistema.
									</div>
								</div>
								<div style="margin-right: -35vh;" class="col">
									<a href="{{ route('dashboard.general_export')}}" class="badge bg-teal me-1 text-white" style="padding-right: 10px">
                                	    <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="{{ asset('../static/svg/file-spreadsheet.svg') }}" width="20" height="20" alt="">
                                	    EXCEL GENERAL
                                	</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Filter reports -->
				<div class="col-sm-6 col-lg-6">
					<div class="card card-sm">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-auto">
									<span class="bg-dark text-white avatar">
										<img style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(158deg) brightness(103%) contrast(103%);" src="{{ asset('../static/svg/report.svg') }}" width="20" height="20">
									</span>
								</div>
								<div class="col">
									<div class="font-weight-medium">
										Reporte filtrado 
									</div>
									<div class="text-muted">
										Reporte con filtros para obtener datos específicos del sistema.
									</div>
								</div>
								<div style="margin-right: -35vh;" class="col">
									<a href="#" data-bs-toggle="modal" data-bs-target="#modal-filters" class="badge bg-dark me-1 text-white">
										<img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="{{ asset('../static/svg/filter.svg') }}" width="20" height="20" alt="">
										MOSTRAR FILTROS
                                	</a>
								</div>

								<!-- Modal filters -->
								<div class="modal modal-blur fade" id="modal-filters" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
										<div class="modal-content" style="border: 2px solid #52524E">
											<div class="modal-header">
												<h5 class="modal-title">Filtros para exportar reporte excel</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<form id="filter-form" method="GET" action="{{ route('dashboard.general_export') }}">
													<table id="filters" class="table table-bordered table-responsive">
														<thead>
															<tr>
																<th style="text-align: center;">FILTRO</th>
																<th style="text-align: center;">DESCRIPCIÓN DEL FILTRO</th>
																<th style="text-align: center;">ACCIONES</th>
															</tr>
														</thead>
														<tbody style="font-size: clamp(0.6rem, 3vw, 0.7rem);">
															<tr>
																<td style="text-align: center;">Fechas</td>
																<td style="text-align: center;">
																	Seleccione la <strong>Fecha Inicio</strong> y  <strong>Fecha Final</strong> para obtener los movimientos a partir de esa fecha.
																</td>
																<td style="text-align: center;">
																	<input style="font-size: clamp(0.6rem, 3vw, 0.7rem);" type="date" name="start_date" class="form-control">
																	<input style="font-size: clamp(0.6rem, 3vw, 0.7rem);" type="date" name="end_date" class="form-control">
																</td>
															</tr>
														</tbody>
													</table>
													<button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
													<button type="submit" class="btn btn-teal me-1 text-white">
														<img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="{{ asset('../static/svg/file-spreadsheet.svg') }}" width="20" height="20" alt="">
														Obtener reporte filtrado
													</button>
												</form>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-7">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title">Gráfico de comisiones otorgadas<sup class="text-muted"> (Junior Alexis Ayala Guerrero)</sup></h3>
					<div id="chart-mentions" class="chart-lg"></div>
				</div>
			</div>
		</div>

		<div class="col-lg-5">
			<div class="row row-cards">
				<div class="col-12">
					<div class="card" style="height: 20rem">
						<div class="card-header">
							<h3 class="card-title">Ultimos pagarés inversionistas<sup class="text-muted"> (últimos 25)</sup>
							</h3>
						</div>
						<div class="card-body card-body-scrollable card-body-scrollable-shadow">
							<div class="divide-y">
								<div>
									<div class="row">
										<table id="example4" class="display table table-bordered">
											<thead>
												<tr>
													<th>Código</th>
													<th>Fecha pago</th>
													<th>Inversionista</th>
													<th>Monto</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($promissoryNotes as $promissoryNote)												
													<tr>
														<td>#{{ $promissoryNote->promissoryNote_code }}</td>
														<td>{{ $promissoryNote->promissoryNote_final_date }}</td>
														<td>
															<a href="{{ route('investor.show', $promissoryNote->investor_id) }}">{{ $promissoryNote->investor->investor_name }}
																<small>
																	<sup>
																		<img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
																	</sup>
																</small>
															</a>
														</td>
														<td>Lps. {{ number_format($promissoryNote->promissoryNote_amount,2) }}</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-7">
			<div class="row row-cards">
				<div class="col-12">
					<div class="card" style="height: 28rem">
						<div class="card-header">
							<h3 class="card-title">Ultimos movimientos / transferencias<sup class="text-muted"> (últimos 25)</sup>
							</h3>
						</div>
						<div class="card-body card-body-scrollable card-body-scrollable-shadow">
							<div class="divide-y">
								<div>
									<div class="row">
										<table id="example2" class="display table table-bordered">
											<thead>
												<tr>
													<th>Fecha</th>
													<th>Inversionista</th>
													<th>Banco</th>
													<th>Monto</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($transfers as $transfer)												
													<tr>
														<td>{{ $transfer->transfer_date }}</td>
														<td>
															<a href="{{ route('investor.show', $transfer->investor_id) }}">{{ $transfer->investor->investor_name }}
																<small>
																	<sup>
																		<img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
																	</sup>
																</small>
															</a>
														</td>
														<td>{{ $transfer->transfer_bank }}</td>
														<td class="text-green">Lps. {{ number_format($transfer->transfer_amount, 2) }}</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-5">
			<div class="row row-cards">
				<div class="col-12">
					<div class="card" style="height: 28rem">
						<div class="card-header">
							<h3 class="card-title">Ultimas notas crédito<sup class="text-muted"> (últimas 25)</sup></h3>
						</div>
						<div class="card-body card-body-scrollable card-body-scrollable-shadow">
							<div class="divide-y">
								<div>
									<div class="row">
										<table id="example3" class="display table table-bordered">
											<thead>
												<tr>
													<th>Fecha</th>
													<th>Inversionista</th>
													<th>Monto</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($creditNotes as $creditNote)												
													<tr>
														<td>{{ $creditNote->creditNote_date }}</td>
														<td>
															<a
																href="{{ route('investor.show', $creditNote->investor_id) }}">{{ $creditNote->investor->investor_name }}
																<small>
																	<sup>
																		<img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
																	</sup>
																</small>
															</a>
														</td>
														<td class="text-red">Lps. {{ number_format($creditNote->creditNote_amount, 2) }}</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_history.js')}}"></script>

<!-- Libs JS -->
<script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        @php
            $paymentAmounts = $payments->pluck('payment_amount');
            $paymentDates = $payments->pluck('created_at');
            $projectNames = $payments->pluck('project_name');
            $projectInvestments = $payments->pluck('project_investment');
        @endphp

        var paymentAmounts = @json($paymentAmounts);
        var paymentDates = @json($paymentDates);
        var projectNames = @json($projectNames);
        var projectInvestments = @json($projectInvestments);

        // Función para formatear números con separadores de miles y dos decimales
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        window.ApexCharts && (new ApexCharts(document.getElementById('chart-mentions'), {
            chart: {
                type: "area",
				dropShadow: {
					enabled: true,
					color: '#000',
					top: 18,
					left: 7,
					blur: 10,
					opacity: 0.2
				},				
                fontFamily: 'inherit',
                height: 240,
                parentHeightOffset: 0,
				toolbar: {
                    show: true,
					tools: {
						download: true,
						selection: true,
						zoom: false,
						zoomin: true,
						zoomout: true,
						pan: false,
						reset: false
					}
                },
                animations: {
                    enabled: true
                },
                stacked: false,
            },
			stroke: {
			curve: 'smooth'
			},
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: "Comisión",
                data: paymentAmounts
            }, {
                name: "Inversión",
                data: projectInvestments
            }],
			markers: {
				size: 4,
				hover: {
					size: 7
				}
			},
            tooltip: {
                theme: 'dark',
                y: {
                    formatter: function(value) {
                        return numberWithCommas(value.toFixed(2)); // Formatea el valor con separadores de miles y dos decimales
                    }
                },
                x: {
                    formatter: function(value, { series, seriesIndex, dataPointIndex, w }) {
                        return projectNames[dataPointIndex]; // Muestra el nombre del proyecto
                    }
                }
            },
            grid: {
                padding: {
                    top: -20,
                    right: 10,
                    left: 0,
                    bottom: 5
                },
                strokeDashArray: 4,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                type: 'datetime',
                categories: paymentDates.map(date => new Date(date).toISOString()),
            },
            yaxis: {
                labels: {
                    padding: 4,
                    formatter: function(value) {
                        return numberWithCommas(value.toFixed(2)); // Formatea el valor con separadores de miles y dos decimales
                    }
                },
            },
            colors: [tabler.getColor("primary"), tabler.getColor("green")],
            legend: {
                show: true,
            },
        })).render();
    });
</script>
@endsection