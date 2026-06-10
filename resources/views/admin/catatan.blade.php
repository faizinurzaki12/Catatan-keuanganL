<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/catatan.css')}}">
</head>

<body>
    <div class="wrapper">
        <!-- navbar humberger  -->
        <nav class="navbar navbar-expand-md navbar-light bg-light d-block d-md-none px-3 shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Catatan Keuangan</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('/catatan') }}">Catatan Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/aktivitas') }}">Aktivitas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- buat sidebar -->
        <aside class="sidebar d-none d-md-flex">
            <div class="brand">Catatan Keuangan</div>
            <nav>
                <a href="{{ route('admin.dashboard') }}">Beranda</a>
                <a href="{{ url('/catatan') }}" class="active">CatatanTransaksi</a>
                <a href="{{ url('/aktivitas') }}">Aktivitas</a>
            </nav>
            <form action="{{ route('logout') }}" method="post" class="mt-auto w-100">
                @csrf
                <button type="submit" class="btn logout text-start p-0">Logout</button>
            </form>

        </aside>

        <main class="main">
            <div class="row justify-content-end me-2">
                <a class="page-title" style="text-decoration: none;" href="#">Print</a>
            </div>
            <div class="container-fluid caption-top m-0 p-0">
                <div class="table-container">
                    <caption>
                        <h3>Catatan Transaksi</h3>
                    </caption>
                    <div class="table-responsive"
                        style="width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch;">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="table-bg p-2">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Pemasukan</th>
                                    <th scope="col">Pengeluaran</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ( $catatanTransaksi as $item )
                                <tr>
                                    <th scope="row">{{ $loop->iteration}}</th>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                    <td class="text-success">
                                        @if($item->tipe == 'pemasukan')
                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-danger">
                                        @if($item->tipe == 'pengeluaran')
                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->deskripsi }}</td>
                                </tr>   
                                @empty 
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        belum ada transaksi
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</body>

</html>