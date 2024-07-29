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
                TRANSFERENCIAS DEL MES
            </td>
            <td style="background-color: #fff; width: 160px;"></td>
            <td style="background-color: #fff; width: 200px;"></td>
            <td style="background-color: #fff; width: 300px;"></td>
            <td style="background-color: #fff; width: 120px;"></td>
            <td style="background-color: #fff; width: 120px;"></td>
            <td style="background-color: #fff; width: 120px;"></td>
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
    
        <!-- Header table -->
        <tr>
            <td></td>
            <td
                style="border: 1px solid #000; background-color: #B1DE75; font-size: 11px; font-weight: bold; text-align: center; width: 160px">
                FECHA</td>
            <td
                style="border: 1px solid #000; background-color: #B1DE75; font-size: 11px; font-weight: bold; text-align: center; width: 200px;">
                BANCO</td>
            <td
                style="border: 1px solid #000; background-color: #B1DE75; font-size: 11px; font-weight: bold; text-align: center; width: 300px">
                INVERSIONISTA</td>
            <td
                style="border: 1px solid #000; background-color: #B1DE75; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                MONTO</td>
            <td
                style="border: 1px solid #000; background-color: #B1DE75; font-size: 11px; font-weight: bold; text-align: center;">
                DETALLES TRANSFERENCIA</td>
            <td style="border: 1px solid #000; background-color: #B1DE75"></td>
            <td style="border: 1px solid #B1DE75"></td>
        </tr>
        @foreach($transfers as $transfer)
            <tr>
                <td></td>
                <td style="border: 1px solid #000; text-align: center;">{{ $transfer->transfer_date }}</td>
                @if($transfer->transfer_bank != 'VARIOS MÉTODOS/TRANSFERENCIAS')
                    <td style="border: 1px solid #000; text-align: center;">{{ $transfer->transfer_bank }}</td>
                @else
                    <td style="border: 1px solid #000; text-align: center;">VARIOS</td>
                @endif
                <td style="border: 1px solid #000; text-align: center;">{{ $transfer->investor->investor_name }}</td>
                <td style="border: 1px solid #000; background-color: #E7F5D5; text-align: center;">L. {{ number_format($transfer->transfer_amount, 2) }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $transfer->transfer_comment }}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border-top: 1px solid #000; background-color: #B1DE75; font-size: 11px; font-weight: bold; text-align: center;">
                L. {{ number_format($totalTransferAmount,2) }}</td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>