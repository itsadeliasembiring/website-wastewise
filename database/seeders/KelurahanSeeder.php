<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kelurahan')->insert([
            // K001 - Asemrowo
            ['id_kelurahan' => 'L001', 'nama_kelurahan' => 'Asemrowo', 'kode_pos' => '60182', 'id_kecamatan' => 'K001'],
            ['id_kelurahan' => 'L002', 'nama_kelurahan' => 'Genting Kalianak', 'kode_pos' => '60183', 'id_kecamatan' => 'K001'],
            ['id_kelurahan' => 'L003', 'nama_kelurahan' => 'Tambak Sarioso', 'kode_pos' => '60184', 'id_kecamatan' => 'K001'],
            
            // K002 - Benowo
            ['id_kelurahan' => 'L004', 'nama_kelurahan' => 'Kandangan', 'kode_pos' => '60199', 'id_kecamatan' => 'K002'],
            ['id_kelurahan' => 'L005', 'nama_kelurahan' => 'Tambak Oso Wilangun', 'kode_pos' => '60191', 'id_kecamatan' => 'K002'],
            ['id_kelurahan' => 'L006', 'nama_kelurahan' => 'Romokalisari', 'kode_pos' => '60192', 'id_kecamatan' => 'K002'],
            ['id_kelurahan' => 'L007', 'nama_kelurahan' => 'Sememi', 'kode_pos' => '60198', 'id_kecamatan' => 'K002'],
            
            // K003 - Bubutan
            ['id_kelurahan' => 'L008', 'nama_kelurahan' => 'Tembok Dukuh', 'kode_pos' => '60173', 'id_kecamatan' => 'K003'],
            ['id_kelurahan' => 'L009', 'nama_kelurahan' => 'Bubutan', 'kode_pos' => '60174', 'id_kecamatan' => 'K003'],
            ['id_kelurahan' => 'L010', 'nama_kelurahan' => 'Alun-alun Contong', 'kode_pos' => '60175', 'id_kecamatan' => 'K003'],
            ['id_kelurahan' => 'L011', 'nama_kelurahan' => 'Gundih', 'kode_pos' => '60172', 'id_kecamatan' => 'K003'],
            ['id_kelurahan' => 'L012', 'nama_kelurahan' => 'Jepara', 'kode_pos' => '60171', 'id_kecamatan' => 'K003'],
            
            // K004 - Dukuh Pakis
            ['id_kelurahan' => 'L013', 'nama_kelurahan' => 'Dukuh Kupang', 'kode_pos' => '60225', 'id_kecamatan' => 'K004'],
            ['id_kelurahan' => 'L014', 'nama_kelurahan' => 'Dukuh Pakis', 'kode_pos' => '60224', 'id_kecamatan' => 'K004'],
            ['id_kelurahan' => 'L015', 'nama_kelurahan' => 'Gunung Sari', 'kode_pos' => '60222', 'id_kecamatan' => 'K004'],
            ['id_kelurahan' => 'L016', 'nama_kelurahan' => 'Pradah Kalikendal', 'kode_pos' => '60226', 'id_kecamatan' => 'K004'],
            
            // K005 - Gayungan
            ['id_kelurahan' => 'L017', 'nama_kelurahan' => 'Gayungan', 'kode_pos' => '60231', 'id_kecamatan' => 'K005'],
            ['id_kelurahan' => 'L018', 'nama_kelurahan' => 'Ketintang', 'kode_pos' => '60232', 'id_kecamatan' => 'K005'],
            ['id_kelurahan' => 'L019', 'nama_kelurahan' => 'Menanggal', 'kode_pos' => '60234', 'id_kecamatan' => 'K005'],
            ['id_kelurahan' => 'L020', 'nama_kelurahan' => 'Dukuh Menanggal', 'kode_pos' => '60234', 'id_kecamatan' => 'K005'],
            
            // K006 - Genteng
            ['id_kelurahan' => 'L021', 'nama_kelurahan' => 'Embong Kaliasin', 'kode_pos' => '60271', 'id_kecamatan' => 'K006'],
            ['id_kelurahan' => 'L022', 'nama_kelurahan' => 'Genteng', 'kode_pos' => '60275', 'id_kecamatan' => 'K006'],
            ['id_kelurahan' => 'L023', 'nama_kelurahan' => 'Kapasari', 'kode_pos' => '60273', 'id_kecamatan' => 'K006'],
            ['id_kelurahan' => 'L024', 'nama_kelurahan' => 'Peneleh', 'kode_pos' => '60274', 'id_kecamatan' => 'K006'],
            ['id_kelurahan' => 'L025', 'nama_kelurahan' => 'Ketabang', 'kode_pos' => '60272', 'id_kecamatan' => 'K006'],
            
            // K007 - Gubeng
            ['id_kelurahan' => 'L026', 'nama_kelurahan' => 'Airlangga', 'kode_pos' => '60286', 'id_kecamatan' => 'K007'],
            ['id_kelurahan' => 'L027', 'nama_kelurahan' => 'Gubeng', 'kode_pos' => '60281', 'id_kecamatan' => 'K007'],
            ['id_kelurahan' => 'L028', 'nama_kelurahan' => 'Kertajaya', 'kode_pos' => '60282', 'id_kecamatan' => 'K007'],
            ['id_kelurahan' => 'L029', 'nama_kelurahan' => 'Mojo', 'kode_pos' => '60285', 'id_kecamatan' => 'K007'],
            ['id_kelurahan' => 'L030', 'nama_kelurahan' => 'Pucang Sewu', 'kode_pos' => '60283', 'id_kecamatan' => 'K007'],
            ['id_kelurahan' => 'L031', 'nama_kelurahan' => 'Baratajaya', 'kode_pos' => '60284', 'id_kecamatan' => 'K007'],
            
            // K008 - Jambangan
            ['id_kelurahan' => 'L032', 'nama_kelurahan' => 'Jambangan', 'kode_pos' => '60232', 'id_kecamatan' => 'K008'],
            ['id_kelurahan' => 'L033', 'nama_kelurahan' => 'Karah', 'kode_pos' => '60232', 'id_kecamatan' => 'K008'],
            ['id_kelurahan' => 'L034', 'nama_kelurahan' => 'Kebonsari', 'kode_pos' => '60233', 'id_kecamatan' => 'K008'],
            ['id_kelurahan' => 'L035', 'nama_kelurahan' => 'Pagesangan', 'kode_pos' => '60233', 'id_kecamatan' => 'K008'],
            
            // K009 - Karang Pilang
            ['id_kelurahan' => 'L036', 'nama_kelurahan' => 'Karang Pilang', 'kode_pos' => '60221', 'id_kecamatan' => 'K009'],
            ['id_kelurahan' => 'L037', 'nama_kelurahan' => 'Kebraon', 'kode_pos' => '60222', 'id_kecamatan' => 'K009'],
            ['id_kelurahan' => 'L038', 'nama_kelurahan' => 'Kedurus', 'kode_pos' => '60223', 'id_kecamatan' => 'K009'],
            ['id_kelurahan' => 'L039', 'nama_kelurahan' => 'Waru Gunung', 'kode_pos' => '60221', 'id_kecamatan' => 'K009'],
            
            // K010 - Kenjeran
            ['id_kelurahan' => 'L040', 'nama_kelurahan' => 'Bulak Banteng', 'kode_pos' => '60127', 'id_kecamatan' => 'K010'],
            ['id_kelurahan' => 'L041', 'nama_kelurahan' => 'Tambak Wedi', 'kode_pos' => '60126', 'id_kecamatan' => 'K010'],
            ['id_kelurahan' => 'L042', 'nama_kelurahan' => 'Tanah Kali Kedinding', 'kode_pos' => '60129', 'id_kecamatan' => 'K010'],
            ['id_kelurahan' => 'L043', 'nama_kelurahan' => 'Sidotopo Wetan', 'kode_pos' => '60128', 'id_kecamatan' => 'K010'],
            
            // K011 - Krembangan
            ['id_kelurahan' => 'L044', 'nama_kelurahan' => 'Krembangan Selatan', 'kode_pos' => '60175', 'id_kecamatan' => 'K011'],
            ['id_kelurahan' => 'L045', 'nama_kelurahan' => 'Perak Barat', 'kode_pos' => '60177', 'id_kecamatan' => 'K011'],
            ['id_kelurahan' => 'L046', 'nama_kelurahan' => 'Kemayoran', 'kode_pos' => '60176', 'id_kecamatan' => 'K011'],
            ['id_kelurahan' => 'L047', 'nama_kelurahan' => 'Morokrembangan', 'kode_pos' => '60178', 'id_kecamatan' => 'K011'],
            ['id_kelurahan' => 'L048', 'nama_kelurahan' => 'Dupak', 'kode_pos' => '60179', 'id_kecamatan' => 'K011'],
            
            // K012 - Lakarsantri
            ['id_kelurahan' => 'L049', 'nama_kelurahan' => 'Bangkingan', 'kode_pos' => '60214', 'id_kecamatan' => 'K012'],
            ['id_kelurahan' => 'L050', 'nama_kelurahan' => 'Jeruk', 'kode_pos' => '60213', 'id_kecamatan' => 'K012'],
            ['id_kelurahan' => 'L051', 'nama_kelurahan' => 'Lakarsantri', 'kode_pos' => '60211', 'id_kecamatan' => 'K012'],
            ['id_kelurahan' => 'L052', 'nama_kelurahan' => 'Lidah Kulon', 'kode_pos' => '60216', 'id_kecamatan' => 'K012'],
            ['id_kelurahan' => 'L053', 'nama_kelurahan' => 'Lidah Wetan', 'kode_pos' => '60215', 'id_kecamatan' => 'K012'],
            ['id_kelurahan' => 'L054', 'nama_kelurahan' => 'Sumur Welut', 'kode_pos' => '60212', 'id_kecamatan' => 'K012'],
            
            // K013 - Mulyorejo
            ['id_kelurahan' => 'L055', 'nama_kelurahan' => 'Dukuh Sutorejo', 'kode_pos' => '60113', 'id_kecamatan' => 'K013'],
            ['id_kelurahan' => 'L056', 'nama_kelurahan' => 'Kalijudan', 'kode_pos' => '60114', 'id_kecamatan' => 'K013'],
            ['id_kelurahan' => 'L057', 'nama_kelurahan' => 'Kalisari', 'kode_pos' => '60112', 'id_kecamatan' => 'K013'],
            ['id_kelurahan' => 'L058', 'nama_kelurahan' => 'Kejawan Putih Tambak', 'kode_pos' => '60112', 'id_kecamatan' => 'K013'],
            ['id_kelurahan' => 'L059', 'nama_kelurahan' => 'Manyar Sabrangan', 'kode_pos' => '60116', 'id_kecamatan' => 'K013'],
            ['id_kelurahan' => 'L060', 'nama_kelurahan' => 'Mulyorejo', 'kode_pos' => '60115', 'id_kecamatan' => 'K013'],
            
            // K014 - Pabean Cantikan
            ['id_kelurahan' => 'L061', 'nama_kelurahan' => 'Bongkaran', 'kode_pos' => '60161', 'id_kecamatan' => 'K014'],
            ['id_kelurahan' => 'L062', 'nama_kelurahan' => 'Krembangan Utara', 'kode_pos' => '60163', 'id_kecamatan' => 'K014'],
            ['id_kelurahan' => 'L063', 'nama_kelurahan' => 'Nyamplungan', 'kode_pos' => '60162', 'id_kecamatan' => 'K014'],
            ['id_kelurahan' => 'L064', 'nama_kelurahan' => 'Perak Timur', 'kode_pos' => '60164', 'id_kecamatan' => 'K014'],
            ['id_kelurahan' => 'L065', 'nama_kelurahan' => 'Perak Utara', 'kode_pos' => '60165', 'id_kecamatan' => 'K014'],
            
            // K015 - Pakal
            ['id_kelurahan' => 'L066', 'nama_kelurahan' => 'Babat Jerawat', 'kode_pos' => '60197', 'id_kecamatan' => 'K015'],
            ['id_kelurahan' => 'L067', 'nama_kelurahan' => 'Benowo', 'kode_pos' => '60195', 'id_kecamatan' => 'K015'],
            ['id_kelurahan' => 'L068', 'nama_kelurahan' => 'Pakal', 'kode_pos' => '60196', 'id_kecamatan' => 'K015'],
            ['id_kelurahan' => 'L069', 'nama_kelurahan' => 'Sumberejo', 'kode_pos' => '60198', 'id_kecamatan' => 'K015'],
            
            // K016 - Rungkut (Fixed from previous duplicate ID)
            ['id_kelurahan' => 'L070', 'nama_kelurahan' => 'Kalirungkut', 'kode_pos' => '60293', 'id_kecamatan' => 'K016'],
            ['id_kelurahan' => 'L071', 'nama_kelurahan' => 'Kedung Baruk', 'kode_pos' => '60298', 'id_kecamatan' => 'K016'],
            ['id_kelurahan' => 'L072', 'nama_kelurahan' => 'Medokan Ayu', 'kode_pos' => '60295', 'id_kecamatan' => 'K016'],
            ['id_kelurahan' => 'L073', 'nama_kelurahan' => 'Penjaringan Sari', 'kode_pos' => '60297', 'id_kecamatan' => 'K016'],
            ['id_kelurahan' => 'L074', 'nama_kelurahan' => 'Rungkut Kidul', 'kode_pos' => '60293', 'id_kecamatan' => 'K016'],
            ['id_kelurahan' => 'L075', 'nama_kelurahan' => 'Wonorejo', 'kode_pos' => '60296', 'id_kecamatan' => 'K016'],
            
            // K017 - Sambikerep
            ['id_kelurahan' => 'L076', 'nama_kelurahan' => 'Lontar', 'kode_pos' => '60216', 'id_kecamatan' => 'K017'],
            ['id_kelurahan' => 'L077', 'nama_kelurahan' => 'Made', 'kode_pos' => '60219', 'id_kecamatan' => 'K017'],
            ['id_kelurahan' => 'L078', 'nama_kelurahan' => 'Sambikerep', 'kode_pos' => '60217', 'id_kecamatan' => 'K017'],
            ['id_kelurahan' => 'L079', 'nama_kelurahan' => 'Bringin', 'kode_pos' => '60218', 'id_kecamatan' => 'K017'],
            
            // K018 - Sawahan
            ['id_kelurahan' => 'L080', 'nama_kelurahan' => 'Banyu Urip', 'kode_pos' => '60254', 'id_kecamatan' => 'K018'],
            ['id_kelurahan' => 'L081', 'nama_kelurahan' => 'Kupang Krajan', 'kode_pos' => '60253', 'id_kecamatan' => 'K018'],
            ['id_kelurahan' => 'L082', 'nama_kelurahan' => 'Pakis', 'kode_pos' => '60256', 'id_kecamatan' => 'K018'],
            ['id_kelurahan' => 'L083', 'nama_kelurahan' => 'Petemon', 'kode_pos' => '60252', 'id_kecamatan' => 'K018'],
            ['id_kelurahan' => 'L084', 'nama_kelurahan' => 'Putat Jaya', 'kode_pos' => '60255', 'id_kecamatan' => 'K018'],
            ['id_kelurahan' => 'L085', 'nama_kelurahan' => 'Sawahan', 'kode_pos' => '60251', 'id_kecamatan' => 'K018'],
            
            // K019 - Semampir (Fixed from previous incorrect label)
            ['id_kelurahan' => 'L086', 'nama_kelurahan' => 'Ampel', 'kode_pos' => '60151', 'id_kecamatan' => 'K019'],
            ['id_kelurahan' => 'L087', 'nama_kelurahan' => 'Pegirian', 'kode_pos' => '60155', 'id_kecamatan' => 'K019'],
            ['id_kelurahan' => 'L088', 'nama_kelurahan' => 'Sidotopo', 'kode_pos' => '60152', 'id_kecamatan' => 'K019'],
            ['id_kelurahan' => 'L089', 'nama_kelurahan' => 'Ujung', 'kode_pos' => '60155', 'id_kecamatan' => 'K019'],
            ['id_kelurahan' => 'L090', 'nama_kelurahan' => 'Wonokusumo', 'kode_pos' => '60154', 'id_kecamatan' => 'K019'],
            
            // K020 - Simokerto
            ['id_kelurahan' => 'L091', 'nama_kelurahan' => 'Kapasan', 'kode_pos' => '60141', 'id_kecamatan' => 'K020'],
            ['id_kelurahan' => 'L092', 'nama_kelurahan' => 'Simokerto', 'kode_pos' => '60143', 'id_kecamatan' => 'K020'],
            ['id_kelurahan' => 'L093', 'nama_kelurahan' => 'Simolawang', 'kode_pos' => '60144', 'id_kecamatan' => 'K020'],
            ['id_kelurahan' => 'L094', 'nama_kelurahan' => 'Tambakrejo', 'kode_pos' => '60142', 'id_kecamatan' => 'K020'],
            ['id_kelurahan' => 'L095', 'nama_kelurahan' => 'Sidodadi', 'kode_pos' => '60145', 'id_kecamatan' => 'K020'],
            
            // K021 - Sukolilo (Fixed from previous incorrect label)
            ['id_kelurahan' => 'L096', 'nama_kelurahan' => 'Gebang Putih', 'kode_pos' => '60117', 'id_kecamatan' => 'K021'],
            ['id_kelurahan' => 'L097', 'nama_kelurahan' => 'Keputih', 'kode_pos' => '60111', 'id_kecamatan' => 'K021'],
            ['id_kelurahan' => 'L098', 'nama_kelurahan' => 'Klampis Ngasem', 'kode_pos' => '60117', 'id_kecamatan' => 'K021'],
            ['id_kelurahan' => 'L099', 'nama_kelurahan' => 'Menur Pumpungan', 'kode_pos' => '60118', 'id_kecamatan' => 'K021'],
            ['id_kelurahan' => 'L100', 'nama_kelurahan' => 'Nginden Jangkungan', 'kode_pos' => '60118', 'id_kecamatan' => 'K021'],
            ['id_kelurahan' => 'L101', 'nama_kelurahan' => 'Semolowaru', 'kode_pos' => '60119', 'id_kecamatan' => 'K021'],
            ['id_kelurahan' => 'L102', 'nama_kelurahan' => 'Medokan Semampir', 'kode_pos' => '60119', 'id_kecamatan' => 'K021'],
            
            // K022 - Wonokromo
            ['id_kelurahan' => 'L103', 'nama_kelurahan' => 'Darmo', 'kode_pos' => '60241', 'id_kecamatan' => 'K022'],
            ['id_kelurahan' => 'L104', 'nama_kelurahan' => 'Jagir', 'kode_pos' => '60244', 'id_kecamatan' => 'K022'],
            ['id_kelurahan' => 'L105', 'nama_kelurahan' => 'Ngagel', 'kode_pos' => '60246', 'id_kecamatan' => 'K022'],
            ['id_kelurahan' => 'L106', 'nama_kelurahan' => 'Ngagel Rejo', 'kode_pos' => '60245', 'id_kecamatan' => 'K022'],
            ['id_kelurahan' => 'L107', 'nama_kelurahan' => 'Sawunggaling', 'kode_pos' => '60242', 'id_kecamatan' => 'K022'],
            ['id_kelurahan' => 'L108', 'nama_kelurahan' => 'Wonokromo', 'kode_pos' => '60243', 'id_kecamatan' => 'K022'],
            
            // K023 - Wiyung
            ['id_kelurahan' => 'L109', 'nama_kelurahan' => 'Babatan', 'kode_pos' => '60227', 'id_kecamatan' => 'K023'],
            ['id_kelurahan' => 'L110', 'nama_kelurahan' => 'Balas Klumprik', 'kode_pos' => '60222', 'id_kecamatan' => 'K023'],
            ['id_kelurahan' => 'L111', 'nama_kelurahan' => 'Jajar Tunggal', 'kode_pos' => '60229', 'id_kecamatan' => 'K023'],
            ['id_kelurahan' => 'L112', 'nama_kelurahan' => 'Wiyung', 'kode_pos' => '60228', 'id_kecamatan' => 'K023'],
            
            // K024 - Tambaksari
            ['id_kelurahan' => 'L113', 'nama_kelurahan' => 'Tambak Sari', 'kode_pos' => '60136', 'id_kecamatan' => 'K024'],
            ['id_kelurahan' => 'L114', 'nama_kelurahan' => 'Pacarkeling', 'kode_pos' => '60131', 'id_kecamatan' => 'K024'],
            ['id_kelurahan' => 'L115', 'nama_kelurahan' => 'Pacarkembang', 'kode_pos' => '60132', 'id_kecamatan' => 'K024'],
            ['id_kelurahan' => 'L116', 'nama_kelurahan' => 'Ploso', 'kode_pos' => '60133', 'id_kecamatan' => 'K024'],
            ['id_kelurahan' => 'L117', 'nama_kelurahan' => 'Rangkah', 'kode_pos' => '60135', 'id_kecamatan' => 'K024'],
            ['id_kelurahan' => 'L118', 'nama_kelurahan' => 'Gading', 'kode_pos' => '60134', 'id_kecamatan' => 'K024'],
            
            // K025 - Tegalsari
            ['id_kelurahan' => 'L119', 'nama_kelurahan' => 'Dr. Sutomo', 'kode_pos' => '60264', 'id_kecamatan' => 'K025'],
            ['id_kelurahan' => 'L120', 'nama_kelurahan' => 'Kedungdoro', 'kode_pos' => '60261', 'id_kecamatan' => 'K025'],
            ['id_kelurahan' => 'L121', 'nama_kelurahan' => 'Keputran', 'kode_pos' => '60265', 'id_kecamatan' => 'K025'],
            ['id_kelurahan' => 'L122', 'nama_kelurahan' => 'Tegalsari', 'kode_pos' => '60262', 'id_kecamatan' => 'K025'],
            ['id_kelurahan' => 'L123', 'nama_kelurahan' => 'Wonorejo', 'kode_pos' => '60263', 'id_kecamatan' => 'K025'],
            
            // K026 - Tenggilis Mejoyo
            ['id_kelurahan' => 'L124', 'nama_kelurahan' => 'Kendangsari', 'kode_pos' => '60292', 'id_kecamatan' => 'K026'],
            ['id_kelurahan' => 'L125', 'nama_kelurahan' => 'Kutisari', 'kode_pos' => '60291', 'id_kecamatan' => 'K026'],
            ['id_kelurahan' => 'L126', 'nama_kelurahan' => 'Panjang Jiwo', 'kode_pos' => '60299', 'id_kecamatan' => 'K026'],
            ['id_kelurahan' => 'L127', 'nama_kelurahan' => 'Tenggilis Mejoyo', 'kode_pos' => '60292', 'id_kecamatan' => 'K026'],
            
            // K027 - Sukomanunggal
            ['id_kelurahan' => 'L128', 'nama_kelurahan' => 'Simomulyo', 'kode_pos' => '60181', 'id_kecamatan' => 'K027'],
            ['id_kelurahan' => 'L129', 'nama_kelurahan' => 'Simomulyo Baru', 'kode_pos' => '60181', 'id_kecamatan' => 'K027'],
            ['id_kelurahan' => 'L130', 'nama_kelurahan' => 'Sukomanunggal', 'kode_pos' => '60187', 'id_kecamatan' => 'K027'],
            ['id_kelurahan' => 'L131', 'nama_kelurahan' => 'Putat Gede', 'kode_pos' => '60189', 'id_kecamatan' => 'K027'],
            ['id_kelurahan' => 'L132', 'nama_kelurahan' => 'Sono Kwijenan', 'kode_pos' => '60189', 'id_kecamatan' => 'K027'],
            ['id_kelurahan' => 'L133', 'nama_kelurahan' => 'Tanjungsari', 'kode_pos' => '60188', 'id_kecamatan' => 'K027'],

            // K028 - Bulak
            ['id_kelurahan' => 'L134', 'nama_kelurahan' => 'Bulak', 'kode_pos' => '60124', 'id_kecamatan' => 'K028'],
            ['id_kelurahan' => 'L135', 'nama_kelurahan' => 'Kedung Cowek', 'kode_pos' => '60125', 'id_kecamatan' => 'K028'],
            ['id_kelurahan' => 'L136', 'nama_kelurahan' => 'Kenjeran', 'kode_pos' => '60123', 'id_kecamatan' => 'K028'],
            ['id_kelurahan' => 'L137', 'nama_kelurahan' => 'Sukolilo Baru', 'kode_pos' => '60122', 'id_kecamatan' => 'K028'],

            // K029 - Tandes
            ['id_kelurahan' => 'L138', 'nama_kelurahan' => 'Balongsari', 'kode_pos' => '60186', 'id_kecamatan' => 'K029'],
            ['id_kelurahan' => 'L139', 'nama_kelurahan' => 'Banjar Sugihan', 'kode_pos' => '60185', 'id_kecamatan' => 'K029'],
            ['id_kelurahan' => 'L140', 'nama_kelurahan' => 'Karang Poh', 'kode_pos' => '60185', 'id_kecamatan' => 'K029'],
            ['id_kelurahan' => 'L141', 'nama_kelurahan' => 'Manukan Kulon', 'kode_pos' => '60185', 'id_kecamatan' => 'K029'],
            ['id_kelurahan' => 'L142', 'nama_kelurahan' => 'Manukan Wetan', 'kode_pos' => '60198', 'id_kecamatan' => 'K029'],
            ['id_kelurahan' => 'L143', 'nama_kelurahan' => 'Tandes', 'kode_pos' => '60187', 'id_kecamatan' => 'K029'],

            // K030 - Gunung Anyar
            ['id_kelurahan' => 'L144', 'nama_kelurahan' => 'Gunung Anyar', 'kode_pos' => '60294', 'id_kecamatan' => 'K030'],
            ['id_kelurahan' => 'L145', 'nama_kelurahan' => 'Gunung Anyar Tambak', 'kode_pos' => '60294', 'id_kecamatan' => 'K030'],
            ['id_kelurahan' => 'L146', 'nama_kelurahan' => 'Rungkut Menanggal', 'kode_pos' => '60293', 'id_kecamatan' => 'K030'],
            ['id_kelurahan' => 'L147', 'nama_kelurahan' => 'Rungkut Tengah', 'kode_pos' => '60293', 'id_kecamatan' => 'K030'],

            // K031 - Surabaya Pusat
            ['id_kelurahan' => 'L148', 'nama_kelurahan' => 'Ketabang Kali', 'kode_pos' => '60272', 'id_kecamatan' => 'K031'],
            ['id_kelurahan' => 'L149', 'nama_kelurahan' => 'Keputran Pasar Kecil', 'kode_pos' => '60265', 'id_kecamatan' => 'K031'],
            ['id_kelurahan' => 'L150', 'nama_kelurahan' => 'Kedung Lumbu', 'kode_pos' => '60261', 'id_kecamatan' => 'K031'],
            ['id_kelurahan' => 'L151', 'nama_kelurahan' => 'Kapasan Dalam', 'kode_pos' => '60141', 'id_kecamatan' => 'K031'],

            // K032 - Menganti
            ['id_kelurahan' => 'L152', 'nama_kelurahan' => 'Menganti', 'kode_pos' => '61174', 'id_kecamatan' => 'K032'],
            ['id_kelurahan' => 'L153', 'nama_kelurahan' => 'Boteng', 'kode_pos' => '61174', 'id_kecamatan' => 'K032'],
            ['id_kelurahan' => 'L154', 'nama_kelurahan' => 'Drancang', 'kode_pos' => '61174', 'id_kecamatan' => 'K032'],
            ['id_kelurahan' => 'L155', 'nama_kelurahan' => 'Sidowungu', 'kode_pos' => '61174', 'id_kecamatan' => 'K032'],

            // K033 - Kebomas
            ['id_kelurahan' => 'L156', 'nama_kelurahan' => 'Kebomas', 'kode_pos' => '61121', 'id_kecamatan' => 'K033'],
            ['id_kelurahan' => 'L157', 'nama_kelurahan' => 'Sidomukti', 'kode_pos' => '61123', 'id_kecamatan' => 'K033'],
            ['id_kelurahan' => 'L158', 'nama_kelurahan' => 'Singosari', 'kode_pos' => '61124', 'id_kecamatan' => 'K033'],
            ['id_kelurahan' => 'L159', 'nama_kelurahan' => 'Karang Kering', 'kode_pos' => '61122', 'id_kecamatan' => 'K033'],

            // K034 - Manyar
            ['id_kelurahan' => 'L160', 'nama_kelurahan' => 'Manyar', 'kode_pos' => '61151', 'id_kecamatan' => 'K034'],
            ['id_kelurahan' => 'L161', 'nama_kelurahan' => 'Manyarejo', 'kode_pos' => '61151', 'id_kecamatan' => 'K034'],
            ['id_kelurahan' => 'L162', 'nama_kelurahan' => 'Sukomulyo', 'kode_pos' => '61151', 'id_kecamatan' => 'K034'],
            ['id_kelurahan' => 'L163', 'nama_kelurahan' => 'Banjarsari', 'kode_pos' => '61151', 'id_kecamatan' => 'K034'],

            // K035 - Sidoarjo
            ['id_kelurahan' => 'L164', 'nama_kelurahan' => 'Sidoarjo', 'kode_pos' => '61212', 'id_kecamatan' => 'K035'],
            ['id_kelurahan' => 'L165', 'nama_kelurahan' => 'Magersari', 'kode_pos' => '61211', 'id_kecamatan' => 'K035'],
            ['id_kelurahan' => 'L166', 'nama_kelurahan' => 'Lemahputro', 'kode_pos' => '61213', 'id_kecamatan' => 'K035'],
            ['id_kelurahan' => 'L167', 'nama_kelurahan' => 'Bulusidokare', 'kode_pos' => '61214', 'id_kecamatan' => 'K035'],
            ['id_kelurahan' => 'L168', 'nama_kelurahan' => 'Celep', 'kode_pos' => '61215', 'id_kecamatan' => 'K035'],

            // K036 - Gedangan
            ['id_kelurahan' => 'L169', 'nama_kelurahan' => 'Gedangan', 'kode_pos' => '61254', 'id_kecamatan' => 'K036'],
            ['id_kelurahan' => 'L170', 'nama_kelurahan' => 'Ketajen', 'kode_pos' => '61254', 'id_kecamatan' => 'K036'],
            ['id_kelurahan' => 'L171', 'nama_kelurahan' => 'Sawotratap', 'kode_pos' => '61254', 'id_kecamatan' => 'K036'],
            ['id_kelurahan' => 'L172', 'nama_kelurahan' => 'Wedi', 'kode_pos' => '61254', 'id_kecamatan' => 'K036'],

            // K037 - Waru
            ['id_kelurahan' => 'L173', 'nama_kelurahan' => 'Waru', 'kode_pos' => '61256', 'id_kecamatan' => 'K037'],
            ['id_kelurahan' => 'L174', 'nama_kelurahan' => 'Pepelegi', 'kode_pos' => '61256', 'id_kecamatan' => 'K037'],
            ['id_kelurahan' => 'L175', 'nama_kelurahan' => 'Wadungasri', 'kode_pos' => '61256', 'id_kecamatan' => 'K037'],
            ['id_kelurahan' => 'L176', 'nama_kelurahan' => 'Tambak Oso', 'kode_pos' => '61256', 'id_kecamatan' => 'K037'],
            ['id_kelurahan' => 'L177', 'nama_kelurahan' => 'Medaeng', 'kode_pos' => '61256', 'id_kecamatan' => 'K037'],

            // K038 - Taman
            ['id_kelurahan' => 'L178', 'nama_kelurahan' => 'Taman', 'kode_pos' => '61257', 'id_kecamatan' => 'K038'],
            ['id_kelurahan' => 'L179', 'nama_kelurahan' => 'Geluran', 'kode_pos' => '61257', 'id_kecamatan' => 'K038'],
            ['id_kelurahan' => 'L180', 'nama_kelurahan' => 'Kalijaten', 'kode_pos' => '61257', 'id_kecamatan' => 'K038'],
            ['id_kelurahan' => 'L181', 'nama_kelurahan' => 'Ngelom', 'kode_pos' => '61257', 'id_kecamatan' => 'K038'],
            ['id_kelurahan' => 'L182', 'nama_kelurahan' => 'Wonocolo', 'kode_pos' => '61257', 'id_kecamatan' => 'K038']
        ]);
    }
}
