<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte</title>
</head>
<body>
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
                <td style="font-size: 16px; width: 100px; font-weight: bold; background-color: #fff; text-align: center; text-decoration: underline;">
                    PROYECTOS DEL MES
                </td>
                <td style="background-color: #fff; width: auto;"></td>
                <td style="background-color: #fff; width: 100px;"></td>
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
                <td style="border: 1px solid #000; background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center; width: 140px">FECHA</td>
                <td style="border: 1px solid #000; background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">PROYECTO</td>
                <td style="border: 1px solid #000; background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">FECHA INICIO</td>
                <td style="border: 1px solid #000; background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">FECHA FINAL</td>
                <td style="border: 1px solid #000; background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center;">INVERSIÓN</td>
                <td style="border: 1px solid #000; background-color: #569a40"></td>
                <td style="border: 1px solid #569a40"></td>
            </tr>
            @foreach($projects as $project)
            <tr>
                <td></td>
                <td style="text-align: center;">{{ $project->created_at }}</td>
                <td style="text-align: center;">{{ $project->project_name }}</td>
                <td style="text-align: center;">{{ $project->project_start_date }}</td>
                <td style="text-align: center;">{{ $project->project_end_date }}</td>
                <td style="text-align: center;">{{ $project->project_investment }}</td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>

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
                <td style="font-size: 16px; width: 100px; font-weight: bold; background-color: #fff; text-align: center; text-decoration: underline;">
                    TRANSFERENCIAS DEL MES
                </td>
                <td style="background-color: #fff; width: auto;"></td>
                <td style="background-color: #fff; width: 100px;"></td>
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
                <td style="border: 1px solid #000; background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center; width: 140px">FECHA</td>
                <td style="border: 1px solid #000; background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">BANCO</td>
                <td style="border: 1px solid #000; background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center; width: 140px">MONTO</td>
                <td style="border: 1px solid #000; background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center;">MOTIVO / COMENTARIO DEL MOVIMIENTO</td>
                <td style="border: 1px solid #000; background-color: #569a40"></td>
                <td style="border: 1px solid #569a40"></td>
            </tr>
            @foreach($transfers as $transfer)
            <tr>
                <td></td>
                <td style="text-align: center;">{{ $transfer->transfer_date }}</td>
                @if($transfer->transfer_bank != 'VARIOS MÉTODOS/TRANSFERENCIAS')
                    <td style="text-align: center;">{{ $transfer->transfer_bank }}</td>
                @else
                    <td style="text-align: center;">VARIOS</td>
                @endif
                <td style="text-align: center;">{{ $transfer->transfer_amount }}</td>
                <td style="text-align: center;">{{ $transfer->transfer_comment }}</td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center;">{{ $totalTransferAmount }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

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
                <td style="font-size: 16px; width: 100px; font-weight: bold; background-color: #fff; text-align: center; text-decoration: underline;">
                    TRANSFERENCIAS DEL MES
                </td>
                <td style="background-color: #fff; width: auto;"></td>
                <td style="background-color: #fff; width: 100px;"></td>
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
                <td style="border: 1px solid #000; background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center; width: 140px">FECHA</td>
                <td style="border: 1px solid #000; background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">BANCO</td>
                <td style="border: 1px solid #000; background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center; width: 140px">MONTO</td>
                <td style="border: 1px solid #000; background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center;">MOTIVO / COMENTARIO DEL MOVIMIENTO</td>
                <td style="border: 1px solid #000; background-color: #569a40"></td>
                <td style="border: 1px solid #569a40"></td>
            </tr>
            @foreach($transfers as $transfer)
            <tr>
                <td></td>
                <td style="text-align: center;">{{ $transfer->transfer_date }}</td>
                @if($transfer->transfer_bank != 'VARIOS MÉTODOS/TRANSFERENCIAS')
                    <td style="text-align: center;">{{ $transfer->transfer_bank }}</td>
                @else
                    <td style="text-align: center;">VARIOS</td>
                @endif
                <td style="text-align: center;">{{ $transfer->transfer_amount }}</td>
                <td style="text-align: center;">{{ $transfer->transfer_comment }}</td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="background-color: #569a40; font-size: 11px; font-weight: bold; text-align: center;">{{ $totalTransferAmount }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>