<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #000;
            margin: 0;
        }

        .container {
            padding: 20px;
        }

        h1, h2, h3 {
            text-align: center;
            margin: 0 0 15px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }

        .footer {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>

<body>

<div class="container">
    @yield('content')
</div>

<div class="footer">
    Dicetak otomatis - {{ date('Y-m-d') }}
</div>

</body>
</html>