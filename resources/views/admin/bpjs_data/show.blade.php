@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">bpjs_datum {{ $bpjs_datum->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/bpjs_data') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/bpjs_data/' . $bpjs_datum->id . '/edit') }}" title="Edit bpjs_datum"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/bpjs_data' . '/' . $bpjs_datum->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete bpjs_datum" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $bpjs_datum->id }}</td>
                                    </tr>
                                    <tr><th> Nama </th><td> {{ $bpjs_datum->nama }} </td></tr><tr><th> Expiration Date </th><td> {{ $bpjs_datum->expiration_date }} </td></tr><tr><th> Cost </th><td> {{ $bpjs_datum->cost }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
