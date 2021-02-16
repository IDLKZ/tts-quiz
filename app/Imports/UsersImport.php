<?php

namespace App\Imports;


use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UsersImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $mails;
    public $department_id;
    public $candidate;

    public function __construct($mails,$department_id,$candidate)
    {
        $this->mails = $mails;
        $this->department_id = $department_id;
        $this->candidate = $candidate === true ? 1 : 0;

    }


    public function model(array $row)
    {
           if ($row[0] && $row[1] && !in_array($row[2],$this->mails) && filter_var($row[2], FILTER_VALIDATE_EMAIL) && $row[3] && $row[4]){
               User::create([
                   "role_id"=>2,
                  "department_id"=>$this->department_id,
                  "candidate"=>$this->candidate,
                  "img"=>"/no-image.png",
                  "name"=> $row[0],
                   "phone"=>$row[1],
                   "email"=>$row[2],
                   "position"=>$row[3],
                   "password"=>bcrypt($row[4]),
               ]);
           }


    }

    public function startRow(): int
    {
        return 2;
    }
}
