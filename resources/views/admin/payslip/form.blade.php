<?php
    use App\Models\Employee;
    use App\Models\bankAccount;

    $employees = Employee::all();

    $employee_data = array();

    foreach ($employees as $employee) {
        $employee_data[$employee->id] = $employee->name;
    }

    $employee_data = array('' => 'Select Employee') + $employee_data;

    $json_data = json_encode($employee_data);

    $bank_account = bankAccount::all();
    $bank_data = array();
    foreach ($bank_account as $bank) {
        $bank_data[$bank->id] = $bank->account_number . ' - ' . $bank->bank_name;
    }

    $bank_data = array('' => 'Select Bank Account') + $bank_data;
    $bank_data = json_encode($bank_data);

?>


<script>

    window.onload = function(){
        onchangeEmployeeDate();
    }

    function onchangeEmployeeDate(){
        var employee_id = document.getElementById("employee_id").value;
        var date_from = document.getElementById("start_date").value;
        var date_to = document.getElementById("end_date").value;
        if (employee_id != '' && date_from != '' && date_to != '') {
            jQuery.ajax({
            type:'GET',
            url:'/admin/compute_payslip',
            data: {"employee_id":employee_id, "date_from": date_from, "date_to": date_to},
            success: function (obj, textstatus) {
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
        console.log(obj);
        document.getElementById("currency").value = obj.currency;
        $currency_str = document.getElementsByName("currency_str");
        for (var i = 0; i < $currency_str.length; i++) {
            $currency_str[i].innerHTML = obj.currency;
        }
        document.getElementById("contract_id").value = obj.contract_id;
        document.getElementById("basic_salary").innerText = obj.wages;
        document.getElementById("food").innerText = obj.food;
        document.getElementById("transport").innerText = obj.transport;
        document.getElementById("pph21").innerText = obj.pph21;
        document.getElementById("bpjs_kesehatan").innerText = obj.bpjs_cost;
        document.getElementById("work_days").innerText = obj.work_day;
        document.getElementById("actual_wages").innerText = obj.total_earned_wages;
        document.getElementById("gross_salary").innerText = obj.total_earned_contract;
        computeTotalWages();
    }

    function computeTotalWages(){
        var gross_salary = document.getElementById("gross_salary").innerText || 0;
        console.log(gross_salary);
        var bonus = document.getElementById("bonus").value || 0;
        var deduction = document.getElementById("deduction").value || 0;
        var total_wages = (parseInt(gross_salary) + parseInt(bonus)) - parseInt(deduction);
        console.log(total_wages);
        document.getElementById("payslip_amount").value = total_wages;
    }

</script>

<div class="form-group {{ $errors->has('employee_id') ? 'has-error' : ''}}">
    <label for="employee_id" class="control-label">{{ 'Employee' }}</label>
    <select onchange=onchangeEmployeeDate() required name="employee_id" class="form-control" id="employee_id" >
    @foreach (json_decode($json_data, true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($payslip->employee_id) && $payslip->employee_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
    </select>
    {!! $errors->first('employee_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('bank_account_id') ? 'has-error' : ''}}">
    <label for="bank_account_id" class="control-label">{{ 'Bank Account' }}</label>
    <select required name="bank_account_id" class="form-control" id="bank_account_id" >
    @foreach (json_decode($bank_data, true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($payslip->bank_account_id) && $payslip->bank_account_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
    </select>
    {!! $errors->first('bank_account_id', '<p class="help-block">:message</p>') !!}
</div>

<div invisible class="form-group {{ $errors->has('contract_id') ? 'has-error' : ''}}">
    <input class="form-control" name="contract_id" type="hidden" id="contract_id" value="{{ isset($payslip->contract_id) ? $payslip->contract_id : ''}}" >
    {!! $errors->first('contract_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('currency') ? 'has-error' : ''}}">
    <label for="currency" class="control-label">{{ 'Currency' }}</label>
    <input readonly class="form-control" name="currency" type="text" id="currency" value="{{ isset($payslip->currency) ? $payslip->currency : ''}}" >
    {!! $errors->first('currency', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
    <label for="start_date" class="control-label">{{ 'Start Date' }}</label>
    <input onchange=onchangeEmployeeDate() class="form-control" name="start_date" type="date" id="start_date" value="{{ isset($payslip->start_date) ? $payslip->start_date : ''}}" >
    {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
    <label for="end_date" class="control-label">{{ 'End Date' }}</label>
    <input onchange=onchangeEmployeeDate() class="form-control" name="end_date" type="date" id="end_date" value="{{ isset($payslip->end_date) ? $payslip->end_date : ''}}" >
    {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('deduction') ? 'has-error' : ''}}">
    <label for="deduction" class="control-label">{{ 'Deduction' }}</label>
    <input class="form-control" onchange=computeTotalWages() name="deduction" type="number" id="deduction" value="{{ isset($payslip->deduction) ? $payslip->deduction : ''}}" >
    {!! $errors->first('deduction', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bonus') ? 'has-error' : ''}}">
    <label for="bonus" class="control-label">{{ 'Bonus' }}</label>
    <input class="form-control" onchange=computeTotalWages() name="bonus" type="number" id="bonus" value="{{ isset($payslip->bonus) ? $payslip->bonus : ''}}" >
    {!! $errors->first('bonus', '<p class="help-block">:message</p>') !!}
</div>

<table>
    <tr>
        <th>Type</th>
        <th>Amount</th>
    </tr>
    <tr>
        <th colspan="2">Base Amount</th>
    </tr>
    <tr>
        <td>Basic Salary</td>
        <td><b name="currency_str"></b> <b id="basic_salary">0</b></td>
    </tr>
    <tr>
        <td>Food</td>
        <td><b name="currency_str"></b> <b id="food">0</b></td>
    </tr>
    <tr>
        <td>Transport</td>
        <td><b name="currency_str"></b> <b id="transport">0</b></td>
    </tr>
    <tr>
        <th colspan="2">Deduction Amount</th>
    </tr>
    <tr>
        <td>PPh21</td>
        <td><b name="currency_str"></b> <b id="pph21">0</b></td>
    </tr>
    <tr>
        <td>BPJS Kesehatan</td>
        <td><b name="currency_str"></b> <b id="bpjs_kesehatan">0</b></td>
    </tr>
    <tr>
        <th class="2">Actual Earned</th>
    </tr>
    <tr>
        <td>Work Days</td>
        <td><b id="work_days">0</b></td>
    </tr>
    <tr>
        <td>Actual Wages</td>
        <td><b name="currency_str"></b> <b id="actual_wages">0</b></td>
    </tr>
    <tr>
        <th colspan="2">Total</th>
    </tr>
    <tr>
        <td>Gross Salary</td>
        <td><b name="currency_str"></b> <b id="gross_salary">0</b></td>
    </tr>
</table>

<div class="form-group {{ $errors->has('payslip_amount') ? 'has-error' : ''}}">
    <label for="payslip_amount" class="control-label">{{ 'Payslip Amount' }}</label>
    <input class="form-control" readonly name="payslip_amount" type="number" id="payslip_amount" value="{{ isset($payslip->payslip_amount) ? $payslip->payslip_amount : ''}}" >
    {!! $errors->first('payslip_amount', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
