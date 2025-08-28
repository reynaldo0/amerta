<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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
    }
}
