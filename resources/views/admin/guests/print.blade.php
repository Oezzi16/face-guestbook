<!DOCTYPE html>
<html>
<head>
    <title>Daftar Tamu</title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 2cm;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: white;
        }

        .container {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 10mm auto;
            background: white;
            box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }

        @media print {
            .container {
                width: 100%;
                box-shadow: none;
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 12px;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="print-btn no-print">Cetak</button>
    
    <div class="container">
        <div class="header">
            <h2>Daftar Tamu</h2>
            <p>Periode: {{ request('start_date') ?? 'Semua' }} s/d {{ request('end_date') ?? 'Semua' }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Pesan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guests as $guest)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $guest->name }}</td>
                    <td>{{ $guest->email }}</td>
                    <td>{{ $guest->phone }}</td>
                    <td>{{ $guest->message }}</td>
                    <td>{{ $guest->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>