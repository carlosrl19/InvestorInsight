<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>{{ $investor_liquidation->investor->investor_name }} - LIQUIDACIÓN</title>
    <link rel="shortcut icon" type="image/png" href="./favicon.png" />
    <style>
        * {
            box-sizing: border-box;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            word-break: break-all;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }

        .h4-14 h4 {
            font-size: 12px;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .img {
            margin-left: "auto";
            margin-top: "auto";
            height: 30px;
        }

        pre,
        p {
            /* width: 99%; */
            /* overflow: auto; */
            /* bpicklist: 1px solid #aaa; */
            padding: 0;
            margin: 0;
        }

        table {
            font-family: arial, sans-serif;
            width: 100%;
            border-collapse: collapse;
            padding: 1px;
        }

        .hm-p p {
            text-align: left;
            padding: 1px;
            padding: 5px 4px;
        }

        td,
        th {
            text-align: left;
            padding: 8px 6px;
        }

        .table-b td,
        .table-b th {
            border: 1px solid #ddd;
        }

        th {
            /* background-color: #ddd; */
        }

        .hm-p td,
        .hm-p th {
            padding: 3px 0px;
        }

        .cropped {
            float: right;
            margin-bottom: 20px;
            height: 100px;
            /* height of container */
            overflow: hidden;
        }

        .cropped img {
            width: 400px;
            margin: 8px 0px 0px 80px;
        }

        .main-pd-wrapper {
            box-shadow: 0 0 10px #ddd;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 14px;
        }

        .invoice-items {
            font-size: 12px;
            border-top: 1px dashed #ddd;
        }

        .invoice-items td {
            padding: 14px 0;
        }
    </style>
</head>

<body>
    <section class="main-pd-wrapper" style="margin: auto; border: 1px solid #000; padding: 20px;">
        <img style="margin-left: 5%;" width="14" height="12" src="static/svg/robenior.svg" alt="logo-img">
        <div style="margin-left: 25%; text-align: justify; line-height: 1.5; font-size: 10px; color: #4a4a4a;">
            <p style="font-weight: bold; color: #000; margin-top: -15px; font-size: 14px;">
                INVERSIONES ROBENIOR
            </p>
            <p style="margin: 5px auto;">
                SAN PEDRO SULA, CORTÉS, HONDURAS, CA
            </p>
        </div>

        <div
            style="margin-left: 70%; margin-top: -60px; text-align: justify; line-height: 1.5; font-size: 10px; color: #4a4a4a;">
            <p style="font-weight: bold; line-height: 1.5; margin-top: -15px; font-size: 14px;">
                RECIBO DE LIQUIDACIÓN
            </p>
            <p style="font-size: 10px; margin: 5px auto;">
                Fecha impresión: {{ $todayDate }}
            </p>
            <p style="font-size: 10px">
                Fecha emisión: {{ $investor_liquidation->investor_liquidation_date }}
            </p>
        </div>

        <div style="margin-top: 30px; padding: 20px; border: 1px solid rgba(0,0,0,0.8)">
            <div style="display:inline-block; line-height: 1.5; font-size: 12px; color: #4a4a4a; width: 100%">
                <p style="font-weight: bold; color: #000; font-size: 12px;">
                    INFORMACIÓN DEL INVERSIONISTA
                </p>
                <p style="margin: 5px auto;">
                    Nombre completo: <span
                        style="margin-left: 10%; font-weight: bold;">{{ $investor_liquidation->investor->investor_name }}</span>
                </p>
                <p style="margin: 5px auto;">
                    D.N.I.: <span
                        style="margin-left: 20.5%;">{{ $investor_liquidation->investor->investor_dni }}</span>
                </p>
                <p style="margin: 5px auto;">
                    Fecha ingreso: <span
                        style="margin-left: 13%;">{{ $investor_liquidation->investor->created_at }}</span>
                </p>
                <p style="margin: 5px auto;">
                    Fecha liquidación: <span
                        style="margin-left: 10%;">{{ $investor_liquidation->investor_liquidation_date }}</span>
                </p>
                <p style="margin: 5px auto;">
                    Fondo actual: <span
                        style="margin-left: 14%;">L. {{ number_format($investor_liquidation->investor_liquidation_amount,2) }}</span>
                </p>
            </div>
        </div>

        <table style="width: 100%; background: #fcbd024f; border-radius: 4px; margin-top: 30px">
            <thead>
                <tr>
                    <th>Total a pagar</th>
                    <th style="text-align: right;">L.
                        {{ number_format($investor_liquidation->investor_liquidation_amount, 2) }}</th>
                </tr>
            </thead>
        </table>
    </section>
</body>

</html>