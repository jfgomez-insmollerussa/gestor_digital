<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titol', 'Digital Signage IES Mollerussa')</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f8;
            color: #222;
        }

        header {
            background-color: #1f2937;
            color: white;
            padding: 20px 28px;
        }

        nav {
            margin-top: 12px;
        }

        nav a {
            color: white;
            margin-right: 16px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        main {
            max-width: 1100px;
            margin: 30px auto;
            padding: 24px;
            background-color: white;
            border: 1px solid #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th,
        td {
            border-bottom: 1px solid #e5e7eb;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f9fafb;
        }

        label {
            display: block;
            font-weight: bold;
            margin: 14px 0 6px;
        }

        input,
        select,
        textarea {
            box-sizing: border-box;
            width: 100%;
            padding: 9px;
            border: 1px solid #cbd5e1;
            font: inherit;
        }

        input[type="checkbox"] {
            width: auto;
        }

        textarea {
            min-height: 120px;
        }

        button,
        .button {
            display: inline-block;
            border: 0;
            background-color: #1f2937;
            color: white;
            padding: 9px 13px;
            text-decoration: none;
            font: inherit;
            cursor: pointer;
        }

        .button.secondary,
        button.secondary {
            background-color: #64748b;
        }

        .button.danger,
        button.danger {
            background-color: #b91c1c;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .status {
            padding: 12px;
            background-color: #dcfce7;
            border: 1px solid #86efac;
            margin-bottom: 18px;
        }

        .errors {
            padding: 12px;
            background-color: #fee2e2;
            border: 1px solid #fca5a5;
            margin-bottom: 18px;
        }

        .muted {
            color: #64748b;
        }

        footer {
            text-align: center;
            padding: 16px;
            background-color: #e5e7eb;
            color: #444;
        }
    </style>
</head>
<body>
    <header>
        <h1>Digital Signage IES Mollerussa</h1>
        <nav>
            <a href="{{ route('inici') }}">Inici</a>
            <a href="{{ route('admin.screens.index') }}">Pantalles</a>
            <a href="{{ route('admin.manual-slides.index') }}">Continguts manuals</a>
        </nav>
    </header>

    <main>
        @if (session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="errors">
                <strong>Revisa el formulari:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('contingut')
    </main>

    <footer>
        <p>Gestor Digital Signage - Edifici H</p>
    </footer>
</body>
</html>
