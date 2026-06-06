<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css')}}">
</head>

<body>
    <div class="wrapper">
        <!-- buat sidebar -->
        <aside class="sidebar">
            <div class="brand">Catatan Keuangan</div>
            <nav>
                <a href="{{ route('admin.dashboard')}}" class="active">Beranda</a>
                <a href="{{ url('/catatan')}}">CatatanTransaksi</a>
                <a href="{{ url('/aktivitas')}}">Aktivitas</a>
            </nav>
            <form action="{{ route('logout')}}"  method="post">
                @csrf
                <button type="submit" class="btn ms-1 logout">logout</button>
            </form>
        </aside>

        <main class="main">

            <!-- Judul  -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="page-title">Beranda</div>
                <div class="page-title">{{ Auth::user()->name }}</div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">   
                    {{session('success')}} 
                </div>
            @endif
            <!-- card -->
            <div class="stat-cards">
                <div class="stat-card card-saldo">
                    <h4>Total Saldo</h4>
                    <div class="nominal">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                </div>
                <div class="stat-card card-masuk">
                    <h4>Pemasukan</h4>
                    <div class="nominal">Rp {{ number_format($pemasukan, 0, ',', '.') }}</div>
                </div>
                <div class="stat-card card-keluar">
                    <h4>Pengeluaran</h4>
                    <div class="nominal">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</div>
                </div>
            </div>


            <div class="bottom-row">

                <!-- Transaksi -->
                    <div class="transaksi-box">
    <h4>Transaksi Terbaru</h4>
    
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
                    <div class="transaksi-item" style="justify-content: center;">
                        <span style="color: #777;">Belum Ada Transaksi</span>
                    </div>
            @endforelse
            </div>

    </div> 

                <div class="right-col">

                    <!-- Ringkasan Bulan Ini -->
                    <div class="bulan-box">
                        <h4>Bulan Ini</h4>
                        <div class="periode">{{ now()->translatedFormat('F Y')}}</div>
                        <div class="bulan-row">
                            <span>Pemasukan</span>
                            <span class="masuk">Rp {{ number_format($pemasukan, 0, ',', '.') }}</span>
                        </div>
                        <div class="bulan-row">
                            <span>Pengeluaran</span>
                            <span class="keluar">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</span>
                        </div>
                        <div class="bulan-row saldo">
                            <span>Saldo</span>
                            <span>Rp {{ number_format($pemasukan - $pengeluaran, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- target -->
                <div class="goals-box">
                    <h4>Target goals</h4>
                    <div class="goal-item">01 Agustus 2026</div>
                    <div class="goal-item">Rp: 500.000</div>
                </div>
            </div>

        </main>
    </div>
</body>

</html>