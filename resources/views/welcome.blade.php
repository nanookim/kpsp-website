<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - KPSP</title>

    <style>
        html, body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #fffdfc;
            color: #1b1b18;
            overflow-x: hidden;
        }
        *, *::before, *::after { box-sizing: inherit; }

        /* HEADER */
        header {
            width: 100%;
            background-color: #fff2f2;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        header h1 {
            font-size: 22px;
            font-weight: 700;
            color: #f53003;
            margin: 0;
            flex: 1;
        }

        nav {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            justify-content: flex-end;
            align-items: center;
            max-width: 100%;
        }

        nav a {
            text-decoration: none;
            color: #1b1b18;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 6px;
            transition: 0.3s;
        }

        nav a:hover {
            background-color: #ffe4e1;
            color: #f53003;
        }

        nav a.active {
            background-color: #f53003;
            color: #fff;
        }

        /* MAIN */
        main {
            max-width: 1100px;
            margin: 60px auto;
            padding: 0 20px;
            text-align: center;
        }

        main h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        main p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
            max-width: 720px;
            margin: 0 auto 30px;
        }

        /* MENU GRID */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 22px;
            margin-top: 40px;
        }

        .menu-item {
            background-color: #fff7f5;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: 0.3s;
            text-align: center;
            text-decoration: none;
            color: #1b1b18;
        }

        .menu-item:hover {
            background-color: #ffe5e2;
            transform: translateY(-4px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.08);
        }

        .menu-item strong {
            display: block;
            font-size: 17px;
            margin-bottom: 6px;
        }

        .menu-item small {
            color: #666;
            font-size: 14px;
        }

        /* FOOTER */
        footer {
            background-color: #f8f8f8;
            text-align: center;
            padding: 18px 0;
            font-size: 13px;
            color: #666;
            margin-top: 60px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                text-align: center;
                gap: 12px;
            }
            nav {
                justify-content: center;
            }
            main h2 {
                font-size: 24px;
            }
            .menu-item {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<!-- HEADER -->
<header>
    <h1>Dashboard Admin - DDTKA</h1>
    <nav>
        <a href="{{ route('users.index') }}" class="{{ request()->is('users*') ? 'active' : '' }}">Users</a>
        <a href="{{ route('anak.index') }}" class="{{ request()->is('anak*') ? 'active' : '' }}">Children</a>
        <a href="{{ route('kpsp-set.index') }}" class="{{ request()->is('kpsp-set*') ? 'active' : '' }}">Set Pertanyaan</a>
        <a href="{{ route('kpsp-pertanyaan.index') }}" class="{{ request()->is('kpsp-pertanyaan*') ? 'active' : '' }}">Pertanyaan</a>
        <a href="{{ route('kpsp-skrining.index') }}" class="{{ request()->is('kpsp-skrining*') ? 'active' : '' }}">Skrining</a>
{{--        <a href="{{ route('kpsp-jawaban.index') }}" class="{{ request()->is('kpsp-jawaban*') ? 'active' : '' }}">Jawaban</a>--}}
{{--        <a href="{{ route('kpsp.index') }}" class="{{ request()->routeIs('kpsp.*') ? 'active' : '' }}">KPSP</a>--}}
    </nav>
</header>

<!-- MAIN -->
<main>
    <h2>Selamat Datang di Dashboard Admin</h2>
    <p>Kelola data pengguna, anak, serta seluruh komponen KPSP dari satu tempat yang efisien dan mudah digunakan.</p>

    <div class="menu-grid">
        <a href="{{ route('users.index') }}" class="menu-item">
            <strong>Users</strong>
            <small>Manajemen akun pengguna</small>
        </a>
        <a href="{{ route('anak.index') }}" class="menu-item">
            <strong>Children</strong>
            <small>Data anak dan perkembangannya</small>
        </a>
        <a href="{{ route('kpsp-set.index') }}" class="menu-item">
            <strong>Set Pertanyaan</strong>
            <small>Kelola grup pertanyaan KPSP</small>
        </a>
        <a href="{{ route('kpsp-pertanyaan.index') }}" class="menu-item">
            <strong>Pertanyaan</strong>
            <small>Daftar pertanyaan skrining</small>
        </a>
        <a href="{{ route('kpsp-skrining.index') }}" class="menu-item">
            <strong>Skrining</strong>
            <small>Lihat hasil pemeriksaan</small>
        </a>
{{--        <a href="{{ route('kpsp-jawaban.index') }}" class="menu-item">--}}
{{--            <strong>Jawaban</strong>--}}
{{--            <small>Hasil respons peserta</small>--}}
{{--        </a>--}}
{{--        <a href="{{ route('kpsp.index') }}" class="menu-item">--}}
{{--            <strong>KPSP</strong>--}}
{{--            <small>Manajemen data KPSP</small>--}}
{{--        </a>--}}
    </div>
</main>

<!-- FOOTER -->
<footer>
    © 2025 Posyandu Digital – Sistem Pemeriksaan & Skrining KPSP Admin
</footer>

</body>
</html>
