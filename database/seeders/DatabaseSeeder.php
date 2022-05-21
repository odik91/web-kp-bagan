<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $categories = [
            [
                'name' => 'Wisata',
                'slug' => 'wisata',
                'description' => 'Membahas mengenai wisata lokal'
            ],
            [
                'name' => 'PKK',
                'slug' => 'pkk',
                'description' => 'Membahas mengenai PKK'
            ],
            [
                'name' => 'Posyandu',
                'slug' => 'posyandu',
                'description' => 'Membahas mengenai posyandu'
            ],
            [
                'name' => 'Bahaya Narkoba',
                'slug' => 'bahaya-narkoba',
                'description' => 'Membahas mengenai seluk beluk narkoba'
            ],
            [
                'name' => 'UMKM',
                'slug' => 'umkm',
                'description' => 'Membahas mengenai UMKM desa'
            ],
            [
                'name' => 'Kampong Kite',
                'slug' => 'kampong-kite',
                'description' => 'Membahas mengenai hal-hal seputar kampong'
            ],
            [
                'name' => 'Uncategoize',
                'slug' => 'uncategoize',
                'description' => 'Tempat posting tanpa kategori'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $subcategories = [
            [
                'category_id' => 1,
                'subname' => 'Pantai',
                'slug' => 'pantai'
            ],
            [
                'category_id' => 1,
                'subname' => 'Spot Menarik',
                'slug' => 'spot-menarik'
            ],
            [
                'category_id' => 1,
                'subname' => 'Potensi Wisata',
                'slug' => 'potensi-wisata'
            ],
            [
                'category_id' => 2,
                'subname' => 'Kegiatan Rutin',
                'slug' => 'kegiatan-rutin'
            ],
            [
                'category_id' => 2,
                'subname' => 'Tanaman Obat Keluarga',
                'slug' => 'tanaman-obat-keluarga'
            ],
            [
                'category_id' => 3,
                'subname' => 'Kegiatan Rutin',
                'slug' => 'kegiatan-rutin'
            ],
            [
                'category_id' => 3,
                'subname' => 'Ibu dan Anak',
                'slug' => 'ibu-dan-anak'
            ],
            [
                'category_id' => 3,
                'subname' => 'Lansia',
                'slug' => 'lansia'
            ],
            [
                'category_id' => 4,
                'subname' => 'Jalur Masuk',
                'slug' => 'jalur-masuk'
            ],
            [
                'category_id' => 4,
                'subname' => 'Kenali Modus',
                'slug' => 'kenali-modus'
            ],
            [
                'category_id' => 4,
                'subname' => 'Bahaya',
                'slug' => 'bahaya'
            ],
            [
                'category_id' => 5,
                'subname' => 'Jenis UMKM lokal',
                'slug' => 'jenis-umkm-lokal'
            ],
            [
                'category_id' => 5,
                'subname' => 'Kiat Usaha',
                'slug' => 'kiat-usaha'
            ],
            [
                'category_id' => 5,
                'subname' => 'Marketing',
                'slug' => 'marketing'
            ],
            [
                'category_id' => 6,
                'subname' => 'Berita',
                'slug' => 'berita'
            ],
            [
                'category_id' => 6,
                'subname' => 'Kegiatan Warga',
                'slug' => 'kegiatan-warga'
            ],
            [
                'category_id' => 6,
                'subname' => 'Keamanan',
                'slug' => 'keamanan'
            ],
            [
                'category_id' => 7,
                'subname' => 'Artikel Bebas',
                'slug' => 'artikel-bebas'
            ],
        ];

        foreach ($subcategories as $subcategory) {
            SubCategory::create($subcategory);
        }
    }
}
