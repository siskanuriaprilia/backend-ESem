<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class event_detail extends Seeder
{
    public function run(): void
    {
        $eventDetails = [
            [
                'event_id' => 1,
                'event_description' => 'Pelatihan ini membahas konsep mendalam mengenai keamanan jaringan modern, perkembangan teknologi proteksi data, serta berbagai teknik penanganan ancaman siber tingkat lanjut. Cocok untuk profesional IT, admin jaringan, dan mahasiswa teknologi informasi. Materi mencakup: Analisis Serangan Siber, Penerapan Firewall Lanjutan, dan Manajemen Keamanan Infrastruktur.',
                'event_address' => 'Ruang Seminar A, Kampus Informatika',
                'event_speaker' => 'Ir. Andi Pratama, M.Kom',
                'register_open_date' => '2025-10-01',
                'register_closed_date' => '2025-11-25',
                'register_status' => false, // Ended

                'total_participant' => 120,
                'date' => '2025-12-01 10:00:00',
                'event_handler' => 1,
                'cost' => 500000,
                'total_income' => 0,
                'paid_status' => false,
            ],
            [
                'event_id' => 2,
                'event_description' => 'Talkshow ini menghadirkan para praktisi industri untuk membahas peta karir di era digital, perkembangan dunia kerja modern, serta keterampilan yang paling dibutuhkan saat ini. Cocok untuk mahasiswa, pencari kerja, dan profesional yang ingin mengembangkan karir. Pembahasan meliputi: Tren Profesi Digital, Tips Membangun Portofolio, dan Strategi Meningkatkan Skill Teknologi.',
                'event_address' => 'Aula Utama Gedung Serbaguna',
                'event_speaker' => 'Dewi Anggraini, S.Kom',
                'register_open_date' => '2025-11-01',
                'register_closed_date' => '2025-12-10',
                'register_status' => false, // Ended

                'total_participant' => 85,
                'date' => '2025-12-15 09:30:00',
                'event_handler' => 2,
                'cost' => 15000000,
                'total_income' => 42500000,
                'paid_status' => true,
            ],
            [
                'event_id' => 3,
                'event_description' => 'Workshop ini fokus pada pembuatan, pengelolaan, dan optimasi API menggunakan framework Laravel. Peserta akan mempelajari implementasi RESTful API, autentikasi, serta teknik pengujian endpoint secara efektif. Cocok untuk developer, programmer pemula, dan praktisi backend. Materi meliputi: Struktur API Laravel, Penggunaan Sanctum/Passport, dan Best Practice Deployment.',
                'event_address' => 'Lab Programming 2, Gedung Teknologi',
                'event_speaker' => 'Fauzan Rizqi, M.TI',
                'register_open_date' => '2025-11-15',
                'register_closed_date' => '2025-12-30',
                'register_status' => false, // Ended

                'total_participant' => 45,
                'date' => '2026-01-05 13:00:00',
                'event_handler' => 1,
                'cost' => 5000000,
                'total_income' => 12000000,
                'paid_status' => true,
            ],
            [
                'event_id' => 4,
                'event_description' => 'Konferensi ini mengulas perkembangan terbaru teknologi blockchain, penerapannya dalam industri global, serta peluang inovasi di masa depan. Cocok untuk peneliti, pelaku startup, investor, dan pemerhati teknologi. Pembahasan mencakup: Smart Contract Modern, Ekosistem Web3, serta Tantangan dan Regulasi Blockchain Tahun 2026.',
                'event_address' => 'Ballroom Hotel Grand Horizon',
                'event_speaker' => 'Dr. Rian Mahendra',
                'register_open_date' => '2025-12-01',
                'register_closed_date' => '2026-01-10',
                'register_status' => false, // Canceled

                'total_participant' => 200,
                'date' => '2026-01-20 18:30:00',
                'event_handler' => 3,
                'cost' => 2000000,
                'total_income' => 0,
                'paid_status' => false,
            ],
            [
                'event_id' => 5,
                'event_description' => 'Webinar ini memperkenalkan konsep fundamental desain grafis, teori warna, serta teknik dasar dalam menciptakan karya visual yang menarik. Cocok untuk pemula, pelajar, dan siapa saja yang ingin mulai berkarya secara kreatif. Materi meliputi: Prinsip Komposisi, Dasar-Dasar Typography, dan Penggunaan Tools Desain Digital.',
                'event_address' => 'Online via Zoom',
                'event_speaker' => 'Sinta Maharani, S.Ds',
                'register_open_date' => '2025-12-20',
                'register_closed_date' => '2026-02-05',
                'register_status' => false, // Ongoing

                'total_participant' => 30,
                'date' => '2026-02-10 11:00:00',
                'event_handler' => 4,
                'cost' => 8000000,
                'total_income' => 18000000,
                'paid_status' => true,
            ],
            [
                'event_id' => 6,
                'event_description' => 'Seminar ini memperkenalkan konsep dasar keamanan siber, jenis serangan umum, dan langkah awal pencegahan. Cocok untuk pelajar, pemula IT, dan pengguna internet yang ingin meningkatkan keamanan digital.',
                'event_address' => 'Ruang Auditorium A, Kampus Informatika',
                'event_speaker' => 'Dr. Luki Pradana',
                'register_open_date' => '2026-03-15',
                'register_closed_date' => '2026-04-01',
                'register_status' => false, // Coming Soon
                'total_participant' => 0,
                'date' => '2026-05-01 09:00:00',
                'event_handler' => 1,
                'cost' => 2000000,
                'total_income' => 0,
                'paid_status' => false,
            ],
            [
                'event_id' => 7,
                'event_description' => 'Bootcamp intensif untuk mempelajari HTML, CSS, JavaScript, dan React dari dasar hingga siap kerja. Peserta akan membangun proyek nyata dan mendapatkan pendampingan mentor.',
                'event_address' => 'Lab Komputer 1, Gedung Teknologi',
                'event_speaker' => 'Siti Marlina, S.Kom',
                'register_open_date' => '2026-03-01',
                'register_closed_date' => '2026-03-25',
                'register_status' => true, // Open Register
                'total_participant' => 50,
                'date' => '2026-04-10 08:00:00',
                'event_handler' => 2,
                'cost' => 10000000,
                'total_income' => 15000000,
                'paid_status' => true,
            ],
            [
                'event_id' => 8,
                'event_description' => 'Workshop yang membahas teknik riset pengguna, analisis kebutuhan, serta penyusunan persona dan user journey. Cocok untuk desainer UI/UX pemula.',
                'event_address' => 'Studio Desain Digital, Lantai 3',
                'event_speaker' => 'Tegar Yudhistira, M.Ds',
                'register_open_date' => '2026-03-05',
                'register_closed_date' => '2026-03-20',
                'register_status' => true, // Open Register
                'total_participant' => 40,
                'date' => '2026-04-05 10:00:00',
                'event_handler' => 3,
                'cost' => 3000000,
                'total_income' => 6000000,
                'paid_status' => true,
            ],
            [
                'event_id' => 9,
                'event_description' => 'Pelatihan ini membahas konfigurasi server Linux, manajemen user, izin file, service monitoring, dan troubleshooting awal. Cocok untuk pemula yang ingin masuk ke dunia sysadmin.',
                'event_address' => 'Lab Server 2, Gedung IT',
                'event_speaker' => 'Ahmad Surya, M.Kom',
                'register_open_date' => '2026-04-01',
                'register_closed_date' => '2026-04-20',
                'register_status' => false, // Coming Soon
                'total_participant' => 0,
                'date' => '2026-05-15 13:00:00',
                'event_handler' => 1,
                'cost' => 5000000,
                'total_income' => 0,
                'paid_status' => false,
            ],
            [
                'event_id' => 10,
                'event_description' => 'Pelatihan dasar untuk memahami strategi pemasaran digital, mulai dari branding, copywriting, hingga penggunaan media sosial sebagai alat promosi utama.',
                'event_address' => 'Online melalui Zoom',
                'event_speaker' => 'Nadia Kusuma, S.E',
                'register_open_date' => '2026-02-25',
                'register_closed_date' => '2026-03-10',
                'register_status' => true, // Open Register
                'total_participant' => 120,
                'date' => '2026-03-20 19:00:00',
                'event_handler' => 4,
                'cost' => 4000000,
                'total_income' => 12000000,
                'paid_status' => true,
            ],
        ];

        DB::table('event_detail_table')->insert($eventDetails);
    }
}
