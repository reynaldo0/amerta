<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!User::where('email', 'admin@example.com')->exists()) {
            $user = User::create([
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'), // ganti di production!
                'role' => 'admin',
                'status' => 'active',
            ]);
        }

         // Regions
        $regions = [
            'Sumatra',
            'Jawa',
            'Kalimantan',
            'Sulawesi',
            'Bali & Nusa Tenggara',
            'Maluku',
            'Papua',
        ];

        $regionIds = [];

        foreach ($regions as $region) {
            $regionIds[$region] = DB::table('regions')->insertGetId([
                'name' => $region,
            ]);
        }

        // Provinces mapped to region
        $provinces = [
            'Sumatra' => [
                'Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau',
                'Kepulauan Riau', 'Jambi', 'Sumatera Selatan', 'Bangka Belitung',
                'Bengkulu', 'Lampung',
            ],
            'Jawa' => [
                'DKI Jakarta', 'Jawa Barat', 'Banten', 'Jawa Tengah',
                'DI Yogyakarta', 'Jawa Timur',
            ],
            'Kalimantan' => [
                'Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan',
                'Kalimantan Timur', 'Kalimantan Utara',
            ],
            'Sulawesi' => [
                'Sulawesi Utara', 'Gorontalo', 'Sulawesi Tengah', 'Sulawesi Barat',
                'Sulawesi Selatan', 'Sulawesi Tenggara',
            ],
            'Bali & Nusa Tenggara' => [
                'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur',
            ],
            'Maluku' => [
                'Maluku', 'Maluku Utara',
            ],
            'Papua' => [
                'Papua', 'Papua Barat', 'Papua Selatan', 'Papua Tengah', 'Papua Pegunungan',
            ],
        ];

        foreach ($provinces as $region => $provList) {
            foreach ($provList as $prov) {
                DB::table('provinces')->insert([
                    'name' => $prov,
                    'region_id' => $regionIds[$region],
                ]);
            }
        }

         $sections = [
            [
                'title' => 'Budaya Permainan',
                'body' => 'Kumpulan pertanyaan seputar permainan tradisional Indonesia.',
                'slug' => 'budaya-permainan',
                'questions' => [
                    [
                        'question_text' => 'Permainan tradisional "Congklak" biasanya dimainkan menggunakan apa?',
                        'options' => ['Batu kecil', 'Kelereng', 'Biji sawo/kerikil', 'Kacang tanah'],
                        'correct_answer' => 2,
                    ],
                    [
                        'question_text' => 'Egrang adalah permainan tradisional dengan alat utama berupa apa?',
                        'options' => ['Bambu', 'Tali', 'Kayu pendek', 'Karet'],
                        'correct_answer' => 0,
                    ],
                    [
                        'question_text' => 'Permainan tradisional "Bentengan" biasanya dimainkan oleh berapa kelompok?',
                        'options' => ['1 kelompok', '2 kelompok', '3 kelompok', '4 kelompok'],
                        'correct_answer' => 1,
                    ],
                    [
                        'question_text' => 'Lompat tali dari karet gelang biasanya dimainkan di mana?',
                        'options' => ['Lapangan bola', 'Halaman rumah/sekolah', 'Di sawah', 'Di pasar'],
                        'correct_answer' => 1,
                    ],
                    [
                        'question_text' => 'Permainan tradisional yang menggunakan gasing disebut?',
                        'options' => ['Layangan', 'Gundu', 'Panggal', 'Petak umpet'],
                        'correct_answer' => 2,
                    ],
                ],
            ],
            [
                'title' => 'Budaya Tarian',
                'body' => 'Kumpulan pertanyaan seputar tarian tradisional Indonesia.',
                'slug' => 'budaya-tarian',
                'questions' => [
                    [
                        'question_text' => 'Tari Saman berasal dari daerah mana?',
                        'options' => ['Jawa Barat', 'Aceh', 'Bali', 'Kalimantan'],
                        'correct_answer' => 1,
                    ],
                    [
                        'question_text' => 'Gerakan utama Tari Pendet biasanya menggambarkan apa?',
                        'options' => ['Penyambutan tamu', 'Perang', 'Panen padi', 'Bermain'],
                        'correct_answer' => 0,
                    ],
                    [
                        'question_text' => 'Tari Kecak dikenal dengan ciri khas apa?',
                        'options' => ['Iringan gamelan', 'Teriakan "cak" berulang', 'Menggunakan pedang', 'Menggunakan topeng'],
                        'correct_answer' => 1,
                    ],
                    [
                        'question_text' => 'Tari Jaipong berasal dari daerah mana?',
                        'options' => ['Jawa Barat', 'Sumatera Barat', 'Sulawesi Selatan', 'Papua'],
                        'correct_answer' => 0,
                    ],
                    [
                        'question_text' => 'Tari Reog Ponorogo terkenal dengan topeng berbentuk apa?',
                        'options' => ['Singa besar', 'Burung garuda', 'Harimau putih', 'Naga'],
                        'correct_answer' => 0,
                    ],
                ],
            ],
            [
                'title' => 'Adat Istiadat',
                'body' => 'Kumpulan pertanyaan seputar adat istiadat Indonesia.',
                'slug' => 'adat-istiadat',
                'questions' => [
                    [
                        'question_text' => 'Upacara Ngaben merupakan tradisi pembakaran jenazah yang berasal dari?',
                        'options' => ['Sumatera Barat', 'Jawa Tengah', 'Bali', 'Kalimantan'],
                        'correct_answer' => 2,
                    ],
                    [
                        'question_text' => 'Tradisi Ma’nene dari Toraja dilakukan untuk?',
                        'options' => ['Mengusir roh jahat', 'Membersihkan dan mengganti pakaian jenazah', 'Perayaan panen', 'Menyambut tamu'],
                        'correct_answer' => 1,
                    ],
                    [
                        'question_text' => 'Tradisi "Tabuik" yang memperingati Asyura berasal dari daerah?',
                        'options' => ['Aceh', 'Sumatera Barat', 'Kalimantan Timur', 'Papua'],
                        'correct_answer' => 1,
                    ],
                    [
                        'question_text' => 'Upacara Kasada dilakukan oleh suku Tengger di gunung apa?',
                        'options' => ['Gunung Rinjani', 'Gunung Merapi', 'Gunung Bromo', 'Gunung Kerinci'],
                        'correct_answer' => 2,
                    ],
                    [
                        'question_text' => 'Tradisi Sekaten biasanya dilaksanakan untuk memperingati apa?',
                        'options' => ['Hari kemerdekaan', 'Maulid Nabi Muhammad SAW', 'Panen raya', 'Tahun baru Jawa'],
                        'correct_answer' => 1,
                    ],
                ],
            ],
        ];

        foreach ($sections as $section) {
            $content = Content::create([
                'title' => $section['title'],
                'body' => $section['body'],
                'slug' => $section['slug'],
                'type' => 'quiz',
                'author_id' => $user->id,
            ]);

            $quiz = Quiz::create([
                'content_id' => $content->id,
                'created_by' => $user->id,
            ]);

            foreach ($section['questions'] as $q) {
                Question::create([
                    'quiz_id' => $quiz->id,
                    'question_text' => $q['question_text'],
                    'options' => json_encode($q['options']),
                    'correct_answer' => $q['correct_answer'], // sudah dalam bentuk index (0,1,2,3)
                ]);
            }
        }
    }
}