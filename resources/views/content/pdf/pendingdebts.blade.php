<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Deudas abiertas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: black;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-property {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Deudas</h1>
    <table>
        <thead>
            <tr>
                <th>Vivienda</th>
                <th>Vecino</th>
                <th>Descripción</th>
                <th>Emisión</th>
                <th>Vencimiento</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
            @foreach($debts as $debt)
                <tr>
                    @if ($debt->property)
                        <td>{{ $debt->property->phase }} <br>{{ $debt->property->block }} -
                            {{ $debt->property->floor }} - {{ $debt->property->number }}
                        </td>
                    @else
                        <td class="no-property">N/A</td>
                    @endif
                    @if ($debt->neighbor)
                        <td>{{ $debt->neighbor->name }} <br>{{ $debt->neighbor->surname }} -
                        </td>
                    @else
                        <td class="no-property"> N/A</td>
                    @endif
                    <td>{{ $debt->debt_description }}</td>
                    <td>{{ $debt->issue_date }}</td>
                    <td>{{ $debt->maturity_date }}</td>
                    <td>{{ $debt->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>