<?php
    use App\Models\Employee;

    $employees = Employee::all();

    $employee_data = array();

    foreach ($employees as $employee) {
        $employee_data[$employee->id] = $employee->name;
    }

    $employee_data = array('' => 'Select Employee') + $employee_data;
?>

@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Payslip</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/payslip/create') }}" class="btn btn-success btn-sm" title="Add New payslip">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/payslip') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>Date Start</th>
                                        <th>Date End</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($payslip as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee_data[$item->employee_id] }}</td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->end_date }}</td>
                                        <td>{{$item->currency}} {{ $item->payslip_amount }}</td>
                                        <td>
                                            <a href="{{ url('/printout/payslip/' . $item->id) }}" title="Print Payslip"><button class="btn btn-info btn-sm"><i class="fa fa-print" aria-hidden="true"></i> Print</button></a>
                                            <a href="{{ url('/admin/payslip/' . $item->id) }}" title="View payslip"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/payslip/' . $item->id . '/edit') }}" title="Edit payslip"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/payslip' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete payslip" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $payslip->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
