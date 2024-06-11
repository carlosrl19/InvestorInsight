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
                <td style="font-size: 14px; width: 100px; font-weight: bold; background-color: #fff; text-align: left; text-decoration: underline;">PROYECTO {{ $investor->investor_name }} </td>
            @endforeach
            <td style="background-color: #fff; width: auto;"></td>
            <td style="background-color: #fff; width: 100px;"></td>
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
            <td style="background-color: #fff; width: 160px;"></td>
            <td style="background-color: #fff; width: 160px;"></td>
            @if(isset($project->commissioners[1]))
                <td style="background-color: #fff;"></td>
                <td style="background-color: #fff; text-align: center; font-weight: bold;">#CP-{{ $project->project_code }}</td>
            @else
                <td style="background-color: #fff; text-align: center; font-weight: bold;">#CP-{{ $project->project_code }}</td>
                <td></td>
            @endif
        </tr>
        
        <!-- Blank rows 1 -->
        <tr>
            <td></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff;"></td>
            <td style="background-color: #fff;"></td>
            @if(isset($project->commissioners[1]))
                <td style="background-color: #fff;"></td>
                <td style="background-color: #fff;"></td>
            @else
                <td style="background-color: #fff"></td>
                <td></td>
            @endif
        </tr>
        
        <!-- Blank rows 2 -->
        <tr>
            <td></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff"></td>
            <td style="background-color: #fff;"></td>
            <td style="background-color: #fff;"></td>
            @if(isset($project->commissioners[1]))
                <td style="background-color: #fff;"></td>
                <td style="background-color: #fff;"></td>
            @else
                <td style="background-color: #fff"></td>
                <td></td>
            @endif
        </tr>

        <!-- Header table -->
        <tr>
            <td></td>
            <td style="background-color: #A9D08E; width: 150px"></td>
            <td></td>
            <td style="background-color: #fff; font-size: 11px; font-weight: bold;">CAPITAL</td>
            <td style="background-color: #fff; font-size: 11px; font-weight: bold; width: 120px; text-align: center;">GANANCIA TOTAL</td>
            <td style="background-color: #fff; font-size: 11px; font-weight: bold; width: 150px; text-align: center;">
                {{ implode(' ', array_slice(explode(' ', $investor->investor_name), 0, 1)) }} 50%
            </td>
            @if(isset($project->commissioners[1]))
                <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center;">
                    {{ implode(' ', array_slice(explode(' ', $commissioners->get(1)->commissioner_name ?? '-'), 0, 1)) }} 10%
                </td>
                <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center;">
                    {{ implode(' ', array_slice(explode(' ', $commissioners[0]->commissioner_name), 0, 1)) }} 40%
                </td>
            @else
                <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center;">
                    {{ implode(' ', array_slice(explode(' ', $commissioners[0]->commissioner_name), 0, 1)) }} 50%
                </td>
            @endif
            <td style="background-color: #fff; font-size: 11px; font-weight: bold; width: 250px; text-align: center;">COMENTARIO</td>
        </tr>
        
        <!-- Content table -->
        <tr>
            <td></td>
            <td style="background-color: #A9D08E; width: 90px"></td>
            <td style="background-color: #fff; font-size: 12px; font-weight: bold; text-align: left; width: 140px; border-bottom: 1px solid #000;">{{ $project->project_name }}</td>
            <td style="text-align: center; font-weight: bold; border-bottom: 1px solid #000;">L. {{ number_format($project->investors->sum('pivot.investor_investment'), 2) }}</td>
            <td style="text-align: center; font-weight: bold; border-bottom: 1px solid #000;">L. {{ number_format($project->investors->sum('pivot.investor_profit'), 2) }}</td>
            <td style="text-align: center; font-weight: bold; border-bottom: 1px solid #000; width: 100px; text-decoration: underline; font-weight: bold;">L. {{ number_format($project->investors->sum('pivot.investor_final_profit'), 2) }}</td>
            @if(isset($project->commissioners[1]))
                <td style="text-align: center; border-bottom: 1px solid #000; width: auto; font-weight: bold;">
                    L. {{ number_format($project->commissioners[1]->pivot->commissioner_commission, 2) }}
                </td>
            @endif
            <td style="text-align: center; font-weight: bold; border-bottom: 1px solid #000; width: 100px">L. {{ number_format($project->commissioners[0]->pivot->commissioner_commission, 2) }}</td>
            <td style="color: #1F4E82; text-decoration: underline; text-align: left; border-bottom: 1px solid #000;">{{ $project->project_comment }}</td>
        </tr>
    </tbody>
</table>