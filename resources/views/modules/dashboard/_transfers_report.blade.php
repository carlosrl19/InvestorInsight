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
                MOVIMIENTOS EN FONDOS DEL MES
            </td>
            <td style="background-color: #fff; width: 160px;"></td>
            <td style="background-color: #fff; width: 290px;"></td>
            <td style="background-color: #fff; width: 120px;"></td>
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
                style="border: 1px solid #000; background-color: #B1DE75; font-size: 11px; font-weight: bold; text-align: center; width: 290px;">
                INVERSIONISTA</td>
            <td
                style="border: 1px solid #000; background-color: #B1DE75; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                MOVIMIENTO</td>
            <td
                style="border: 1px solid #000; background-color: #B1DE75; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                FONDO ANTERIOR</td>
            <td
                style="border: 1px solid #000; background-color: #B1DE75; font-size: 11px; font-weight: bold; text-align: center; width: 120px">
                NUEVO FONDO</td>
            <td
                style="border: 1px solid #000; background-color: #B1DE75; font-size: 11px; font-weight: bold; text-align: center; width: 140px">
                DETALLES MOVIMIENTO</td>
            <td style="border: 1px solid #000; background-color: #B1DE75"></td>
            <td style="border: 1px solid #B1DE75"></td>
        </tr>

        @foreach($founds as $found)
            <tr>
                <td></td>               
                @if($found->investor_new_funds - $found->investor_old_funds < 0)
                    <td style="border: 1px solid #000; background-color: #FCD2CE; text-align: center;">{{ $found->investor_change_date }}</td>
                    <td style="border: 1px solid #000; background-color: #FCD2CE; text-align: center;">{{ $found->investor->investor_name }}</td>
                    <td style="border: 1px solid #000; background-color: #FCD2CE; text-align: center;">
                        L. {{ number_format($found->investor_new_funds - $found->investor_old_funds,2) }}</td>
                    <td style="border: 1px solid #000; background-color: #FCD2CE; text-align: center;">L. {{ number_format($found->investor_old_funds, 2) }}</td>
                    <td style="border: 1px solid #000; background-color: #FCD2CE; text-align: center;">L. {{ number_format($found->investor_new_funds,2) }}</td>
                    <td style="border: 1px solid #000; background-color: #FCD2CE; text-align: center;">{{ $found->investor_new_funds_comment }}</td>
                @else
                    <td style="border: 1px solid #000; background-color: #E8F5CC; text-align: center;">{{ $found->investor_change_date }}</td>
                    <td style="border: 1px solid #000; background-color: #E8F5CC; text-align: center;">{{ $found->investor->investor_name }}</td>
                    <td style="border: 1px solid #000; background-color: #E8F5CC; text-align: center;">L. {{ number_format($found->investor_new_funds - $found->investor_old_funds,2) }}</td>
                    <td style="border: 1px solid #000; background-color: #E8F5CC; text-align: center;">L. {{ number_format($found->investor_old_funds, 2) }}</td>
                    <td style="border: 1px solid #000; background-color: #E8F5CC; text-align: center;">L. {{ number_format($found->investor_new_funds,2) }}</td>
                    <td style="border: 1px solid #000; background-color: #E8F5CC; text-align: center;">{{ $found->investor_new_funds_comment }}</td>
                @endif
                <td></td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>