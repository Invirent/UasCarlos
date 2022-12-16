<?php
    use App\Models\Employee;

    $employees = Employee::all();

    $employee_data = array();

    foreach ($employees as $employee) {
        $employee_data[$employee->id] = $employee->name;
    }

    $employee_data = array('' => 'Select Employee') + $employee_data;
?>

<script>
    window.onload = function(){
        onchangeEmployeeDate();
    }

    function onchangeEmployeeDate(){
        var employee_id = "{{ $employee->id }}";
        var date_from = "{{ $payslip->start_date }}";
        var date_to = "{{ $payslip->end_date }}";
        if (employee_id != '' && date_from != '' && date_to != '') {
            jQuery.ajax({
            type:'GET',
            url:'/admin/compute_payslip',
            data: {"employee_id":employee_id, "date_from": date_from, "date_to": date_to},
            success: function (obj, textstatus) {
                console.log(obj);
                if( !('error' in obj) ){
                    insertData(obj);
                }
                else {
                    console.log(obj.error);
                }
            }
            })
        }
    }

    function insertData(obj){
        $currency_str = document.getElementsByName("currency_str");
        for (var i = 0; i < $currency_str.length; i++) {
            $currency_str[i].innerHTML = obj.currency;
        }
        document.getElementById("basic_salary").innerText = obj.wages;
        document.getElementById("food").innerText = obj.food;
        document.getElementById("transport").innerText = obj.transport;
        document.getElementById("pph21").innerText = obj.pph21;
        document.getElementById("bpjs_kesehatan").innerText = obj.bpjs_cost;
        document.getElementById("work_days").innerText = obj.work_day;
        document.getElementById("actual_wages").innerText = obj.total_earned_wages;
    }

</script>

@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Payslip {{ $payslip->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/payslip') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/payslip/' . $payslip->id . '/edit') }}" title="Edit payslip"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/payslip' . '/' . $payslip->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete payslip" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th> Employee </th>
                                        <td> {{ $employee_data[$payslip->employee_id] }} </td>
                                    </tr>
                                    <tr>
                                        <th> Period </th>
                                        <td> {{ $payslip->start_date }} to {{ $payslip->end_date }} </td>
                                    </tr>
                                    <tr>
                                        <td>Attendance</td>
                                        <td><b id="work_days">0</b></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Salary Stucture</th>
                                    </tr>
                                    <tr>
                                        <td>Basic Salary :</td>
                                        <td><b name="currency_str"></b> <b id="basic_salary">0</b></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Actual Wages :</td>
                                        <td><b name="currency_str"></b> <b id="actual_wages">0</b></td>
                                    </tr>  

                                    <tr>
                                        <td>Food :</td>
                                        <td><b name="currency_str"></b> <b id="food">0</b></td>
                                    </tr>
                                    <tr>
                                        <td>Transport</td>
                                        <td><b name="currency_str"></b> <b id="transport">0</b></td>
                                    </tr>
                                    <tr>
                                        <td>Bonus :</td>
                                        <td><b name="currency_str"></b> <b>{{ $payslip->bonus }}</b></td>
                                    </tr>

                                    <tr>
                                        <td>PPh21 :</td>
                                        <td><b name="currency_str"></b> <b id="pph21">0</b></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>BPJS Kesehatan :</td>
                                        <td><b name="currency_str"></b> <b id="bpjs_kesehatan">0</b></td>
                                    </tr>

                                    <tr>
                                        <td>Deduction :</td>
                                        <td><b name="currency_str"></b> <b>{{ $payslip->deduction }}</b></td>
                                    </tr>    
                                    
                                    <tr>
                                        <td>Total Wages :</td>
                                        <td><b name="currency_str"></b> <b>{{ $payslip->payslip_amount }}</b></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
