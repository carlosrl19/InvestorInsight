<!-- Excel template used to export all active projects to an investors -->

<?php
// Array de colores
$colors = array(
    // Rojo
    "#FF6B6B", "#E74C3C", "#FF4500", "#B22222",

    // Morado claro:
    "#FF00FF",
    
    // Naranja:
    "#FFA500", "#F1C40F", "#FF7F50", "#F39C12", "#D2691E", "#FFD700", "#D35400", "#E67E22", "#FF8C00",
    
    // Morado:
    "#9B59B6", "#8E44AD", "#9932CC", "#BA55D3", "#9400D3", "#4B0082",
    
    // Verde:
    "#1ABC9C", "#16A085", "#2ECC71", "#27AE60", "#00FA9A", "#00FF7F", "#228B22", "#7CFC00",
    
    // Azul:
    "#2980B9", "#3498DB", "#1E90FF", "#00BFFF", "#87CEEB", "#4682B4", "#10439F", "#6A5ACD", "#614BC3",
    
    // Azul claro:
    "#ABCDEF",
    
    // Rosado:
    "#A25772", "#C71585", "#FF1493", "#FF69B4",

    // Verde limón:
    "#32CD32", "#7FFF00", "#ADFF2F",
);

// Mezclar los colores para asegurarse de que sean aleatorios
shuffle($colors);

// Asegurarse de que cada proyecto tenga un color distinto
$projectColors = [];
foreach ($projects as $index => $project) {
    $colorAssigned = false;
    while (!$colorAssigned) {
        $colorIndex = $index % count($colors);
        $color = $colors[$colorIndex];
        if (!array_key_exists($project->id, $projectColors) || !in_array($color, array_values($projectColors))) {
            $projectColors[$project->id] = $color;
            $colorAssigned = true;
        }
    }
}
?>

