<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class PcpSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        
        $specialties = [
            'Cardiology', 'Dermatology', 'Endocrinology', 
            'Gastroenterology', 'Neurology', 'Oncology',
            'Pediatrics', 'Psychiatry', 'Rheumatology'
        ];

        $data = [];
        
        for ($i = 0; $i < 15; $i++) {
            $data[] = [
                'PCP_Name' => 'Dr. ' . $faker->lastName,
                'PCP_Specialty' => $faker->randomElement($specialties),
                'PCP_Phone' => $faker->phoneNumber,
                'PCP_Email' => $faker->companyEmail,
                'PCP_Address' => $faker->streetAddress . ', ' . $faker->city,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->db->table('pcps')->insertBatch($data);
    }
}