<?php
// Array de colores
$colors = array(
    // Rojo
    "#FF6B6B", "#E74C3C", "#FF4500", "#B22222",

    // Morado claro:
    "#FF00FF",
    
    // Naranja:
    "#FFA500", "#F1C40F", "#FF7F50", "#F39C12", "#D2691E", "#FFD700", "#D35400", "#E67E22", "#FF8C00",
    
    // Morado:
    "#9B59B6", "#8E44AD", "#9932CC", "#BA55D3", "#9400D3", "#4B0082",
    
    // Verde:
    "#1ABC9C", "#16A085", "#2ECC71", "#27AE60", "#00FA9A", "#00FF7F", "#228B22", "#7CFC00",
    
    // Azul:
    "#2980B9", "#3498DB", "#1E90FF", "#00BFFF", "#87CEEB", "#4682B4", "#10439F", "#6A5ACD", "#614BC3",
    
    // Azul claro:
    "#ABCDEF",
    
    // Rosado:
    "#A25772", "#C71585", "#FF1493", "#FF69B4",

    // Verde limón:
    "#32CD32", "#7FFF00", "#ADFF2F",
);

// Generar un color aleatorio
$randomColor = $colors[rand(0, count($colors) - 1)];

// Convertir el color a hexadecimal
$hexColor = $randomColor;
?>

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
                <td style="font-size: 14px; width: 100px; font-weight: bold; background-color: #fff; text-align: left; text-decoration: underline;">
                    PROYECTO {{ implode(' ', array_slice(explode(' ', $investor->investor_name), 0, 1)) }} {{ implode(' ', array_slice(explode(' ', $investor->investor_name), -1)) }}
                </td>
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
                <td style="background-color: #fff; width: 160px;"></td>
                <td style="background-color: #fff; text-align: center; font-weight: bold;">
                    #CP-{{ $project->project_code }}
                </td>
            @else
                <td style="background-color: #fff; text-align: center; font-weight: bold;">
                    #CP-{{ $project->project_code }}
                </td>
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
            <td style="background-color: #fff; width: 120px;"></td> <!-- Asegurar el ancho -->
            @if(isset($project->commissioners[1]))
                <td style="background-color: #fff; width: 120px;"></td> <!-- Asegurar el ancho -->
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
            <td style="background-color: #fff; width: 120px;"></td> <!-- Asegurar el ancho -->
            @if(isset($project->commissioners[1]))
                <td style="background-color: #fff; width: 120px;"></td> <!-- Asegurar el ancho -->
                <td style="background-color: #fff;"></td>
            @else
                <td style="background-color: #fff"></td>
                <td></td>
            @endif
        </tr>

        <!-- Header table -->
        <tr>
            <td></td>
            <td style="background-color: <?php echo htmlspecialchars($hexColor) ?>; width: 150px"></td>
            <td></td>
            <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center; width: 90px">CAPITAL</td>
            <td style="background-color: #fff; font-size: 11px; font-weight: bold; width: 120px; text-align: center;">GANANCIA TOTAL</td>
            
            <!-- Inversionistas  -->
            @if(isset($project->investors[1]))
                <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                    {{ implode(' ', array_slice(explode(' ', $investors->get(1)->investor_name ?? '-'), 0, 1)) }} 5%
                </td>
                <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                    {{ implode(' ', array_slice(explode(' ', $investors[0]->investor_name), 0, 1)) }} 45%
                </td>
            @else
                <td style="background-color: #fff; font-size: 11px; font-weight: bold; width: 150px; text-align: center;">
                    {{ implode(' ', array_slice(explode(' ', $investor->investor_name), 0, 1)) }} 50%
                </td>
            @endif

            <!-- Comisionistas  -->
            @if(isset($project->commissioners[1]))
                <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                    {{ implode(' ', array_slice(explode(' ', $commissioners->get(1)->commissioner_name ?? '-'), 0, 1)) }} 10%
                </td>
                <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                    {{ implode(' ', array_slice(explode(' ', $commissioners[0]->commissioner_name), 0, 1)) }} 40%
                </td>
            @else
                <td style="background-color: #fff; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                    {{ implode(' ', array_slice(explode(' ', $commissioners[0]->commissioner_name), 0, 1)) }} 50%
                </td>
            @endif
            
            <td style="background-color: #fff; font-size: 11px; font-weight: bold; width: 250px; text-align: center;">COMENTARIO</td>
        </tr>
        
        <!-- Content table -->
        <tr>
            <td></td>
            <td style="background-color: <?php echo htmlspecialchars($hexColor) ?>; width: 90px"></td>
            <td style="background-color: #fff; font-size: 12px; font-weight: bold; text-align: left; width: 140px; border-bottom: 1px solid #000;">{{ $project->project_name }}</td>
            <td style="text-align: center; font-weight: bold; border-bottom: 1px solid #000; width: 90px">L. {{ number_format($project->investors->max('pivot.investor_investment'), 2) }}</td>
            <td style="text-align: center; font-weight: bold; border-bottom: 1px solid #000;">L. {{ number_format($project->investors->max('pivot.investor_profit'), 2) }}</td>
            @if(isset($project->investors[1]))
                <td style="text-align: center; border-bottom: 1px solid #000; width: 120px; font-weight: bold;">
                    L. {{ number_format($project->investors[1]->pivot->investor_profit, 2) }}
                </td>
            @endif
            <td style="text-align: center; font-weight: bold; border-bottom: 1px solid #000; width: 100px; text-decoration: underline; font-weight: bold;">L. {{ number_format($project->investors->max('pivot.investor_final_profit'), 2) }}</td>
            @if(isset($project->commissioners[1]))
                <td style="text-align: center; border-bottom: 1px solid #000; width: 120px; font-weight: bold;">
                    L. {{ number_format($project->commissioners[1]->pivot->commissioner_commission, 2) }}
                </td>
            @endif
            <td style="text-align: center; font-weight: bold; border-bottom: 1px solid #000; width: 120px">L. {{ number_format($project->commissioners[0]->pivot->commissioner_commission, 2) }}</td>
            <td style="color: #1F4E82; text-decoration: underline; text-align: left; border-bottom: 1px solid #000;">{{ $project->project_comment }}</td>
        </tr>
    </tbody>
</table>
