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
                COMISIONES A FAVOR DE INVERSIONISTAS
            </td>
            <td></td> <!-- Merge con td anterior -->
            <td style="background-color: #fff; width: 347px;"></td>
            <td></td> <!-- Merge con td anterior -->
            <td style="background-color: #fff; width: 120px;"></td>
            <td style="width: 120px;"></td>
        </tr>

        <!-- Blank rows -->
        <tr>
            <td></td>
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
                style="border: 1px solid #000; background-color: #FFD966; font-size: 12px; font-weight: bold; text-align: center; width: 290px;">
                PROYECTO</td>
            <td></td> <!-- Merge con td anterior -->
            <td
                style="border: 1px solid #000; background-color: #FFD966; font-size: 12px; font-weight: bold; text-align: center; width: 290px">
                NOMBRE INVERSIONISTA</td>
            <td></td>
            <td
                style="border: 1px solid #000; background-color: #FFD966; font-size: 12px; font-weight: bold; text-align: center; min-width: 120px;">
                INVERSION</td>
            <td
                style="border: 1px solid #000; background-color: #FFD966; font-size: 12px; font-weight: bold; text-align: center; min-width: 120px;">
                COMISION</td>
        </tr>
        @foreach($investorCommissions as $investorCommission)
            <tr>
                <td></td>
                @if($investorCommission->investor_investment == 0)
                    <td style="border: 1px solid #000; text-align: center;">{{ $investorCommission->project_name }}&nbsp;<b>(5%)</b></td>    
                @else
                    <td style="border: 1px solid #000; text-align: center;">{{ $investorCommission->project_name }}</td>
                @endif
                <td></td> <!-- Merge con td anterior -->
                <td style="border: 1px solid #000; text-align: center;">{{ $investorCommission->investor_name }}</td>
                <td></td> <!-- Merge con td anterior -->
                <td style="border: 1px solid #000; text-align: center; background-color: #FFF3D1;">L. {{ number_format($investorCommission->investor_investment, 2) }}</td>
                <td style="border: 1px solid #000; text-align: center; background-color: #FFF3D1;">L. {{ number_format($investorCommission->investor_final_profit, 2) }}</td>
            </tr>
        @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="background-color: #FFD966; font-weight: bold; border: 1px solid #000; text-align: center;">L. {{ number_format($totalInvestorInvestment, 2) }}</td>
                <td style="background-color: #FFD966; font-weight: bold; border: 1px solid #000; text-align: center;">L. {{ number_format($totalInvestorCommissions, 2) }}</td>
            </tr>
    </tbody>
</table>

<!-- Tabla a comisionistas -->
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
                COMISIONES A FAVOR DE COMISIONISTAS
            </td>
            <td></td> <!-- Merge con td anterior -->
            <td style="background-color: #fff; width: 347px;"></td>
            <td></td> <!-- Merge con td anterior -->
            <td style="background-color: #fff; width: 120px;"></td>
            <td style="width: 120px;"></td>
        </tr>

        <!-- Blank rows -->
        <tr>
            <td></td>
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
                style="border: 1px solid #000; background-color: #E06666; font-size: 12px; font-weight: bold; text-align: center; width: 290px;">
                PROYECTO</td>
            <td></td> <!-- Merge con td anterior -->
            <td
                style="border: 1px solid #000; background-color: #E06666; font-size: 12px; font-weight: bold; text-align: center; width: 290px">
                NOMBRE COMISIONISTA</td>
            <td></td>
            <td
                style="border: 1px solid #000; background-color: #E06666; font-size: 12px; font-weight: bold; text-align: center; min-width: 120px;">
                COMISION</td>
        </tr>
        @foreach($commissionerCommissions as $commissionerCommission)
            <tr>
                <td></td>
                <td style="border: 1px solid #000; text-align: center;">{{ $commissionerCommission->project_name }}</td>    
                <td></td> <!-- Merge con td anterior -->
                <td style="border: 1px solid #000; text-align: center;">{{ $commissionerCommission->commissioner_name }}</td>
                <td></td> <!-- Merge con td anterior -->
                <td style="border: 1px solid #000; text-align: center; background-color: #F8E0E0">L. {{ number_format($commissionerCommission->commissioner_commission, 2) }}</td>
            </tr>
        @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="background-color: #E06666; font-weight: bold; border: 1px solid #000; text-align: center;">L. {{ number_format($totalCommissionerCommissions, 2) }}</td>
            </tr>
    </tbody>
</table>