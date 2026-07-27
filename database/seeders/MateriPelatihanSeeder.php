<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MateriPelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('materi_pelatihan')->insert([
            [
                'pelatihans_id'    => 1,
                'judul_materi'     => 'Pengenalan Dasar Pelatihan',
                'deskripsi'        => 'Materi pengantar untuk memahami konsep dasar dari pelatihan ini melalui tayangan video.',
                'file_materi_path' => null,
                'link_video'       => 'https://youtu.be/6kCC9whsGvc?si=dsiPti_-cKi0505M',
                'uploaded_by'      => 4,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'pelatihans_id'    => 1,
                'judul_materi'     => 'Studi Kasus & Implementasi',
                'deskripsi'        => 'Penjelasan langkah demi langkah implementasi materi pelatihan.',
                'file_materi_path' => null,
                'link_video'       => 'https://youtu.be/6kCC9whsGvc?si=dsiPti_-cKi0505M',
                'uploaded_by'      => 4,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
        ]);
    }
}
