(function($) {
    "use strict"

    var table = $('#example').DataTable({
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                className: 'btn btn-success dt-buttons btnExcel',
                exportOptions: {
                    modifier: {
                        search: 'applied',
                    },
                    columns: [0, 1, 2, 3, 4, 5, 6]
                },
                text: 'Exportar información a Excel',
            },
            {
                extend: 'pdfHtml5',
                className: 'btn btn-danger dt-buttons btnPDF',
                exportOptions: {
                    modifier: {
                        search: 'applied',
                    },
                    columns: [0, 1]
                },
                text: 'Exportar información a PDF',
            },
        ],
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
            emptyTable: "No se encontraron registros de inversionistas para mostrar.",
            zeroRecords:
                "No se encontraron registros que coincidan con la búsqueda.",
        },
        responsive: true,
        paginate: true,
        info: true,
        searching: false,
        lengthChange: true,
        aLengthMenu: [
            [10, 20, 50],
            [10, 20, 50]
        ],
    });
})(jQuery);