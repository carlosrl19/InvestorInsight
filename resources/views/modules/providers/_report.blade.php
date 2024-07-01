<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>Tax Invoice</title>
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
         height: 100px; /* height of container */
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
         .invoice-items td{
         padding: 14px 0;
         }
      </style>
   </head>
   <body>
      <section class="main-pd-wrapper" style="margin: auto; border: 1px solid #000; padding: 20px;">
         <img style="float: right" src="static/logo.png" alt="logo-img">
         <div style="text-align: justify; margin: auto; line-height: 1.5; font-size: 14px; color: #4a4a4a;">
            <p style="font-weight: bold; color: #000; margin-top: 15px; font-size: 18px;">
               INVERSIONES ROBENIOR
            </p>
            <p style="margin: 15px auto;">
               SAN PEDRO SULA, CORTÉS, HONDURAS, CA
            </p>
            <p>
               <b>{{ $provider_fund->provider_change_date }}</b>
            </p>
         </div>

         <div style="margin-top: 30px; padding: 20px; border: 1px solid rgba(0,0,0,0.8)">
            <div style="display:inline-block; line-height: 1.5; font-size: 12px; color: #4a4a4a;">
                <p style="font-weight: bold; color: #000; font-size: 12px;">
                INFORMACIÓN DEL CLIENTE
                </p>
                <p style="margin: 10px auto;">
                - CONSUMIDOR FINAL
                </p>
                <p style="margin: 10px auto;">
                - R.T.N.: 0000000000000
                </p>
            </div>

            <div style="display:inline-block; float: right; line-height: 1.5; font-size: 12px; color: #4a4a4a;">
                <p style="font-weight: bold; color: #000; font-size: 12px;">
                INFORMACIÓN DEL PROVEEDOR
                </p>
                <p style="margin: 5px auto;">
                - {{ $provider_fund->provider->provider_name }}
                </p>
                <p style="margin: 5px auto;">
                - D.N.I.: {{ $provider_fund->provider->provider_dni }}
                </p>
                <p style="margin: 5px auto;">
                - TELÉFONO.: {{ $provider_fund->provider->provider_phone }}
                </p>
            </div>
         </div>

         <div style="padding: 10px; border: 1px solid rgba(0,0,0,0.8); margin-top: 30px">
            <table style="width: 100%; table-layout: fixed">
                <thead>
                <tr>
                    <th style="font-size: 12px; width: 80%;">DESCRIPCIÓN DEL SERVICIO PRESTADO</th>
                    <th style="font-size: 12px; width: 20%; text-align: center; padding-right: 0;">PRECIO</th>
                </tr>
                </thead>
                <tbody>
                <tr class="invoice-items">
                    <td>{{ $provider_fund->provider_new_funds_comment }}</td>
                    <td style="text-align: center; padding-right: 0;">L. {{ number_format($provider_fund->provider_new_funds, 2) }}</td>
                </tbody>
                <p style="font-size: 12px;">--- ULTIMA LÍNEA ---</p>
            </table>
         </div>

         <div style="padding: 10px; border: 1px solid rgba(0,0,0,0.8); margin-top: 30px">
            <p style="font-size: 12px;"><strong>VALOR EN LETRAS:&nbsp;&nbsp;</strong> {{ $valorLetras }} LEMPIRAS</p>
            <p style="font-size: 12px; margin-top: 15px"><strong>OBSERVACIONES:</strong></p>
            <p style="margin-top: 145px"></p>

            <div style="margin-left: 55%;" class="mt-6">
                &nbsp;&nbsp;<img src="static/Firma-ejemplo.png" alt="Logo" height="80px"
                    style="position: absolute; margin-top: -45px; transform: scale(1.2)">
                    <img src="static/sello-ejemplo.png" alt="Sello" height="80px"
                    style="position: absolute; margin-top: -70px; margin-left: 150px; transform: scale(1.2)">
                <span style="margin-left: -30px;">__________________________</span><br>
                <strong style="font-size: 12px">Junior Alexis Ayala Guerrero</strong><br>
            </div>
         </div>

         <table style="width: 100%; background: #fcbd024f; border-radius: 4px; margin-top: 30px">
            <thead>
               <tr>
                  <th>Total a pagar</th>
                  <th style="text-align: right;">L. {{ number_format($provider_fund->provider_new_funds, 2) }}</th>
               </tr>
            </thead>
         </table>
      </section>
   </body>
</html>