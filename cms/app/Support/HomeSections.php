<?php

namespace App\Support;

/**
 * Defines every editable section on the Home page: its default content
 * (extracted from the original static index.html) and, for repeatable
 * sections, the shape of each item. This is the single source of truth
 * used by both the database seeder and the Filament section editor.
 */
class HomeSections
{
    public static function definitions(): array
    {
        return [
            [
                'section_key' => 'hero',
                'section_type' => 'hero',
                'label' => 'Hero Banner',
                'content' => [
                    'image' => 'images/project/bg-main.png',
                    'heading' => 'Freezing Solutions',
                    'description' => 'Machines for IQF, Spiral, Impingement, Plate Contact & Carton Box Freezers',
                    'primary_button_text' => 'Download Brochure',
                    'primary_button_link' => '/E-Brochure Final.pdf',
                    'secondary_button_text' => 'Contact Us',
                    'secondary_button_link' => '/contact.html',
                ],
            ],
            [
                'section_key' => 'products',
                'section_type' => 'product_grid',
                'label' => 'Our Equipments',
                'content' => [
                    'short_title' => 'OUR EQUIPMENTS',
                    'heading' => 'Advanced Freezing Technology for Food Processing',
                    'description' => 'We provide high-performance food processing solutions engineered for efficiency, reliability, and global food safety standards.',
                    'items' => [
                        [
                            'title' => 'OctoFrost IQF Freezer',
                            'subtitle' => 'High IQF degree',
                            'image' => 'images/project/IQF.png',
                            'quote' => 'High IQF degree, natural appearance',
                            'caption' => 'Highest yeild in industry, low lifecycle cost of freezing',
                            'link' => '/freezing/freezing.html',
                        ],
                        [
                            'title' => 'Blancher',
                            'subtitle' => 'Precision Blanching',
                            'image' => 'images/product/blancher.png',
                            'quote' => 'Precision blanching (+- 0.5 deg C) for natural-looking products.',
                            'caption' => 'Lowest steam and water consumption in industry with high yields.',
                            'link' => '/process/blanching.html',
                        ],
                        [
                            'title' => 'Chiller',
                            'subtitle' => 'Rapid Chilling',
                            'image' => 'images/product/chiller.png',
                            'quote' => 'Fast chilling with recirculated 1°C water for uniform cooling.',
                            'caption' => 'Guaranteed product temperature at outfeed 5°C or lower.',
                            'link' => '/process/blanching.html',
                        ],
                        [
                            'title' => 'Belt Grill',
                            'subtitle' => 'BG Pro-series',
                            'image' => 'images/product/grill.png',
                            'quote' => 'Sears products in their own fat for natural flavor.',
                            'caption' => 'OctoFrost-BG Belt Grill Systems Pro-series.',
                            'link' => '/heating/grill.html',
                        ],
                        [
                            'title' => 'Oil Filtration',
                            'subtitle' => 'Longer Oil Life',
                            'image' => 'images/product/oil-filteration.png',
                            'quote' => 'Improved end-product quality with extended oil lifetime.',
                            'caption' => 'Quick return on investment with reduced frying oil costs.',
                            'link' => '/heating/filteration.html',
                        ],
                        [
                            'title' => 'Washer',
                            'subtitle' => 'High Efficiency',
                            'image' => 'images/product/washing.png',
                            'quote' => 'Efficient washing for clean, safe, high-volume processing.',
                            'caption' => 'Gentle yet effective cleaning for consistent hygiene and dependable throughput.',
                            'link' => '/freezing/spiral.html',
                        ],
                        [
                            'title' => 'OctoFrost-HiTec Fryer',
                            'subtitle' => 'High Efficiency',
                            'image' => 'images/product/Fryer.png',
                            'quote' => 'Efficient frying for consistent, high-volume production.',
                            'caption' => 'The OctoFrost HiTec fryers deliver consistent frying performance with dependable throughput.',
                            'link' => '/freezing/spiral.html',
                        ],
                        [
                            'title' => 'Spiral Oven',
                            'subtitle' => 'Box Freezing',
                            'image' => 'images/product/spiraaloven.png',
                            'quote' => 'Specialized freezing for cartoned products.',
                            'caption' => 'Delivers even heat transfer, steady product quality, and dependable throughput.',
                            'link' => '/freezing/spiral.html',
                        ],
                    ],
                    'view_all_link' => '/equipments.html',
                ],
            ],
            [
                'section_key' => 'client_map',
                'section_type' => 'map_stats',
                'label' => 'Global Presence Map',
                'content' => [
                    'short_title' => 'Client Locations',
                    'heading' => 'Global Presence',
                    'image' => 'images/project/map.svg',
                ],
            ],
            [
                'section_key' => 'about',
                'section_type' => 'about',
                'label' => 'About Us',
                'content' => [
                    'short_title' => 'About Us',
                    'heading' => 'Empowering Growth Through Engineering',
                    'description' => 'Established in 2004, GBASE Technologies is helping food processors in South Asia & Oceanic Regions, with customised horticulture and food processing solutions - Project design and implementation - After-sales, maintenance & Operations. We deliver reliable engineering services to ensure operational efficiency and quality outcomes.',
                    'image' => 'images/product/peeling.png',
                    'badge_title' => '20+ Years',
                    'badge_description' => 'Of delivering trusted engineering and horticulture solutions across industries.',
                    'feature_cards' => [
                        [
                            'icon' => 'images/icon/info-card/v-1/icon-2.png',
                            'title' => 'Project Design & Implementation',
                            'description' => 'Our team of experts plans and executes turnkey horticulture and processing projects with precision and scalability.',
                        ],
                        [
                            'icon' => 'images/icon/info-card/v-1/icon-3.png',
                            'title' => 'Aftersales & Maintenance Support',
                            'description' => 'We ensure your operations run smoothly with planned repair, spares supply, and continuous technical support.',
                        ],
                    ],
                ],
            ],
            [
                'section_key' => 'contact_cta',
                'section_type' => 'contact_cta',
                'label' => 'Book a Meeting CTA',
                'content' => [
                    'heading' => 'Let\'s book an online meeting.',
                    'image' => 'images/product/3.png',
                ],
            ],
            [
                'section_key' => 'brand_slider',
                'section_type' => 'logo_slider',
                'label' => 'Our Clientele (Logos)',
                'content' => [
                    'heading' => 'Our Clientele',
                    'logos' => array_map(
                        fn (string $n) => ['image' => "images/clientlogos/{$n}.png"],
                        ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14.1', '14.2', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26.1', '26.2', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39']
                    ),
                ],
            ],
        ];
    }
}
