<?php

use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 'App\Semester'::create([
        //     'kode_semester' => '19201',
        //     'semester' => 'Ganjil',
        //     'tapel' => '2019/2020'
        // ]);
        $y = date('y', '2019');
        for($i = 0; $i < 10 ; $i++) {
            'App\Semester'::create([
                'kode_semester' => ($y).($y+1),
                'semester' => 'Ganjil',
                'tapel' => '2019/2020'
            ]);
        }
    }
}
