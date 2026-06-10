<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivitas Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/aktivitas.css') }}">
</head>

<body>

    <div class="wrapper">
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
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/catatan') }}">Catatan Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/aktivitas') }}">Aktivitas</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="post" class="mt-auto w-100">
                                @csrf
                                <button type="submit" class="btn text-danger logout text-start p-0">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <aside class="sidebar d-none d-md-flex">
            <div class="brand">Catatan Keuangan</div>
            <nav>
                <a href="{{ route('admin.dashboard') }}">Beranda</a>
                <a href="{{ url('/catatan') }}">Catatan Transaksi</a>
                <a href="{{ url('/aktivitas') }}" class="active">Aktivitas</a>
            </nav>
            <form action="{{ route('logout') }}" method="post" class="mt-auto w-100">
                @csrf
                <button type="submit" class="btn logout text-start p-0">Logout</button>
            </form>
        </aside>

        <main class="main">
            <div class="row w-100 m-0">
                <div class="page-title">Semua Aktivitas</div>
            </div>

            @if(session('success'))
                <div class="alert alert-success mx-3">   
                    {{ session('success') }} 
                </div>
            @endif

            <div class="card-container">
                
                <div class="card-aktivitas">
                    <div class="card-header-title">Semua Aktivitas Pemasukan</div>
                    <button type="button" class="btn btn-success btn-md mb-3" data-bs-toggle="modal"
                        data-bs-target="#modalPemasukan">
                        + Pemasukan
                    </button>
                    <div class="list-wrapper">
                        @forelse($aktivitas->where('tipe', 'pemasukan') as $transaksi)
                            <div class="aktivitas-item">
                                <div class="item-left">
                                    <div class="item-title">{{ $transaksi->deskripsi }}</div>
                                    <div class="item-time">{{ $transaksi->created_at->diffForHumans() }}</div>
                                </div>
                                <div class="item-price masuk">+Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</div>
                            </div>
                        @empty
                            <div class="aktivitas-item">
                                <div class="item-left">
                                    <div class="item-title text-muted">Belum Ada Pemasukan</div>
                                </div> 
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="card-aktivitas">
                    <div class="card-header-title">Semua Aktivitas Pengeluaran</div>
                    <button type="button" class="btn btn-danger btn-md mb-3" data-bs-toggle="modal"
                        data-bs-target="#modalPengeluaran">
                        - Pengeluaran
                    </button>
                    <div class="list-wrapper">
                        @forelse($aktivitas->where('tipe', 'pengeluaran') as $transaksi)
                            <div class="aktivitas-item">
                                <div class="item-left">
                                    <div class="item-title">{{ $transaksi->deskripsi }}</div>
                                    <div class="item-time">{{ $transaksi->created_at->diffForHumans() }}</div>
                                </div>
                                <div class="item-price keluar">-Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</div>
                            </div>
                        @empty
                            <div class="aktivitas-item">
                                <div class="item-left">
                                    <div class="item-title text-muted">Belum Ada Pengeluaran</div>
                                </div> 
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="card-aktivitas">
                    <div class="card-header-title">Semua Aktivitas Saldo</div>
                    <div class="list-wrapper" style="margin-top: 55px;"> @forelse($aktivitas as $transaksi)
                            <div class="aktivitas-item">
                                <div class="item-left">
                                    <div class="item-title">{{ $transaksi->deskripsi }}</div>
                                    <div class="item-time">{{ $transaksi->created_at->diffForHumans() }}</div>
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
                                    <div class="item-title text-muted">Belum Ada Transaksi</div>
                                </div> 
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </main>

        <div class="modal fade" id="modalPemasukan" tabindex="-1" role="dialog" aria-labelledby="modalPemasukanLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPemasukanLabel">Uang Masuk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/catatan" method="post">
                            @csrf
                            <input type="hidden" name="tipe" value="pemasukan">

                            <div class="form-grup mb-3">
                                <label class="text-success mb-1" for="deskismatch_pemasukan">Deskripsi</label>
                                <input type="text" id="deskismatch_pemasukan" name="deskripsi" class="form-control"
                                    placeholder="Contoh : Gajihan Masuk..." required>
                            </div>

                            <div class="form-grup mb-3">
                                <label class="text-success mb-1" for="jumlah_pemasukan">Jumlah Pemasukan</label>
                                <div class="input-prefix">
                                    <span>Rp</span>
                                    <input type="number" id="jumlah_pemasukan" name="jumlah" class="form-control" placeholder="0" min="0" required>
                                </div>
                            </div>

                            <button type="submit" class="btn-simpan btn-masuk w-100">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalPengeluaran" tabindex="-1" role="dialog" aria-labelledby="modalPengeluaranLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPengeluaranLabel">Uang Keluar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/catatan" method="post">
                            @csrf
                            <input type="hidden" name="tipe" value="pengeluaran">

                            <div class="form-grup mb-3">
                                <label class="text-danger" for="deskripsi">Deskripsi</label>
                                <input type="text" id="deskripsi" name="deskripsi" class="form-control"
                                    placeholder="Contoh : Beli Makanan..." required>
                            </div>

                            <div class="form-grup mb-3">
                                <label class="text-danger" for="jumlah">Jumlah Pengeluaran</label>
                                <div class="input-prefix">
                                    <span>Rp</span>
                                    <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="0" min="0" required>
                                </div>
                            </div>

                            <button type="submit" class="btn-simpan btn-keluar w-100">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>