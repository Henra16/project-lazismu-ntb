<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate existing news
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        News::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $news = [
            [
                'title'   => 'Lazismu NTB Salurkan Beasiswa ke Daerah 3T',
                'slug'    => 'beasiswa-daerah-3t',
                'excerpt' => 'Sebanyak 50 siswa berprestasi dari daerah Terdepan, Terluar, dan Tertinggal (3T) di NTB menerima beasiswa dari Lazismu NTB.',
                'content' => '<p>Lazismu NTB kembali menunjukkan kepeduliannya terhadap dunia pendidikan dengan menyalurkan beasiswa kepada 50 siswa berprestasi yang berasal dari daerah Terdepan, Terluar, dan Tertinggal (3T) di Nusa Tenggara Barat.</p><p>Program beasiswa ini merupakan wujud nyata dari komitmen Lazismu NTB dalam memberdayakan generasi muda melalui akses pendidikan yang merata. Para penerima beasiswa dipilih berdasarkan prestasi akademik dan kondisi ekonomi keluarga yang membutuhkan dukungan.</p><p>"Kami berharap beasiswa ini menjadi motivasi bagi anak-anak di daerah 3T untuk terus semangat belajar dan meraih cita-cita setinggi-tingginya," ujar Ketua Lazismu NTB dalam acara penyerahan beasiswa.</p><p>Dana beasiswa ini berasal dari pengumpulan zakat, infaq, dan shadaqah para donatur yang dipercayakan kepada Lazismu NTB. Lazismu NTB berkomitmen untuk terus mengelola dana umat secara transparan dan amanah.</p>',
                'image'   => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=900&q=80',
                'category'=> 'Pendidikan',
                'is_published' => true,
                'published_at' => '2026-03-21 09:00:00',
            ],
            [
                'title'   => 'BPKH RI dan Lazismu Salurkan Bingkisan Ramadhan dan Mushaf Al-Qur\'an di Pancor',
                'slug'    => 'bingkisan-ramadhan-pancor',
                'excerpt' => 'Dalam rangka menyambut bulan suci Ramadhan, BPKH RI bersama Lazismu NTB menyalurkan bingkisan sembako dan Mushaf Al-Qur\'an di Kota Pancor.',
                'content' => '<p>Dalam rangka menyambut bulan suci Ramadhan 1447 H, Badan Pengelola Keuangan Haji (BPKH) Republik Indonesia bekerja sama dengan Lazismu NTB menyalurkan ratusan paket bingkisan Ramadhan dan Mushaf Al-Qur\'an kepada masyarakat di Kota Pancor, Lombok Timur.</p><p>Kegiatan ini merupakan bagian dari program sosial BPKH RI yang bertujuan untuk mempererat tali silaturahmi dan meringankan beban masyarakat menjelang bulan Ramadhan. Setiap paket bingkisan berisi sembako seperti beras, minyak goreng, gula, dan kebutuhan pokok lainnya.</p><p>Selain sembako, setiap penerima manfaat juga mendapatkan satu buah Mushaf Al-Qur\'an berkualitas tinggi sebagai sarana untuk meningkatkan ibadah di bulan yang penuh berkah ini.</p><p>Perwakilan BPKH RI menyatakan rasa terima kasih atas dukungan Lazismu NTB dalam mendistribusikan bantuan ini kepada masyarakat yang membutuhkan. "Sinergi ini diharapkan dapat terus berlanjut demi kemaslahatan umat," ujarnya.</p>',
                'image'   => 'https://images.unsplash.com/photo-1544027993-37dbfe43562a?w=900&q=80',
                'category'=> 'Sosial',
                'is_published' => true,
                'published_at' => '2026-03-15 10:30:00',
            ],
            [
                'title'   => 'Membangun Kesadaran Zakat Satu Pintu: MBS Ummat Gandeng Lazismu NTB Salurkan Zakat Fitrah',
                'slug'    => 'zakat-fitrah-mbs-ummat',
                'excerpt' => 'MBS Ummat bekerja sama dengan Lazismu NTB dalam program zakat satu pintu untuk memudahkan masyarakat menunaikan zakat fitrah secara terorganisir.',
                'content' => '<p>Ma\'had Bina Siswa (MBS) Ummat menggandeng Lazismu NTB dalam program inovatif bertajuk "Zakat Satu Pintu" untuk membangun kesadaran berzakat yang terorganisir di kalangan civitas akademika dan masyarakat sekitar.</p><p>Program ini hadir sebagai solusi atas masih berseraknya penyaluran zakat yang belum terkoordinasi. Dengan sistem satu pintu, seluruh zakat fitrah yang terkumpul akan dikelola dan disalurkan secara profesional oleh Lazismu NTB kepada mustahik yang berhak.</p><p>Kepala MBS Ummat menjelaskan bahwa program ini tidak hanya memudahkan proses pembayaran zakat, tetapi juga menjadi sarana edukasi bagi santri dan masyarakat tentang pentingnya membayar zakat melalui lembaga resmi.</p><p>Pada pelaksanaan perdana ini, berhasil terkumpul zakat fitrah senilai lebih dari Rp 150 juta yang langsung disalurkan kepada 500 keluarga mustahik di wilayah sekitar pesantren.</p>',
                'image'   => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=900&q=80',
                'category'=> 'Zakat',
                'is_published' => true,
                'published_at' => '2026-03-03 14:00:00',
            ],
            [
                'title'   => 'Lazismu NTB Gelar Pelatihan Wirausaha untuk Mustahik',
                'slug'    => 'pelatihan-wirausaha-mustahik',
                'excerpt' => 'Lazismu NTB menggelar pelatihan kewirausahaan bagi para mustahik sebagai upaya pemberdayaan ekonomi umat.',
                'content' => '<p>Lazismu NTB menggelar pelatihan kewirausahaan selama tiga hari bagi 60 mustahik terpilih dari berbagai kecamatan di Lombok. Program ini bertujuan mengubah penerima zakat menjadi wirausahawan mandiri yang produktif.</p><p>Pelatihan mencakup berbagai materi praktis seperti manajemen keuangan sederhana, teknik pemasaran digital, pengelolaan usaha kecil, dan motivasi wirausaha. Para peserta juga mendapatkan modal usaha awal sesuai dengan bidang yang dipilih.</p><p>"Kami ingin mustahik hari ini menjadi muzakki masa depan. Itulah esensi dari zakat produktif," ujar Direktur Lazismu NTB dalam sambutan pembukaan pelatihan.</p>',
                'image'   => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=900&q=80',
                'category'=> 'Pemberdayaan',
                'is_published' => true,
                'published_at' => '2026-02-25 08:30:00',
            ],
            [
                'title'   => 'Lazismu NTB Bagikan Paket Sembako untuk Warga Terdampak Bencana',
                'slug'    => 'sembako-bencana',
                'excerpt' => 'Lazismu NTB bergerak cepat menyalurkan bantuan paket sembako kepada ratusan keluarga yang terdampak banjir di wilayah NTB.',
                'content' => '<p>Merespons bencana banjir yang melanda beberapa wilayah di Nusa Tenggara Barat, Lazismu NTB bergerak cepat menyalurkan bantuan berupa paket sembako kepada 300 keluarga terdampak di tiga kecamatan.</p><p>Tim relawan Lazismu NTB langsung turun ke lokasi bencana untuk memastikan bantuan sampai ke tangan warga yang benar-benar membutuhkan. Setiap paket berisi beras 10 kg, mie instan, minyak goreng, dan kebutuhan dasar lainnya.</p><p>Lazismu NTB mengajak masyarakat untuk berpartisipasi dalam aksi kemanusiaan ini melalui donasi yang dapat disalurkan melalui berbagai kanal resmi Lazismu NTB.</p>',
                'image'   => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=900&q=80',
                'category'=> 'Kemanusiaan',
                'is_published' => true,
                'published_at' => '2026-02-18 16:00:00',
            ],
            [
                'title'   => 'Program Beasiswa Lazismu NTB: 120 Siswa Berprestasi Terima Bantuan Pendidikan',
                'slug'    => 'beasiswa-siswa-berprestasi',
                'excerpt' => '120 siswa berprestasi dari keluarga kurang mampu di seluruh NTB menerima bantuan beasiswa dari Lazismu NTB.',
                'content' => '<p>Lazismu NTB menyerahkan bantuan beasiswa kepada 120 siswa berprestasi dari keluarga kurang mampu yang tersebar di seluruh kabupaten/kota di Nusa Tenggara Barat. Penyerahan beasiswa dilaksanakan dalam sebuah acara yang dihadiri oleh para penerima manfaat beserta orang tua dan tokoh masyarakat setempat.</p><p>Besaran beasiswa bervariasi mulai dari Rp 500.000 hingga Rp 2.000.000 per siswa tergantung jenjang pendidikan. Dana ini diharapkan dapat membantu meringankan biaya pendidikan dan kebutuhan sekolah para penerima.</p><p>Proses seleksi dilakukan secara ketat dengan mempertimbangkan prestasi akademik, kondisi ekonomi keluarga, dan komitmen penerima untuk terus berprestasi dan berkontribusi bagi masyarakat.</p>',
                'image'   => 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=900&q=80',
                'category'=> 'Pendidikan',
                'is_published' => true,
                'published_at' => '2026-02-10 11:00:00',
            ],
        ];

        foreach ($news as $item) {
            News::create($item);
        }
    }
}
