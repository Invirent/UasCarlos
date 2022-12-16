<?php
    use App\Models\Employee;
    $Employees = Employee::get();
    $json_data = array();
    foreach ($Employees as $Employee) {
        $json_data[$Employee->id] = $Employee->name;
    }
    $employee_data = json_encode($json_data);
?>

<div class="form-group {{ $errors->has('account_number') ? 'has-error' : ''}}">
    <label for="account_number" class="control-label">{{ 'Account Number' }}</label>
    <input class="form-control" name="account_number" type="text" id="account_number" value="{{ isset($bankaccount->account_number) ? $bankaccount->account_number : ''}}" >
    {!! $errors->first('account_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bank_name') ? 'has-error' : ''}}">
    <label for="bank_name" class="control-label">{{ 'Bank Name' }}</label>
    <input class="form-control" name="bank_name" type="text" id="bank_name" value="{{ isset($bankaccount->bank_name) ? $bankaccount->bank_name : ''}}" >
    {!! $errors->first('bank_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('employee_id') ? 'has-error' : ''}}">
    <label for="employee_id" class="control-label">{{ 'Employee' }}</label>
    <select required name="employee_id" class="form-control" id="employee_id" >
        @foreach (json_decode($employee_data, true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($employee->employee_id) && $employee->employee_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
