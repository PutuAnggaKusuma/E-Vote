@extends('admin.layout')

@section('title')
    <h1>Data Hasil Voting</h1>
@endsection

@section('content')
<div style="width: 80%; margin: auto;" class="px-4">
    <div class="w-100 d-flex justify-content-between my-4">
        <div>
            <h2>Grafik Hasil Voting</h2>
        </div>
        <div>
            <form action="{{route('hasil-voting')}}" method="GET" class="d-flex gap-4">
                @csrf
                <input id="year" name="year" type="number" min="1900" max="2099" step="1" value="{{$curYear}}" style="border-radius: 3px 0 0 3px; border: none; border: .1px solid black;" />
                <button style="border-radius: 0 3px 3px 0; padding: 0 1.5em;" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>

    <div style="width: 100%;">
        <canvas id="myChart"></canvas>
    </div>
</div>

<hr style="height: 2px; background: black; margin: 3em 0;">

<div style="width: 80%; margin: auto;">
    <div style="width: 100%;" class="p-4">
        <div>
            <h2>Tabel Hasil Voting</h2>
        </div>
    </div>
    <div style="width: 100%;" class="table-bordered">
        <table style="width: 100%;" class="display nowrap table" id="tableVote">
            <caption style="text-align: end;">Hasil Voting Pemilihan Kepala Desa - Tahun {{$curYear}}</caption>
            <thead>
                <tr>
                    <td class="font-weight-bold" style="font-size: .9em">#</td>
                    <td class="font-weight-bold" style="font-size: .9em">Pasangan Calon</td>
                    <td class="font-weight-bold" style="font-size: .9em">Nomor</td>
                    <td class="font-weight-bold" style="font-size: .9em">Jumlah Suara</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($resultArray as $vote)
                    <tr>
                        <td class="text-center" style="font-size: .85em">{{$loop->iteration}}</td>
                        <td style="font-size: .85em">{{$vote->label}}</td>
                        <td class="text-right" style="font-size: .85em">{{$vote->noPaslon}}</td>
                        <td class="text-right" style="font-size: .85em">{{$vote->totalVote}}</td>
                    </tr>
                @empty

                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    let label = [
        @foreach ($resultArray as $array)
            '{{$array->label}}',
        @endforeach
    ];
    
    let totalVote = [
        @foreach ($resultArray as $array)
            '{{$array->totalVote}}',
        @endforeach    
    ];
  
  var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: label,
            datasets: [{
                label: 'Grafik Hasil Voting',
                data: totalVote,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
  
</script>
<script>
    function printTable() {
        var table = document.getElementById("tableVote");
        var win = window.open("", "Print", "width=800px,height=700px");
        win.document.write('<html><head><title>Cetak Tabel</title>');
        win.document.write('</head><body>');
        win.document.write(table.outerHTML);
        win.document.write('</body></html>');
        win.document.close();
        win.print();
    }
</script>
@endsection