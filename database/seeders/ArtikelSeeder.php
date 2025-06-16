<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('artikel')->insert([
            'id_artikel' => 'A0001',
            'judul_artikel' => 'Pentingnya Pengelolaan Sampah di Kota',
            'detail_artikel' => 'Pengelolaan sampah merupakan salah satu tantangan terbesar yang dihadapi oleh kota-kota besar di Indonesia. Dengan pertumbuhan populasi yang terus meningkat, volume sampah yang dihasilkan setiap harinya mencapai ribuan ton. Hal ini menjadi masalah serius yang memerlukan perhatian khusus dari pemerintah dan masyarakat.

Dampak dari pengelolaan sampah yang tidak tepat sangat beragam. Mulai dari pencemaran lingkungan, penyebaran penyakit, hingga degradasi kualitas hidup masyarakat. Sampah yang tidak terkelola dengan baik dapat mencemari air tanah, udara, dan tanah itu sendiri. Selain itu, sampah yang menumpuk juga menjadi sumber penyakit karena menjadi tempat berkembang biaknya bakteri dan virus berbahaya.

Untuk mengatasi masalah ini, diperlukan sistem pengelolaan sampah yang terintegrasi. Konsep 3R (Reduce, Reuse, Recycle) menjadi kunci utama dalam mengurangi volume sampah. Reduce berarti mengurangi penggunaan barang-barang yang berpotensi menjadi sampah. Reuse adalah menggunakan kembali barang-barang yang masih bisa dimanfaatkan. Sedangkan Recycle adalah mendaur ulang sampah menjadi produk baru yang bermanfaat.

Peran masyarakat sangat penting dalam keberhasilan pengelolaan sampah. Kesadaran untuk memilah sampah sejak dari rumah tangga merupakan langkah awal yang sangat fundamental. Pemilahan sampah organik dan anorganik akan mempermudah proses pengolahan selanjutnya. Sampah organik dapat diolah menjadi kompos, sedangkan sampah anorganik dapat didaur ulang menjadi produk baru.

Pemerintah juga perlu menyediakan infrastruktur yang memadai untuk mendukung pengelolaan sampah. Hal ini meliputi penyediaan tempat pembuangan sampah sementara, kendaraan pengangkut sampah, dan tempat pengolahan sampah akhir. Selain itu, perlu adanya regulasi yang jelas dan tegas mengenai pengelolaan sampah, termasuk sanksi bagi yang melanggar.

Teknologi juga memainkan peran penting dalam pengelolaan sampah modern. Berbagai inovasi teknologi telah dikembangkan untuk mengoptimalkan proses pengolahan sampah. Mulai dari teknologi pengomposan, insinerasi, hingga pengolahan sampah menjadi energi. Teknologi-teknologi ini dapat membantu mengurangi volume sampah sekaligus menghasilkan nilai ekonomi.

Edukasi masyarakat tentang pentingnya pengelolaan sampah juga tidak kalah penting. Program-program sosialisasi dan kampanye kesadaran lingkungan perlu terus dilakukan untuk mengubah perilaku masyarakat. Mulai dari anak-anak di sekolah hingga orang dewasa di lingkungan kerja, semua perlu dilibatkan dalam upaya pengelolaan sampah yang berkelanjutan.

Dengan pengelolaan sampah yang baik, kota-kota besar dapat menjadi lebih bersih, sehat, dan nyaman untuk ditinggali. Lingkungan yang bersih akan meningkatkan kualitas hidup masyarakat dan mendukung pembangunan berkelanjutan. Oleh karena itu, pengelolaan sampah bukan hanya tanggung jawab pemerintah, tetapi juga merupakan tanggung jawab bersama seluruh masyarakat.',
            'foto' => 'artikel1.png',
            'created_at' => now(),
            'updated_at' => now(),
            // 'penulis_artikel' => 'B01', // diubah dari u0001 ke B01
        ]);
        
        DB::table('artikel')->insert([
            'id_artikel' => 'A0002',
            'judul_artikel' => 'Inovasi Teknologi dalam Daur Ulang Sampah',
            'detail_artikel' => 'Perkembangan teknologi dalam beberapa dekade terakhir telah membawa dampak positif dalam berbagai aspek kehidupan, termasuk dalam pengelolaan dan daur ulang sampah. Inovasi-inovasi teknologi terbaru telah memberikan solusi yang lebih efektif dan efisien untuk mengolah sampah, khususnya sampah plastik yang menjadi salah satu masalah lingkungan terbesar di dunia.

Salah satu inovasi terdepan dalam daur ulang sampah adalah teknologi pirolisis. Teknologi ini menggunakan proses pemanasan pada suhu tinggi tanpa oksigen untuk memecah molekul plastik menjadi bahan bakar cair. Proses pirolisis dapat mengubah sampah plastik menjadi minyak sintetis yang dapat digunakan sebagai bahan bakar alternatif. Teknologi ini sangat efektif karena dapat mengolah berbagai jenis plastik yang sulit didaur ulang dengan metode konvensional.

Teknologi lain yang sedang berkembang adalah chemical recycling atau daur ulang kimia. Berbeda dengan daur ulang mekanis yang hanya mencacah dan melelehkan plastik, daur ulang kimia memecah polimer plastik kembali ke monomer asalnya. Proses ini memungkinkan plastik untuk didaur ulang berkali-kali tanpa kehilangan kualitas, sehingga menciptakan sistem ekonomi sirkular yang berkelanjutan.

Artificial Intelligence (AI) dan machine learning juga mulai diterapkan dalam sistem pengelolaan sampah. Teknologi AI dapat digunakan untuk mengoptimalkan rute pengumpulan sampah, memprediksi volume sampah yang akan dihasilkan, dan bahkan untuk sistem pemilahan sampah otomatis. Robot-robot yang dilengkapi dengan sensor dan AI dapat memilah sampah dengan akurasi tinggi, memisahkan berbagai jenis material dengan efisiensi yang jauh lebih baik dibandingkan pemilahan manual.

Internet of Things (IoT) juga memberikan kontribusi signifikan dalam pengelolaan sampah modern. Sensor IoT dapat dipasang pada tempat sampah untuk memantau tingkat kepenuhan, kualitas sampah, dan bahkan kondisi lingkungan sekitar. Data yang dikumpulkan dapat dianalisis untuk mengoptimalkan jadwal pengumpulan sampah dan meningkatkan efisiensi operasional.

Teknologi blockchain mulai diimplementasikan untuk menciptakan sistem pelacakan sampah yang transparan. Dengan blockchain, setiap tahap dalam siklus hidup sampah dapat dilacak dan diverifikasi, mulai dari pembuangan hingga pengolahan akhir. Ini menciptakan akuntabilitas yang tinggi dan memastikan bahwa sampah benar-benar dikelola sesuai dengan standar lingkungan.

Inovasi dalam material juga turut mendukung upaya daur ulang sampah. Pengembangan bioplastik yang dapat terurai secara alami telah mengurangi ketergantungan pada plastik konvensional. Selain itu, teknologi untuk mengubah sampah organik menjadi biogas dan kompos berkualitas tinggi terus berkembang, memberikan alternatif energi terbarukan.

Nanotechnology juga mulai diterapkan dalam pengolahan sampah. Nanopartikel dapat digunakan untuk membersihkan kontaminan dari air limbah, menguraikan polutan organik, dan bahkan mengubah sampah menjadi material yang berguna. Teknologi ini sangat menjanjikan untuk mengatasi polusi mikroplastik yang sulit dideteksi dan dihilangkan dengan metode konvensional.

Aplikasi mobile dan platform digital juga memfasilitasi partisipasi masyarakat dalam daur ulang sampah. Aplikasi-aplikasi ini dapat membantu masyarakat menemukan titik pengumpulan sampah terdekat, memberikan informasi tentang cara memilah sampah, dan bahkan memberikan reward untuk perilaku ramah lingkungan.

Robotika dan otomasi telah merevolusi fasilitas pengolahan sampah. Robot-robot canggih dapat bekerja 24 jam tanpa henti untuk memilah, mengolah, dan mengemas produk daur ulang. Sistem otomatis ini tidak hanya meningkatkan efisiensi tetapi juga mengurangi risiko kesehatan bagi pekerja yang sebelumnya harus menangani sampah secara manual.

Teknologi-teknologi inovatif ini memberikan harapan besar untuk masa depan pengelolaan sampah yang lebih berkelanjutan. Dengan terus berkembangnya teknologi, diharapkan masalah sampah global dapat diatasi dengan lebih efektif, menciptakan lingkungan yang lebih bersih dan sehat untuk generasi mendatang.',
            'foto' => 'artikel2.png',
            'created_at' => now(),
            'updated_at' => now(),
            // 'penulis_artikel' => 'B02', // diubah dari u0002 ke B02
        ]);
        
        // Tambahkan artikel ketiga sebagai bonus
        DB::table('artikel')->insert([
            'id_artikel' => 'A0003',
            'judul_artikel' => 'Peran Masyarakat dalam Menjaga Kebersihan Lingkungan',
            'detail_artikel' => 'Kebersihan lingkungan merupakan tanggung jawab bersama yang tidak dapat dibebankan hanya kepada pemerintah atau lembaga tertentu. Peran aktif masyarakat sangat menentukan keberhasilan program kebersihan dan kelestarian lingkungan. Setiap individu memiliki kontribusi penting dalam menciptakan lingkungan yang bersih, sehat, dan berkelanjutan.

Kesadaran lingkungan harus dimulai dari diri sendiri dan lingkungan terdekat. Kebiasaan sederhana seperti tidak membuang sampah sembarangan, menggunakan produk ramah lingkungan, dan mengurangi penggunaan plastik sekali pakai dapat memberikan dampak positif yang signifikan. Tindakan kecil ini, jika dilakukan oleh banyak orang, akan menciptakan perubahan besar dalam kualitas lingkungan.

Pendidikan lingkungan sejak dini sangat penting untuk membentuk karakter peduli lingkungan. Anak-anak yang diajarkan tentang pentingnya menjaga kebersihan lingkungan akan tumbuh menjadi generasi yang bertanggung jawab terhadap alam. Program edukasi di sekolah, rumah, dan komunitas perlu terus dikembangkan untuk meningkatkan kesadaran lingkungan.

Gotong royong dan kerja sama antarwarga merupakan kekuatan besar dalam menjaga kebersihan lingkungan. Kegiatan seperti kerja bakti membersihkan lingkungan, penanaman pohon bersama, dan program bank sampah dapat memperkuat solidaritas masyarakat sekaligus meningkatkan kualitas lingkungan. Tradisi gotong royong yang sudah mengakar di masyarakat Indonesia dapat menjadi modal sosial yang berharga untuk program kebersihan lingkungan.',
            'foto' => 'artikel3.png',
            'created_at' => now(),
            'updated_at' => now(),
            // 'penulis_artikel' => 'B03',
        ]);
    }
}