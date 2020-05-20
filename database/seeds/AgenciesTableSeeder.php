<?php

use Illuminate\Database\Seeder;

class AgenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
            
        DB::table('agencies')->insert([
            'name' =>  Str::random(6),
            'email' => 'agency@agency.com',
            'phone' =>'01281252153',
            'password' =>  Hash::make('password'),
            'address' => 'male',
            'country' =>  Str::random(6)
        ]);
    
    }
}
