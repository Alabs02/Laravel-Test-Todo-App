<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
</head>
<style>
    body {
        width: 100%;
        min-height: 100vh;
        background: #ECEFF1;
    }

    .container {
        display: grid !important;
        place-items: center !important;

        padding-top: 4rem;
    }
</style>
<body>
    <div class="container mt-5">
        <a href="{{ route('user.dashboard') }}">Go To Dashboard</a>
    </div>
</body>
</html>