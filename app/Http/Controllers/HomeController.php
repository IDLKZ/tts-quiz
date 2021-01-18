<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getDepartment(Request $request)
    {
        $company = Company::with('departments')->find($request['id']);
        if ($company) {
            if ($company->departments) {
                $index = 1;
                $return = "<table class='table mb-0'>
                         <thead>
                         <tr>
                             <th>#</th>
                             <th>Департамент</th>
                             <th>Действие</th>
                         </tr>
                         </thead>
                         <tbody>";
                foreach ($company->departments as $department){
                    $link = route('employee-getUser', $department->id);
                    $return .= "<tr>
                             <th scope='row'>".$index++."</th>
                             <td>$department->title</td>
                             <td>
                             <a target='_blank' class='btn btn-info' href=".$link.">Посмотреть</a>
</td>
                         </tr>";
                }
                $return .= "</tbody>
                              </table>";
                return $return;
            } else {
                return "<p>Нет отделов</p>";
            }
        } else {
            return "Что то пошло не так!";
        }
    }

    public function getEmployee($id) {
        $users = User::where('department_id', $id)->paginate(20);
        return view('directory.show', compact('users'));
    }
}
