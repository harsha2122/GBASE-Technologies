<?php

namespace App\Support;

/**
 * Definitions for the Phase 3 equipment catalog: the two category
 * landing pages (Freezing, Heating) and the 18 individual equipment
 * detail pages that sit under /freezing, /heating, /process and
 * /sorting. Each page is modelled as a Page + page_header section
 * (breadcrumb heading + CTA copy) and an equipment_cards section
 * (the body content), mirroring the pattern used for Consulting and
 * Spare Parts.
 */
class EquipmentPagesSections
{
    private const GENERIC_CTA_HEADING = 'Your questions deserve the best answers.';

    private const GENERIC_CTA_SUBHEADING = "Let's get in touch and talk.";

    public static function pages(): array
    {
        return [
            // Category landing pages
            [
                'slug' => 'freezing-landing',
                'category' => 'freezing',
                'detail_slug' => null,
                'title' => 'Freezing',
                'meta_title' => 'Freezing Equipment | GBASE Technologies',
                'meta_description' => 'IQF, Impingement, Spiral, Plate and Carton Box freezing equipment from GBASE Technologies.',
                'header' => [
                    'heading' => 'Freezing',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => "Let's get in touch and talk about Individual Quick Freezing and Processing.",
                ],
                'cards' => [
                    'intro_short_title' => 'Freezing',
                    'intro_heading' => 'Explore our Freezing Equipment',
                    'intro_description' => '',
                    'cards' => [
                        ['heading' => 'OctoFrost IQF Freezer', 'description' => 'Innovative open design to deliver natural appearance, high yields & low lifetime cost of operations.', 'image' => '/images/project/IQF.png', 'link' => '/freezing/freezing.html'],
                        ['heading' => 'OctoFrost Impingement Freezer', 'description' => 'A high-capacity, compact freezing solution designed for static and flat food products.', 'image' => '/images/project/impingement.png', 'link' => '/freezing/impingement.html'],
                        ['heading' => 'Spiral / Plate / Carton Box Freezers', 'description' => 'Spiral, Contact Plate and Carton Box freezing systems tailored to your product range.', 'image' => null, 'link' => '/freezing/spiral.html'],
                    ],
                ],
            ],
            [
                'slug' => 'heating-landing',
                'category' => 'heating',
                'detail_slug' => null,
                'title' => 'Heating',
                'meta_title' => 'Heating Equipment | GBASE Technologies',
                'meta_description' => 'Grills, fryers, ovens and oil filtration/coating systems from GBASE Technologies.',
                'header' => [
                    'heading' => 'Heating',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => 'Heating',
                    'intro_heading' => 'Explore our Heating Equipment',
                    'intro_description' => '',
                    'cards' => [
                        ['heading' => 'OctoFrost-HiTec Fryer TH/EH Pro Series', 'description' => 'Multi-purpose, continuously operating high-performance frying machines.', 'image' => '/images/product/Fryer.png', 'link' => '/heating/grill.html'],
                        ['heading' => 'OctoFrost HiTec Spiral & Linear Ovens', 'description' => 'Cooked, browned, roasted or steamed products in hot circulating air and/or steam.', 'image' => '/images/product/spiraaloven.png', 'link' => '/heating/oven.html'],
                        ['heading' => 'Oil Filtration, Coating & Flattening', 'description' => 'Extended oil lifetime and a quick return on investment, plus full coating lines.', 'image' => '/images/product/oil-filteration.png', 'link' => '/heating/filteration.html'],
                    ],
                ],
            ],

            // Freezing detail pages
            [
                'slug' => 'freezing-freezing',
                'category' => 'freezing',
                'detail_slug' => 'freezing',
                'title' => 'IQF Freezer',
                'meta_title' => 'OctoFrost IQF Freezer | GBASE Technologies',
                'meta_description' => 'Innovative open design to deliver natural appearance, high yields and low lifetime cost of operations.',
                'header' => [
                    'heading' => 'IQF Freezer',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => '',
                    'intro_heading' => '',
                    'intro_description' => '',
                    'cards' => [
                        [
                            'heading' => 'OctoFrost IQF Freezer',
                            'description' => 'Innovative open design to deliver natural appearance, high yields & low lifetime cost of operations.',
                            'image' => '/images/project/IQF.png',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'freezing-impingement',
                'category' => 'freezing',
                'detail_slug' => 'impingement',
                'title' => 'Impingement Freezer',
                'meta_title' => 'OctoFrost Impingement Freezer | GBASE Technologies',
                'meta_description' => 'A high-capacity, compact freezing solution designed for static and flat food products.',
                'header' => [
                    'heading' => 'Impingement Freezer',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => '',
                    'intro_heading' => '',
                    'intro_description' => '',
                    'cards' => [
                        [
                            'heading' => 'OctoFrost Impingement Freezer',
                            'description' => 'The OctoFrost Impingement Freezer is a high-capacity, compact freezing solution designed for static and flat food products. With multi-level belt option, it offers efficient freezing, minimal dehydration, and maximum yield - all within a small factory footprint.',
                            'image' => '/images/project/impingement.png',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'freezing-spiral',
                'category' => 'freezing',
                'detail_slug' => 'spiral',
                'title' => 'Spiral / Plate / Carton Box Freezers',
                'meta_title' => 'Spiral, Plate & Carton Box Freezers | GBASE Technologies',
                'meta_description' => 'Spiral, Contact Plate and Carton Box freezing systems from GBASE Technologies.',
                'header' => [
                    'heading' => 'Spiral /Plate / Carton box Freezers',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => '',
                    'intro_heading' => '',
                    'intro_description' => '',
                    'cards' => [
                        ['heading' => 'Spiral Systems', 'description' => 'Tailored to your needs RTE, poultry, Sea-Food to raw dough. We ensure the spiral system is the best suited to our customers needs.'],
                        ['heading' => 'Contact Plate Freezer', 'description' => 'Strong industrial design to deliver world class performance year after year.'],
                        ['heading' => 'Carton box Freezers', 'description' => 'The carton box freezers helps in fast freezing for the best quality of your products.'],
                    ],
                ],
            ],

            // Heating detail pages
            [
                'slug' => 'heating-filteration',
                'category' => 'heating',
                'detail_slug' => 'filteration',
                'title' => 'Oil-Filteration / Coating / Flattener',
                'meta_title' => 'Oil Filtration, Coating & Flattener | GBASE Technologies',
                'meta_description' => 'Oil filtration systems, flatteners and coating equipment from GBASE Technologies.',
                'header' => [
                    'heading' => 'Oil-Filteration / Coating / Flattener',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => '',
                    'intro_heading' => '',
                    'intro_description' => '',
                    'cards' => [
                        ['heading' => 'OctoFrost Oil Filtration Systems', 'description' => 'Improved quality of your end product, extended oil lifetime. Quick return on investment! Reduced cost due to longer lifetime of frying oil.', 'image' => '/images/product/oil-filteration.png'],
                        ['heading' => 'OctoFrost Flattener', 'description' => 'The OctoFrost Flattening-system is designed to flatten and roll out all types of fresh and soft frozen meat and vegetarian products.', 'image' => '/images/product/flattener.png'],
                        ['heading' => 'Coating Equipment', 'sub_label' => '(Predust-Wetcoat/Tempura, Dip/Breader, Crumb)', 'description' => 'Complete coating lines with an accurate solution to produce a range of perfectly coated and fried products.', 'image' => '/images/product/coating.png'],
                    ],
                ],
            ],
            [
                'slug' => 'heating-grill',
                'category' => 'heating',
                'detail_slug' => 'grill',
                'title' => 'Grill / Fryer',
                'meta_title' => 'Grill & Fryer Systems | GBASE Technologies',
                'meta_description' => 'OctoFrost grill and fryer systems from GBASE Technologies.',
                'header' => [
                    'heading' => 'Grill / Fryer',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => '',
                    'intro_heading' => '',
                    'intro_description' => '',
                    'cards' => [
                        ['heading' => 'OctoFrost-HiTec FRYER TH/EH PRO Series', 'description' => 'The OctoFrost HiTec fryers are multi-purpose, continuously operating high-performance machines which allow to fry a wide range of products.', 'image' => '/images/product/Fryer.png'],
                        ['heading' => 'OctoFrost-BG Belt Grill Systems Pro-series', 'description' => 'The OctoFrost HiTec Belt Grill contact cooker pro-series sears products exclusively in their own fat. That way, it gets the natural flavor of the products.', 'image' => '/images/product/grill.png'],
                    ],
                ],
            ],
            [
                'slug' => 'heating-oven',
                'category' => 'heating',
                'detail_slug' => 'oven',
                'title' => 'Spiral / Linear Oven',
                'meta_title' => 'Spiral & Linear Ovens | GBASE Technologies',
                'meta_description' => 'OctoFrost HiTec spiral and linear ovens from GBASE Technologies.',
                'header' => [
                    'heading' => 'Spiral / Linear Oven',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => '',
                    'intro_heading' => '',
                    'intro_description' => '',
                    'cards' => [
                        ['heading' => 'OctoFrost HiTec Spiral Oven', 'description' => 'The OctoFrost HiTec Spiral Oven (HSO) the future of food processing is here! Perfectly suited for producing cooked, browned and roasted and or steamed products in hot circulating air and/or steam.', 'image' => '/images/product/spiraaloven.png'],
                        ['heading' => 'OctoFrost HiTec Linear Heat Oven', 'description' => "The OctoFrost HiTec Aircook linear oven has two heating areas available that can be tempered differently at the same time. That'll bring you maximum efficiency.", 'image' => '/images/product/linearoven.png'],
                    ],
                ],
            ],

            // Process detail pages
            [
                'slug' => 'process-blanching',
                'category' => 'process',
                'detail_slug' => 'blanching',
                'title' => 'Blanching / Chilling / De-Watering',
                'meta_title' => 'Blanching, Chilling & De-Watering | GBASE Technologies',
                'meta_description' => 'Blanchers, chillers and de-watering shakers from GBASE Technologies.',
                'header' => [
                    'heading' => 'Blanching / Chilling / De-Watering',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => '',
                    'intro_heading' => '',
                    'intro_description' => '',
                    'cards' => [
                        [
                            'heading' => 'Blancher',
                            'description' => 'Precision blanching (+- 0.5 deg C) for natural-looking products and high yields. Ability to blanch/cook a wide range of products. Lowest steam and water consumption in industry.',
                            'image' => '/images/product/blancher.png',
                            'product_group' => [
                                ['label' => 'Fruits', 'icon' => '/images/icon/fruits-p-Copy.png'],
                                ['label' => 'Pasta', 'icon' => '/images/icon/pasta-p-2048x1299.png'],
                                ['label' => 'Vegetables', 'icon' => '/images/icon/vegetables-p-2048x1165.png'],
                                ['label' => 'Rice & Grains', 'icon' => '/images/icon/rice-and-grains-p.png'],
                            ],
                        ],
                        [
                            'heading' => 'Chiller',
                            'description' => 'The OctoFrost™ impingement flash water system results in the fast chilling of the product. The high volume of filtered and recirculated 1°C water is distributed evenly across the whole width and length of the chiller. Guaranteed product temperature at chiller outfeed 5 deg C or lower.',
                            'image' => '/images/product/chiller.png',
                            'product_group' => [
                                ['label' => 'Fruits', 'icon' => '/images/icon/fruits-p-Copy.png'],
                                ['label' => 'Pasta', 'icon' => '/images/icon/pasta-p-2048x1299.png'],
                                ['label' => 'Vegetables', 'icon' => '/images/icon/vegetables-p-2048x1165.png'],
                                ['label' => 'Seafood', 'icon' => '/images/icon/seafood-p-2048x1753.png'],
                                ['label' => 'Rice & Grains', 'icon' => '/images/icon/rice-and-grains-p.png'],
                            ],
                        ],
                        [
                            'heading' => 'De-watering',
                            'description' => 'De-watering shakers 1/2/3 decks',
                            'image' => '/images/project/4.png',
                            'bullets' => ['Options:', '1 - Heated nose', '2 - Air Knife', '3 - Cyclon', '4 - Flow Carry'],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'process-cutting',
                'category' => 'process',
                'detail_slug' => 'cutting',
                'title' => 'Cutting',
                'meta_title' => 'Cutting Machines | GBASE Technologies',
                'meta_description' => 'WPS series vegetable cutting, slicing, shredding and chopping machines.',
                'header' => [
                    'heading' => 'Cutting',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => '',
                    'intro_heading' => 'Model Range and Specifications',
                    'intro_description' => 'WPS series machines for slicing, shredding, cubing and chopping applications.',
                    'cards' => self::cuttingMachineCards(),
                ],
            ],
            [
                'slug' => 'process-dicing',
                'category' => 'process',
                'detail_slug' => 'dicing',
                'title' => 'Dicing',
                'meta_title' => 'Dicing & Cubing Machines | GBASE Technologies',
                'meta_description' => 'High-performance machines for precise dicing and cubing.',
                'header' => [
                    'heading' => 'Dicing',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => 'DICING MACHINES',
                    'intro_heading' => 'Dicing & Cubing Models',
                    'intro_description' => 'High-performance machines for precise dicing and cubing.',
                    'cards' => [
                        ['heading' => 'WPS-100 Dicing & Cubing Machine', 'image' => '/images/product/dicing1.png', 'bullets' => ['Cutting Shapes: Cube & Shred', 'Cube cutting sizes 5mm to 20mm thickness.', 'Capacity 300-400 kgs/Hr.']],
                        ['heading' => 'WPS-200 Dicing & Cubing Machine', 'image' => '/images/product/dicing2.png', 'bullets' => ['Cutting Shapes: Cube & Shred', 'Cube cutting sizes 5mm to 20mm thickness.', 'Capacity 600-800 kgs/Hr.']],
                    ],
                ],
            ],
            [
                'slug' => 'process-more-machines',
                'category' => 'process',
                'detail_slug' => 'more_machines',
                'title' => 'Cutting / Slicing / Dicing',
                'meta_title' => 'Cutting, Slicing & Dicing Machines | GBASE Technologies',
                'meta_description' => 'Vegetable and fruit slicing, dicing, shredding, julienne and sticks machines.',
                'header' => [
                    'heading' => 'Cutting / Slicing / Dicing',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => 'CUTTING MACHINES',
                    'intro_heading' => 'Model Range and Specifications',
                    'intro_description' => 'WPS series machines for slicing, shredding, cubing and chopping applications.',
                    'cards' => array_merge([
                        [
                            'heading' => 'Vegetable and Fruit Slicing, Dicing, Shredding, Julienne & Sticks',
                            'description' => "Used in thousands of applications worldwide: the multi functional machine cuts almost all food products - including lettuce, vegetables and fruit, effectively, precisely and gently.\nCapacity 500 to 3,000 kg/h (Product / Cut Size Depending)",
                            'image' => '/images/product/cutting.jpg',
                            'product_group' => [
                                ['label' => 'Tomato & Carrot', 'icon' => '/images/icon/tomatoandcarrot.png'],
                                ['label' => 'Apple', 'icon' => '/images/icon/apple.png'],
                                ['label' => 'Cabbage', 'icon' => '/images/icon/cabbage.png'],
                                ['label' => 'Fish', 'icon' => '/images/icon/fish.png'],
                                ['label' => 'Meat', 'icon' => '/images/icon/meat.png'],
                                ['label' => 'Herbs', 'icon' => '/images/icon/herbs.png'],
                                ['label' => 'Shrimp', 'icon' => '/images/icon/shrimp.png'],
                                ['label' => 'Rice & Grains', 'icon' => '/images/icon/rice-bowl.png'],
                            ],
                        ],
                        [
                            'heading' => 'Cube, strip & slice cutting machine',
                            'description' => "The high-performance machine cuts vegetable, fruit and meat into cubes, strips or slices - in a single operation and with exact and perfect quality, even with very fine cuts.\nCapacity 500 to 3,000 kg/h (Product / Cut Size Depending)",
                            'image' => '/images/product/cutting2.png',
                            'product_group' => [
                                ['label' => 'Tomato & Carrot', 'icon' => '/images/icon/tomatoandcarrot.png'],
                                ['label' => 'Apple', 'icon' => '/images/icon/apple.png'],
                                ['label' => 'Meat', 'icon' => '/images/icon/meat.png'],
                                ['label' => 'Rice & Grains', 'icon' => '/images/icon/rice-bowl.png'],
                            ],
                        ],
                    ], self::cuttingMachineCards()),
                ],
            ],
            [
                'slug' => 'process-peeling',
                'category' => 'process',
                'detail_slug' => 'peeling',
                'title' => 'Peeling / Washing',
                'meta_title' => 'Peeling Machines | GBASE Technologies',
                'meta_description' => 'Reliable peeling solutions for different produce and capacities.',
                'header' => [
                    'heading' => 'Peeling / Washing',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => 'PEELING MACHINES',
                    'intro_heading' => 'Peeling Machines & Specifications',
                    'intro_description' => 'Reliable peeling solutions for different produce and capacities.',
                    'cards' => [
                        ['heading' => 'WPS-140 Potato Peeling Machine', 'image' => '/images/product/peeling1.png', 'bullets' => ['Equipped with 1hp/3ph motor.', 'Capacity approx. 50 kgs/hr.']],
                        ['heading' => 'WPS- Jackfruit Peeler', 'image' => '/images/product/peeling2.png', 'bullets' => ['Specially designed to peel out the skin of jackfruit.', 'Capacity 100 kg/hr.']],
                        ['heading' => 'WPS- Pineapple Peeler', 'image' => '/images/product/peeling3.png', 'bullets' => ['Specially designed to peel and remove the core of pineapple.', 'Capacity 200 kg/hr.']],
                        ['heading' => 'WPS- Washer Cum Peeler', 'image' => '/images/product/peeling4.png', 'bullets' => ['Suitable to peel-clean-wash various vegetables like Radish, Onion, Carrot, Potato, Ginger, Turnip, Turmeric, Stem Root etc.', 'Capacity 200/400/600/1000 kg/hr.']],
                    ],
                ],
            ],
            [
                'slug' => 'process-slicing',
                'category' => 'process',
                'detail_slug' => 'slicing',
                'title' => 'Slicing',
                'meta_title' => 'Slicing Machines | GBASE Technologies',
                'meta_description' => 'High-performance slicers for precise output and reliable throughput.',
                'header' => [
                    'heading' => 'Slicing',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => 'SLICING MACHINES',
                    'intro_heading' => 'Slicer Models and Specifications',
                    'intro_description' => 'High-performance slicers for precise output and reliable throughput.',
                    'cards' => [
                        ['heading' => 'WPS-18 Vegetable Slicer Machine', 'image' => '/images/product/slicing1.png', 'bullets' => ['Cutting Shapes: Slice', 'Capacity 50-100 kgs/Hr.']],
                        ['heading' => 'WPS-Ginger Slicer', 'image' => '/images/product/slicing2.png', 'bullets' => ['Cutting Shapes: Slice', 'Capacity 2000-3000 kgs/Hr.']],
                        ['heading' => 'WPS-Bulk Vegetable Slicer', 'image' => '/images/product/slicing3.png', 'bullets' => ['Cutting Shapes: Slice-Shred', 'Capacity: 1000-2000 KG PER HR']],
                    ],
                ],
            ],
            [
                'slug' => 'process-used-equipments',
                'category' => 'process',
                'detail_slug' => 'used-equipments',
                'title' => 'Used Equipments',
                'meta_title' => 'Used Equipment | GBASE Technologies',
                'meta_description' => 'Key in your need and be first to know when suitable used equipment is available.',
                'header' => [
                    'heading' => 'Used Equipments',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => '',
                    'intro_heading' => 'Please key in your need and you will be first to know when suitable used equipment is available',
                    'intro_description' => '',
                    'cards' => [
                        ['heading' => 'OctoFrost IQF Freezer', 'image' => '/images/product/iqf.jpeg'],
                    ],
                ],
            ],
            [
                'slug' => 'process-washing',
                'category' => 'process',
                'detail_slug' => 'washing',
                'title' => 'Peeling / Washing',
                'meta_title' => 'Washing Machines | GBASE Technologies',
                'meta_description' => 'Efficient washing solutions for different produce and capacities.',
                'header' => [
                    'heading' => 'Peeling / Washing',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => 'WASHING MACHINES',
                    'intro_heading' => 'Washing Machines & Specifications',
                    'intro_description' => 'Efficient washing solutions for different produce and capacities.',
                    'cards' => [
                        [
                            'heading' => 'Washing machine with vibration or belt outfeed',
                            'description' => "Cost-reduced ECO model: a universal washing machine for the continuous pre-washing, washing, disinfection and treatment of both cut and whole lettuce, vegetables, herbs and fruit, among others.\nMax. capacity 600 kg/h",
                            'image' => '/images/product/washing.png',
                            'product_group' => [
                                ['label' => 'Tomato & Carrot', 'icon' => '/images/icon/tomatoandcarrot.png'],
                                ['label' => 'Apple', 'icon' => '/images/icon/apple.png'],
                                ['label' => 'Cabbage', 'icon' => '/images/icon/cabbage.png'],
                            ],
                        ],
                        ['heading' => 'WPS- Washer Cum Peeler', 'image' => '/images/product/washing1.png', 'bullets' => ['Suitable to peel-clean-wash various vegetables like Radish, Onion, Carrot, Potato, Ginger, Turnip, Turmeric, Stem Root etc.', 'Capacity 200/400/600/1000 kg/hr.']],
                        ['heading' => 'WPS- Conveyor Washer', 'image' => '/images/product/washing2.png', 'bullets' => ['Bubble-type washer with air blower.', 'Capacity 200/500/1000 kg/hr.']],
                        ['heading' => 'WPS- Rotary Washer', 'image' => '/images/product/washing3.png', 'bullets' => ['Material gets washed by the slow tumbling action of the rotary drum.', 'Capacity 200/500/1000 kg/hr.']],
                        ['heading' => 'WPS- Batch Washer', 'image' => '/images/product/washing4.png', 'bullets' => ['Batch type bubble washer.', 'Capacity 100-200 kg/hr.']],
                    ],
                ],
            ],

            // Sorting detail pages
            [
                'slug' => 'sorting-conveyors',
                'category' => 'sorting',
                'detail_slug' => 'conveyors',
                'title' => 'Conveyors',
                'meta_title' => 'Conveyors | GBASE Technologies',
                'meta_description' => 'Conveyor systems for sorting and grading lines from GBASE Technologies.',
                'header' => [
                    'heading' => 'Conveyors',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => '',
                    'intro_heading' => '',
                    'intro_description' => '',
                    'cards' => [],
                ],
            ],
            [
                'slug' => 'sorting-others',
                'category' => 'sorting',
                'detail_slug' => 'others',
                'title' => 'Others',
                'meta_title' => 'Sorting Equipment | GBASE Technologies',
                'meta_description' => 'Additional sorting and grading equipment from GBASE Technologies.',
                'header' => [
                    'heading' => 'Others',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => '',
                    'intro_heading' => '',
                    'intro_description' => '',
                    'cards' => [],
                ],
            ],
            [
                'slug' => 'sorting-sorting',
                'category' => 'sorting',
                'detail_slug' => 'sorting',
                'title' => 'Sorting',
                'meta_title' => 'Round Fruit Sorting | GBASE Technologies',
                'meta_description' => 'GeoSort and CombiSort round fruit sorting and grading systems.',
                'header' => [
                    'heading' => 'Sorting',
                    'cta_heading' => self::GENERIC_CTA_HEADING,
                    'cta_subheading' => self::GENERIC_CTA_SUBHEADING,
                ],
                'cards' => [
                    'intro_short_title' => '',
                    'intro_heading' => '',
                    'intro_description' => '',
                    'cards' => [
                        ['heading' => 'GeoSort', 'description' => 'High speed and fruit-friendliness go hand in hand with the GeoSort. As our most productive sorting solution for delicate fruit, GeoSort guarantees accurate grading through modular, in-own-house developed measuring systems for external and internal quality (iQS and iFA).', 'image' => '/images/product/geo.png'],
                        ['heading' => 'Combisort', 'description' => 'Meet CombiSort – our capable all-rounder. It combines versatility with maximum fruit-friendliness through use of the patented GREEFA flap, making it not only a great solution for pears, but for many different kinds of fruits.', 'image' => '/images/product/combisort.jpg'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Shared 14-card WPS machine grid used by both process-cutting and
     * process-more-machines (the original theme duplicated it across
     * both pages verbatim).
     */
    private static function cuttingMachineCards(): array
    {
        return [
            ['heading' => 'WPS-800 Multifunctional Vegetable Cutter', 'image' => '/images/product/5.png', 'bullets' => ['Cutting Shapes: Slice-Shred-Cube', 'Capacity: 200-300 kgs/hr']],
            ['heading' => 'WPS-810 Multifunctional Vegetable Cutter', 'image' => '/images/product/6.png', 'bullets' => ['Cutting Shapes: Slice-Shred-Cube', 'Capacity: 500-600 kgs/hr']],
            ['heading' => 'WPS-850 Double Head Leafy and Root Vegetable Cutter', 'image' => '/images/product/7.png', 'bullets' => ['Cutting Shapes: Slice-Shred-Cube-Chopping', 'Adjustable cut size from control panel', 'Capacity: 400-500 kgs/hr']],
            ['heading' => 'WPS-860 Double Head Leafy and Root Vegetable Cutter', 'image' => '/images/product/8.png', 'bullets' => ['Cutting Shapes: Slice-Shred-Cube-Chopping', 'Adjustable cut size from control panel', 'Capacity: 600-800 kgs/hr']],
            ['heading' => 'WPS 80 Vegetable Cutter', 'image' => '/images/product/9.png', 'bullets' => ['Cutting Shapes: Slice-Shred', 'Capacity: 200-500 kg/hr']],
            ['heading' => 'WPS 81 Vegetable Cutter', 'image' => '/images/product/10.png', 'bullets' => ['Cutting Shapes: Slice-Shred-Cube', 'Capacity: 200-300 kg/hr']],
            ['heading' => 'WPS-820 Single Head Leafy Vegetable Cutter', 'image' => '/images/product/11.png', 'bullets' => ['Cutting Shapes: Slice-Chopping', 'Capacity: 80-100 kgs/hr']],
            ['heading' => 'WPS-830 Single Head Leafy Vegetable Cutter', 'image' => '/images/product/12.png', 'bullets' => ['Cutting Shapes: Slice-Chopping', 'Capacity: 400-500 kgs/hr']],
            ['heading' => 'WPS Raw Mango Cutter', 'image' => '/images/product/13.png', 'bullets' => ['Raw mango cut into 8 pieces', 'Circular and cross cutters rotating at high speed', 'Capacity: 400-500 kgs/hr']],
            ['heading' => 'WPS Lemon Cutter', 'image' => '/images/product/14.png', 'bullets' => ['Lemon cut into 4 pieces', 'Four high-carbon steel circular knives toward center', 'Capacity: 200 kg/hr']],
            ['heading' => 'WPS-120 Bowl Chopper Machine', 'image' => '/images/product/15.png', 'bullets' => ['Specially used to crush roots, stems and leafy vegetables', 'Suitable for carrots, potatoes, tomatoes, onions, bamboo shoots and cabbage', 'Capacity: 100-200 kgs/hr']],
            ['heading' => 'WPS-840 Single Head Leafy Vegetable Cutter', 'image' => '/images/product/16.png', 'bullets' => ['Cutting Shapes: Slice-Chopping', 'Capacity: 800-1000 kgs/hr']],
            ['heading' => 'WPS-Ginger Shredding Machine', 'image' => '/images/product/17.png', 'bullets' => ['Cutting Shapes: Slice-Shred', 'Capacity: 500 kgs/hr']],
            ['heading' => 'WPS-French Fries Making Machine', 'image' => '/images/product/18.png', 'bullets' => ['Cutting Shapes: French Fries', 'Capacity: 500-800 kgs/hr']],
        ];
    }
}
