<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Admin Login</title>
</head>
<body class="container">

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    @endif

    @if (Session::has('success'))
        <li>{{ Session::get('success') }}</li>
    @endif
    @if (Session::has('error'))
        <li>{{ Session::get('error') }}</li>
    @endif

    <h1>Admin Login</h1>

    <form method="POST" action={{ route('admin.login') }}>
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember_me">
        <label class="form-check-label" for="remember_me">Remember Me</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>