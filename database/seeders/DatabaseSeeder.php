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
        User::factory(10)->create();

        if (app()->environment('local')) {
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

        }
    }
}
