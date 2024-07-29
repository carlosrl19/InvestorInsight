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
                PROYECTOS INGRESADOS ESTE MES
            </td>
            <td style="background-color: #fff; width: auto;"></td>
            <td style="background-color: #fff; width: 347px;"></td>
            <td style="background-color: #fff; width: 160px;"></td>
            <td style="background-color: #fff; width: 120px;"></td>
            <td style="background-color: #fff; width: 120px;"></td>
            <td style="background-color: #fff; width: 120px;"></td>
        </tr>

        <!-- Blank rows -->
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
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 12px; font-weight: bold; text-align: center; width: 140px">
                FECHA</td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 12px; font-weight: bold; text-align: center; width: 140px">
                CODIGO</td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 12px; font-weight: bold; text-align: center; min-width: 347px;">
                NOMBRE PROYECTO</td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 12px; font-weight: bold; text-align: center;">
                INVERSION</td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 12px; font-weight: bold; text-align: center; width: 120px;">
                INICIO / FINAL</td>
            <td
                style="border: 1px solid #000; background-color: #cce0f8; font-size: 12px; font-weight: bold; text-align: center; width: 120px;">
                DIAS TRABAJO</td>
        </tr>
        @foreach($projects as $project)
            <tr>
                <td></td>
                <td style="text-align: center;">{{ $project->project }}</td>
                <td style="text-align: center;">{{ $project->project_code }}</td>
                <td style="text-align: center;" class="project_name">{{ $project->project_name }}</td>
                <td style="text-align: center;">{{ number_format($project->project_investment, 2) }}</td>
                <td style="text-align: center;">{{ $project->project_start_date }} / {{ $project->project_end_date }}</td>
                <td style="text-align: center;">{{ $project->project_work_days }} días</td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="background-color: #cce0f8; border-top: 1px solid #000; text-align: center; font-weight: bold;">
                {{ number_format($totalProjectInvestment, 2) }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>