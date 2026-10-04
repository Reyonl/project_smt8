from pptx import Presentation
from pptx.util import Inches, Pt
from pptx.dml.color import RGBColor
import os

# Create presentation
prs = Presentation()

# Define Color Palette
PRIMARY_COLOR = RGBColor(15, 23, 42)    # Sleek dark slate for text
TITLE_COLOR = RGBColor(79, 70, 229)    # Indigo for titles
MUTED_COLOR = RGBColor(71, 85, 105)    # Gray for subtitle/secondary text
BG_COLOR = RGBColor(248, 250, 252)     # Off-white / light background

# Fonts
FONT_NAME = 'Calibri'

# Image paths from the workspace
img_dashboard = r'C:\Users\ThinkPad\.gemini\antigravity\brain\3b8610f0-4c5f-45c3-bdd3-9588b861ac24\visitor_analytics_dashboard_1780839888466.png'
img_funnel = r'C:\Users\ThinkPad\.gemini\antigravity\brain\3b8610f0-4c5f-45c3-bdd3-9588b861ac24\ecommerce_tracking_concept_1780839902526.png'

def format_text(shape, text, size=16, bold=False, italic=False, color=PRIMARY_COLOR):
    tf = shape.text_frame
    tf.word_wrap = True
    p = tf.paragraphs[0]
    p.text = text
    p.font.name = FONT_NAME
    p.font.size = Pt(size)
    p.font.bold = bold
    p.font.italic = italic
    p.font.color.rgb = color

def format_bullets(shape, bullets, font_size=16):
    tf = shape.text_frame
    tf.word_wrap = True
    for i, bullet in enumerate(bullets):
        p = tf.add_paragraph() if i > 0 else tf.paragraphs[0]
        p.text = bullet
        p.font.name = FONT_NAME
        p.font.color.rgb = PRIMARY_COLOR
        if bullet.strip().startswith("•") or bullet.strip().startswith("-"):
            p.level = 1
            p.font.size = Pt(font_size - 2)
        else:
            p.level = 0
            p.font.size = Pt(font_size)
            p.font.bold = True

def add_presenter_notes(slide, notes_text):
    notes_slide = slide.notes_slide
    text_frame = notes_slide.notes_text_frame
    text_frame.text = notes_text

# -----------------
# SLIDE 1: PENDAHULUAN
# -----------------
slide_layout = prs.slide_layouts[5] # Blank layout with title
slide1 = prs.slides.add_slide(slide_layout)

# Title
title_box = slide1.shapes.add_textbox(Inches(0.5), Inches(0.5), Inches(9.0), Inches(1.2))
format_text(title_box, "Slide 1: Pendahuluan\nAnalisis Pengunjung Platform Jasa Website", size=24, bold=True, color=TITLE_COLOR)

# Content Box (Left side)
content_box = slide1.shapes.add_textbox(Inches(0.5), Inches(1.8), Inches(5.0), Inches(5.0))
bullets_1 = [
    "Latar Belakang & Urgensi Data",
    "  • Memahami preferensi dan ketertarikan calon klien secara objektif.",
    "Peran Google Analytics 4",
    "  • Perekaman aktivitas secara real-time dan terstruktur berbasis event.",
    "Tujuan Implementasi",
    "  • Mengukur rasio konversi paket pesanan.",
    "  • Meminimalisir persentase pembatalan (Cart Abandonment).",
    "  • Dasar pengambilan keputusan pengembangan (Data-Driven)."
]
format_bullets(content_box, bullets_1, font_size=16)

# Image (Right side)
if os.path.exists(img_funnel):
    slide1.shapes.add_picture(img_funnel, Inches(5.8), Inches(1.8), width=Inches(3.8), height=Inches(4.5))

notes_1 = (
    "Selamat pagi/siang Bapak/Ibu Dewan Penguji serta rekan-rekan mahasiswa sekalian. "
    "Hari ini saya akan memaparkan hasil implementasi Google Analytics 4 pada platform 'Jasa Website'. "
    "Sebelum kita membahas aspek teknisnya, mari perhatikan terlebih dahulu diagram alur pengguna (User Funnel) "
    "di sisi kanan layar. Diagram ini menggambarkan tahapan perjalanan pengunjung kita: dari awal mereka datang ke website, "
    "melihat katalog paket jasa, menekan tombol order, hingga akhirnya berhasil melakukan transaksi pembayaran.\n\n"
    "Seperti yang tertera pada poin-poin latar belakang di sebelah kiri, memiliki data kunjungan secara empiris sangatlah "
    "penting bagi keberlanjutan bisnis. Tanpa alat analitik, kita tidak akan pernah tahu halaman mana yang paling disukai pengunjung "
    "dan di bagian mana mereka mengalami kesulitan. Di sinilah Google Analytics 4 berperan sebagai perekam otomatis seluruh aktivitas tersebut. "
    "Tujuan utama yang ingin dicapai melalui implementasi ini adalah untuk melacak rasio konversi pesanan, menekan tingkat pembatalan "
    "belanja (cart abandonment), dan menghasilkan landasan keputusan berbasis data (data-driven) agar pengembangan sistem di masa depan "
    "tidak lagi berdasarkan asumsi subjektif."
)
add_presenter_notes(slide1, notes_1)


