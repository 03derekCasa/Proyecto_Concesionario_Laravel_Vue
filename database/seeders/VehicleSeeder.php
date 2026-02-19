<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'type' => 'car',
                'brand' => 'Toyota',
                'model' => 'Corolla',
                'year' => 2021,
                'price' => 17990.00,
                'fuel' => 'Hybrid',
                'mileage' => 32000,
                'image_url' => null,
                'description' => 'Compacto, fiable y eficiente. Ideal para ciudad y carretera.',
            ],
            [
                'type' => 'car',
                'brand' => 'Seat',
                'model' => 'Ibiza',
                'year' => 2019,
                'price' => 12990.00,
                'fuel' => 'Gasolina',
                'mileage' => 54000,
                'image_url' => null,
                'description' => 'Buen consumo, mantenimiento económico y gran manejo.',
            ],
            [
                'type' => 'car',
                'brand' => 'Tesla',
                'model' => 'Model 3',
                'year' => 2022,
                'price' => 32990.00,
                'fuel' => 'Eléctrico',
                'mileage' => 21000,
                'image_url' => null,
                'description' => 'Autonomía excelente y experiencia de conducción moderna.',
            ],
            [
                'type' => 'motorcycle',
                'brand' => 'Yamaha',
                'model' => 'MT-07',
                'year' => 2020,
                'price' => 6990.00,
                'fuel' => 'Gasolina',
                'mileage' => 18000,
                'image_url' => null,
                'description' => 'Naked ligera, divertida y con motor muy aprovechable.',
            ],
            [
                'type' => 'motorcycle',
                'brand' => 'Honda',
                'model' => 'CBR500R',
                'year' => 2021,
                'price' => 7590.00,
                'fuel' => 'Gasolina',
                'mileage' => 12000,
                'image_url' => null,
                'description' => 'Deportiva para carnet A2: cómoda, estable y fiable.',
            ],
        ];

        foreach ($vehicles as $v) {
            Vehicle::create($v);
        }
    }
}
