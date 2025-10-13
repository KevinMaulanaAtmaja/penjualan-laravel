<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Admin Dashboard</title>
</head>
<body class="container">
    <h1>Admin Dashboard</h1>

    @if (Session::has('success'))
        <li>{{ Session::get('success') }}</li>
    @endif
    @if (Session::has('error'))
        <li>{{ Session::get('error') }}</li>
    @endif
    
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button>Logout</button>
    </form>
    {{-- <a href="{{ route('admin.logout') }}">Logout</a> --}}
</body>
</html>