# -----------------
# SLIDE 2: PENGENALAN GOOGLE ANALYTICS
# -----------------
slide2 = prs.slides.add_slide(slide_layout)

# Title
title_box = slide2.shapes.add_textbox(Inches(0.5), Inches(0.5), Inches(9.0), Inches(1.2))
format_text(title_box, "Slide 2: Pengenalan Google Analytics\nDasar Teori & Mekanisme GA4", size=24, bold=True, color=TITLE_COLOR)

# Content Box
content_box = slide2.shapes.add_textbox(Inches(0.5), Inches(1.8), Inches(8.5), Inches(5.0))
bullets_2 = [
    "Definisi Google Analytics 4 (GA4)",
    "  • Platform pelacakan web berbasis event untuk merekam aktivitas user.",
    "Mekanisme Kerja Sistem",
    "  • Integrasi script gtag.js global di dalam tag <head>.",
    "  • Data interaksi ditransmisikan asinkron ke server Google Analytics.",
    "Fitur Utama Pelacakan",
    "  • E-Commerce Tracking, Traffic Source, Real-time Reports, Demografi.",
    "Manfaat Pengelolaan Website",
    "  • Deteksi halaman bermasalah (Bounce Rate tinggi) & optimalisasi pemasaran."
]
format_bullets(content_box, bullets_2, font_size=16)

notes_2 = (
    "Pada slide kedua ini, saya ingin mengajak rekan-rekan memahami definisi serta cara kerja Google Analytics 4. "
    "Silakan rekan-rekan perhatikan bagan alir data di layar. Di situ digambarkan bahwa saat pengunjung mengakses platform kita, "
    "browser mereka akan secara otomatis memuat skrip pelacak bernama 'gtag.js' yang dipasang di dalam kode sistem. "
    "Setiap kali pengunjung melakukan aktivitas—seperti mengklik tombol order, melihat rincian paket, atau melakukan scroll—"
    "skrip tersebut akan mengirimkan data interaksi secara asinkron langsung ke Server Google Analytics tanpa membebani performa "
    "pemuatan website kita.\n\n"
    "Melalui metode berbasis aktivitas atau event ini, kita bisa memantau empat fitur utama yang tertera pada slide. "
    "Kita memiliki laporan Real-time untuk melihat aktivitas yang sedang terjadi detik ini juga, laporan Demografi untuk memetakan "
    "lokasi fisik pengguna, Akuisisi untuk melacak dari mana mereka mengetahui website kita, hingga pelacakan transaksi E-commerce. "
    "Dengan fitur-fitur ini, pengelola website dapat langsung mendeteksi halaman mana yang bermasalah—misalnya halaman petunjuk "
    "pembayaran yang memiliki tingkat pentalan (bounce rate) tinggi—agar bisa segera diperbaiki."
)
add_presenter_notes(slide2, notes_2)


# -----------------
# SLIDE 3: IMPLEMENTASI GOOGLE ANALYTICS
# -----------------
slide3 = prs.slides.add_slide(slide_layout)

# Title
title_box = slide3.shapes.add_textbox(Inches(0.5), Inches(0.5), Inches(9.0), Inches(1.2))
format_text(title_box, "Slide 3: Implementasi GA4 pada Sistem\nIntegrasi Laravel & Pemetaan Event", size=24, bold=True, color=TITLE_COLOR)

# Content Box
content_box = slide3.shapes.add_textbox(Inches(0.5), Inches(1.8), Inches(9.0), Inches(5.0))
bullets_3 = [
    "Integrasi Global (Measurement ID: G-5TCTDT8KM1)",
    "  • Pemasangan tag pelacak pada berkas app.blade.php secara terpusat.",
    "Funneling Event E-Commerce yang Diterapkan",
    "  • view_item_list & select_item: Katalog paket (packages.blade.php).",
    "  • begin_checkout: Halaman rincian checkout (checkout.blade.php).",
    "  • purchase: Konfirmasi pembayaran lunas (my-orders.blade.php).",
    "Inovasi: Session Flash Tracking Laravel",
    "  • Enkapsulasi data purchase di server sesaat setelah upload bukti transfer.",
    "  • Mencegah duplikasi data tracking akibat page-refresh di browser."
]
format_bullets(content_box, bullets_3, font_size=15)

