<table>
    <thead>
        <tr class="text-center">
            <th></th>
        </tr>
    </thead>
    <tbody>
        <!-- Header text -->
        <tr style="border: 1px solid #000">
            <td></td>
            <td
                style="font-size: 16px; width: 100px; font-weight: bold; background-color: #fff; text-align: center; text-decoration: underline;">
                PAGARÉS DE PROYECTOS DEL MES
            </td>
            <td style="background-color: #fff; width: auto;"></td>
            <td style="background-color: #fff; width: 347px;"></td>
            <td style="background-color: #fff; width: 160px;"></td>
            <td style="background-color: #fff; width: 200px;"></td>
            <td style="background-color: #fff; width: 200px;"></td>
            <td style="background-color: #fff; width: 200px;"></td>
        </tr>
        <!-- Blank rows 1 -->
        <tr>
            <td></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
        </tr>
        <!-- Blank rows 2 -->
        <tr>
            <td></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
        </tr>
        <!-- Header table -->
        <tr>
            <td></td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                FECHA EMISIÓN</td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                FECHA LIMITE PAGO</td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 347px;">
                INVERSIONISTA</td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                MONTO</td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 11px; font-weight: bold; text-align: center;">
                MOTIVO / COMENTARIO DEL MOVIMIENTO</td>
            <td style="border: 1px solid #000; background-color: #cce0f8"></td>
            <td style="border: 1px solid #cce0f8"></td>
        </tr>
        @foreach($promissory_notes as $promissoryNote)
            <tr>
                <td></td>
                <td style="text-align: center;">{{ $promissoryNote->promissoryNote_emission_date }}</td>
                <td style="text-align: center;">{{ $promissoryNote->promissoryNote_final_date }}</td>
                <td style="text-align: center;">{{ $promissoryNote->investor->investor_name }}</td>
                <td style="text-align: center;">{{ $promissoryNote->promissoryNote_amount }}</td>
                <td style="text-align: center;">{{ $promissoryNote->promissoryNote_comment }}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>