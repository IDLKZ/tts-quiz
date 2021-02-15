<?php

namespace App\Imports;


use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $mails;
    public $department_id;

    public function __construct($mails,$department_id)
    {
        $this->mails = $mails;
        $this->department_id = $department_id;

    }


    public function model(array $row)
    {
        if($row[0] !== "ФИО"){
           if ($row[0] && $row[1] && !in_array($row[2],$this->mails) && $row[3] && $row[4]){
               User::create([
                   "role_id"=>2,
                  "department_id"=>$this->department_id,
                  "img"=>"/no-image.png",
                  "name"=> $row[0],
                   "phone"=>$row[1],
                   "email"=>$row[2],
                   "position"=>$row[3],
                   "password"=>bcrypt($row[4]),
               ]);
           }
        }

    }
}
