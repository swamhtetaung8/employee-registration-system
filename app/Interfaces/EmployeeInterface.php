<?php

namespace App\Interfaces;

interface EmployeeInterface
{
    public function getAllEmployees();

    public function getAllEmployeesPaginate($perPage);

    public function getEmployee($id);

    public function getAllEmployeesDownload();

    public function getEmpCountBeforeCurrent($id);
}
