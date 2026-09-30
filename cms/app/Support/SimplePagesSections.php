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
                        'content' => ['heading' => 'Consulting'],
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
                        'content' => ['heading' => 'Spare Parts'],
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
                        'content' => ['heading' => 'Get Equipments'],
                    ],
                ],
            ],
        ];
    }
}
