<?php

    use App\Models\bpjs_datum as bpjs;

    $BPJS = bpjs::get()->where("active",'=',1);

    $bpjs_data = array();

    foreach ($BPJS as $bpjs) {
        $bpjs_data[$bpjs->id] = $bpjs->nama;
    }

    $bpjs_json = json_encode($bpjs_data);

?>

<div class="form-group {{ $errors->has('contract_name') ? 'has-error' : ''}}">
    <label for="contract_name" class="control-label">{{ 'Contract Name *' }}</label>
    <input required class="form-control" name="contract_name" type="text" id="contract_name" value="{{ isset($contract->contract_name) ? $contract->contract_name : ''}}" >
    {!! $errors->first('contract_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('currency') ? 'has-error' : ''}}">
    <label for="currency" class="control-label">{{ 'Currency *' }}</label>
    <input required class="form-control" name="currency" type="text" id="currency" value="{{ isset($contract->currency) ? $contract->currency : ''}}" >
    {!! $errors->first('currency', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date_start') ? 'has-error' : ''}}">
    <label for="date_start" class="control-label">{{ 'Date Start *' }}</label>
    <input required class="form-control" name="date_start" type="date" id="date_start" value="{{ isset($contract->date_start) ? $contract->date_start : ''}}" >
    {!! $errors->first('date_start', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date_end') ? 'has-error' : ''}}">
    <label for="date_end" class="control-label">{{ 'Date End' }}</label>
    <input class="form-control" name="date_end" type="date" id="date_end" value="{{ isset($contract->date_end) ? $contract->date_end : ''}}" >
    {!! $errors->first('date_end', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('wages') ? 'has-error' : ''}}">
    <label for="wages" class="control-label">{{ 'Wages *' }}</label>
    <input required class="form-control" name="wages" type="number" id="wages" value="{{ isset($contract->wages) ? $contract->wages : ''}}" >
    {!! $errors->first('wages', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('pph21') ? 'has-error' : ''}}">
    <label for="pph21" class="control-label">{{ 'Pph21' }}</label>
    <input class="form-control" name="pph21" type="number" id="pph21" value="{{ isset($contract->pph21) ? $contract->pph21 : ''}}" >
    {!! $errors->first('pph21', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('food') ? 'has-error' : ''}}">
    <label for="food" class="control-label">{{ 'Food' }}</label>
    <input class="form-control" name="food" type="number" id="food" value="{{ isset($contract->food) ? $contract->food : ''}}" >
    {!! $errors->first('food', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('transport') ? 'has-error' : ''}}">
    <label for="transport" class="control-label">{{ 'Transport' }}</label>
    <input class="form-control" name="transport" type="number" id="transport" value="{{ isset($contract->transport) ? $contract->transport : ''}}" >
    {!! $errors->first('transport', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
    <label for="active" class="control-label">{{ 'Active' }}</label>
    <div class="radio">
    <label><input name="active" type="radio" value="1" {{ (isset($contract) && 1 == $contract->active) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="active" type="radio" value="0" @if (isset($contract)) {{ (0 == $contract->active) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
<div class="form-group {{ $errors->has('work_day') ? 'has-error' : ''}}">
    <label for="work_day" class="control-label">{{ 'Work Days' }}</label>
    <input class="form-control" name="work_day" type="number" id="work_day" value="{{ isset($contract->work_day) ? $contract->work_day : ''}}" >
    {!! $errors->first('work_day', '<p class="help-block">:message</p>') !!}
</div>
    {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('bpjs_category_id') ? 'has-error' : ''}}">
    <label for="bpjs_category_id" class="control-label">{{ 'BPJS Category' }}</label>
    <select required name="bpjs_category_id" class="form-control" id="bpjs_category_id" >
    @foreach (json_decode($bpjs_json, true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($contract->bpjs_category_id) && $contract->bpjs_category_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
