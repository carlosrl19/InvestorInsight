<body>
    <div id="page_pdf">
        <table id="factura_head">
            <tr>
                <td class="info_empresa">
                    <div>
                        <span class="h2"><strong>INVESTOR INSIGHT</strong></span>
                    </div>
                </td>
                <td class="info_factura">
                    <div class="round">
                        <span class="h3">Nota de Crédito</span>
                        <p><strong>Fecha de Emisión:</strong> {{ $creditNote->creditNote_date }}</p>
                        <p><strong>Fecha actual:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
                        <p><strong>Hora actual:</strong> {{ \Carbon\Carbon::now()->format('h:i A') }}</p>
                        <br>
                    </div>
                </td>
            </tr>
        </table>
    </div>

<style>
*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}
p, label, span, table{
	font-size: 9pt;
}
.h2{
	font-size: 16pt;
}
.h3{
	font-size: 12pt;
	display: block;
	background: #0a4661;
	color: #FFF;
	text-align: center;
	padding: 3px;
	margin-bottom: 5px;
}
#page_pdf{
	width: 95%;
	margin: 15px auto 10px auto;
}

#factura_head, #factura_cliente, #factura_detalle{
	width: 100%;
	margin-bottom: 10px;
}
.logo_factura{
	width: 25%;
}
.info_empresa{
	width: 50%;
	text-align: center;
}
.info_factura{
	width: 25%;
}
.info_cliente{
	width: 100%;
}
.datos_cliente{
	width: 100%;
}
.datos_cliente tr td{
	width: 50%;
}
.datos_cliente{
	padding: 10px 10px 0 10px;
}
.datos_cliente label{
	width: 75px;
	display: inline-block;
}
.datos_cliente p{
	display: inline-block;
}

.textright{
	text-align: right;
}
.textleft{
	text-align: left;
}
.textcenter{
	text-align: center;
}
.round{
	border-radius: 10px;
	border: 1px solid #0a4661;
	overflow: hidden;
}
.round p{
	padding: 0 15px;
}

#factura_detalle{
	border-collapse: collapse;
}
#factura_detalle thead th{
	background: #058167;
	color: #FFF;
	padding: 5px;
}
#detalle_productos tr:nth-child(even) {
    background: #ededed;
}

@media print {
        /* Oculta la barra de navegación superior */
        .navbar {
            display: none !important;
        }

        /* Oculta la barra lateral */
        .sidebar {
            display: none !important;
        }
        .options{
            display: none !important;
        }

        /* Ajusta el ancho del contenido principal */
        .container.bootdey {
            width: 100%;
            margin: 0;
        }

        /* Ajusta el tamaño de la fuente para la impresión */
        body {
            font-size: 14pt;
        }
    }
</style>
</body>