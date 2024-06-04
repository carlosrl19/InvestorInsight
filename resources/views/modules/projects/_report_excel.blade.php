<table>
    <thead>
        <tr>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <!-- Header text -->
        <tr>
            <td></td>
            @foreach($project->investors as $investor)
                <td style="font-size: 14px; width: 150px; font-weight: bold; background-color: #fff; text-align: center; text-decoration: underline;">PROYECTO {{ $investor->investor_name }} </td>
            @endforeach
            <td style="background-color: #fff; width: 200px;"></td>
            <td style="font-size: 12px; font-weight: bold; background-color: #FFF455; width: 160px; text-align: center; text-decoration: underline;">
                @if($project->project_status == 0)
                    FINALIZADO
                @elseif($project->project_status == 1)
                    TRABAJANDO
                @elseif($project->project_status == 2)
                    CERRADO
                @else
                    DESCONOCIDO
                @endif
            </td>
            <td style="background-color: #fff;"></td>
            <td style="background-color: #fff;"></td>
            <td style="background-color: #fff;"></td>
            <td style="background-color: #fff;"></td>
            <td style="background-color: #fff;"></td>
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
            <td style="background-color: #fff"></td>
        </tr>

        <!-- Header table -->
        <tr>
            <td></td>
            <td style="background-color: #A9D08E; width: 90px"></td>
            <td></td>
            <td style="background-color: #fff; font-size: 11px; font-weight: bold;">CAPITAL</td>
            <td style="background-color: #fff; font-size: 11px; font-weight: bold; width: 120px">GANANCIA TOTAL</td>
            <td style="background-color: #fff; color: #375623; font-size: 12px; font-weight: bold; width: 230px">COMISIÓN {{ $investor->investor_name }} 50%</td>
            @if(isset($project->commissioners[1]))
                <td style="background-color: #fff; font-size: 11px; font-weight: bold; width: 170px">COMISIÓN {{ $commissioners->get(1)->commissioner_name ?? '-' }} 10%</td>
                <td style="background-color: #fff; font-size: 12px; font-weight: bold; width: 220px">COMISIÓN {{ $commissioners[0]->commissioner_name }} 40%</td>
            @else
                <td style="background-color: #fff; font-size: 12px; font-weight: bold; width: 220px">COMISIÓN {{ $commissioners[0]->commissioner_name }} 50%</td>
            @endif
            <td style="background-color: #fff; font-size: 11px; font-weight: bold; width: 170px">COMENTARIO</td>
        </tr>
        
        <!-- Content table -->
        <tr>
            <td></td>
            <td style="background-color: #A9D08E; width: 90px"></td>
            <td style="background-color: #fff; font-size: 12px; font-weight: bold; text-align: justify; border-bottom: 1px solid #000;">{{ $project->project_name }}</td>
            <td style="text-align: justify; border-bottom: 1px solid #000;">L. {{ number_format($project->investors->sum('pivot.investor_investment'), 2) }}</td>
            <td style="text-align: justify; border-bottom: 1px solid #000;">L. {{ number_format($project->investors->sum('pivot.investor_profit'), 2) }}</td>
            <td style="text-align: justify; border-bottom: 1px solid #000; color: #375623; text-decoration: underline; font-weight: bold;">L. {{ number_format($project->investors->sum('pivot.investor_final_profit'), 2) }}</td>
            @if(isset($project->commissioners[1]))
                <td style="text-align: justify; border-bottom: 1px solid #000; width: 220px; font-weight: bold;">
                    L. {{ number_format($project->commissioners[1]->pivot->commissioner_commission, 2) }}
                </td>
            @endif
            <td style="text-align: justify; border-bottom: 1px solid #000; width: 220px">L. {{ number_format($project->commissioners[0]->pivot->commissioner_commission, 2) }}</td>
            <td style="color: #1F4E82; text-decoration: underline; border-bottom: 1px solid #000;">{{ $project->project_comment }}</td>
        </tr>
    </tbody>
</table>