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
                LISTADO DE COMISIONISTAS
            </td>
            <td style="background-color: #fff; width: 347px;"></td>
            <td style="background-color: #fff; width: 247px;"></td>
            <td style="width: 180px;"></td>
            <td style="width: 180px;"></td>
        </tr>

        <!-- Blank rows -->
        <tr>
            <td></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- Header table -->
        <tr>
            <td></td>
            <td
                style="border: 1px solid #000; background-color: #E69C46; font-size: 12px; font-weight: bold; text-align: center; width: 120px;">
                FONDO ACTUAL</td>
            <td
                style="border: 1px solid #000; background-color: #E69C46; font-size: 12px; font-weight: bold; text-align: center; width: 140px">
                COMISIONISTA</td>
            <td></td>
            <td
                style="border: 1px solid #000; background-color: #E69C46; font-size: 12px; font-weight: bold; text-align: center; min-width: 180px;">
                DNI</td>
            <td
                style="border: 1px solid #000; background-color: #E69C46; font-size: 12px; font-weight: bold; text-align: center; min-width: 180px;">
                TELEFONO</td>
        </tr>
        @foreach($commissioners as $commissioner)
            <tr>
                <td></td>
                <td style="border: 1px solid #000; text-align: center;">L. {{ number_format($commissioner->commissioner_balance,2) }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $commissioner->commissioner_name }}</td>
                <td></td> <!-- Merge con td anterior -->
                <td style="border: 1px solid #000; text-align: center;">{{ $commissioner->commissioner_dni }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $commissioner->commissioner_phone }}</td>
            </tr>
        @endforeach
    </tbody>
</table>