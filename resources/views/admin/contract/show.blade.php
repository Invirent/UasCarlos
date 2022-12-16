@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Contract / {{ $contract->contract_name }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/contract') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/contract/' . $contract->id . '/edit') }}" title="Edit contract"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/contract' . '/' . $contract->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete contract" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th> Contract Name </th>
                                        <td> {{ $contract->contract_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Date Start </th><td> {{ $contract->date_start }} </td>
                                    </tr>
                                    <tr>
                                        <th> Date End </th><td> {{ $contract->date_end }} </td>
                                    </tr>
                                    <tr>
                                        <th> Wages </th><td> {{$contract->currency}} {{ $contract->wages }} </td>
                                    </tr>
                                    <tr>
                                        <th> PPh21 </th><td> {{$contract->currency}} {{ $contract->pph21 }} </td>
                                    </tr>
                                    <tr>
                                        <th> Food </th><td> {{$contract->currency}} {{ $contract->food }} </td>
                                    </tr>
                                    <tr>
                                        <th> Transport </th><td> {{$contract->currency}} {{ $contract->transport }} </td>
                                    </tr>
                                    <tr>
                                        <th> Work Day </th><td> {{$contract->work_day}} </td>
                                    </tr>
                                    <tr>
                                        <th> Active </th><td>{{ $contract->active }} </td>
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
