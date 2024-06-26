// Investors select2 init
$(document).ready(function() {
  $(".select2-investors").select2({
    dropdownParent: $("#modal-team"),
    placeholder: "Seleccione un inversionista",
    allowClear: true,
    language: "es",
  });
});

$('.select2-investors').select2().on('select2:open', function(e){
  $('.select2-search__field').attr('placeholder', 'BUSCAR INVERSIONISTA ...');
})

// Investors select2 init -> Project index (excel export)
$(document).ready(function() {
  $(".select2-active-project-investors").select2({
    dropdownParent: $("#investorsModal"),
    placeholder: "Seleccione un inversionista",
    allowClear: true,
    language: "es",
  });
});

$('.select2-active-project-investor').select2().on('select2:open', function(e){
  $('.select2-search__field').attr('placeholder', 'BUSCAR INVERSIONISTA ...');
})

// Commission agents select2 init
$(document).ready(function() {
  $(".select2-commissioners").select2({
    dropdownParent: $("#modal-team"),
    placeholder: "Seleccione los comisionistas",
    allowClear: true,
    language: "es",
  });
});

$('.select2-commissioners').select2().on('select2:open', function(e){
  $('.select2-search__field').attr('placeholder', 'BUSCAR COMISIONISTA ...');
})

// Prommissory notes select2 init
$(document).ready(function() {
  $(".select2-promissoryNotes").select2({
    dropdownParent: $("#modal-payment"),
    allowClear: true,
    language: "es",
  });
});

$('.select2-promissoryNotes').select2().on('select2:open', function(e){
  $('.select2-search__field').attr('placeholder', 'BUSCAR PAGARÉ ...');
})

// Transfer bank select2 init
$(document).ready(function() {
  $(".select2-transferBank").select2({
    dropdownParent: $("#modal-team"),
    allowClear: true,
    language: "es",
  });
});

$('.select2-transferBank').select2().on('select2:open', function(e){
  $('.select2-search__field').attr('placeholder', 'BUSCAR AGENTE FINANCIERO...');
})