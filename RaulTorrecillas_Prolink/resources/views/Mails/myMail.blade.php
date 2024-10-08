<!DOCTYPE html>
<html lang="es">
<head>
    <title>Factura de su pedido</title>
</head>
<body>
<h1>Hola {{ $details['userName'] }},</h1>
<p>Gracias por tu pedido. Aquí están los detalles:</p>

<table>
    <thead>
    <tr>
        <th>Nombre de la Propuesta</th>
        <th>Número de Horas</th>
        <th>Precio</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($details['orderDetails'] as $detail)
        <tr>
            <td>{{ $detail['proposal_name'] }}</td>
            <td>{{ $detail['n_hours'] }}</td>
            <td>{{ $detail['price'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<p>Total de Horas: {{ $details['totalHours'] }}</p>
<p>Precio Total: {{ $details['totalPrice'] }}</p>

<p>Gracias,</p>
<p>{{ config('app.name') }}</p>
</body>
</html>
