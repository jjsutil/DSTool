<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!app()->environment('local')) {
            return;
        }

        if (app()->environment('local')) {

            User::factory(10)->create();

            DB::table('users')->insert([
                'id'       => Str::uuid(),
                'name'     => 'Admin',
                'email'    => 'admin@dstool.cl',
                'password' => Hash::make('12341234'),
            ]);

            DB::table('users')->insert([
                'id'       => Str::uuid(),
                'name'     => 'Valentina Hennings',
                'email'    => 'vale_hennings@hotmail.com',
                'password' => Hash::make('friends<3'),
            ]);

            DB::table('search_recipes')->insert([
                'id' => Str::uuid(),
                'name' => 'Nicho de prueba',
                'keywords' => 'producto 1,producto 2, producto 3',
                'min_price' => 10.00,
                'max_price' => 100.00,
                'sort_by' => 'relevance',
                'category' => 'test',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
    }
}
