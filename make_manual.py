import base64
import os

files = {
    'homepage': r'C:\Users\ThinkPad\.gemini\antigravity\brain\4b563207-c224-447a-aefd-afdbaa5f07fd\manual_homepage_1775131874472.png',
    'packages': r'C:\Users\ThinkPad\.gemini\antigravity\brain\4b563207-c224-447a-aefd-afdbaa5f07fd\homepage_packages_listing_1775132187470.png',
    'register': r'C:\Users\ThinkPad\.gemini\antigravity\brain\4b563207-c224-447a-aefd-afdbaa5f07fd\manual_register_1775131927957.png',
    'login': r'C:\Users\ThinkPad\.gemini\antigravity\brain\4b563207-c224-447a-aefd-afdbaa5f07fd\manual_login_1775131912001.png',
    'cust_dashboard': r'C:\Users\ThinkPad\.gemini\antigravity\brain\4b563207-c224-447a-aefd-afdbaa5f07fd\customer_dashboard_1775132079317.png',
    'checkout': r'C:\Users\ThinkPad\.gemini\antigravity\brain\4b563207-c224-447a-aefd-afdbaa5f07fd\checkout_page_1775132208787.png',
    'custom_order': r'C:\Users\ThinkPad\.gemini\antigravity\brain\4b563207-c224-447a-aefd-afdbaa5f07fd\custom_order_page_1_1775132106629.png',
    'my_orders': r'C:\Users\ThinkPad\.gemini\antigravity\brain\4b563207-c224-447a-aefd-afdbaa5f07fd\my_orders_page_1775132093106.png',
    'admin_dashboard': r'C:\Users\ThinkPad\.gemini\antigravity\brain\4b563207-c224-447a-aefd-afdbaa5f07fd\admin_dashboard_page_1775133778992.png',
    'admin_orders': r'C:\Users\ThinkPad\.gemini\antigravity\brain\4b563207-c224-447a-aefd-afdbaa5f07fd\admin_orders_list_1775133795997.png',
    'admin_detail': r'C:\Users\ThinkPad\.gemini\antigravity\brain\4b563207-c224-447a-aefd-afdbaa5f07fd\admin_order_detail_1775133810729.png',
    'admin_packages': r'C:\Users\ThinkPad\.gemini\antigravity\brain\4b563207-c224-447a-aefd-afdbaa5f07fd\admin_packages_1775133831134.png',
    'admin_report': r'C:\Users\ThinkPad\.gemini\antigravity\brain\4b563207-c224-447a-aefd-afdbaa5f07fd\admin_report_1775133835520.png',
}

imgs = {}
for k, p in files.items():
    with open(p, 'rb') as f:
        imgs[k] = 'data:image/png;base64,' + base64.b64encode(f.read()).decode()

def img(key, caption):
    return f'''<div class="ss-wrap"><img src="{imgs[key]}" alt="{caption}"><div class="ss-cap"><span class="dot"></span>{caption}</div></div>'''

