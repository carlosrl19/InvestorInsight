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
            <td style="font-size: 14px; width: 100px; font-weight: bold; background-color: #fff; text-align: left; text-align: center; text-decoration: underline;">
                MOVIMIENTO DE FONDOS {{ implode(' ', array_slice(explode(' ', $investor->investor_name), 0, 1)) }} {{ implode(' ', array_slice(explode(' ', $investor->investor_name), -1)) }}
            </td>
            <td style="background-color: #fff; width: auto;"></td>
            <td style="background-color: #fff; width: 100px;"></td>
            <td style="background-color: #fff; width: 160px;"></td>
            <td style="background-color: #fff; width: 160px;"></td>
            <td style="background-color: #fff; width: 160px;"></td>
            <td style="background-color: #fff; width: 160px;"></td>
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
            <td style="border: 1px solid #000; background-color: #3d9163; font-size: 11px; font-weight: bold; text-align: center; width: 140px">FECHA</td>
            <td style="border: 1px solid #000; background-color: #3d9163; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">MOVIMIENTO</td>
            <td style="border: 1px solid #000; background-color: #3d9163; font-size: 11px; font-weight: bold; text-align: center; width: 140px">FONDO ANTERIOR</td>
            <td style="border: 1px solid #000; background-color: #3d9163; font-size: 11px; font-weight: bold; text-align: center; width: 140px">FONDO FINAL</td>
            <td style="border: 1px solid #000; background-color: #3d9163; font-size: 11px; font-weight: bold; text-align: center;">MOTIVO / COMENTARIO DEL MOVIMIENTO</td>
            <td style="border: 1px solid #000; background-color: #3d9163"></td>
            <td style="border: 1px solid #3d9163"></td>
        </tr>

        <!-- Content table -->
        @foreach($investor_funds as $fund)
        <tr style="border: 1px solid #000">
            <td></td>
            <td style="background-color: #fff; text-align: center;">{{ $fund->investor_change_date }}</td>
            <td style="background-color: #fff; text-align: center;">{{ $fund->investor_new_funds - $fund->investor_old_funds }}</td>
            <td style="background-color: #fff; text-align: center;">{{ $fund->investor_old_funds }}</td>
            <td style="background-color: #fff; text-align: center;">{{ $fund->investor_new_funds }}</td>
            <td style="background-color: #fff; text-align: center;">{{ $fund->investor_new_funds_comment }}</td>
            <td style="background-color: #fff;"></td>
            <td style="background-color: #fff;"></td>
        </tr>
        @endforeach
    </tbody>
</table>
