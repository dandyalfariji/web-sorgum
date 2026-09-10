<?php

namespace Database\Seeders;

use App\Models\Header;
use App\Models\HeaderMenuItem;
use App\Models\HeroSection;
use App\Models\Feature;
use App\Models\CompanyPage;
use App\Models\Partner;
use App\Models\TeamMember;
use App\Models\Footer;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Header
        $header = Header::updateOrCreate(
            ['name' => 'Header Utama'],
            [
                'logo_path' => 'logo/01K606ZG8YP2M535S5YRSZNJDR.png',
                'is_active' => true,
            ]
        );

        // Header Menu Items
        $menuItems = [
            ['label' => 'Home', 'url' => '#home', 'wire_click_key' => 'home', 'order' => 1],
            ['label' => 'Fitur', 'url' => '#features', 'wire_click_key' => 'features', 'order' => 2],
            ['label' => 'Tentang Kami', 'url' => '#company', 'wire_click_key' => 'company', 'order' => 3],
            ['label' => 'Mitra', 'url' => '#partners', 'wire_click_key' => 'partners', 'order' => 4],
            ['label' => 'Tim Kami', 'url' => '#team', 'wire_click_key' => 'team', 'order' => 5],
            ['label' => 'Marketplace', 'url' => '/marketplace', 'wire_click_key' => 'marketplace', 'order' => 6],
            ['label' => 'Article', 'url' => '/artikel', 'wire_click_key' => 'article', 'order' => 7],
        ];

        foreach ($menuItems as $item) {
            HeaderMenuItem::updateOrCreate(
                ['header_id' => $header->id, 'label' => $item['label']],
                [
                    'url' => $item['url'],
                    'wire_click_key' => $item['wire_click_key'],
                    'order' => $item['order'],
                    'is_visible' => true,
                ]
            );
        }

        // 2. Hero Section
        HeroSection::updateOrCreate(
            ['name' => 'Hero Utama'],
            [
                'is_active' => true,
                'headline' => 'Nikmati Kebaikan Sorgum Bersama Sorgummi',
                'description' => 'Minuman sereal sorgum premium yang sehat, praktis, alami, dan bebas gluten untuk mendukung produktivitas dan energi harian Anda.',
                'primary_button_text' => 'Belanja Sekarang',
                'primary_button_url' => '/marketplace',
                'secondary_button_text' => 'Pelajari Lebih Lanjut',
                'secondary_button_url' => '#features',
                'hero_image_path' => 'hero-images/01K60NDNY2M1BQKMGTDV9E215B.png',
                'mid_section_headline' => 'Sehat dan Halal untuk Keluarga',
                'mid_section_description' => 'Produk Sorgummi diproduksi dengan standar higienis tinggi, 100% alami, dan telah bersertifikasi Halal. Pilihan terbaik untuk gaya hidup sehat Anda.',
                'mid_section_image_path' => 'site-logos/01K65941E03BW331S9YEBAYC7B.png',
                'cta_headline' => 'Mulai Hidup Sehat dengan Sorgummi',
                'cta_description' => 'Temukan berbagai produk olahan sorgum berkualitas tinggi di marketplace kami sekarang.',
                'cta_button_text' => 'Lihat Produk',
                'cta_button_url' => '/marketplace',
            ]
        );

        // 3. Features
        $features = [
            [
                'title' => 'Energi Seimbang',
                'description' => '<b>79,9 kkal</b> per 30 g—pas untuk sarapan ringan atau pengganjal lapar.',
                'icon' => 'feature-icons/01K62MBGEA4WJFXMDR7NRZNAWR.png',
                'sort_order' => 1,
            ],
            [
                'title' => 'Tinggi Serat',
                'description' => '<b>3,2 g serat</b> membantu kenyang lebih lama & mendukung pencernaan.',
                'icon' => 'feature-icons/01K62PHM9HWC2FPN7FSJ5RGAJ7.png',
                'sort_order' => 2,
            ],
            [
                'title' => 'Karbohidrat Baik',
                'description' => '<b>13,03 g karbo</b> dari sorgum & biji-bijian, cocok untuk energi harian.',
                'icon' => 'feature-icons/01K62PPMQBVTHGBRZP007TMDXS.png',
                'sort_order' => 3,
            ],
            [
                'title' => 'Lemak Sehat',
                'description' => '<b>3,4 g lemak</b> terutama dari almond & chia—lemak tak jenuh yang baik.',
                'icon' => 'feature-icons/01K62PQK8HQFY788T3QF4T9GG2.png',
                'sort_order' => 4,
            ],
            [
                'title' => 'Natrium Rendah',
                'description' => 'Hanya <b>47,11 mg</b> natrium per saji—lebih nyaman untuk pola makan harian.',
                'icon' => 'feature-icons/01K62Q12GM065ZEZKQCAZFAK9H.png',
                'sort_order' => 5,
            ],
            [
                'title' => 'Bebas Gluten',
                'description' => 'Berbasis sorgum—<b>naturally gluten-free</b>, nyaman untuk banyak orang.',
                'icon' => 'feature-icons/01K62QRMK62PY7AYDTVGE6SHHZ.png',
                'sort_order' => 6,
            ],
        ];

        foreach ($features as $feat) {
            Feature::updateOrCreate(
                ['title' => $feat['title']],
                [
                    'description' => $feat['description'],
                    'icon' => $feat['icon'],
                    'sort_order' => $feat['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        // 4. Company Page
        CompanyPage::updateOrCreate(
            ['headline' => 'Tentang Sorgumology & Sorgummi'],
            [
                'paragraph_1' => 'Sorgumology merupakan program pemberdayaan masyarakat dan inovasi pangan yang diinisiasi oleh civitas akademika Telkom University bekerjasama dengan Telkom Indonesia. Kami berfokus pada pemanfaatan sorgum sebagai bahan pangan berkelanjutan guna mendukung ketahanan pangan nasional.',
                'paragraph_2' => 'Melalui produk Sorgummi, kami menghadirkan minuman sereal sehat instan berbasis sorgum dengan gizi seimbang, tinggi serat, dan bebas gluten. Diproduksi bersama dengan kelompok tani lokal Bojongmanggu untuk meningkatkan perekonomian daerah secara berkelanjutan.',
                'button_1_text' => 'Lihat Produk',
                'button_1_link' => '/marketplace',
                'button_2_text' => 'Hubungi Kami',
                'button_2_link' => 'https://wa.me/628123456789',
                'image_1' => 'company-images/01K644JA7P7X7DQDBQTK3AQ9KN.jpg',
                'image_1_alt' => 'Lab Sorgumology',
                'image_2' => 'company-images/01K644JA9PJYQKYEBX0050N7W0.jpg',
                'image_2_alt' => 'Greenhouse Sorgum',
            ]
        );

        // 5. Partners
        $partners = [
            ['name' => 'Telkom University', 'image' => 'partners/01K647F5NQP57BZ485KVZDTSH9.png'],
            ['name' => 'Telkom Indonesia', 'image' => 'partners/01K647M9A0EGFGYSDF1F3FYDBA.png'],
            ['name' => 'KWT Melati Sorgum', 'image' => 'partners/01K647P54AW8VQ4QDY9YBBSYT5.png'],
        ];

        foreach ($partners as $partner) {
            Partner::updateOrCreate(
                ['name' => $partner['name']],
                [
                    'image' => $partner['image'],
                    'url' => '#',
                    'is_active' => true,
                ]
            );
        }

        // 6. Team Members
        $team = [
            [
                'name' => 'M. Dandy Alfariji',
                'role' => 'CEO',
                'photo' => 'team-photos/01K6512QBEREQB07B00QGHYVKV.jpg',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'order' => 1,
            ],
            [
                'name' => 'Kak Salma',
                'role' => 'UI/UX Designer & Creative lead',
                'photo' => 'team-photos/01K6516ZS6ZBT8TXTBD8HY2WRW.jpg',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'order' => 2,
            ],
            [
                'name' => 'Kak Irba',
                'role' => 'Marketing & External Relation',
                'photo' => 'team-photos/01K651SZEW6B9ZJQGYN2HAHE3M.jpg',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'order' => 3,
            ],
            [
                'name' => 'Anak Agung Rizky Jhotama',
                'role' => 'CTO',
                'photo' => 'team-photos/01K651RNJ3P360KD6KWTVVJ2C0.jpg',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'order' => 4,
            ],
            [
                'name' => 'Zahara',
                'role' => 'COO',
                'photo' => 'team-photos/01K651VF299GNT0M1AZ45P9C0D.jpg',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'order' => 5,
            ],
            [
                'name' => 'Khairunisa Nur Aqila',
                'role' => 'CMO',
                'photo' => 'team-photos/01K651RNJ3P360KD6KWTVVJ2C0.jpg',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
                'order' => 6,
            ],
        ];

        foreach ($team as $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name']],
                [
                    'role' => $member['role'],
                    'photo' => $member['photo'],
                    'instagram_url' => $member['instagram'],
                    'linkedin_url' => $member['linkedin'],
                    'sort_order' => $member['order'],
                    'is_active' => true,
                ]
            );
        }

        // 7. Footer
        Footer::updateOrCreate(
            ['brand_name' => 'Sorgummi'],
            [
                'logo_path' => 'logo/01K60B2DMZK615F1D56R3YG52X.png',
                'description' => 'Minuman sereal sorgum premium yang sehat, praktis, alami, dan bebas gluten.',
                'copyright_text' => 'All Rights Reserved.',
                'whatsapp_url' => 'https://wa.me/628123456789',
                'instagram_url' => 'https://instagram.com/sorgumology',
                'tiktok_url' => 'https://tiktok.com',
                'shopee_url' => 'https://shopee.co.id',
                'link_columns' => [
                    [
                        'column_title' => 'Layanan',
                        'links' => [
                            ['link_text' => 'Home', 'link_url' => '#home'],
                            ['link_text' => 'Fitur', 'link_url' => '#features'],
                            ['link_text' => 'Marketplace', 'link_url' => '/marketplace'],
                            ['link_text' => 'Article', 'link_url' => '/artikel'],
                        ]
                    ],
                    [
                        'column_title' => 'Tentang Kami',
                        'links' => [
                            ['link_text' => 'Profil', 'link_url' => '#company'],
                            ['link_text' => 'Tim Kami', 'link_url' => '#team'],
                        ]
                    ],
                    [
                        'column_title' => 'Kontak',
                        'links' => [
                            ['link_text' => 'WhatsApp', 'link_url' => 'https://wa.me/628123456789'],
                            ['link_text' => 'Email Kami', 'link_url' => 'mailto:info@sorgummi.com'],
                        ]
                    ]
                ],
            ]
        );
    }
}