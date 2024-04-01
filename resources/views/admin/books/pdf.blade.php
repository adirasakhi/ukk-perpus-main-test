<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">Data Buku</h1>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penerbit</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Terbit</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($books as $book)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->judul }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->penulis }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->penerbit }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->tahun_terbit }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
