<table>
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>GANANCIA TOTAL</th>
            <th>INVERSIONISTA</th>
            <th>COMISIONISTA 1</th>
            <th>COMISIONISTA 2</th>
            <th>Comentario</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="background-color: #2d91ff"></td>
            <td style="font-weight: bold; width: 150px; text-decoration: underline; text-align: center">Proyecto '{{ $project->project_name }}'</td>
            <td style="font-weight: bold; background-color: #ffe924; width: 100px; text-decoration: underline; text-align: center">(TRABAJANDO)</td>
            <td style="width: 100px; text-align: center;">L. {{ number_format($project->investors->sum('pivot.investor_profit'), 2) }}</td>
            <td>
                @foreach($project->investors as $investor)
                    {{ $investor->investor_name }}
                @endforeach
            </td>
            <td>{{ $commissioners[0]->commissioner_name }}</td>
            <td style="width: 100px; text-align: center;">{{ $commissioners->get(1)->commissioner_name ?? '-' }}</td>
            <td style="color: #2d91ff">{{ $project->project_comment }}</td>
        </tr>
    </tbody>
</table>