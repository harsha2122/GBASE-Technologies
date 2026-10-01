<?php

namespace App\Support;

/**
 * Definitions for the smaller Phase 2 pages: Consulting, Spare Parts,
 * and the Equipments overview. Each entry maps a page slug to its
 * meta info and ordered sections, mirroring HomeSections.
 */
class SimplePagesSections
{
    public static function pages(): array
    {
        return [
            [
                'slug' => 'consulting',
                'title' => 'Consulting',
                'meta_title' => 'Consulting | GBASE Technologies',
                'meta_description' => 'Project consulting for horticulture and food processing: conceptualization, feasibility, engineering support, regulatory compliance, and project management.',
                'sections' => [
                    [
                        'section_key' => 'page_header',
                        'section_type' => 'page_header',
                        'label' => 'Page Header',
                        'content' => [
                            'heading' => 'Consulting',
                            'cta_heading' => 'Your questions deserve the best answers.',
                            'cta_subheading' => "Let's get in touch and talk about Individual Quick Freezing and Processing.",
                        ],
                    ],
                    [
                        'section_key' => 'domain_scope_services',
                        'section_type' => 'domain_scope_services',
                        'label' => 'Domain, Scope & Services',
                        'content' => [
                            'domain_heading' => 'Domain',
                            'domain_items' => [
                                ['label' => 'Freezing –', 'description' => 'IQF, Spiral, Blast, Plate freezing, Carton Box projects'],
                                ['label' => 'Heating –', 'description' => 'Grilling, frying, baking, oil filtration, coating, flattening'],
                                ['label' => 'Fruit and vegetable –', 'description' => 'Receiving, Washing, Sorting, Grading, Cutting, Dicing and Packing – storage'],
                                ['label' => 'Cold Storage –', 'description' => 'Refer Storage and Refrigeration Projects'],
                            ],
                            'scope_heading' => 'Scope',
                            'scope_paragraphs' => [
                                'Ideation, DPR presentation, Project Planning, Execution, Startup, Training, handover, after-sales and retraining support.',
                                'Food industry involves a range of services, from initial project conceptualization and technical feasibility studies to detailed engineering.',
                            ],
                            'services_heading' => 'Services',
                            'services' => [
                                ['title' => 'Project conceptualization and feasibility', 'description' => 'Conducting detailed project reports (DPR), techno-economic feasibility studies, and project profiles to assess viability.'],
                                ['title' => 'Technical and engineering support', 'description' => 'Providing expertise on plant design, machinery planning and selection, process optimization, and new product development.'],
                                ['title' => 'Regulatory compliance', 'description' => 'Guiding businesses through food safety standards like HACCP, ISO 22000, and FSSC 22000, and ensuring compliance with local and international regulations such as FSSAI approval.'],
                                ['title' => 'Project management', 'description' => 'Overseeing the entire project lifecycle, from planning and execution to commissioning and startup, to ensure projects are completed on time and within budget.'],
                                ['title' => 'Operational efficiency', 'description' => 'Streamlining operations, improving production processes, developing Standard Operating Procedures (SOPs), and implementing cost-saving measures.'],
                                ['title' => 'Linkages', 'description' => 'Backward and forward Linkages'],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'spare-parts',
                'title' => 'Spare Parts',
                'meta_title' => 'Spare Parts | GBASE Technologies',
                'meta_description' => 'Request genuine spare parts for your GBASE Technologies food processing equipment.',
                'sections' => [
                    [
                        'section_key' => 'page_header',
                        'section_type' => 'page_header',
                        'label' => 'Page Header',
                        'content' => [
                            'heading' => 'Spare Parts',
                            'cta_heading' => 'Your questions deserve the best answers.',
                            'cta_subheading' => "Let's get in touch and talk.",
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'equipments',
                'title' => 'Equipments',
                'meta_title' => 'Get Equipments | GBASE Technologies',
                'meta_description' => 'Request a quote for new food processing equipment from GBASE Technologies.',
                'sections' => [
                    [
                        'section_key' => 'page_header',
                        'section_type' => 'page_header',
                        'label' => 'Page Header',
                        'content' => [
                            'heading' => 'Get Equipments',
                            'cta_heading' => 'Your questions deserve the best answers.',
                            'cta_subheading' => "Let's get in touch and talk about Individual Quick Freezing and Processing.",
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'contact',
                'title' => 'Contact',
                'meta_title' => 'Contact Us | GBASE Technologies',
                'meta_description' => 'Get in touch with GBASE Technologies for consulting, equipment, spare parts, and service enquiries.',
                'sections' => [
                    [
                        'section_key' => 'page_header',
                        'section_type' => 'page_header',
                        'label' => 'Page Header',
                        'content' => [
                            'heading' => 'Contact',
                            'cta_heading' => 'Your questions deserve the best answers.',
                            'cta_subheading' => "Let's get in touch and talk about Individual Quick Freezing and Processing.",
                        ],
                    ],
                    [
                        'section_key' => 'contact_info',
                        'section_type' => 'contact_info',
                        'label' => 'Contact Information',
                        'content' => [
                            'phone_numbers' => '+91 98103 84249, +91 93157 38121, +91 90563 29395',
                            'emails' => 'info@gbase.co.in, gbasetechnologies.info@gmail.com',
                            'address' => '597, Sector 30, Faridabad, 121003, Haryana, India',
                        ],
                    ],
                    [
                        'section_key' => 'company_about',
                        'section_type' => 'company_about',
                        'label' => 'About Us',
                        'content' => [
                            'heading' => 'About US',
                            'description' => 'GBASE Technologies was established in 2004, with happy customers in Australia, Bangladesh, India, Indonesia, New Zealand, and Sri Lanka.',
                            'services_heading' => 'Our Services',
                            'services' => [
                                'Project consulting, design, and implementation.',
                                'Machinery supply, installation, commissioning, spares, technical services, training, and performance audits.',
                            ],
                            'principals_heading' => 'Our Principals',
                            'principals' => [
                                'OctoFrost (Sweden) - IQF freezing, frying, grilling, blanching, cooking, and chilling.',
                                'Greefa (Netherlands) - round fruit sorting and grading.',
                                'Gbase Technologies Pvt Limited - cutting, dicing, slicing, and washing of fruits, vegetables, herbs, meat, and poultry.',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'service',
                'title' => 'Service',
                'meta_title' => 'Service | GBASE Technologies',
                'meta_description' => 'Consulting, equipment audits, online and onsite support services from GBASE Technologies.',
                'sections' => [
                    [
                        'section_key' => 'page_header',
                        'section_type' => 'page_header',
                        'label' => 'Page Header',
                        'content' => [
                            'heading' => 'Service',
                            'cta_heading' => 'Your questions deserve the best answers.',
                            'cta_subheading' => "Let's get in touch and talk about Individual Quick Freezing and Processing.",
                        ],
                    ],
                    [
                        'section_key' => 'domain_scope_services',
                        'section_type' => 'domain_scope_services',
                        'label' => 'Domain, Scope & Services',
                        'content' => [
                            'domain_heading' => 'Domain',
                            'domain_items' => [
                                ['label' => 'Freezing –', 'description' => 'IQF, Spiral, Blast, Plate freezing, Carton Box projects'],
                                ['label' => 'Heating –', 'description' => 'Grilling, frying, baking, oil filtration, coating, flattening'],
                                ['label' => 'Fruit and vegetable –', 'description' => 'Receiving, Washing, Sorting, Grading, Cutting, Dicing and Packing – storage'],
                                ['label' => 'Cold Storage –', 'description' => 'Refer Storage and Refrigeration Projects'],
                            ],
                            'scope_heading' => 'Scope',
                            'scope_paragraphs' => [
                                'Ideation, DPR presentation, Project Planning, Execution, Startup, Training, handover, after-sales and retraining support.',
                                'Food industry involves a range of services, from initial project conceptualization and technical feasibility studies to detailed engineering.',
                            ],
                            'services_heading' => 'Services',
                            'services' => [
                                ['title' => 'Project conceptualization and feasibility', 'description' => 'Conducting detailed project reports (DPR), techno-economic feasibility studies, and project profiles to assess viability.'],
                                ['title' => 'Technical and engineering support', 'description' => 'Providing expertise on plant design, machinery planning and selection, process optimization, and new product development.'],
                                ['title' => 'Regulatory compliance', 'description' => 'Guiding businesses through food safety standards like HACCP, ISO 22000, and FSSC 22000, and ensuring compliance with local and international regulations such as FSSAI approval.'],
                                ['title' => 'Project management', 'description' => 'Overseeing the entire project lifecycle, from planning and execution to commissioning and startup, to ensure projects are completed on time and within budget.'],
                                ['title' => 'Operational efficiency', 'description' => 'Streamlining operations, improving production processes, developing Standard Operating Procedures (SOPs), and implementing cost-saving measures.'],
                                ['title' => 'Linkages', 'description' => 'Backward and forward Linkages'],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'service-equipment-audits',
                'title' => 'Equipment Audits',
                'meta_title' => 'Equipment Audits | GBASE Technologies',
                'meta_description' => 'Equipment audits that keep performance on track, from GBASE Technologies.',
                'sections' => [
                    [
                        'section_key' => 'page_header',
                        'section_type' => 'page_header',
                        'label' => 'Page Header',
                        'content' => [
                            'heading' => 'Equipment Audits',
                            'cta_heading' => 'Equipment audits that keep performance on track.',
                            'cta_subheading' => "For equipment audits, please fill in the fields below, send a message & we'll revert.",
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'service-online-support',
                'title' => 'Online Support',
                'meta_title' => 'Online Support | GBASE Technologies',
                'meta_description' => 'Online support and troubleshooting from GBASE Technologies.',
                'sections' => [
                    [
                        'section_key' => 'page_header',
                        'section_type' => 'page_header',
                        'label' => 'Page Header',
                        'content' => [
                            'heading' => 'Online Support',
                            'cta_heading' => 'Fast answers, wherever you are.',
                            'cta_subheading' => "For online support, please fill in the fields below, send a message & we'll revert.",
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'service-onsite-support',
                'title' => 'Onsite Support',
                'meta_title' => 'Onsite Support | GBASE Technologies',
                'meta_description' => 'Onsite support and site visits from GBASE Technologies.',
                'sections' => [
                    [
                        'section_key' => 'page_header',
                        'section_type' => 'page_header',
                        'label' => 'Page Header',
                        'content' => [
                            'heading' => 'Onsite Support',
                            'cta_heading' => 'Onsite support, right where you need it.',
                            'cta_subheading' => "For onsite support, please fill in the fields below, send a message & we'll revert.",
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'knowledge-videos',
                'title' => 'Knowledge Videos',
                'meta_title' => 'Videos | GBASE Technologies',
                'meta_description' => 'Short demos, walkthroughs, and service tips from our team.',
                'sections' => [
                    [
                        'section_key' => 'listing_header',
                        'section_type' => 'listing_header',
                        'label' => 'Listing Header',
                        'content' => [
                            'short_title' => 'Knowledge Centre',
                            'heading' => 'Videos',
                            'description' => 'Short demos, walkthroughs, and service tips from our team.',
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'knowledge-articles',
                'title' => 'Knowledge Articles',
                'meta_title' => 'Articles | GBASE Technologies',
                'meta_description' => 'Practical notes, guides, and insights from the GBASE team.',
                'sections' => [
                    [
                        'section_key' => 'listing_header',
                        'section_type' => 'listing_header',
                        'label' => 'Listing Header',
                        'content' => [
                            'short_title' => 'Knowledge Centre',
                            'heading' => 'Articles',
                            'description' => 'Practical notes, guides, and insights from the GBASE team.',
                        ],
                    ],
                ],
            ],
        ];
    }
}
