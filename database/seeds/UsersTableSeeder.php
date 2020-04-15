<?php

use Facade\Ignition\Support\FakeComposer;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        DB::table('users')->insert([
            'frist_name' =>  Str::random(10),
            'last_name' =>  Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'telephone' => '01281252153',
            'gender' => 'male',
            'password' =>  Hash::make('password'),
            'dob' => '1996-01-01']);
    }
}
