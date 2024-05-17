(function($) {
    "use strict"

    var table = $('#example').DataTable({
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];

                    // Suma de la columna F (Total de cuota sindical)
                    var totalCuotaSindical = 0;
                    table.column(5, { search: 'applied' }).data().each(function(value) {
                        totalCuotaSindical += parseFloat(value);
                    });

                    // Suma de la columna G (Total de plan mortuorio)
                    var totalPlanMortuorio = 0;
                    table.column(6, { search: 'applied' }).data().each(function(value) {
                        totalPlanMortuorio += parseFloat(value);
                    });

                    // Formatear el total de la cuota sindical y plan mortuorio con comas
                    var formattedTotalCuotaSindical = totalCuotaSindical.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    var formattedTotalPlanMortuorio = totalPlanMortuorio.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    // Agregar los totales debajo de las columnas correspondientes
                    var sheetData = sheet.getElementsByTagName('sheetData')[0];

                    var rowLastIndex = sheetData.getElementsByTagName('row').length - 1;

                    // Total de cuota sindical
                    var cuotaSindicalRow = sheet.createElement('row');
                    var cuotaSindicalCell = sheet.createElement('c');
                    cuotaSindicalCell.setAttribute('r', 'F' + (rowLastIndex + 2));
                    var cuotaSindicalValue = sheet.createElement('v');
                    cuotaSindicalValue.appendChild(sheet.createCDATASection('Total  Lps ' +formattedTotalCuotaSindical));
                    cuotaSindicalCell.appendChild(cuotaSindicalValue);
                    cuotaSindicalRow.appendChild(cuotaSindicalCell);
                    sheetData.appendChild(cuotaSindicalRow);

                    // Total de plan mortuorio
                    var planMortuorioRow = sheet.createElement('row');
                    var planMortuorioCell = sheet.createElement('c');
                    planMortuorioCell.setAttribute('r', 'G' + (rowLastIndex + 2));
                    var planMortuorioValue = sheet.createElement('v');
                    planMortuorioValue.appendChild(sheet.createCDATASection('Total  Lps ' +formattedTotalPlanMortuorio));
                    planMortuorioCell.appendChild(planMortuorioValue);
                    planMortuorioRow.appendChild(planMortuorioCell);
                    sheetData.appendChild(planMortuorioRow);

                    // Aplicar estilos
                    $(sheet).find("row:nth-child(n+3) c[r^='F'], row:nth-child(n+3) c[r^='G']").each(function() {
                        $(this).attr("s", "40");
                    });
                    
                    // Aplicar estilos a la fila 2 para todas las columnas
                    $(sheet).find("row:nth-child(2) c").each(function() {
                        $(this).attr("s", "47");
                    });

                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="A1"]', sheet).each( function () {
                        if ( $('is t', this).text() == 'SIDEYMS' ) {
                            $('is t', this).text( 'Listado de empleados - SIDEYTMS' );
                        } else {
                            $('is t', this).text( 'Listado de empleados - SIDEYTMS' );
                        }
                    });
                },
                className: 'btn btn-success dt-buttons btnExcel',
                filename: function() {
                    var date = new Date();
                    var day = date.getDate();
                    var monthNames = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
                    var month = monthNames[date.getMonth()];
                    var year = date.getFullYear();
                    return 'Listado de empleados - ' + day + ' de ' + month + ' de ' + year;
                },
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
                filename: function() {
                    var date = new Date();
                    var day = date.getDate();
                    var monthNames = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
                    var month = monthNames[date.getMonth()];
                    var year = date.getFullYear();
                    return 'Listado de empleados - ' + day + ' de ' + month + ' de ' + year;
                },
                // Change texto from 'SIDEYTMS' to 'Listado de empleados - SIDEYTMS'
                customize: function (doc) {
                    doc.content.splice(0, 1, {
                        text: 'Listado de empleados - SIDEYTMS',
                        fontSize: 12,
                        alignment: 'center',
                        margin: [0, 0, 0, 12]
                    });
                    // Get all page width
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');

                    // Center table registers
                    doc.content[1].table.body.forEach(function(row) {
                        row.forEach(function(cell) {
                            cell.alignment = 'center';
                        });
                    });
                },
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
            emptyTable: "No se encontraron registros de transferencias para mostrar.",
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

    // Script to show a filter per columns excluding the last 3 columns
    $("#example tfoot th").each(function(index) {
        if (index < $("#example thead th").length - 3) {
            var title = $("#example thead th").eq($(this).index()).text();
            $(this).html('<input type="text" data-kt-filter="search" style="width: 100%;" placeholder="Filtrar" />');
        }
    });
})(jQuery);