notes_3 = (
    "Mari kita masuk ke aspek teknis yang telah saya terapkan pada sistem. Bisa dilihat pada tabel pemetaan event di layar, "
    "alur pelacakan transaksi e-commerce dibagi menjadi empat event utama. Pertama, event 'view_item_list' merekam saat katalog "
    "paket pembuatan website dimuat di halaman 'packages.blade.php'. Kedua, event 'select_item' dipicu ketika tombol 'Order' "
    "diklik pada paket tertentu (misal: paket Basic Website atau Company Profile). Ketiga, event 'begin_checkout' melacak saat "
    "pengguna memasuki halaman detail pemesanan di 'checkout.blade.php'. Terakhir, event 'purchase' dipicu di halaman "
    "'my-orders.blade.php' ketika pembayaran berhasil dikonfirmasi.\n\n"
    "Ada satu teknik krusial yang ingin saya tunjukkan di sini. Karena pembayaran di website kita menggunakan transfer bank manual, "
    "verifikasi pembayaran tidak instan dan pengguna harus mengunggah bukti transfer terlebih dahulu. Apabila setelah mengunggah "
    "bukti bayar pengguna menyegarkan (refresh) halaman, browser berisiko mengirimkan event purchase berulang kali ke server Google. "
    "Hal ini dapat merusak validitas laporan analitik pendapatan bisnis kita.\n\n"
    "Untuk mengatasi celah ini, saya menerapkan skema Session Flash Laravel pada controller sistem seperti yang tertera di kode. "
    "Data transaksi disimpan sementara di memori server dan diteruskan ke frontend halaman 'Pesanan Saya'. Setelah JavaScript "
    "menangkap session tersebut dan menembakkan event purchase satu kali saja ke GA4, data session langsung dihapus dari memori server. "
    "Dengan solusi ini, data transaksi yang terekam dijamin 100% valid tanpa adanya duplikasi data."
)
add_presenter_notes(slide3, notes_3)


# -----------------
# SLIDE 4: ANALISIS DAN MANFAAT DATA
# -----------------
slide4 = prs.slides.add_slide(slide_layout)

# Title
title_box = slide4.shapes.add_textbox(Inches(0.5), Inches(0.5), Inches(9.0), Inches(1.2))
format_text(title_box, "Slide 4: Analisis & Manfaat Data\nOptimasi & Pengambilan Keputusan Bisnis", size=24, bold=True, color=TITLE_COLOR)

# Content Box (Left side)
content_box = slide4.shapes.add_textbox(Inches(0.5), Inches(1.8), Inches(5.0), Inches(5.0))
bullets_4 = [
    "Metrik Kunci yang Dipantau",
    "  • Users, Sessions, Page Views, Traffic Source, Device, Engagement.",
    "Analisis Conversion Funnel",
    "  • Menghitung persentase user drop-off di setiap halaman pesanan.",
    "  • Menemukan Cart Abandonment Rate (Checkout vs Purchase).",
    "Dampak Pengembangan & Keputusan",
    "  • Optimasi UI/UX halaman pembayaran yang membingungkan.",
    "  • Fokus promosi pada saluran akuisisi terbaik yang menghasilkan konversi."
]
format_bullets(content_box, bullets_4, font_size=15)

# Image (Right side)
if os.path.exists(img_dashboard):
    slide4.shapes.add_picture(img_dashboard, Inches(5.8), Inches(1.8), width=Inches(3.8), height=Inches(4.5))

notes_4 = (
    "Pada bagian akhir presentasi ini, mari kita bahas apa manfaat nyata dari pengumpulan data analitik ini. "
    "Silakan perhatikan diagram grafik lingkaran perangkat serta grafik batang akuisisi di layar. Grafik ini memberikan kita "
    "wawasan instan mengenai demografi audiens kita. Misalnya, jika mayoritas pengguna mengakses website kita melalui perangkat "
    "smartphone (mobile), maka prioritas pengembangan sistem harus difokuskan pada desain yang ramah pengguna mobile (mobile-first design).\n\n"
    "Selain itu, manfaat terbesar yang diperoleh adalah analisis corong e-commerce (Funnel Chart). Kita dapat membandingkan jumlah "
    "pengguna yang memicu event 'begin_checkout' dengan event 'purchase' untuk mencari tahu Cart Abandonment Rate—yaitu persentase "
    "pengunjung yang berniat membeli namun membatalkan transaksi di tengah jalan.\n\n"
    "Jika data GA4 menunjukkan penurunan drastis di halaman pembayaran, kita memiliki bukti objektif bahwa antarmuka halaman instruksi "
    "transfer bank manual kita membingungkan atau terlalu rumit bagi pengguna. Berdasarkan data empiris tersebut, kita dapat melakukan "
    "perbaikan UI/UX halaman pembayaran secara terarah. Inilah wujud dari pengambilan keputusan berbasis data (data-driven decision) "
    "yang membuat sistem informasi kita berkembang secara efektif dan efisien."
)
add_presenter_notes(slide4, notes_4)

# Save presentation
output_path = r'c:\laragon\www\jasa-website\Presentasi_GA4_Analisis_Pengunjung.pptx'
prs.save(output_path)
print(f"Presentation updated successfully with notes at {output_path}")
