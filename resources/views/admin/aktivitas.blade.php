<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
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
                <div class="aktivitas-item">
                    <div class="item-left">
                        <div class="item-title">Mie ayam</div>
                        <div class="item-time">36 Menit Yang Lalu</div>
                    </div>
                    <div class="item-price ">-Rp 10.000</div>
                </div>

                <div class="aktivitas-item">
                    <div class="item-left">
                        <div class="item-title">Mie ayam</div>
                        <div class="item-time">36 Menit Yang Lalu</div>
                    </div>
                    <div class="item-price ">-Rp 10.000</div>
                </div>
                <div class="aktivitas-item">
                    <div class="item-left">
                        <div class="item-title">Mie ayam</div>
                        <div class="item-time">36 Menit Yang Lalu</div>
                    </div>
                    <div class="item-price">-Rp 10.000</div>
                </div>
                <div class="aktivitas-item">
                    <div class="item-left">
                        <div class="item-title">Mie ayam</div>
                        <div class="item-time">36 Menit Yang Lalu</div>
                    </div>
                    <div class="item-price">-Rp 10.000</div>
                </div>
                <div class="aktivitas-item">
                    <div class="item-left">
                        <div class="item-title">Mie ayam</div>
                        <div class="item-time">36 Menit Yang Lalu</div>
                    </div>
                    <div class="item-price">-Rp 10.000</div>
                </div>
                <div class="aktivitas-item">
                    <div class="item-left">
                        <div class="item-title">Mie ayam</div>
                        <div class="item-time">36 Menit Yang Lalu</div>
                    </div>
                    <div class="item-price">-Rp 10.000</div>
                </div>
                <div class="aktivitas-item">
                    <div class="item-left">
                        <div class="item-title">Mie ayam</div>
                        <div class="item-time">36 Menit Yang Lalu</div>
                    </div>
                    <div class="item-price">-Rp 10.000</div>
                </div>
                <div class="aktivitas-item">
                    <div class="item-left">
                        <div class="item-title">Mie ayam</div>
                        <div class="item-time">36 Menit Yang Lalu</div>
                    </div>
                    <div class="item-price">-Rp 10.000</div>
                </div>
                <div class="aktivitas-item">
                    <div class="item-left">
                        <div class="item-title">Mie ayam</div>
                        <div class="item-time">36 Menit Yang Lalu</div>
                    </div>
                    <div class="item-price">-Rp 10.000</div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>

</html>