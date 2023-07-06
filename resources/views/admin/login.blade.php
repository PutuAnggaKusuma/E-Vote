<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Admin | Voting Online</title>
</head>
<body>
    <div style="width: 100%; height: 100vh; background: url('{{asset('style/images/bg/3.jpg')}}'); object-fit: cover; background-position: center;" class="d-flex align-items-center justify-content-center">
        <div style="width: 450px; margin: auto; background: white; border-radius: 10px" class="container shadow p-4">
            <h1 style="font-size: 2em; text-align: center;">Voting Online</h1>
            <div style="width: 100%; gap: 1em;" class="mt-4 d-flex align-items-center justify-content-center">
                <div style="flex: 1; height: 2px; background: grey;"></div>
                <span style="font-size: 1.2em">Login</span>
                <div style="flex: 1; height: 2px; background: grey;"></div>
            </div>
            <form method="POST" action="{{route('admin.authenticate')}}" style="margin-top: 2em;" accept-charset="UTF-8">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input id="email" name="email" type="email" class="form-control" autofocus required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input id="password" name="password" type="password" class="form-control" required>
                </div>
                <button class="btn btn-primary w-100" type="submit">Login</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>