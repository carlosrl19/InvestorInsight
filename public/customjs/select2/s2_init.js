// Investors select2 init
$(document).ready(function() {
  $(".select2-investors").select2({
    dropdownParent: $("#modal-team"),
    placeholder: "Seleccione un inversionista",
    allowClear: true,
    language: "es",
  });
});

// Commission agents select2 init
$(document).ready(function() {
  $(".select2-commissioners").select2({
    dropdownParent: $("#modal-team"),
    placeholder: "Seleccione los comisionistas",
    allowClear: true,
    language: "es",
  });
});

// Prommissory notes select2 init
$(document).ready(function() {
  $(".select2-promissoryNotes").select2({
    dropdownParent: $("#modal-team"),
    placeholder: "Seleccione el pagaré a pagar",
    allowClear: true,
    language: "es",
  });
});