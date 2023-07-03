<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database
     *
     * @author Swam Htet Aung
     *
     * @create date 21-06-2023
     *
     */
    public function run()
    {
        $this->call(EmployeeSeeder::class);
    }
}
