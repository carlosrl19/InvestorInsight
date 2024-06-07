(function($) {
    "use strict"

    var table = $('#example').DataTable({
        dom: 'lBfrtip',
        initComplete: function () {
            var api = this.api();

            // Crea los filtros de búsqueda en el elemento #search-filters
            api.columns()
                .eq(0)
                .each(function (colIdx) {
                    // Verifica si la columna actual no es la última
                    if (colIdx < api.columns().eq(0).length - 2) {
                        var column = api.column(colIdx);
                        var title = $(column.header()).text();

                        var $input = $(
                            '<input type="text" data-kt-filter="search" id="search-filters" style="width: 100%;" placeholder="' +
                                title +
                                '" />'
                        );

                        $input
                            .appendTo($("#search-filters-container"))
                            .on("keyup change", function () {
                                column.search(this.value).draw();
                            });
                    }
                });

            // Agrega el botón para limpiar los campos de búsqueda
            $(
                '<button type="button" class="btn btn-sm btn-secondary" id="clear-search">Limpiar búsqueda</button>'
            )
                .appendTo($("#search-filters-container"))
                .on("click", function () {
                    // Limpia los campos de búsqueda
                    $("#search-filters-container input").val("");
                    // Resetear los filtros de búsqueda
                    table.columns().search("").draw();
                });
        },
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
            emptyTable: "No se encontraron registros de proyectos para mostrar.",
            zeroRecords:
                "No se encontraron registros que coincidan con la búsqueda.",
        },
        responsive: true,
        paginate: true,
        info: true,
        searching: true,
        lengthChange: true,
        aLengthMenu: [
            [10, 20, 50],
            [10, 20, 50]
        ],
    });
})(jQuery);