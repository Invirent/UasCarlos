<?php

namespace App\Models;

use Exception;

use Illuminate\Support\Facades\DB; 

use Illuminate\Database\Eloquent\Model;

class payslip extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payslips';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['employee_id', 'contract_id', 'currency', 'start_date', 'end_date', 'deduction', 'bonus', 'payslip_amount', 'bank_account_id'];

    static function checkView($employee_id)
    {
        #This function is used to check if view is exist or not
        #If exist, return the view else, create the view and return the view

        $employeeContractView = payslip::searchView($employee_id);
        return $employeeContractView;
    }

    static function searchView($employee_id)
    {
        try{
            $view = DB::select(
            'SELECT
                employees.id as employee_id,
                employees.name as employee_name,
                contracts.id as contract_id,
                contracts.currency as currency,
                COALESCE(contracts.wages, 0) as wages,
                COALESCE(contracts.pph21, 0) as pph21,
                COALESCE(contracts.food, 0) as food,
                COALESCE(contracts.transport,0) as transport,
                COALESCE(contracts.work_day,0) as work_day,
                COALESCE(bpjs.cost,0) as bpjs_cost
            FROM employees
            LEFT JOIN contracts ON employees.contract_id = contracts.id
            LEFT JOIN bpjs_datas bpjs ON contracts.bpjs_category_id = bpjs.id
            WHERE contracts.active = 1 AND bpjs.active = 1 AND employees.id = ?', [$employee_id]);
            return $view;
        }
        catch(Exception $e){
            return false;
        }
    }

    static function getTotalWorkDays($employee_id,$date_from, $date_to){
        $query = "
            SELECT COALESCE(COUNT(a.in_time),0) as total_attendance
            FROM employees
            LEFT JOIN attendances a on employees.id = a.employee_id
            WHERE a.in_time BETWEEN '". $date_from ."' AND '".$date_to."' AND employees.id = ".$employee_id."
        ";
        $totalWorkDays = DB::select($query);
        return $totalWorkDays[0]->total_attendance;
    }

    static function onchangeEmployee($request){
        # if employee change, compute wages, pph21, bpjs, etc
        $employee_id = $request->employee_id;
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $employeeContractView = payslip::checkView($employee_id);
        $total_work_days = payslip::getTotalWorkDays($employee_id,$date_from, $date_to);
        $contractView = $employeeContractView[0];
        $earned_data = payslip::getEarnedData($contractView, $total_work_days);
        return $earned_data;
    }

    static function getEarnedData($contractView, $total_work_days){
        #Function to get earned data in dict format
        $wages = $contractView->wages;
        $pph21 = $contractView->pph21;
        $food = $contractView->food;
        $transport = $contractView->transport;
        $work_day = $contractView->work_day;
        $bpjs_cost = $contractView->bpjs_cost;
        $wages_per_day = $wages / $work_day;
        $total_earned_wages = $wages_per_day * $total_work_days;
        $total_earned_contract = ($total_earned_wages + $food + $transport) - ($pph21 + $bpjs_cost);
        $earned_data = array(
            "currency" => $contractView->currency,
            "contract_id" => $contractView->contract_id,
            'wages' => $wages,
            'pph21' => $pph21,
            'food' => $food,
            'transport' => $transport,
            'work_day' => $total_work_days,
            'bpjs_cost' => $bpjs_cost,
            'wages_per_day' => $wages_per_day,
            'total_earned_wages' => $total_earned_wages,
            'total_earned_contract' => $total_earned_contract
        );
        return $earned_data;
    }
}
