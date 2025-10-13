<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Reset Password</title>
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

    <h1>Reset Password</h1>

    <form method="POST" action={{ route('admin.reset_password_submit') }}>
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <div class="mb-3">
            <label for="password_conf" class="form-label">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_conf">
        </div>
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</body>
</html>