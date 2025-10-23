<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lietotu auto saraksts</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Lietotu automašīnu saraksts</h1>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-4 text-left">Marka</th>
                    <th class="py-3 px-4 text-left">Modelis</th>
                    <th class="py-3 px-4 text-left">Gads</th>
                    <th class="py-3 px-4 text-left">Cena</th>
                    <th class="py-3 px-4 text-left">Sludinājums</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $car->brand }}</td>
                        <td class="py-2 px-4">{{ $car->model }}</td>
                        <td class="py-2 px-4">{{ $car->year }}</td>
                        <td class="py-2 px-4">{{ $car->price }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ $car->url }}" target="_blank" class="text-blue-600 hover:underline">Apskatīt</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $cars->links() }}
        </div>
    </div>

</body>
</html>
