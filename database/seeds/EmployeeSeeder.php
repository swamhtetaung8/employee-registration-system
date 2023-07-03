<?php

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Seeding for employees table.
     * @author Swam Htet Aung
     *
     * @create date 21-06-2023
     * @return void
     */
    public function run()
    {
        factory(App\Models\Employee::class, 1)->create();
    }
}
