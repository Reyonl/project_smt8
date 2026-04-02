<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Transaksi — {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #1e293b;
            background: #fff;
            font-size: 12px;
            line-height: 1.5;
        }

        /* Print-specific styles */
        @media print {
            body { background: #fff; }
            .no-print { display: none !important; }
            .page-break { page-break-before: always; }
            table { page-break-inside: auto; }
            tr { page-break-inside: avoid; }
            @page {
                margin: 1.5cm;
                size: A4;
            }
        }

        /* Screen-specific styles */
        @media screen {
            body { background: #f1f5f9; padding: 40px; }
            .report-container {
                max-width: 900px;
                margin: 0 auto;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                padding: 48px;
            }
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 36px;
            padding-bottom: 24px;
            border-bottom: 2px solid #e2e8f0;
        }
        .header-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .header-logo .logo-box {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
        }
        .header-logo h1 {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
        }
        .header-logo p {
            color: #64748b;
            font-size: 11px;
        }
        .header-meta {
            text-align: right;
            font-size: 11px;
            color: #64748b;
        }
        .header-meta strong {
            color: #0f172a;
            display: block;
            font-size: 14px;
            margin-bottom: 4px;
        }

        h2 {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            margin: 32px 0 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Summary cards */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 32px;
        }
        .summary-card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px;
            text-align: center;
        }
        .summary-card .label {
            font-size: 10px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }
        .summary-card .value {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
        }
        .summary-card.green { border-color: #a7f3d0; background: #f0fdf4; }
        .summary-card.green .value { color: #059669; }
        .summary-card.amber { border-color: #fde68a; background: #fffbeb; }
        .summary-card.amber .value { color: #d97706; }
        .summary-card.red { border-color: #fecaca; background: #fef2f2; }
        .summary-card.red .value { color: #dc2626; }

        /* Monthly table */
        .monthly-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 32px;
        }
        .monthly-table th {
            background: #f8fafc;
            padding: 10px 12px;
            text-align: left;
            font-size: 10px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e2e8f0;
        }
        .monthly-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 12px;
        }
        .monthly-table td.number {
            text-align: right;
            font-weight: 600;
            font-variant-numeric: tabular-nums;
        }
        .monthly-table tr:last-child td { border-bottom: none; }
        .monthly-table tfoot td {
            font-weight: 700;
            border-top: 2px solid #e2e8f0;
            background: #f8fafc;
        }

        /* Orders table */
        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }
        .orders-table th {
            background: #f8fafc;
            padding: 8px 10px;
            text-align: left;
            font-size: 9px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e2e8f0;
        }
        .orders-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 11px;
            vertical-align: middle;
        }
        .orders-table tr:nth-child(even) { background: #fafbfc; }
        .orders-table .code {
            font-family: 'SFMono-Regular', monospace;
            font-weight: 600;
            font-size: 10px;
        }
        .orders-table .number {
            text-align: right;
            font-weight: 600;
            font-variant-numeric: tabular-nums;
        }

        /* Status badges (print-friendly) */
        .status {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status.paid { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .status.pending { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
        .status.review { background: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; }
        .status.failed { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        .footer {
            margin-top: 48px;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: #94a3b8;
        }

        /* Action bar */
        .action-bar {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            gap: 8px;
            z-index: 100;
        }
        .action-bar button, .action-bar a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-print {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 4px 12px rgba(15,23,42,0.3);
        }
        .btn-print:hover { background: #1e293b; transform: translateY(-1px); }
        .btn-back {
            background: #fff;
            color: #475569;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .btn-back:hover { background: #f8fafc; }
    </style>
</head>
<body>

    {{-- Floating Action Bar (hidden on print) --}}
    <div class="action-bar no-print">
        <a href="{{ route('admin.dashboard') }}" class="btn-back">
            ← Kembali
        </a>
        <button onclick="window.print()" class="btn-print">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
            Cetak / PDF
        </button>
    </div>

    <div class="report-container">
        {{-- Report Header --}}
        <div class="header">
            <div class="header-logo">
                <div class="logo-box">JW</div>
                <div>
                    <h1>{{ config('app.name', 'Jasa Websites') }}</h1>
                    <p>Laporan Transaksi & Pendapatan</p>
                </div>
            </div>
            <div class="header-meta">
                <strong>Laporan Period</strong>
                Dicetak: {{ now()->translatedFormat('d F Y, H:i') }} WIB<br>
                Oleh: {{ auth()->user()->name }}
            </div>
        </div>

        {{-- Summary --}}
        <h2>📊 Ringkasan Keseluruhan</h2>
        <div class="summary-grid">
            <div class="summary-card">
                <div class="label">Total Pesanan</div>
                <div class="value">{{ $totalOrders }}</div>
            </div>
            <div class="summary-card green">
                <div class="label">Lunas</div>
                <div class="value">{{ $paidOrders }}</div>
            </div>
            <div class="summary-card amber">
                <div class="label">Pending</div>
                <div class="value">{{ $pendingOrders }}</div>
            </div>
            <div class="summary-card red">
                <div class="label">Gagal</div>
                <div class="value">{{ $failedOrders }}</div>
            </div>
        </div>

        <div class="summary-grid" style="grid-template-columns: 1fr;">
            <div class="summary-card green">
                <div class="label">Total Pendapatan (Lunas)</div>
                <div class="value" style="font-size: 24px;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            </div>
        </div>

        {{-- Monthly Summary --}}
        <h2>📅 Ringkasan Bulanan (6 Bulan Terakhir)</h2>
        <table class="monthly-table">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th style="text-align:right">Total Order</th>
                    <th style="text-align:right">Lunas</th>
                    <th style="text-align:right">Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthlyRevenue as $mr)
                    <tr>
                        <td>{{ $mr['month'] }}</td>
                        <td class="number">{{ $mr['total_orders'] }}</td>
                        <td class="number">{{ $mr['paid_orders'] }}</td>
                        <td class="number">Rp {{ number_format($mr['revenue'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>Total</td>
                    <td class="number">{{ array_sum(array_column($monthlyRevenue, 'total_orders')) }}</td>
                    <td class="number">{{ array_sum(array_column($monthlyRevenue, 'paid_orders')) }}</td>
                    <td class="number">Rp {{ number_format(array_sum(array_column($monthlyRevenue, 'revenue')), 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        {{-- Detail Order List --}}
        <h2 class="page-break">📋 Detail Seluruh Pesanan</h2>
        <table class="orders-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Order</th>
                    <th>Pelanggan</th>
                    <th>Paket</th>
                    <th style="text-align:right">Harga</th>
                    <th>Metode Bayar</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $i => $o)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="code">{{ $o->order_code }}</td>
                        <td>{{ optional($o->user)->name ?? 'User #'.$o->user_id }}</td>
                        <td>{{ optional($o->package)->name ?? 'Custom' }}</td>
                        <td class="number">
                            @if($o->price > 0) Rp {{ number_format($o->price, 0, ',', '.') }} @else — @endif
                        </td>
                        <td>{{ optional($o->payment)->payment_method ?? '—' }}</td>
                        <td>
                            @if($o->status === 'paid')
                                <span class="status paid">Lunas</span>
                            @elseif($o->status === 'pending')
                                <span class="status pending">Pending</span>
                            @elseif($o->status === 'pending_review')
                                <span class="status review">Review</span>
                            @else
                                <span class="status failed">{{ ucfirst($o->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $o->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Footer --}}
        <div class="footer">
            <span>{{ config('app.name') }} — Laporan Transaksi</span>
            <span>Halaman 1 | Dicetak {{ now()->format('d/m/Y') }}</span>
        </div>
    </div>

</body>
</html>
