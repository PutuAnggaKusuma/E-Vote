<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>VOTING</title>
</head>
<body>
    <div class="container py-5 px-3">
        <div class="row">
            @foreach ($kandidats as $kandidat)
                <div class="col">
                    <div class="p-4 d-flex flex-column justify-content-center align-items-center gap-4 rounded shadow-lg">
                        <img style="width: 100%; max-height: 200px; object-fit:fill;" src="{{asset('storage/' . $kandidat->foto)}}" alt="Foto Kandidat">
                        <div></div>
                        <h2 style="width: fit-content; aspect-ratio: 1/1;" class="bg-primary text-light text-center rounded-circle">{{$kandidat->nomor_pasangan}}</h2>
                        <span>{{$kandidat->nama_kepala . ' & ' . $kandidat->nama_wakil_kepala}}</span>
                        <div class="w-100 d-grid gap-2">
                            <h4>Visi</h4>
                            <p>{{$kandidat->visi}}</p>
                        </div>
                        <div class="w-100 d-grid gap-2">
                            <h4>Misi</h4>
                            <p>{{$kandidat->misi}}</p>
                        </div>
                        <form method="POST" action="{{route('user.vote', $user->id)}}" class="d-flex justify-content-between align-items-center">
                            @csrf
                            <input type="hidden" name="id_penduduks" id="id_penduduks" value="{{$user->id_penduduks}}">
                            <input type="hidden" name="id_kandidats" id="id_kandidats" value="{{$kandidat->id}}">
                            <button type="submit" class="btn btn-primary">Vote!</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>