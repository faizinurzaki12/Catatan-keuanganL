<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
</head>

<body>
    <div class="wrapper">
        <!-- navbar humberger (Mobile View Only) -->
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
                            <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/catatan') }}">Catatan Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/aktivitas') }}">Aktivitas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- buat sidebar (Desktop View Only) -->
        <aside class="sidebar d-none d-md-flex">
            <div class="brand">Catatan Keuangan</div>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="active">Beranda</a>
                <a href="{{ url('/catatan') }}">Catatan Transaksi</a>
                <a href="{{ url('/aktivitas') }}">Aktivitas</a>
            </nav>
            <form action="{{ route('logout') }}" method="post" class="mt-auto w-100">
                @csrf
                <button type="submit" class="btn logout text-start p-0">Logout</button>
            </form>
        </aside>

        <main class="main">

            <!-- Judul  -->
            <div class="d-flex page-title justify-content-between align-items-center mb-3">
                <div>Beranda</div>
                <div>{{ Auth::user()->name }}</div>
            </div>

            <!-- Flash Message Success -->
            @if(session('success'))
                <div class="alert alert-success">   
                    {{ session('success') }} 
                </div>
            @endif

            <!-- card -->
            <div class="stat-cards">
                <div class="stat-card card-saldo">
                    <h2>Total Saldo</h2>
                    <div class="nominal">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                </div>
                <div class="stat-card card-masuk">
                    <h2>Pemasukan</h2>
                    <div class="nominal">Rp {{ number_format($pemasukan, 0, ',', '.') }}</div>
                </div>
                <div class="stat-card card-keluar">
                    <h2>Pengeluaran</h2>
                    <div class="nominal">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</div>
                </div>
            </div>


            <div class="bottom-row">

                <!-- Transaksi Terbaru -->
                <div class="transaksi-box">
                    <h3>Transaksi Terbaru</h3>
                    <div class="transaksi-list">
                        @forelse ($transaksiTerbaru as $transaksi)
                            <div class="transaksi-item">
                                <span class="nama">{{ $transaksi->deskripsi }}</span>
                                
                                @if($transaksi->tipe == 'pemasukan')
                                    <span class="nominal-masuk">
                                        +Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                                    </span>
                                @else 
                                    <span class="nominal-keluar">
                                        -Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                                    </span>
                                @endif
                            </div>
                        @empty
                            <div class="transaksi-item">
                                <span>Belum Ada Transaksi</span>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Kolom Kanan (Bulan Ini & Goals) -->
                <div class="right-col">

                    <!-- Ringkasan Bulan Ini -->
                    <div class="bulan-box">
                        <h3>Bulan Ini</h3>
                        <div class="periode">{{ now()->translatedFormat('F Y') }}</div>
                        <div class="bulan-row">
                            <span class="pemasukan">Pemasukan</span>
                            <span class="masuk">Rp {{ number_format($pemasukan, 0, ',', '.') }}</span>
                        </div>
                        <div class="bulan-row">
                            <span class="pengeluaran">Pengeluaran</span>
                            <span class="keluar">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</span>
                        </div>
                        <div class="bulan-row saldo">
                            <span>Saldo</span>
                            <span>Rp {{ number_format($pemasukan - $pengeluaran, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Target Goals -->
                    <div class="goals-box">
                        <h3>Target goals</h3>
                        <div class="goal-item">01 Agustus 2026</div>
                        <div class="goal-item">Rp: 500.000</div>
                    </div>

                </div>
            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>