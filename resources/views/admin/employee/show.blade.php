<?php
    use App\Models\Contract;
    
    $gender_list = array("male"=> "Male", "female"=> "Female");
    $marriage_list = array("not_married"=> "Not Married", "married"=> "Married", "widow"=> "Widow/Widower");

    $Contracts = contract::get()->find($employee->contract_id);
?>
@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Employee / {{ $employee->name }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/employee') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/employee/' . $employee->id . '/edit') }}" title="Edit employee"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/employee' . '/' . $employee->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete employee" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th> Name </th><td> {{ $employee->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Code </th><td> {{ $employee->code }} </td>
                                    </tr>
                                    <tr>
                                        <th> Identification No </th><td> {{ $employee->identification_no }} </td>
                                    </tr>
                                    <tr>
                                        <th> Address </th><td> {{ $employee->address }} </td>
                                    </tr>
                                    <tr>
                                        <th> Marriage Status </th><td> {{ $marriage_list[$employee->marriage_status] }} </td>
                                    </tr>
                                    <tr>
                                        <th> Gender </th><td> {{ $gender_list[$employee->gender] }} </td>
                                    </tr>
                                    <tr>
                                        <th> Contract </th><td> {{$Contracts->contract_name }} </td>
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
