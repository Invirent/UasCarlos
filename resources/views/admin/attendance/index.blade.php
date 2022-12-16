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
                        <a href="{{ url('/admin/attendance/create') }}" class="btn btn-success btn-sm" title="Add New attendance">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/attendance') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee</th>
                                        <th>In Time</th>
                                        <th>Out Time</th>
                                        <th>Work Hours</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($attendance as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee_data[$item->employee_id] }}</td>
                                        <td>{{ $item->in_time }}</td>
                                        <td>{{ $item->out_time }}</td>
                                        <td>{{ compute_time($item->work_hours) }}</td>
                                        <td>
                                            <a href="{{ url('/admin/attendance/' . $item->id) }}" title="View attendance"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/attendance/' . $item->id . '/edit') }}" title="Edit attendance"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/attendance' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete attendance" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $attendance->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
