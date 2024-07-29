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
            <td
                style="font-size: 16px; width: 100px; font-weight: bold; background-color: #fff; text-align: center; text-decoration: underline;">
                TRANSFERENCIAS DEL MES
            </td>
            <td style="background-color: #fff; width: auto;"></td>
            <td style="background-color: #fff; width: 100px;"></td>
            <td style="background-color: #fff; width: 160px;"></td>
            <td style="background-color: #fff; width: 120px;"></td>
            <td style="background-color: #fff; width: 120px;"></td>
            <td style="background-color: #fff; width: 120px;"></td>
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
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                FECHA</td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                BANCO</td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                INVERSIONISTA</td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                MONTO</td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center;">
                MOTIVO / COMENTARIO DEL MOVIMIENTO</td>
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
                <td style="text-align: center;"><?php echo e($transfer->investor->investor_name); ?></td>
                <td style="text-align: center;"><?php echo e(number_format($transfer->transfer_amount, 2)); ?></td>
                <td style="text-align: center;"><?php echo e($transfer->transfer_comment); ?></td>
                <td></td>
                <td></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center;">
                <?php echo e($totalTransferAmount); ?></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table><?php /**PATH /home/carlos/Code/InvestorInsight/resources/views/modules/dashboard/_transfers_report.blade.php ENDPATH**/ ?>