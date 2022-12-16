<?php
    use Illuminate\Support\Facades\DB;
    $id = $bankaccount->id;
    $bank_account_view = DB::select('SELECT * FROM bank_employee_view WHERE id = ?', [$id])[0];
?>

@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Bank Account</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/bank-account') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/bank-account/' . $bank_account_view->id . '/edit') }}" title="Edit Bank Account"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/bankaccount' . '/' . $bank_account_view->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Bank Account" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $bank_account_view->id }}</td>
                                    </tr>
                                    <tr><th> Account Number </th><td> {{ $bank_account_view->account_number }} </td></tr><tr><th> Bank Name </th><td> {{ $bank_account_view->bank_name }} </td></tr><tr><th> Employee </th><td> {{ $bank_account_view->employee_name }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
