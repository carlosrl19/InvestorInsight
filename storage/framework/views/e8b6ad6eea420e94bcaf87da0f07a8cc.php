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
                COMISIONES A FAVOR DE INVERSIONISTAS
            </td>
            <td></td> <!-- Merge con td anterior -->
            <td style="background-color: #fff; width: 347px;"></td>
            <td></td> <!-- Merge con td anterior -->
            <td style="background-color: #fff; width: 120px;"></td>
            <td style="width: 120px;"></td>
        </tr>

        <!-- Blank rows -->
        <tr>
            <td></td>
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
                style="border: 1px solid #000; background-color: #FFD966; font-size: 12px; font-weight: bold; text-align: center; width: 290px;">
                PROYECTO</td>
            <td></td> <!-- Merge con td anterior -->
            <td
                style="border: 1px solid #000; background-color: #FFD966; font-size: 12px; font-weight: bold; text-align: center; width: 290px">
                NOMBRE INVERSIONISTA</td>
            <td></td>
            <td
                style="border: 1px solid #000; background-color: #FFD966; font-size: 12px; font-weight: bold; text-align: center; min-width: 120px;">
                INVERSION</td>
            <td
                style="border: 1px solid #000; background-color: #FFD966; font-size: 12px; font-weight: bold; text-align: center; min-width: 120px;">
                COMISION</td>
        </tr>
        <?php $__currentLoopData = $investorCommissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investorCommission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <?php if($investorCommission->investor_investment == 0): ?>
                    <td style="border: 1px solid #000; text-align: center;"><?php echo e($investorCommission->project_name); ?>&nbsp;<b>(5%)</b></td>    
                <?php else: ?>
                    <td style="border: 1px solid #000; text-align: center;"><?php echo e($investorCommission->project_name); ?></td>
                <?php endif; ?>
                <td></td> <!-- Merge con td anterior -->
                <td style="border: 1px solid #000; text-align: center;"><?php echo e($investorCommission->investor_name); ?></td>
                <td></td> <!-- Merge con td anterior -->
                <td style="border: 1px solid #000; text-align: center; background-color: #FFF3D1;">L. <?php echo e(number_format($investorCommission->investor_investment, 2)); ?></td>
                <td style="border: 1px solid #000; text-align: center; background-color: #FFF3D1;">L. <?php echo e(number_format($investorCommission->investor_final_profit, 2)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="background-color: #FFD966; font-weight: bold; border: 1px solid #000; text-align: center;">L. <?php echo e(number_format($totalInvestorInvestment, 2)); ?></td>
                <td style="background-color: #FFD966; font-weight: bold; border: 1px solid #000; text-align: center;">L. <?php echo e(number_format($totalInvestorCommissions, 2)); ?></td>
            </tr>
    </tbody>
</table>

<!-- Tabla a comisionistas -->
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
                COMISIONES A FAVOR DE COMISIONISTAS
            </td>
            <td></td> <!-- Merge con td anterior -->
            <td style="background-color: #fff; width: 347px;"></td>
            <td></td> <!-- Merge con td anterior -->
            <td style="background-color: #fff; width: 120px;"></td>
            <td style="width: 120px;"></td>
        </tr>

        <!-- Blank rows -->
        <tr>
            <td></td>
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
                style="border: 1px solid #000; background-color: #E06666; font-size: 12px; font-weight: bold; text-align: center; width: 290px;">
                PROYECTO</td>
            <td></td> <!-- Merge con td anterior -->
            <td
                style="border: 1px solid #000; background-color: #E06666; font-size: 12px; font-weight: bold; text-align: center; width: 290px">
                NOMBRE COMISIONISTA</td>
            <td></td>
            <td
                style="border: 1px solid #000; background-color: #E06666; font-size: 12px; font-weight: bold; text-align: center; min-width: 120px;">
                COMISION</td>
        </tr>
        <?php $__currentLoopData = $commissionerCommissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commissionerCommission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td style="border: 1px solid #000; text-align: center;"><?php echo e($commissionerCommission->project_name); ?></td>    
                <td></td> <!-- Merge con td anterior -->
                <td style="border: 1px solid #000; text-align: center;"><?php echo e($commissionerCommission->commissioner_name); ?></td>
                <td></td> <!-- Merge con td anterior -->
                <td style="border: 1px solid #000; text-align: center; background-color: #F8E0E0">L. <?php echo e(number_format($commissionerCommission->commissioner_commission, 2)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="background-color: #E06666; font-weight: bold; border: 1px solid #000; text-align: center;">L. <?php echo e(number_format($totalCommissionerCommissions, 2)); ?></td>
            </tr>
    </tbody>
</table><?php /**PATH /home/carlos/Code/InvestorInsight (Copiar)/resources/views/modules/dashboard/_commissions_report.blade.php ENDPATH**/ ?>