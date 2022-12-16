<?php
    use App\Models\Employee;
    $Employees = Employee::get();
    $json_data = array();
    foreach ($Employees as $Employee) {
        $json_data[$Employee->id] = $Employee->name;
    }
    $employee_data = $json_data;

    function compute_time($total_microseconds){
        $total_seconds = $total_microseconds / 1000;
        $hours = floor($total_seconds / 3600);
        $minutes = floor(($total_seconds - ($hours * 3600)) / 60);
        $seconds = $total_seconds - ($hours * 3600) - ($minutes * 60);

        if ($hours < 10) {
            $hours = "0".$hours;
        }

        if ($minutes < 10) {
            $minutes = "0".$minutes;
        }

        if ($seconds < 10) {
            $seconds = "0".$seconds;
        }

        $time = $hours . ":" . $minutes . ":" . $seconds;
        return $time;
    }
?>

@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Attendance</div>
                    <div class="card-body">
                        
                        <a href="{{ url('/admin/attendance') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/attendance/' . $attendance->id . '/edit') }}" title="Edit attendance"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/attendance' . '/' . $attendance->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete attendance" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th> Employee </th><td> {{ $employee_data[$attendance->employee_id] }} </td>
                                    </tr>
                                    <tr>
                                        <th> In Time </th><td> {{ $attendance->in_time }} </td>
                                    </tr>
                                    <tr>
                                        <th> Out Time </th><td> {{ $attendance->out_time }} </td>
                                    </tr>
                                    <tr>
                                        <th> Work Hours </th><td> {{ compute_time($attendance->work_hours) }} </td>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
