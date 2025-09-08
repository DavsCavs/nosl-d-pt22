<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lietotu auto sludinājumi</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
        tr:hover { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h1>Lietotu auto sludinājumi</h1>
    <table>
        <thead>
            <tr>
                <th>Marka</th>
                <th>Modelis</th>
                <th>Gads</th>
                <th>Cena</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cars as $car)
            <tr>
                <td>{{ $car->brand }}</td>
                <td>{{ $car->model }}</td>
                <td>{{ $car->year }}</td>
                <td>{{ $car->price }} €</td>
                <td><a href="{{ $car->url }}" target="_blank">Skatīt</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Nav pieejami sludinājumi</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginācija -->
    <div>
        {{ $cars->links() }}
    </div>
</body>
</html>
