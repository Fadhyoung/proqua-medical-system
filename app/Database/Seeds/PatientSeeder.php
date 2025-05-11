<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class PatientSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        
        $pcpIds = $this->db->table('pcps')->select('PCP_ID')->get()->getResultArray();
        $pcpIds = array_column($pcpIds, 'PCP_ID');

        $data = [];        
        
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'Pat_Name' => $faker->name,
                'Pat_Gender' => $faker->randomElement(['Male', 'Female']),
                'Pat_Address' => $faker->address,
                'Pat_DOB' => $faker->date('Y-m-d', '-80 years'),
                'PCP_ID' => $faker->randomElement($pcpIds),
                'Pat_Phone' => $faker->phoneNumber,
                'Pat_Email' => $faker->safeEmail,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->db->table('patients')->truncate();

        $this->db->table('patients')->insertBatch($data);
    }
}