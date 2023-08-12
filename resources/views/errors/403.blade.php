<!DOCTYPE html>
<html>
<head>
    <title>403 Unauthorized</title>
</head>
<body>
    <h1>403 Unauthorized</h1>
    <p>You are not authorized to access this page.</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        Go to <button class="btn btn-danger" type="submit">Login</button>
    </form>
</body>
</html>