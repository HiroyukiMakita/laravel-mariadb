<?php

use Illuminate\Database\Seeder;

class RoleOwnershipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(App\Models\RoleOwnerships::class)->create();
    }
}
