<?php $__env->startSection('head'); ?>
<!-- Datatable CSS -->
<link href="<?php echo e(asset('vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/datatables/css/buttons.dataTables.min.css')); ?>" rel="stylesheet">

<!-- Apexchart -->
<link href="<?php echo e(asset('dist/libs/apexcharts/dist/apexcharts.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pretitle'); ?>
Panel principal <small>(Tiempo de carga: <?php echo e(number_format($loadTime, 2)); ?> segundos)</small>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
											<img style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(158deg) brightness(103%) contrast(103%);" src="<?php echo e(asset('../static/svg/users-group.svg')); ?>" width="20" height="20">
										</span>
								</div>
								<div class="col">
									<div class="font-weight-medium">
										<?php if($investor = 1): ?>
											<?php echo e($investors); ?> inversionista<br>
										<?php else: ?>
											<?php echo e($investors); ?> inversionistas<br>
										<?php endif; ?>
									</div>
									<div class="text-muted">
										<?php echo e($commissioner); ?> comisionistas
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
										<img style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(158deg) brightness(103%) contrast(103%);" src="<?php echo e(asset('../static/svg/building-skyscraper.svg')); ?>" width="20" height="20">
								</div>
								<div class="col">
									<div class="font-weight-medium">
										<?php echo e($activeProjectsCount); ?>

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
										<img style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(158deg) brightness(103%) contrast(103%);" src="<?php echo e(asset('../static/svg/clock-check.svg')); ?>" width="20" height="20">
								</div>
								<div class="col">
									<div class="font-weight-medium">
										<?php echo e($completedProjectsCount); ?>

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
										<img style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(158deg) brightness(103%) contrast(103%);" src="<?php echo e(asset('../static/svg/clock-off.svg')); ?>" width="20" height="20">
								</div>
								<div class="col">
									<div class="font-weight-medium">
										<?php echo e($closedProjectsCount); ?>

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
												<?php $__currentLoopData = $promissoryNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promissoryNote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>												
													<tr>
														<td>#<?php echo e($promissoryNote->promissoryNote_code); ?></td>
														<td><?php echo e($promissoryNote->promissoryNote_final_date); ?></td>
														<td>
															<a href="<?php echo e(route('investor.show', $promissoryNote->investor_id)); ?>"><?php echo e($promissoryNote->investor->investor_name); ?>

																<small>
																	<sup>
																		<img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
																	</sup>
																</small>
															</a>
														</td>
														<td>Lps. <?php echo e(number_format($promissoryNote->promissoryNote_amount,2)); ?></td>
													</tr>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
												<?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>												
													<tr>
														<td><?php echo e($transfer->transfer_date); ?></td>
														<td>
															<a href="<?php echo e(route('investor.show', $transfer->investor_id)); ?>"><?php echo e($transfer->investor->investor_name); ?>

																<small>
																	<sup>
																		<img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
																	</sup>
																</small>
															</a>
														</td>
														<td><?php echo e($transfer->transfer_bank); ?></td>
														<td class="text-green">Lps. <?php echo e(number_format($transfer->transfer_amount, 2)); ?></td>
													</tr>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
												<?php $__currentLoopData = $creditNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $creditNote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>												
													<tr>
														<td><?php echo e($creditNote->creditNote_date); ?></td>
														<td>
															<a
																href="<?php echo e(route('investor.show', $creditNote->investor_id)); ?>"><?php echo e($creditNote->investor->investor_name); ?>

																<small>
																	<sup>
																		<img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
																	</sup>
																</small>
															</a>
														</td>
														<td class="text-red">Lps. <?php echo e(number_format($creditNote->creditNote_amount, 2)); ?></td>
													</tr>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_history.js')); ?>"></script>

<!-- Libs JS -->
<script src="<?php echo e(asset('dist/libs/apexcharts/dist/apexcharts.min.js')); ?>" defer></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        <?php
            $paymentAmounts = $payments->pluck('payment_amount');
            $paymentDates = $payments->pluck('created_at');
            $projectNames = $payments->pluck('project_name');
            $projectInvestments = $payments->pluck('project_investment');
        ?>

        var paymentAmounts = <?php echo json_encode($paymentAmounts, 15, 512) ?>;
        var paymentDates = <?php echo json_encode($paymentDates, 15, 512) ?>;
        var projectNames = <?php echo json_encode($projectNames, 15, 512) ?>;
        var projectInvestments = <?php echo json_encode($projectInvestments, 15, 512) ?>;

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/En proceso/InvestorInsight/resources/views/modules/dashboard/index.blade.php ENDPATH**/ ?>