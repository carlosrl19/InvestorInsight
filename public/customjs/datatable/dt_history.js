(function($) {
    "use strict"

    var table = $('#example1').DataTable({
        dom: 'lBfrtip',
        language: {
            paginate: {
                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                previous:
                    '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
            },

            // Personaliza el mensaje de búsqueda
            search: "Buscar",
            searchPlaceholder: "Buscar transferencias ...",

            // Personaliza el mensaje de cantidad de filas mostradas
            lengthMenu: "Mostrando _MENU_ registros por página",
            infoFiltered: "- Filtrado de _MAX_ registros.",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            sInfoEmpty: "Sin registros para mostrar",
            emptyTable: "No se encontraron registros de transferencias para mostrar.",
            zeroRecords:
                "No se encontraron registros que coincidan con la búsqueda.",
        },
        responsive: true,
        paginate: false,
        info: true,
        searching: true,
        lengthChange: false,
        aLengthMenu: [
            [10, 20, 50],
            [10, 20, 50]
        ],
    });
})(jQuery);

(function($) {
    "use strict"

    var table = $('#example2').DataTable({
        dom: 'lBfrtip',
        language: {
            paginate: {
                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                previous:
                    '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
            },

            // Personaliza el mensaje de búsqueda
            search: "Buscar",
            searchPlaceholder: "Buscar nota crédito ...",

            // Personaliza el mensaje de cantidad de filas mostradas
            lengthMenu: "Mostrando _MENU_ registros por página",
            infoFiltered: "- Filtrado de _MAX_ registros.",
            sInfoEmpty: "Sin registros para mostrar",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            emptyTable: "No se encontraron registros de notas crédito para mostrar.",
            zeroRecords:
                "No se encontraron registros que coincidan con la búsqueda.",
        },
        responsive: true,
        paginate: false,
        info: true,
        searching: true,
        lengthChange: false,
        aLengthMenu: [
            [10, 20, 50],
            [10, 20, 50]
        ],
    });
})(jQuery);