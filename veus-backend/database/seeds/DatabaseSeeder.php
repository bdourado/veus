<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        for ($int = 1; $int < 5; $int++){
            DB::table('marcas')->insert(['nome'=>'marca '.$int,'created_at' => $now,'updated_at' => $now]);
            for ($i = 0; $i < 25; $i++){
                DB::table('produtos')->insert([
                    'nome' => 'produto_'.$i,
                    'marca_id' => $int,
                    'preco' => rand(10,99).'.'.rand(10,99),
                    'qtde' => rand(1,99),
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }
        }

    }
}
