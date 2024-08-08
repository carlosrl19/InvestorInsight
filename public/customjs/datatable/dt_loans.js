// Loans init
(function($) {
    "use strict"

    var table = $('#loans').DataTable({
        dom: 'lBfrtip',
        language: {
            paginate: {
                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                previous:
                    '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
            },

            // Personaliza el mensaje de búsqueda
            search: "Buscar",
            searchPlaceholder: "Buscar préstamo ...",

            // Personaliza el mensaje de cantidad de filas mostradas
            lengthMenu: "Mostrando _MENU_ registros por página",
            infoFiltered: "- Filtrado de _MAX_ registros.",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            sInfoEmpty: "Sin registros para mostrar",
            emptyTable: "No se encontraron registros de préstamos para mostrar.",
            zeroRecords:
                "No se encontraron registros que coincidan con la búsqueda.",
        },
        responsive: true,
        paginate: false,
        info: false,
        searching: false,
        lengthChange: false,
        aLengthMenu: [
            [10, 20, 50],
            [10, 20, 50]
        ],
    });
})(jQuery);