@extends('layout.admin')

@section('head')
<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">

<!-- Apexchart -->
<link href="{{ asset('dist/libs/apexcharts/dist/apexcharts.css') }}" rel="stylesheet">

@endsection

@section('pretitle')
Panel principal
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
			</div>
		</div>

		<div class="col-lg-7">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title">Registro de comisiones<sup class="text-muted"> (Junior Alexis Ayala Guerrero)</sup></h3>
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
							<h3 class="card-title">Ultimos fondos de proyecto<sup class="text-muted"> (últimos 25)</sup>
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