<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $color = $projectColors[$project->id]; ?>
    <table>
        <thead>
            <tr>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr class="header-row">
                <td></td>
                <?php $__currentLoopData = $project->investors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td style="font-size: 14px; width: 100px; font-weight: bold; background-color: #fff; text-align: left; text-decoration: underline;">
                        PROYECTO <?php echo e(explode(' ', $investor->investor_name)[0]); ?>

                        <?php if(count(explode(' ', $investor->investor_name)) > 1): ?>
                            <?php echo e(implode(' ', array_slice(explode(' ', $investor->investor_name), 1))); ?>

                        <?php endif; ?>
                    </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <td style="background-color: #fff; width: auto;"></td>
                <td style="background-color: #fff; width: 100px;"></td>
                <td style="font-size: 12px; font-weight: bold; background-color: #FFF455; width: 160px; text-align: center; text-decoration: underline;">
                    <?php if($project->project_status == 0): ?>
                        FINALIZADO
                    <?php elseif($project->project_status == 1): ?>
                        TRABAJANDO
                    <?php elseif($project->project_status == 2): ?>
                        CERRADO
                    <?php else: ?>
                        DESCONOCIDO
                    <?php endif; ?>
                </td>
                <td style="background-color: #fff; width: 160px;"></td>
                <td style="background-color: #fff; width: 160px;"></td>
                <?php if(isset($project->commissioners[1])): ?>
                    <td style="background-color: #fff; width: 160px;"></td>
                    <td style="background-color: #fff; text-align: center; font-weight: bold;">
                        #CP-<?php echo e($project->project_code); ?>

                    </td>
                <?php else: ?>
                    <td style="background-color: #fff; text-align: center; font-weight: bold;">
                        #CP-<?php echo e($project->project_code); ?>

                    </td>
                    <td></td>
                <?php endif; ?>
            </tr>

            <!-- Blank rows 1 -->
            <tr class="blank-row">
                <td></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <?php if(isset($project->commissioners[1])): ?>
                    <td style="background-color: #fff; width: 120px;"></td>
                    <td style="background-color: #fff;"></td>
                <?php else: ?>
                    <td style="background-color: #fff"></td>
                    <td></td>
                <?php endif; ?>
            </tr>

            <!-- Blank rows 2 -->
            <tr class="blank-row">
                <td></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff"></td>
                <td style="background-color: #fff; width: 120px;"></td>
                <?php if(isset($project->commissioners[1])): ?>
                    <td style="background-color: #fff; width: 120px;"></td>
                    <td style="background-color: #fff;"></td>
                <?php else: ?>
                    <td style="background-color: #fff"></td>
                    <td></td>
                <?php endif; ?>
            </tr>

            <!-- Header table -->
            <tr>
                <td></td>
                <td style="background-color: <?php echo htmlspecialchars($color); ?>; width: 150px"></td>
                <td></td>
                <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center; width: 90px">CAPITAL</td>
                <td style="background-color: #fff; font-size: 11px; font-weight: bold; width: 120px; text-align: center;">GANANCIA TOTAL</td>
                
                <!-- Inversionistas  -->
                <?php if(isset($project->investors[1])): ?>
                    <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                        <?php echo e(implode(' ', array_slice(explode(' ', $investor[0]->investor_name ?? '-'), 0, 1))); ?> 5%
                    </td>
                    <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                        <?php echo e(implode(' ', array_slice(explode(' ', $investor[0]->investor_name), 0, 1))); ?> 45%
                    </td>
                <?php else: ?>
                    <td style="background-color: #fff; font-size: 11px; font-weight: bold; width: 150px; text-align: center;">
                        <?php echo e(implode(' ', array_slice(explode(' ', $investor->investor_name), 0, 1))); ?> 50% - asldkmalsd
                    </td>
                <?php endif; ?>

                <!-- Comisionistas  -->
                <?php if(isset($project->commissioners[1])): ?>
                    <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                        <?php echo e(implode(' ', array_slice(explode(' ', $commissioners->get(1)->commissioner_name ?? '-'), 0, 1))); ?> 10%
                    </td>
                    <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                        <?php echo e(implode(' ', array_slice(explode(' ', $commissioners[0]->commissioner_name), 0, 1))); ?> 40%
                    </td>
                <?php else: ?>
                    <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                        <?php echo e(implode(' ', array_slice(explode(' ', $commissioners[0]->commissioner_name), 0, 1))); ?> 50%
                    </td>
                <?php endif; ?>
                <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">COMENTARIO</td>
            </tr>

            <!-- Content table -->
            <tr>
                <td></td>
                <td style="background-color: <?php echo htmlspecialchars($hexColor) ?>; width: 90px"></td>
                <td style="background-color: #fff; font-size: 12px; font-weight: bold; text-align: left; width: 140px; border-bottom: 1px solid #000;"><?php echo e($project->project_name); ?></td>
                <td style="text-align: center; font-weight: bold; border-bottom: 1px solid #000; width: 90px">L. <?php echo e(number_format($project->investors->max('pivot.investor_investment'), 2)); ?></td>
                <td style="text-align: center; font-weight: bold; border-bottom: 1px solid #000;">L. <?php echo e(number_format($project->investors->max('pivot.investor_profit'), 2)); ?></td>
                <?php if(isset($project->investors[1])): ?>
                    <td style="text-align: center; border-bottom: 1px solid #000; width: 120px; font-weight: bold;">
                        L. <?php echo e(number_format($project->investors[1]->pivot->investor_profit, 2)); ?>

                    </td>
                <?php endif; ?>
                <td style="text-align: center; font-weight: bold; border-bottom: 1px solid #000; width: 100px; text-decoration: underline; font-weight: bold;">L. <?php echo e(number_format($project->investors->max('pivot.investor_final_profit'), 2)); ?></td>
                <?php if(isset($project->commissioners[1])): ?>
                    <td style="text-align: center; border-bottom: 1px solid #000; width: 120px; font-weight: bold;">
                        L. <?php echo e(number_format($project->commissioners[1]->pivot->commissioner_commission, 2)); ?>

                    </td>
                <?php endif; ?>
                <td style="text-align: center; font-weight: bold; border-bottom: 1px solid #000; width: 120px">L. <?php echo e(number_format($project->commissioners[0]->pivot->commissioner_commission, 2)); ?></td>
                <td style="color: #1F4E82; text-decoration: underline; text-align: left; border-bottom: 1px solid #000;"><?php echo e($project->project_comment); ?></td>
            </tr>
        </tbody>
    </table>
    <br>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home/carlos/Code/En proceso/InvestorInsight/resources/views/modules/projects/_report_active_investor_project_excel.blade.php ENDPATH**/ ?>