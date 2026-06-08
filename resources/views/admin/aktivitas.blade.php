<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/aktivitas.css')}}">
</head>

<body>

    <div class="wrapper">
    <aside class="sidebar">
        <div class="brand">Catatan Keuangan</div>
        <nav>
            <a href="{{ route('admin.dashboard')}}">Beranda</a>
            <a href="{{ url('/catatan')}}">CatatanTransaksi</a>
            <a href="{{ url('/aktivitas')}}" class="active">Aktivitas</a>
        </nav>
        <form action="{{ route('logout')}}"  method="post">
            @csrf
            <button type="submit" class="btn ms-1 logout">logout</button>
        </form>
    </aside>

    <main class="main">
        <div class="page-title">Aktivitas</div>

        <div class="card-aktivitas">
            <div class="card-header-title">Aktivitas</div>
            
            <div class="list-wrapper">
                @forelse($aktivitas as $transaksi)
                <div class="aktivitas-item">
                    <div class="item-left">
                        <div class="item-title">{{ $transaksi->deskripsi}}</div>
                        <div class="item-time">{{ $transaksi->created_at->diffForHumans()}}</div>
                    </div>
                    @if($transaksi->tipe == 'pemasukan')
                    <div class="item-price masuk">+Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</div>
                    @else
                    <div class="item-price keluar">-Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</div>
                    @endif
                </div>
                @empty
                <div class="aktivitas-item">
                    <div class="item-left">
                        <div class="item-title">Belum Ada Transaksi</div>
                    </div> 
                </div>
                @endforelse
            </div>
        </div>
    </main>
</div>
</body>

</html>