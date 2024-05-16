$(document).ready(function() {
  $(".js-example-basic-multiple").select2({
    dropdownParent: $("#modal-team"),
    placeholder: "Seleccione un inversionista",
    allowClear: true,
    language: "es",
  });
});