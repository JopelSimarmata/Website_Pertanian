<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ForumCategories;

class ForumCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Budidaya Tanaman',
                'slug' => 'budidaya-tanaman',
                'description' => 'Diskusi tentang teknik budidaya, penanaman, dan perawatan tanaman',
                'icon' => '🌱'
            ],
            [
                'name' => 'Hama & Penyakit',
                'slug' => 'hama-penyakit',
                'description' => 'Pertanyaan dan solusi mengenai hama dan penyakit tanaman',
                'icon' => '🐛'
            ],
            [
                'name' => 'Pupuk & Nutrisi',
                'slug' => 'pupuk-nutrisi',
                'description' => 'Pembahasan tentang jenis pupuk, pemupukan, dan nutrisi tanaman',
                'icon' => '🧪'
            ],
            [
                'name' => 'Alat & Teknologi',
                'slug' => 'alat-teknologi',
                'description' => 'Diskusi seputar alat pertanian dan teknologi modern',
                'icon' => '🚜'
            ],
            [
                'name' => 'Panen & Pascapanen',
                'slug' => 'panen-pascapanen',
                'description' => 'Tips dan trik seputar waktu panen, penyimpanan, dan pengolahan hasil panen',
                'icon' => '🌾'
            ],
            [
                'name' => 'Pemasaran & Bisnis',
                'slug' => 'pemasaran-bisnis',
                'description' => 'Strategi pemasaran produk pertanian dan pengembangan bisnis',
                'icon' => '💼'
            ],
            [
                'name' => 'Tanaman Hias',
                'slug' => 'tanaman-hias',
                'description' => 'Diskusi tentang budidaya dan perawatan tanaman hias',
                'icon' => '🌺'
            ],
            [
                'name' => 'Pertanian Organik',
                'slug' => 'pertanian-organik',
                'description' => 'Pembahasan metode pertanian organik dan ramah lingkungan',
                'icon' => '♻️'
            ],
            [
                'name' => 'Tips & Trik',
                'slug' => 'tips-trik',
                'description' => 'Berbagi tips, trik, dan pengalaman praktis dalam bertani',
                'icon' => '💡'
            ],
            [
                'name' => 'Tanya Jawab Umum',
                'slug' => 'tanya-jawab-umum',
                'description' => 'Pertanyaan umum seputar dunia pertanian',
                'icon' => '❓'
            ],
        ];

        foreach ($categories as $category) {
            ForumCategories::create($category);
        }
    }
}
