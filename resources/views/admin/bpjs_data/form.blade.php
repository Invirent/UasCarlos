<div class="form-group {{ $errors->has('nama') ? 'has-error' : ''}}">
    <label for="nama" class="control-label">{{ 'Nama' }}</label>
    <input class="form-control" name="nama" type="text" id="nama" value="{{ isset($bpjs_datum->nama) ? $bpjs_datum->nama : ''}}" >
    {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('expiration_date') ? 'has-error' : ''}}">
    <label for="expiration_date" class="control-label">{{ 'Expiration Date' }}</label>
    <input class="form-control" name="expiration_date" type="date" id="expiration_date" value="{{ isset($bpjs_datum->expiration_date) ? $bpjs_datum->expiration_date : ''}}" >
    {!! $errors->first('expiration_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cost') ? 'has-error' : ''}}">
    <label for="cost" class="control-label">{{ 'Cost' }}</label>
    <input class="form-control" name="cost" type="number" id="cost" value="{{ isset($bpjs_datum->cost) ? $bpjs_datum->cost : ''}}" >
    {!! $errors->first('cost', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
    <label for="active" class="control-label">{{ 'Active' }}</label>
    <div class="radio">
    <label><input name="active" type="radio" value="1" {{ (isset($bpjs_datum) && 1 == $bpjs_datum->active) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="active" type="radio" value="0" @if (isset($bpjs_datum)) {{ (0 == $bpjs_datum->active) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
    {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
