<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Pro CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    <style>
        body {
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 240px;
            background: #212529;
            color: white;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #adb5bd;
            text-decoration: none;
        }
        .sidebar a.active, .sidebar a:hover {
            background: #343a40;
            color: white;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h4 class="p-3">KPSP Admin</h4>

    {{-- Users --}}
    <a href="{{ route('users.index') }}"
       class="{{ request()->is('users*') ? 'active' : '' }}">
        👤 Users
    </a>

    {{-- Children --}}
    <a href="{{ route('children.index') }}"
       class="{{ request()->is('children*') ? 'active' : '' }}">
        👶 Children
    </a>

    {{-- KPSP Set Pertanyaan --}}
    <a href="{{ route('kpsp-set.index') }}"
       class="{{ request()->is('kpsp-set*') ? 'active' : '' }}">
        📂 Set Pertanyaan
    </a>

    {{-- KPSP Pertanyaan --}}
    <a href="{{ route('kpsp-pertanyaan.index') }}"
       class="{{ request()->is('kpsp-pertanyaan*') ? 'active' : '' }}">
        ❓ Pertanyaan
    </a>

    {{-- KPSP Skrining --}}
    <a href="{{ route('kpsp-skrining.index') }}"
       class="{{ request()->is('kpsp-skrining*') ? 'active' : '' }}">
        🩺 Skrining
    </a>

    {{-- KPSP Jawaban --}}
    <a href="{{ route('kpsp-jawaban.index') }}"
       class="{{ request()->is('kpsp-jawaban*') ? 'active' : '' }}">
        ✅ Jawaban
    </a>

    {{-- KPSP User --}}
    <a href="{{ route('kpsp.index') }}"
       class="{{ request()->routeIs('kpsp.*') ? 'active' : '' }}">
        📝 KPSP
    </a>
</div>



<div class="content">
    <nav class="navbar navbar-light bg-light mb-3 shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand">Dashboard</span>
            <div>
                <button class="btn btn-sm btn-outline-secondary" onclick="toggleDark()">🌙 Dark</button>
            </div>
        </div>
    </nav>
    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    function toggleDark() {
        document.body.classList.toggle('bg-dark');
        document.body.classList.toggle('text-white');
    }
</script>
@stack('scripts')
</body>
</html>