html = f'''<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manual Book — Jasa Website Indonesia</title>
<style>
*{{box-sizing:border-box;margin:0;padding:0}}
body{{font-family:'Times New Roman',Times,serif;color:#1e293b;background:#f8fafc;font-size:15px;line-height:1.8}}

/* COVER */
.cover{{background:linear-gradient(135deg,#0f172a 0%,#1a2d4f 50%,#0f172a 100%);color:white;min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:60px 40px;page-break-after:always}}
.cover-badge{{background:rgba(99,102,241,.25);border:1px solid rgba(99,102,241,.4);border-radius:50px;padding:8px 24px;font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:#a5b4fc;margin-bottom:32px}}
.cover h1{{font-size:52px;font-weight:900;line-height:1.1;background:linear-gradient(135deg,#60a5fa,#818cf8,#c084fc);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:16px}}
.cover h2{{font-size:18px;font-weight:400;color:#94a3b8;margin-bottom:56px;max-width:500px}}
.cover-cards{{display:flex;gap:20px;justify-content:center;margin-bottom:56px;flex-wrap:wrap}}
.cover-card{{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:24px 32px;min-width:140px}}
.cover-card .icon{{font-size:32px;margin-bottom:10px}}
.cover-card strong{{display:block;color:white;font-size:15px;font-weight:700}}
.cover-card p{{color:#94a3b8;font-size:12px;margin-top:4px}}
.cover-meta{{border-top:1px solid rgba(255,255,255,.1);padding-top:28px;color:#64748b;font-size:12.5px;line-height:2}}

/* TOC */
.toc{{background:white;padding:70px 90px;page-break-after:always}}
.toc h2{{font-size:30px;font-weight:bold;color:#0f172a;margin-bottom:8px;font-family:'Times New Roman',Times,serif}}
.toc-line{{height:4px;width:56px;background:linear-gradient(90deg,#6366f1,#8b5cf6);border-radius:2px;margin-bottom:44px}}
.toc-item{{display:flex;align-items:flex-start;gap:16px;padding:15px 0;border-bottom:1px dashed #e2e8f0}}
.toc-num{{background:linear-gradient(135deg,#6366f1,#8b5cf6);color:white;width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:13px;flex-shrink:0;margin-top:2px}}
.toc-label strong{{display:block;font-size:15px;font-weight:700;color:#1e293b;margin-bottom:2px}}
.toc-label span{{font-size:12px;color:#94a3b8}}

/* SECTION */
.section{{background:white;padding:60px 90px;page-break-before:always}}
.sec-head{{display:flex;align-items:center;gap:16px;margin-bottom:8px}}
.sec-icon{{width:50px;height:50px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0}}
.ic-blue{{background:#eff6ff}}.ic-purple{{background:#f5f3ff}}.ic-green{{background:#f0fdf4}}
.section h2{{font-size:28px;font-weight:bold;color:#0f172a;font-family:'Times New Roman',Times,serif}}
.sec-bar{{height:3px;background:linear-gradient(90deg,#6366f1 60%,transparent);border-radius:2px;margin:16px 0 36px}}

/* SUBSECTION */
.sub{{margin-bottom:44px}}
.sub h3{{font-size:16px;font-weight:700;color:#1e293b;background:#f8fafc;border-left:4px solid #6366f1;padding:10px 16px;border-radius:0 8px 8px 0;margin-bottom:18px}}
.sub p,.sub li{{color:#475569;margin-bottom:8px}}
.sub ul,.sub ol{{padding-left:22px}}

/* STEPS */
.steps{{list-style:none;padding:0;counter-reset:s}}
.steps li{{counter-increment:s;display:flex;gap:12px;align-items:flex-start;margin-bottom:14px;color:#475569}}
.steps li::before{{content:counter(s);background:#6366f1;color:white;width:26px;height:26px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12px;flex-shrink:0;margin-top:2px}}

/* SCREENSHOT */
.ss-wrap{{margin:22px 0;border-radius:12px;overflow:hidden;border:1px solid #e2e8f0;box-shadow:0 4px 20px rgba(0,0,0,.07)}}
.ss-wrap img{{width:100%;display:block}}
.ss-cap{{background:#f8fafc;border-top:1px solid #e2e8f0;padding:10px 16px;font-size:12px;color:#64748b;display:flex;align-items:center;gap:8px}}
.dot{{width:8px;height:8px;border-radius:50%;background:#6366f1;flex-shrink:0}}

/* CALLOUT */
.callout{{border-radius:12px;padding:14px 18px;margin:18px 0;display:flex;gap:12px}}
.c-tip{{background:#f0fdf4;border:1px solid #bbf7d0}}
.c-warn{{background:#fffbeb;border:1px solid #fde68a}}
.c-info{{background:#eff6ff;border:1px solid #bfdbfe}}
.callout .ci{{font-size:18px;flex-shrink:0;margin-top:1px}}
.callout p{{margin:0;font-size:13px}}
.c-tip p{{color:#166534}}.c-warn p{{color:#92400e}}.c-info p{{color:#1e40af}}

/* TABLE */
table{{width:100%;border-collapse:collapse;margin:18px 0;font-size:13px}}
th{{background:#0f172a;color:white;padding:11px 15px;text-align:left;font-weight:600}}
th:first-child{{border-radius:8px 0 0 0}}th:last-child{{border-radius:0 8px 0 0}}
td{{padding:11px 15px;border-bottom:1px solid #f1f5f9;color:#475569}}
tr:nth-child(even) td{{background:#f8fafc}}

/* BADGE */
.bd{{display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700}}
.b-blue{{background:#dbeafe;color:#1d4ed8}}.b-yellow{{background:#fef9c3;color:#a16207}}
.b-orange{{background:#ffedd5;color:#c2410c}}.b-green{{background:#dcfce7;color:#15803d}}.b-red{{background:#fee2e2;color:#b91c1c}}

/* FLOW */
.flow{{background:#0f172a;color:#e2e8f0;border-radius:12px;padding:28px;margin:20px 0;font-family:'Courier New',monospace;font-size:13px;line-height:2;white-space:pre}}

/* FAQ */
.faq{{border:1px solid #e2e8f0;border-radius:12px;padding:20px;margin-bottom:14px}}
.fq{{font-weight:700;color:#1e293b;margin-bottom:8px;display:flex;align-items:flex-start;gap:10px}}
.fq-n{{background:#6366f1;color:white;width:22px;height:22px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;flex-shrink:0;margin-top:2px}}
.fa{{color:#475569;padding-left:32px;font-size:13px}}

/* FOOTER */
.footer{{background:#0f172a;color:#64748b;text-align:center;padding:40px;font-size:12px;line-height:2}}
.footer strong{{color:#94a3b8}}

@media print{{
  body{{background:white}}
  .cover,.toc,.section{{page-break-before:always}}
  .no-break{{page-break-inside:avoid}}
  @page{{margin:12mm;size:A4}}
}}
</style>
</head>
<body>

<div class="cover">
  <div class="cover-badge">User Manual &bull; April 2026</div>
  <h1>Jasa Website<br>Indonesia</h1>
  <h2>Panduan Penggunaan Sistem Pemesanan Website</h2>
  <div class="cover-cards">
    <div class="cover-card"><div class="icon">👥</div><strong>Guest</strong><p>Pengunjung</p></div>
    <div class="cover-card"><div class="icon">🛒</div><strong>Pelanggan</strong><p>Customer</p></div>
    <div class="cover-card"><div class="icon">⚙️</div><strong>Admin</strong><p>Administrator</p></div>
  </div>
  <div class="cover-meta">
    <div>Dokumen ini mencakup panduan lengkap untuk semua peran pengguna</div>
    <div>Versi 1.0 &bull; Sistem Manajemen Pesanan &bull; Jasa Website Indonesia</div>
  </div>
</div>

<div class="toc">
  <h2>Daftar Isi</h2>
  <div class="toc-line"></div>
  <div class="toc-item"><div class="toc-num">1</div><div class="toc-label"><strong>Pendahuluan</strong><span>Gambaran sistem dan peran pengguna</span></div></div>
  <div class="toc-item"><div class="toc-num">2</div><div class="toc-label"><strong>Manual Pelanggan (Customer)</strong><span>Register, Login, Pesan Paket, Custom Order, Pembayaran, Status, Notifikasi</span></div></div>
  <div class="toc-item"><div class="toc-num">3</div><div class="toc-label"><strong>Manual Administrator</strong><span>Dashboard, Manajemen Pesanan, Verifikasi Bayar, Kelola Paket, Laporan</span></div></div>
  <div class="toc-item"><div class="toc-num">4</div><div class="toc-label"><strong>Alur Status Pesanan</strong><span>Flowchart status dari awal hingga selesai</span></div></div>
  <div class="toc-item"><div class="toc-num">5</div><div class="toc-label"><strong>Sistem Notifikasi Lonceng</strong><span>Cara kerja dan membaca notifikasi realtime</span></div></div>
  <div class="toc-item"><div class="toc-num">6</div><div class="toc-label"><strong>FAQ & Pemecahan Masalah</strong><span>Pertanyaan umum dan solusinya</span></div></div>
</div>

<div class="section">
  <div class="sec-head"><div class="sec-icon ic-blue">📘</div><h2>1. Pendahuluan</h2></div>
  <div class="sec-bar"></div>
  <div class="sub">
    <p>Aplikasi <strong>Jasa Website Indonesia</strong> adalah sistem manajemen pesanan layanan pembuatan website yang terintegrasi. Sistem ini memungkinkan pelanggan memesan paket standar maupun mengajukan proyek custom, melakukan pembayaran via transfer bank, dan memantau status pesanan secara realtime melalui dashboard dan notifikasi.</p>
    <br>
    <table>
      <tr><th>Peran</th><th>Keterangan</th><th>Hak Akses</th></tr>
      <tr><td><strong>Guest</strong></td><td>Pengunjung yang belum login</td><td>Beranda, Daftar Paket</td></tr>
      <tr><td><strong>Pelanggan</strong></td><td>Pengguna terdaftar yang dapat memesan layanan</td><td>Dashboard, Pesanan, Pembayaran, Custom Order</td></tr>
      <tr><td><strong>Administrator</strong></td><td>Pengelola sistem dan validasi transaksi</td><td>Semua halaman + Admin Panel</td></tr>
    </table>
  </div>
</div>

<div class="section">
  <div class="sec-head"><div class="sec-icon ic-blue">👤</div><h2>2. Manual Pelanggan (Customer)</h2></div>
  <div class="sec-bar"></div>

  <div class="sub no-break">
    <h3>2.1 Halaman Beranda & Daftar Paket</h3>
    <p>Halaman pertama yang dilihat pengunjung menampilkan seluruh paket layanan website yang tersedia lengkap dengan harga dan fitur. Tidak perlu login untuk melihat informasi paket.</p>
    {img('homepage', 'Halaman Beranda — Tampilan awal website Jasa Website Indonesia')}
    {img('packages', 'Daftar Paket Layanan — Pilih paket yang sesuai kebutuhan Anda')}
  </div>

  <div class="sub no-break">
    <h3>2.2 Registrasi Akun Baru</h3>
    {img('register', 'Halaman Register — Daftarkan akun baru Anda')}
    <ol class="steps">
      <li>Klik tombol <strong>"Register"</strong> di pojok kanan atas navbar.</li>
      <li>Isi form: Nama Lengkap, Email, Password (minimal 8 karakter), dan Konfirmasi Password.</li>
      <li>Klik <strong>"Register"</strong> untuk membuat akun dan masuk ke Dashboard.</li>
    </ol>
    <div class="callout c-tip"><div class="ci">💡</div><p>Gunakan email yang aktif. Semua notifikasi status pesanan akan dikirim melalui sistem in-app notification.</p></div>
  </div>

  <div class="sub no-break">
    <h3>2.3 Login ke Akun</h3>
    {img('login', 'Halaman Login — Masuk ke akun Anda yang sudah terdaftar')}
    <ol class="steps">
      <li>Klik tombol <strong>"Login"</strong> di navbar.</li>
      <li>Masukkan <strong>Email</strong> dan <strong>Password</strong> yang sudah terdaftar.</li>
      <li>Klik <strong>"Log In"</strong> untuk masuk.</li>
    </ol>
  </div>

  <div class="sub no-break">
    <h3>2.4 Dashboard Pelanggan</h3>
    {img('cust_dashboard', 'Dashboard Pelanggan — Ringkasan aktivitas dan statistik pesanan Anda')}
    <p>Dashboard menampilkan: total pesanan, jumlah pesanan aktif, total pengeluaran, dan riwayat pesanan terbaru secara sekilas.</p>
  </div>

  <div class="sub no-break">
    <h3>2.5 Memesan Paket Website (Standar)</h3>
    {img('checkout', 'Halaman Checkout — Konfirmasi pesanan sebelum pembayaran')}
    <ol class="steps">
      <li>Pilih paket di halaman Beranda atau menu <strong>"Paket"</strong>.</li>
      <li>Klik <strong>"Pesan Sekarang"</strong> pada paket pilihan Anda.</li>
      <li>Periksa ringkasan pesanan: nama paket dan total tagihan.</li>
      <li>Klik <strong>"Arahkan ke Pembayaran"</strong> untuk menuju halaman transfer bank.</li>
    </ol>
  </div>

  <div class="sub no-break">
    <h3>2.6 Mengajukan Custom Order</h3>
    {img('custom_order', 'Form Custom Order — Ajukan proyek website dengan spesifikasi khusus')}
    <ol class="steps">
      <li>Akses menu <strong>Custom Order</strong> dari Dashboard atau URL <code>/custom-order</code>.</li>
      <li>Isi <strong>Nama Proyek</strong> dan <strong>Kategori Proyek</strong> (wajib).</li>
      <li>Deskripsikan <strong>Fitur yang Diinginkan</strong> secara detail — semakin rinci, semakin akurat estimasi harga.</li>
      <li>Pilih <strong>Estimasi Anggaran</strong> (opsional).</li>
      <li>Klik <strong>"Kirim Form Pengajuan"</strong>.</li>
    </ol>
    <div class="callout c-info"><div class="ci">ℹ️</div><p>Pengajuan Custom Order <strong>gratis dan tidak mengikat</strong>. Admin akan merespons dalam 1×24 jam kerja. Pembayaran hanya dilakukan setelah Anda menyetujui harga yang ditawarkan Admin.</p></div>
  </div>

  <div class="sub no-break">
    <h3>2.7 Memantau Status Pesanan</h3>
    {img('my_orders', 'Halaman Pesanan Saya — Pantau semua pesanan dan status terkininya')}
    <table>
      <tr><th>Status</th><th>Indikator</th><th>Keterangan</th></tr>
      <tr><td><span class="bd b-blue">Pending Review</span></td><td>🔵</td><td>Admin sedang meninjau Custom Order Anda</td></tr>
      <tr><td><span class="bd b-yellow">Pending</span></td><td>🟡</td><td>Menunggu pembayaran dari Anda</td></tr>
      <tr><td><span class="bd b-orange">Pending Verification</span></td><td>🟠</td><td>Bukti transfer diunggah, menunggu konfirmasi Admin</td></tr>
      <tr><td><span class="bd b-green">Paid</span></td><td>🟢</td><td>Pembayaran terverifikasi — Pesanan Lunas!</td></tr>
      <tr><td><span class="bd b-red">Cancelled</span></td><td>🔴</td><td>Pesanan dibatalkan oleh Admin atau sistem</td></tr>
    </table>
  </div>

  <div class="sub no-break">
    <h3>2.8 Melakukan Pembayaran (Transfer Bank Manual)</h3>
    <ol class="steps">
      <li>Buka detail pesanan berstatus <strong>"Pending"</strong> lalu klik <strong>"Bayar Sekarang"</strong>.</li>
      <li>Halaman pembayaran menampilkan nomor rekening tujuan, nama bank, dan total tagihan.</li>
      <li>Lakukan transfer melalui M-Banking, ATM, atau Internet Banking sesuai rekening tertera.</li>
      <li>Kembali ke halaman pembayaran, klik <strong>"Pilih File"</strong> dan unggah foto/screenshot struk M-Banking Anda.</li>
      <li>Klik <strong>"Kirim Bukti Pembayaran"</strong>.</li>
      <li>Status berubah ke <strong>"Pending Verification"</strong> — Admin akan segera memverifikasi.</li>
    </ol>
    <div class="callout c-warn"><div class="ci">⚠️</div><p>Pastikan nominal transfer <strong>tepat</strong> sesuai tagihan. Foto bukti harus jelas dan terbaca. Format yang diterima: PNG, JPG, maks. 5 MB.</p></div>
  </div>
</div>

<div class="section">
  <div class="sec-head"><div class="sec-icon ic-purple">⚙️</div><h2>3. Manual Administrator</h2></div>
  <div class="sec-bar"></div>

  <div class="callout c-info"><div class="ci">🔐</div><p>Akun Admin memiliki role khusus. Setelah login, navbar menampilkan tombol <strong>"Admin"</strong> dan <strong>"Kelola Paket"</strong>. Jangan bagikan kredensial Admin kepada siapapun.</p></div>

  <div class="sub no-break">
    <h3>3.1 Dashboard Admin</h3>
    {img('admin_dashboard', 'Dashboard Admin — Statistik sistem dan ringkasan aktivitas')}
    <p>Dashboard menampilkan statistik keseluruhan sistem: total pesanan, pendapatan, dan aktivitas terkini. Akses melalui navbar → <strong>"Admin"</strong> atau URL <code>/admin/dashboard</code>.</p>
  </div>

  <div class="sub no-break">
    <h3>3.2 Manajemen Pesanan</h3>
    {img('admin_orders', 'Daftar Semua Pesanan — Pantau seluruh pesanan dari semua pelanggan')}
    <p>Halaman ini menampilkan semua pesanan dari seluruh pelanggan, diurutkan terbaru. Klik <strong>"Detail"</strong> untuk membuka halaman aksi pesanan.</p>
  </div>

  <div class="sub no-break">
    <h3>3.3 Detail & Aksi Pesanan</h3>
    {img('admin_detail', 'Detail Pesanan Admin — Panel informasi lengkap dan kontrol aksi')}
    <p><strong>Untuk Custom Order (status: Pending Review):</strong></p>
    <ol class="steps">
      <li>Baca <em>"Detail Permintaan Klien"</em>: nama proyek, kategori, budget, dan deskripsi.</li>
      <li>Diskusikan dengan tim dan tentukan harga final.</li>
      <li>Masukkan nominal di field <strong>"Angka Harga Deal (Rp)"</strong>, klik <strong>"Simpan & Tagih Klien"</strong>.</li>
      <li>Pelanggan otomatis menerima notifikasi <em>"Disetujui"</em> + harga.</li>
    </ol>
    <br>
    <p><strong>Untuk Menolak Custom Order:</strong></p>
    <ol class="steps">
      <li>Isi alasan di kolom <strong>"Tolak Order Ini (Sertakan Alasan)"</strong>.</li>
      <li>Klik <strong>"Kembalikan / Tolak Penawaran"</strong>.</li>
      <li>Pelanggan otomatis menerima notifikasi <em>"Ditolak"</em> beserta alasan Anda.</li>
    </ol>
    <br>
    <p><strong>Untuk Verifikasi Pembayaran (status: Pending Verification):</strong></p>
    <ol class="steps">
      <li>Panel biru <em>"Verifikasi Pembayaran"</em> muncul dengan foto bukti transfer pelanggan.</li>
      <li>Cek mutasi rekening bank Anda secara langsung.</li>
      <li>Jika masuk: klik <strong>"Terima & Tandai Lunas"</strong> → status jadi Paid.</li>
      <li>Jika tidak valid: klik <strong>"Tolak Bukti"</strong> → status kembali ke Pending.</li>
    </ol>
    <div class="callout c-warn"><div class="ci">⚠️</div><p>Selalu cek mutasi rekening secara langsung sebelum mengklik "Terima & Tandai Lunas". Jangan mengandalkan foto bukti transfer saja.</p></div>
  </div>

  <div class="sub no-break">
    <h3>3.4 Kelola Paket Layanan</h3>
    {img('admin_packages', 'Kelola Paket — Tambah, edit, dan hapus paket layanan')}
    <table>
      <tr><th>Aksi</th><th>Cara Melakukan</th></tr>
      <tr><td><strong>Tambah Paket Baru</strong></td><td>Klik "Tambah Paket" → isi nama, deskripsi, harga, upload gambar → Simpan</td></tr>
      <tr><td><strong>Edit Paket</strong></td><td>Klik tombol "Edit" pada baris paket → ubah data → klik "Update"</td></tr>
      <tr><td><strong>Hapus Paket</strong></td><td>Klik tombol "Hapus" → konfirmasi pada dialog yang muncul</td></tr>
    </table>
  </div>

  <div class="sub no-break">
    <h3>3.5 Laporan Transaksi</h3>
    {img('admin_report', 'Laporan Transaksi — Rekap pesanan yang dapat dicetak sebagai PDF')}
    <p>Halaman Laporan menyajikan rekap yang bisa dicetak: total pesanan per status, daftar pesanan lunas, dan total pendapatan. Gunakan <strong>Ctrl+P</strong> di browser untuk mencetak atau Save as PDF.</p>
  </div>
</div>

<div class="section">
  <div class="sec-head"><div class="sec-icon ic-green">🔄</div><h2>4. Alur Status Pesanan</h2></div>
  <div class="sec-bar"></div>
  <div class="flow">[ PAKET STANDAR ]
Pilih Paket → Checkout → Halaman Pembayaran Transfer Bank
  → Upload Bukti → [ pending_verification ]
  → Admin Verifikasi ✓ → [ PAID ✅ Selesai ]
  → Admin Tolak Bukti → [ pending ] → coba upload ulang

[ CUSTOM ORDER ]
Submit Form → [ pending_review ]
  → Admin Set Harga  → Notifikasi "Disetujui" ke Pelanggan → [ pending ]
      → Pelanggan Upload Bukti → [ pending_verification ]
          → Admin Verifikasi → [ PAID ✅ Selesai ]
  → Admin Tolak Form → Notifikasi "Ditolak" ke Pelanggan → [ cancelled ❌ ]</div>
  <table>
    <tr><th>Status</th><th>Siapa Mengubah</th><th>Aksi Selanjutnya</th></tr>
    <tr><td><span class="bd b-blue">pending_review</span></td><td>Sistem (auto saat submit Custom Order)</td><td>Admin meninjau & menetapkan harga</td></tr>
    <tr><td><span class="bd b-yellow">pending</span></td><td>Admin (setelah set harga / tolak bukti)</td><td>Pelanggan melakukan pembayaran</td></tr>
    <tr><td><span class="bd b-orange">pending_verification</span></td><td>Sistem (auto setelah upload bukti)</td><td>Admin verifikasi pembayaran</td></tr>
    <tr><td><span class="bd b-green">paid</span></td><td>Admin (verifikasi berhasil)</td><td>Selesai — Pesanan Lunas</td></tr>
    <tr><td><span class="bd b-red">cancelled</span></td><td>Admin (tolak form / batalkan manual)</td><td>Pelanggan mengajukan ulang jika diperlukan</td></tr>
  </table>
</div>

<div class="section">
  <div class="sec-head"><div class="sec-icon ic-blue">🔔</div><h2>5. Sistem Notifikasi Lonceng</h2></div>
  <div class="sec-bar"></div>
  <div class="sub">
    <p>Pelanggan menerima notifikasi otomatis melalui ikon lonceng 🔔 di navbar. Badge angka merah muncul ketika ada notifikasi baru yang belum dibaca.</p>
    <table>
      <tr><th>Pemicu</th><th>Isi Notifikasi</th><th>Ikon</th></tr>
      <tr><td>Admin menyetujui & menetapkan harga Custom Order</td><td>"Disetujui" + harga + pesan admin</td><td>✅ Hijau</td></tr>
      <tr><td>Admin menolak form Custom Order</td><td>"Ditolak" + alasan penolakan admin</td><td>❌ Merah</td></tr>
    </table>
    <br>
    <p><strong>Cara Membaca Notifikasi:</strong></p>
    <ol class="steps">
      <li>Klik ikon 🔔 di navbar (badge angka merah = ada notif baru).</li>
      <li>Panel dropdown menampilkan daftar notifikasi dengan ikon warna dan detail pesan.</li>
      <li>Setiap notif menampilkan kode pesanan, status, pesan admin, harga (jika ada), dan waktu relatif.</li>
      <li>Notifikasi otomatis ditandai <em>"sudah dibaca"</em> saat panel dibuka.</li>
      <li>Klik notifikasi untuk langsung ke halaman <strong>"Pesanan Saya"</strong>.</li>
    </ol>
  </div>
</div>

<div class="section">
  <div class="sec-head"><div class="sec-icon ic-green">❓</div><h2>6. FAQ & Pemecahan Masalah</h2></div>
  <div class="sec-bar"></div>

  <div class="faq"><div class="fq"><div class="fq-n">Q</div>Saya sudah transfer tapi lupa upload bukti. Apa yang harus dilakukan?</div><div class="fa">Masuk ke menu <strong>Pesanan</strong> → pilih pesanan berstatus "Pending" → klik <strong>"Bayar Sekarang"</strong> untuk membuka kembali halaman upload bukti transfer.</div></div>

  <div class="faq"><div class="fq"><div class="fq-n">Q</div>Bukti transfer saya ditolak Admin. Bagaimana?</div><div class="fa">Status dikembalikan ke "Pending". Silakan buka detail pesanan dan unggah ulang foto bukti yang lebih jelas, lengkap, dan terbaca.</div></div>

  <div class="faq"><div class="fq"><div class="fq-n">Q</div>Saya sudah submit Custom Order, kapan dapat kabar dari Admin?</div><div class="fa">Admin akan merespons dalam <strong>1×24 jam kerja</strong>. Notifikasi otomatis muncul di ikon lonceng navbar Anda begitu Admin mengambil keputusan.</div></div>

  <div class="faq"><div class="fq"><div class="fq-n">Q</div>Apakah bisa mengubah data Custom Order setelah di-submit?</div><div class="fa">Belum tersedia fitur edit. Jika ada yang perlu diperbarui, ajukan form Custom Order baru atau hubungi Admin secara langsung untuk diskusi lebih lanjut.</div></div>

  <div class="faq"><div class="fq"><div class="fq-n">Q</div>Apakah mengajukan Custom Order itu berbayar?</div><div class="fa">Tidak. Pengajuan Custom Order <strong>sepenuhnya gratis dan tidak mengikat</strong>. Pembayaran baru dilakukan setelah Admin menetapkan harga dan Anda menyetujuinya.</div></div>

  <div class="faq"><div class="fq"><div class="fq-n">Q</div>Saya tidak bisa login setelah register. Apa solusinya?</div><div class="fa">Pastikan email dan password yang dimasukkan benar dan sesuai saat registrasi. Gunakan fitur <strong>"Forgot Password"</strong> di halaman login jika lupa password.</div></div>
</div>

<div class="footer">
  <strong>Jasa Website Indonesia</strong><br>
  Manual Book v1.0 &bull; Diterbitkan April 2026<br>
  Dokumen ini bersifat konfidensial untuk penggunaan internal.
</div>

<script>
// Auto print dialog hint
window.addEventListener('load', function() {{
  // Uncomment line below to auto-open print dialog:
  // window.print();
}});
</script>
</body>
</html>'''

with open(r'C:\laragon\www\jasa-website\public\manual-book.html', 'w', encoding='utf-8') as f:
    f.write(html)

print('SUCCESS - size:', len(html), 'bytes')
