<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admins = factory(App\Admin::class , 50)->create();
        $this->command->info('Admins created');
    }
}
