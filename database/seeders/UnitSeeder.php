<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $letters = ['A', 'B', 'C'];

        foreach ($letters as $letter) {
            for ($i = 1; $i <= 99; $i++) {
                DB::table('units')->insert([
                    'name' => $letter . $i, // A1 .. A99, B1 .. B99, C1 .. C99
                    'price' => rand(15000, 100000), // سعر عشوائي
                    'area' => rand(50, 300),       // مساحة عشوائية
                    'floor' => ['first', 'second', 'third', 'fourth', 'fifth', 'sixth'][array_rand(['first', 'second', 'third', 'fourth', 'fifth', 'sixth'])],
                    'wing' => ['left', 'middle', 'right'][array_rand(['left', 'middle', 'right'])],
                    'status' => ['available', 'reserved', 'reserved_downpayment', 'sold'][array_rand(['available', 'reserved', 'reserved_downpayment', 'sold'])],
                    // 'status' => 'available', // كل الوحدات متاحة
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
