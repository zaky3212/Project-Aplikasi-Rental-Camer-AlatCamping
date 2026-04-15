<!DOCTYPE html>
<html>
<head>
    <title>Kategori</title>
</head>
<body>

<div>
    <h1>Kelola Kategori</h1>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
        </tr>

        @foreach ($data as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['nama'] }}</td>
        </tr>
        @endforeach

    </table>
</div>

</body>
</html>