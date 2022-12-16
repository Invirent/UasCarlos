<?php
    use App\Models\Contract;
    $Contracts = contract::get()->where('active', '=', 1);
    $json_data = array();
     
    foreach ($Contracts as $Contract) {
        $json_data[$Contract->id] = $Contract->contract_name;
    }
    $contract_data = json_encode($json_data);
?>

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($employee->name) ? $employee->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="control-label">{{ 'Code' }}</label>
    <input class="form-control" name="code" type="text" id="code" value="{{ isset($employee->code) ? $employee->code : ''}}" >
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('identification_no') ? 'has-error' : ''}}">
    <label for="identification_no" class="control-label">{{ 'Identification No' }}</label>
    <input required class="form-control" name="identification_no" type="text" id="identification_no" value="{{ isset($employee->identification_no) ? $employee->identification_no : ''}}" >
    {!! $errors->first('identification_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Address' }}</label>
    <textarea class="form-control" rows="5" name="address" type="textarea" id="address" >{{ isset($employee->address) ? $employee->address : ''}}</textarea>
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('marriage_status') ? 'has-error' : ''}}">
    <label for="marriage_status" class="control-label">{{ 'Marriage Status' }}</label>
    <select required name="marriage_status" class="form-control" id="marriage_status" >
    @foreach (json_decode('{"not_married":"Not Married", "married": "Married", "widow": "Widow/Widower"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($employee->marriage_status) && $employee->marriage_status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('marriage_status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
    <label for="gender" class="control-label">{{ 'Gender' }}</label>
    <select required name="gender" class="form-control" id="gender" >
    @foreach (json_decode('{"male": "Male", "female": "Female"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($employee->gender) && $employee->gender == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('contract_id') ? 'has-error' : ''}}">
    <label for="contract_id" class="control-label">{{ 'Contract Id' }}</label>
    <select required name="contract_id" class="form-control" id="contract_id" >
    @foreach (json_decode($contract_data, true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($employee->contract_id) && $employee->contract_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
