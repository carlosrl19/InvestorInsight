(function ($) {
    "use strict";

    var table = $("#exampleProviderFunds").DataTable({
        dom: "lBfrtip",
        language: {
            paginate: {
                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                previous:
                    '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
            },

            // Personaliza el mensaje de búsqueda
            search: "Buscar",
            searchPlaceholder: "Ingresa tu búsqueda...",

            // Personaliza el mensaje de cantidad de filas mostradas
            lengthMenu: "Mostrando _MENU_ registros por página",
            infoFiltered: "- Filtrado de _MAX_ registros.",
            sInfoEmpty: "Sin registros para mostrar",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            emptyTable:
                "No se encontraron registros de cambios en fondos para mostrar.",
            zeroRecords:
                "No se encontraron registros que coincidan con la búsqueda.",
        },
        responsive: true,
        paginate: true,
        info: true,
        searching: false,
        lengthChange: true,
        aLengthMenu: [
            [5, 10, 20],
            [5, 10, 20],
        ],
    });
})(jQuery);
