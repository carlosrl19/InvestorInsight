@extends('layout.admin')

@section('head')
<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">

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
										class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
											viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"
											stroke-linecap="round" stroke-linejoin="round"
											class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
											<path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
											<path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
											<path d="M17 10h2a2 2 0 0 1 2 2v1" />
											<path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
											<path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
										</svg> </span>
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
										class="bg-cyan text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
											viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
											stroke-linecap="round" stroke-linejoin="round"
											class="icon icon-tabler icons-tabler-outline icon-tabler-building-skyscraper">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<path d="M3 21l18 0" />
											<path d="M5 21v-14l8 -4v18" />
											<path d="M19 21v-10l-6 -4" />
											<path d="M9 9l0 .01" />
											<path d="M9 12l0 .01" />
											<path d="M9 15l0 .01" />
											<path d="M9 18l0 .01" />
										</svg>
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
										class="bg-success text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
											viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
											stroke-linecap="round" stroke-linejoin="round"
											class="icon icon-tabler icons-tabler-outline icon-tabler-clock-check">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<path d="M20.942 13.021a9 9 0 1 0 -9.407 7.967" />
											<path d="M12 7v5l3 3" />
											<path d="M15 19l2 2l4 -4" />
										</svg>
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
										class="bg-red text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
											viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
											stroke-linecap="round" stroke-linejoin="round"
											class="icon icon-tabler icons-tabler-outline icon-tabler-clock-off">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<path
												d="M5.633 5.64a9 9 0 1 0 12.735 12.72m1.674 -2.32a9 9 0 0 0 -12.082 -12.082" />
											<path d="M12 7v1" />
											<path d="M3 3l18 18" />
										</svg>
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
					<h3 class="card-title">Inversión de proyectos</h3>
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
														<td>{{ $promissoryNote->promissoryNote_code }}</td>
														<td>{{ $promissoryNote->promissoryNote_final_date }}</td>
														<td>
															<a href="{{ route('investor.show', $promissoryNote->investor_id) }}">{{ $promissoryNote->investor->investor_name }}
																<small>
																	<sup>
																		<svg xmlns="http://www.w3.org/2000/svg" width="24"
																			height="24" viewBox="0 0 24 24" fill="none"
																			stroke="currentColor" stroke-width="1"
																			stroke-linecap="round" stroke-linejoin="round"
																			class="icon icon-tabler icons-tabler-outline icon-tabler-link">
																			<path stroke="none" d="M0 0h24v24H0z"
																				fill="none" />
																			<path d="M9 15l6 -6" />
																			<path
																				d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" />
																			<path
																				d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
																		</svg>
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
							<h3 class="card-title">Ultimas transferencias<sup class="text-muted"> (últimas 25)</sup>
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
																		<svg xmlns="http://www.w3.org/2000/svg" width="24"
																			height="24" viewBox="0 0 24 24" fill="none"
																			stroke="currentColor" stroke-width="1"
																			stroke-linecap="round" stroke-linejoin="round"
																			class="icon icon-tabler icons-tabler-outline icon-tabler-link">
																			<path stroke="none" d="M0 0h24v24H0z"
																				fill="none" />
																			<path d="M9 15l6 -6" />
																			<path
																				d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" />
																			<path
																				d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
																		</svg>
																	</sup>
																</small>
															</a>
														</td>
														<td>{{ $transfer->transfer_bank }}</td>
														<td class="text-green">Lps.
															{{ number_format($transfer->transfer_amount, 2) }}</td>
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
																		<svg xmlns="http://www.w3.org/2000/svg" width="24"
																			height="24" viewBox="0 0 24 24" fill="none"
																			stroke="currentColor" stroke-width="1"
																			stroke-linecap="round" stroke-linejoin="round"
																			class="icon icon-tabler icons-tabler-outline icon-tabler-link">
																			<path stroke="none" d="M0 0h24v24H0z"
																				fill="none" />
																			<path d="M9 15l6 -6" />
																			<path
																				d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" />
																			<path
																				d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
																		</svg>
																	</sup>
																</small>
															</a>
														</td>
														<td class="text-red">Lps.
															{{ number_format($creditNote->creditNote_amount, 2) }}</td>
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
	// @formatter:off
	document.addEventListener("DOMContentLoaded", function () {
		window.ApexCharts && (new ApexCharts(document.getElementById('chart-mentions'), {
			chart: {
				type: "bar",
				fontFamily: 'inherit',
				height: 240,
				parentHeightOffset: 0,
				toolbar: {
					show: false,
				},
				animations: {
					enabled: false
				},
				stacked: true,
			},
			plotOptions: {
				bar: {
					columnWidth: '50%',
				}
			},
			dataLabels: {
				enabled: false,
			},
			fill: {
				opacity: 1,
			},
			series: [{
				name: "Web",
				data: [1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 2, 12, 5, 8, 22, 6, 8, 6, 4, 1, 8, 24, 29, 51, 40, 47, 23, 26, 50, 26, 41, 22, 46, 47, 81, 46, 6]
			}, {
				name: "Social",
				data: [2, 5, 4, 3, 3, 1, 4, 7, 5, 1, 2, 5, 3, 2, 6, 7, 7, 1, 5, 5, 2, 12, 4, 6, 18, 3, 5, 2, 13, 15, 20, 47, 18, 15, 11, 10, 0]
			}, {
				name: "Other",
				data: [2, 9, 1, 7, 8, 3, 6, 5, 5, 4, 6, 4, 1, 9, 3, 6, 7, 5, 2, 8, 4, 9, 1, 2, 6, 7, 5, 1, 8, 3, 2, 3, 4, 9, 7, 1, 6]
			}],
			tooltip: {
				theme: 'dark'
			},
			grid: {
				padding: {
					top: -20,
					right: 0,
					left: -4,
					bottom: -4
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
			},
			yaxis: {
				labels: {
					padding: 4
				},
			},
			labels: [
				'2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19', '2020-07-20', '2020-07-21', '2020-07-22', '2020-07-23', '2020-07-24', '2020-07-25', '2020-07-26'
			],
			colors: [tabler.getColor("primary"), tabler.getColor("primary", 0.8), tabler.getColor("green", 0.8)],
			legend: {
				show: false,
			},
		})).render();
	});
	// @formatter:on
</script>
@endsection