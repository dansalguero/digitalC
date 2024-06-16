<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Notificación de Nueva Deuda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
        }
        p {
            margin-bottom: 10px;
        }
        .property-info {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #007bff;
        }
        .debt-info {
            background-color: #fefefe;
            padding: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Notificación de Nueva Deuda</h2>

        <div class="property-info">
            <h3>Información de la Propiedad</h3>
            <p><strong>Fase:</strong> {{ $debt->property->phase }}</p>
            <p><strong>Bloque:</strong> {{ $debt->property->block }}</p>
            <p><strong>Piso:</strong> {{ $debt->property->floor }}</p>
            <p><strong>Número:</strong> {{ $debt->property->number }}</p>
        </div>

        <div class="debt-info">
            <h3>Información de la Deuda</h3>
            <p><strong>Descripción:</strong> {{ $debt->debt_description }}</p>
            <p><strong>Fecha de Emisión:</strong> {{ $debt->issue_date }}</p>
            <p><strong>Fecha de Vencimiento:</strong> {{ $debt->maturity_date }}</p>
            <p><strong>Importe:</strong> {{ $debt->amount }}</p>
        </div>

        <p>Para más detalles, por favor contacte con la administración de la comunidad.</p>
    </div>
</body>
</html>
