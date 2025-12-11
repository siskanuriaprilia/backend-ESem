<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class event extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'event_name' => 'Pelatihan Keamanan Jaringan Tingkat Lanjut',
                'event_status' => 'Ended',
            ],
            [
                'event_name' => 'Sesi Talkshow Karir Digital',
                'event_status' => 'On Going',
            ],
            [
                'event_name' => 'Workshop Pengembangan API Laravel',
                'event_status' => 'Ended',
            ],
            [
                'event_name' => 'Konferensi Teknologi Blockchain 2026',
                'event_status' => 'Canceled',
            ],
            [
                'event_name' => 'Webinar Desain Grafis Dasar',
                'event_status' => 'Ended',
            ],
            [
                'event_name' => 'Seminar Keamanan Siber Dasar',
                'event_status' => 'Coming Soon',
            ],
            [
                'event_name' => 'Bootcamp Frontend Developer 2026',
                'event_status' => 'Open Register',
            ],
            [
                'event_name' => 'Workshop UI/UX Research Fundamentals',
                'event_status' => 'Open Register',
            ],
            [
                'event_name' => 'Pelatihan Administrasi Server Linux',
                'event_status' => 'Coming Soon',
            ],
            [
                'event_name' => 'Pelatihan Digital Marketing Pemula',
                'event_status' => 'Open Register',
            ],
        ];

        // Masukkan data ke dalam tabel 'event_table'
        DB::table('event_table')->insert($events);
    }
}
