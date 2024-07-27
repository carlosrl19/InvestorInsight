<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte</title>
</head>
<body>
    <table>
        <thead>
            <tr class="text-center">
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- Header text -->
            <tr style="border: 1px solid #000">
                <td></td>
                <td style="font-size: 16px; width: 100px; font-weight: bold; background-color: #fff; text-align: center; text-decoration: underline;">
                    PROYECTOS INGRESADOS ESTE MES
                </td>
                <td style="background-color: #fff; width: auto;"></td>
                <td style="background-color: #fff; width: 397px;"></td>
                <td style="background-color: #fff; width: 160px;"></td>
                <td style="background-color: #fff; width: 200px;"></td>
                <td style="background-color: #fff; width: 200px;"></td>
                <td style="background-color: #fff; width: 200px;"></td>
            </tr>
            
            <!-- Blank rows -->
            <tr>
                <td></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
            </tr>
            <!-- Header table -->
            <tr>
                <td></td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 140px">FECHA</td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 140px">CODIGO</td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; min-width: 397px;">NOMBRE PROYECTO</td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center;">INVERSION</td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">FECHA INICIO</td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">FECHA FINAL</td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">DIAS TRABAJO</td>
            </tr>
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td style="text-align: center;"><?php echo e($project->created_at); ?></td>
                <td style="text-align: center;"><?php echo e($project->project_code); ?></td>
                <td style="text-align: center;"><?php echo e($project->project_name); ?></td>
                <td style="text-align: center;"><?php echo e(number_format($project->project_investment,2)); ?></td>
                <td style="text-align: center;"><?php echo e($project->project_start_date); ?></td>
                <td style="text-align: center;"><?php echo e($project->project_end_date); ?></td>
                <td style="text-align: center;"><?php echo e($project->project_work_days); ?> días</td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <table>
        <thead>
            <tr class="text-center">
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- Header text -->
            <tr style="border: 1px solid #000">
                <td></td>
                <td style="font-size: 16px; width: 100px; font-weight: bold; background-color: #fff; text-align: center; text-decoration: underline;">
                    TRANSFERENCIAS DEL MES
                </td>
                <td style="background-color: #fff; width: auto;"></td>
                <td style="background-color: #fff; width: 100px;"></td>
                <td style="background-color: #fff; width: 160px;"></td>
                <td style="background-color: #fff; width: 200px;"></td>
                <td style="background-color: #fff; width: 200px;"></td>
                <td style="background-color: #fff; width: 200px;"></td>
            </tr>
            <!-- Blank rows 1 -->
            <tr>
                <td></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
            </tr>
            <!-- Blank rows 2 -->
            <tr>
                <td></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
            </tr>
            <!-- Header table -->
            <tr>
                <td></td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 140px">FECHA</td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">BANCO</td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 140px">MONTO</td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center;">MOTIVO / COMENTARIO DEL MOVIMIENTO</td>
                <td style="border: 1px solid #000; background-color: #cce0f8"></td>
                <td style="border: 1px solid #cce0f8"></td>
            </tr>
            <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td style="text-align: center;"><?php echo e($transfer->transfer_date); ?></td>
                <?php if($transfer->transfer_bank != 'VARIOS MÉTODOS/TRANSFERENCIAS'): ?>
                    <td style="text-align: center;"><?php echo e($transfer->transfer_bank); ?></td>
                <?php else: ?>
                    <td style="text-align: center;">VARIOS</td>
                <?php endif; ?>
                <td style="text-align: center;"><?php echo e($transfer->transfer_amount); ?></td>
                <td style="text-align: center;"><?php echo e($transfer->transfer_comment); ?></td>
                <td></td>
                <td></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center;"><?php echo e($totalTransferAmount); ?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr class="text-center">
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- Header text -->
            <tr style="border: 1px solid #000">
                <td></td>
                <td style="font-size: 16px; width: 100px; font-weight: bold; background-color: #fff; text-align: center; text-decoration: underline;">
                    PAGARÉS DE PROYECTOS DEL MES
                </td>
                <td style="background-color: #fff; width: auto;"></td>
                <td style="background-color: #fff; width: 397px;"></td>
                <td style="background-color: #fff; width: 160px;"></td>
                <td style="background-color: #fff; width: 200px;"></td>
                <td style="background-color: #fff; width: 200px;"></td>
                <td style="background-color: #fff; width: 200px;"></td>
            </tr>
            <!-- Blank rows 1 -->
            <tr>
                <td></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
            </tr>
            <!-- Blank rows 2 -->
            <tr>
                <td></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
            </tr>
            <!-- Header table -->
            <tr>
                <td></td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 140px">FECHA EMISIÓN</td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 140px">FECHA LIMITE PAGO</td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 397px;">INVERSIONISTA</td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 140px">MONTO</td>
                <td style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center;">MOTIVO / COMENTARIO DEL MOVIMIENTO</td>
                <td style="border: 1px solid #000; background-color: #cce0f8"></td>
                <td style="border: 1px solid #cce0f8"></td>
            </tr>
            <?php $__currentLoopData = $promissory_notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promissoryNote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td style="text-align: center;"><?php echo e($promissoryNote->promissoryNote_emission_date); ?></td>
                <td style="text-align: center;"><?php echo e($promissoryNote->promissoryNote_final_date); ?></td>
                <td style="text-align: center;"><?php echo e($promissoryNote->investor->investor_name); ?></td>
                <td style="text-align: center;"><?php echo e($promissoryNote->promissoryNote_amount); ?></td>
                <td style="text-align: center;"><?php echo e($promissoryNote->promissoryNote_comment); ?></td>
                <td></td>
                <td></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center;"><?php echo e($totalTransferAmount); ?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH /home/carlos/Code/InvestorInsight/resources/views/modules/dashboard/_general_report.blade.php ENDPATH**/ ?>