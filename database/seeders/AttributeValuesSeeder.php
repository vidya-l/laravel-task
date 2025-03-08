<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AttributeValue;

class AttributeValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributeIds = [1, 2, 3, 4];
        $entityIds = [1, 2, 3, 4];
        $attributeValues = [
            [
                'attribute_id' => $attributeIds[0],
                'value' => 'alpha',
                'entity_id' => $entityIds[0],
            ],
            [
                'attribute_id' => $attributeIds[0],
                'value' => 'beta',
                'entity_id' => $entityIds[0],
            ],
            [
                'attribute_id' => $attributeIds[0],
                'value' => 'gama',
                'entity_id' => $entityIds[0],
            ],

            [
                'attribute_id' => $attributeIds[1],
                'value' => '2025-09-09',
                'entity_id' => $entityIds[1],
            ],
            [
                'attribute_id' => $attributeIds[1],
                'value' => '2025-09-08',
                'entity_id' => $entityIds[1],
            ],
            [
                'attribute_id' => $attributeIds[1],
                'value' => '2025-09-06',
                'entity_id' => $entityIds[1],
            ],

            [
                'attribute_id' => $attributeIds[2],
                'value' => '2025-10-06',
                'entity_id' => $entityIds[2],
            ],
            [
                'attribute_id' => $attributeIds[2],
                'value' => '2025-10-06',
                'entity_id' => $entityIds[2],
            ],
            [
                'attribute_id' => $attributeIds[2],
                'value' => '2025-10-06',
                'entity_id' => $entityIds[2],
            ],

            [
                'attribute_id' => $attributeIds[3],
                'value' => 'IT',
                'entity_id' => $entityIds[3],
            ],
            [
                'attribute_id' => $attributeIds[3],
                'value' => 'Sales',
                'entity_id' => $entityIds[3],
            ],
            [
                'attribute_id' => $attributeIds[3],
                'value' => 'Marketing',
                'entity_id' => $entityIds[3],
            ],
        ];

        foreach ($attributeValues as $value) {
            AttributeValue::create($value);
        }
    }
}
