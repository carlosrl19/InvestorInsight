<div class="modal modal-blur fade" id="modal-promissoryCommissionerNotes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Historial de pagarés</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="card-body">
                            <table id="promissoryNotes" class="display table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>CÓDIGO</th>
                                        <th>FECHA EMISIÓN</th>
                                        <th>FECHA PAGO</th>
                                        <th>NOMBRE <br>COMISIONISTA</th>
                                        <th>MONTO <br>PAGARÉ</th>
                                        <th>ESTADO <br>PAGARÉ</th>
                                        <th>EXPORTAR <br>PAGARÉ</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php $__currentLoopData = $promissoryNoteCommissioners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promissoryCommissionerNote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="text-center">
                                            <td>#<?php echo e($promissoryCommissionerNote->promissoryNoteCommissioner_code); ?></td>
                                            <td><?php echo e($promissoryCommissionerNote->promissoryNoteCommissioner_emission_date); ?></td>
                                            <td><?php echo e($promissoryCommissionerNote->promissoryNoteCommissioner_final_date); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('commission_agent.show', $promissoryCommissionerNote->commissioner)); ?>"><?php echo e($promissoryCommissionerNote->commissioner->commissioner_name); ?>

                                                    <small>
                                                        <sup>
                                                            <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                                        </sup>
                                                    </small>
                                                </a>
                                            </td>
                                            <td>Lps. <?php echo e(number_format($promissoryCommissionerNote->promissoryNoteCommissioner_amount, 2)); ?></td>
                                            <td>
                                                <?php if($promissoryCommissionerNote->promissoryNoteCommissioner_status == '1'): ?>
                                                    <span class="badge bg-orange me-1"></span> Emitido / Sin pagar
                                                <?php elseif($promissoryCommissionerNote->promissoryNoteCommissioner_status == '0'): ?>
                                                    <span class="badge bg-success me-1"></span> Emitido / Pagado
                                                <?php else: ?>
                                                    <span class="badge bg-red me-1"></span> Estado inválido
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('promissory_note_commissioner.report', $promissoryCommissionerNote->id)); ?>" class="btn btn-sm btn-red"
                                                    data-toggle="modal" data-target="#pdfPromissoryCommissionerNote" style="padding-right: 20px; font-size: clamp(0.6rem, 3vw, 0.7rem)">
                                                    &nbsp;&nbsp;&nbsp;<img style="filter: invert(99%) sepia(43%) saturate(0%) hue-rotate(95deg) brightness(110%) contrast(101%);" src="<?php echo e(asset('../static/svg/file-text.svg')); ?>" width="20" height="20" alt="">
                                                    &nbsp;PAGARÉ
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <!-- Modal -->
                            <div class="modal fade modal-blur" id="pdfPromissoryCommissionerNote" data-backdrop="static" data-keyboard="false" tabindex="-1"
                                role="dialog" aria-labelledby="pdfPromissoryCommissionerNoteLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="pdfPromissoryCommissionerNoteLabel">Previsualización de pagaré</h5>
                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe id="pdf-promissory_commissioner_note" style="width:100%; height:500px;" src=""></iframe>
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
</div>

<style>
    .dataTables_filter{
        display: inline;
    }
</style>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_promissoryNotes.js')); ?>"></script>

<!-- PDF view -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $('#pdfPromissoryCommissionerNote').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var url = button.attr('href'); // Extraer la información de los atributos data-*
        var modal = $(this);
        modal.find('#pdf-promissory_commissioner_note').attr('src', url);
    });
    $('#pdfPromissoryCommissionerNote').on('hidden.bs.modal', function (e) {
        $(this).find('#pdf-promissory_commissioner_note').attr('src', '');
    });
</script>
<?php /**PATH /home/carlos/Code/En proceso/InvestorInsight/resources/views/modules/promissory_note_commissioner/_index.blade.php ENDPATH**/ ?>