<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Generator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'email_verified_at' => $now,
            'password' => bcrypt('secret'),
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $produtos = factory(\App\Produtos::class,100)->create();






    }
}
