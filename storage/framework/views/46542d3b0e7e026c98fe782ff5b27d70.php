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
                PAGARES ACTUALES A FAVOR DE INVERSIONISTAS
            </td>
            <td style="background-color: #fff; width: auto;"></td>
            <td style="background-color: #fff; width: 347px;"></td>
            <td style="background-color: #fff; width: 160px;"></td>
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
      
        <!-- Header table -->
        <tr>
            <td></td>
            <td
                style="border: 1px solid #000; background-color: #F77B72; font-size: 11px; font-weight: bold; text-align: center; width: 160px">
                CODIGO</td>
            <td
                style="border: 1px solid #000; background-color: #F77B72; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                FECHA EMISIÓN</td>
            <td
                style="border: 1px solid #000; background-color: #F77B72; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                FECHA LIMITE PAGO</td>
            <td
                style="border: 1px solid #000; background-color: #F77B72; font-size: 11px; font-weight: bold; text-align: center; width: 347px;">
                INVERSIONISTA</td>
            <td
                style="border: 1px solid #000; background-color: #F77B72; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                MONTO</td>
        </tr>
        <?php $__currentLoopData = $promissory_notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promissoryNote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td style="border: 1px solid #000; text-align: center;"><?php echo e($promissoryNote->promissoryNote_code); ?></td>
                <td style="border: 1px solid #000; text-align: center;"><?php echo e($promissoryNote->promissoryNote_emission_date); ?></td>
                <td style="border: 1px solid #000; text-align: center;"><?php echo e($promissoryNote->promissoryNote_final_date); ?></td>
                <td style="border: 1px solid #000; text-align: center;"><?php echo e($promissoryNote->investor->investor_name); ?></td>
                <td style="border: 1px solid #000; text-align: center; background-color: #FCD7D4">L. <?php echo e(number_format($promissoryNote->promissoryNote_amount,2)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="border-top: 1px solid #000; background-color: #F77B72; text-align: center; font-weight: bold;">L. <?php echo e(number_format($totalPromissoriesAmount,2)); ?></td>
            </tr>
    </tbody>
</table>

<!-- Prommissory notes to commissioners -->
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
                PAGARES ACTUALES A FAVOR DE COMISIONISTAS
            </td>
            <td style="background-color: #fff; width: auto;"></td>
            <td style="background-color: #fff; width: 347px;"></td>
            <td style="background-color: #fff; width: 160px;"></td>
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
      
        <!-- Header table -->
        <tr>
            <td></td>
            <td
                style="border: 1px solid #000; background-color: #F77B72; font-size: 11px; font-weight: bold; text-align: center; width: 160px">
                CODIGO</td>
            <td
                style="border: 1px solid #000; background-color: #F77B72; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                FECHA EMISIÓN</td>
            <td
                style="border: 1px solid #000; background-color: #F77B72; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                FECHA LIMITE PAGO</td>
            <td
                style="border: 1px solid #000; background-color: #F77B72; font-size: 11px; font-weight: bold; text-align: center; width: 347px;">
                INVERSIONISTA</td>
            <td
                style="border: 1px solid #000; background-color: #F77B72; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                MONTO</td>
        </tr>
        <?php $__currentLoopData = $promissory_notes_commissioners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promissory_note_commissioner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td style="border: 1px solid #000; text-align: center;"><?php echo e($promissory_note_commissioner->promissoryNoteCommissioner_code); ?></td>
                <td style="border: 1px solid #000; text-align: center;"><?php echo e($promissory_note_commissioner->promissoryNoteCommissioner_emission_date); ?></td>
                <td style="border: 1px solid #000; text-align: center;"><?php echo e($promissory_note_commissioner->promissoryNoteCommissioner_final_date); ?></td>
                <td style="border: 1px solid #000; text-align: center;"><?php echo e($promissory_note_commissioner->commissioner->commissioner_name); ?></td>
                <td style="border: 1px solid #000; text-align: center; background-color: #FCD7D4">L. <?php echo e(number_format($promissory_note_commissioner->promissoryNoteCommissioner_amount,2)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="border-top: 1px solid #000; background-color: #F77B72; text-align: center; font-weight: bold;">L. <?php echo e(number_format($totalPromissoriesCommissionerAmount,2)); ?></td>
            </tr>
    </tbody>
</table><?php /**PATH /home/carlos/Code/InvestorInsight (Copiar)/resources/views/modules/dashboard/_promissory_notes_report.blade.php ENDPATH**/ ?>