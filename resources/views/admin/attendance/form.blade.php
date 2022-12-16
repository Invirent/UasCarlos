<script>
    function check_date(start, end){
        if(start > end){
            alert('Date Start must be less than Date End');
        }
    }

    function compute_time(start, end){
        var start = new Date(start);
        var end = new Date(end);
        var diff = end - start;
        return diff;
    }

    function compute_time_string(total_microseconds){
        var total_seconds = total_microseconds / 1000;
        var hours = Math.floor(total_seconds / 3600);
        var minutes = Math.floor((total_seconds - (hours * 3600)) / 60);
        var seconds = total_seconds - (hours * 3600) - (minutes * 60);

        if (hours < 10) {
            hours = "0" + hours;
        }

        if (minutes < 10) {
            minutes = "0" + minutes;
        }

        if (seconds < 10) {
            seconds = "0" + seconds;
        }

        var time = hours + ":" + minutes + ":" + seconds;
        return time;
    }

    function date_function(){
        var date_start = document.getElementById('in_time').value;
        var date_end = document.getElementById('out_time').value;
        if (date_start != '' && date_end != ''){
            check_date(date_start, date_end);
            var time = compute_time(date_start, date_end);
            document.getElementById('work_hours').value = time;
            var time_string = compute_time_string(time);
            document.getElementById('work_hours_string').value = time_string;
        }
    }

</script>

<?php
    use App\Models\Employee;
    $Employees = Employee::get();
    $json_data = array();
    foreach ($Employees as $Employee) {
        $json_data[$Employee->id] = $Employee->name;
    }
    $employee_data = json_encode($json_data);
?>

<div class="form-group {{ $errors->has('employee_id') ? 'has-error' : ''}}">
    <label for="employee_id" class="control-label">{{ 'Employee' }}</label>
    <select required name="employee_id" class="form-control" id="employee_id" >
        @foreach (json_decode($employee_data, true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($employee->employee_id) && $employee->employee_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
        @endforeach
    </select>
<div class="form-group {{ $errors->has('in_time') ? 'has-error' : ''}}">
    <label for="in_time" class="control-label">{{ 'In Time' }}</label>
    <input onchange=date_function(); class="form-control" name="in_time" type="datetime-local" id="in_time" value="{{ isset($attendance->in_time) ? $attendance->in_time : ''}}" >
    {!! $errors->first('in_time', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('out_time') ? 'has-error' : ''}}">
    <label for="out_time" class="control-label">{{ 'Out Time' }}</label>
    <input onchange=date_function(); class="form-control" name="out_time" type="datetime-local" id="out_time" value="{{ isset($attendance->out_time) ? $attendance->out_time : ''}}" >
    {!! $errors->first('out_time', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('work_hours') ? 'has-error' : ''}}">
    <label for="work_hours" class="control-label">{{ 'Work Hours' }}</label>
    <input class="form-control" name="work_hours_string" type="text" readonly id="work_hours_string" value="00:00:00" >
    <input class="form-control" name="work_hours" type="hidden" id="work_hours" value="{{ isset($attendance->work_hours) ? $attendance->work_hours : ''}}" >
    {!! $errors->first('work_hours', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
