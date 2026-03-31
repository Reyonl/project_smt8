<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->order_code }}</title>
    <style>
        body { font-family: sans-serif; color: #333; margin: 0; padding: 0; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; font-size: 16px; line-height: 24px; }
        .invoice-box table { width: 100%; line-height: inherit; text-align: left; border-collapse: collapse; }
        .invoice-box table td { padding: 5px; vertical-align: top; }
        .invoice-box table tr td:nth-child(2) { text-align: right; }
        .invoice-box table tr.top table td { padding-bottom: 20px; }
        .invoice-box table tr.top table td.title { font-size: 45px; line-height: 45px; color: #333; }
        .invoice-box table tr.information table td { padding-bottom: 40px; }
        .invoice-box table tr.heading td { background: #eee; border-bottom: 1px solid #ddd; font-weight: bold; }
        .invoice-box table tr.details td { padding-bottom: 20px; }
        .invoice-box table tr.item td { border-bottom: 1px solid #eee; }
        .invoice-box table tr.item.last td { border-bottom: none; }
        .invoice-box table tr.total td:nth-child(2) { border-top: 2px solid #eee; font-weight: bold; }
        .badge { padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold; }
        .badge-success { background: #dcfce7; color: #166534; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h2 style="margin:0; color:#4f46e5;">JW</h2>
                            </td>
                            <td>
                                Invoice #: {{ $order->order_code }}<br>
                                Tanggal: {{ $order->created_at->format('d F Y') }}<br>
                                Status: <span class="badge badge-success">LUNAS</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong>Penerbit:</strong><br>
                                Jasa Website Inc.<br>
                                admin@jasa-website.com
                            </td>
                            <td>
                                <strong>Klien:</strong><br>
                                {{ $order->user->name }}<br>
                                {{ $order->user->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Item Layanan</td>
                <td>Harga</td>
            </tr>
            <tr class="item last">
                <td>
                    {{ $order->package_id ? $order->package->name : 'Custom Order Website' }}
                    <br>
                    <small style="color:#666;">{{ $order->order_code }}</small>
                </td>
                <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td></td>
                <td>Total: Rp {{ number_format($order->price, 0, ',', '.') }}</td>
            </tr>
        </table>
        <div style="margin-top: 50px; text-align: center; border-top: 1px solid #eee; padding-top: 20px;">
            <p style="font-size: 12px; color: #666;">Terima kasih atas kepercayaan Anda menggunakan jasa kami.</p>
        </div>
    </div>
</body>
</html>
