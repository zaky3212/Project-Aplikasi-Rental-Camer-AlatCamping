<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Halo, {{ Auth::user()->name }}!</h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="padding: 10px 20px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Log Out
        </button>
    </form>

</body>
</html>