@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Contract</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/contract/create') }}" class="btn btn-success btn-sm" title="Add New contract">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/contract') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>Contract</th>
                                        <th>Date Start</th>
                                        <th>Date End</th>
                                        <th>Wages</th>
                                        <th>PPH21</th>
                                        <th>Food</th>
                                        <th>Transport</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($contract as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->contract_name }}</td>
                                        <td>{{ $item->date_start }}</td>
                                        <td>{{ $item->date_end }}</td>
                                        <td>{{$item->currency}} {{ $item->wages }}</td>
                                        <td>{{$item->currency}} {{ $item->pph21 }}</td>
                                        <td>{{$item->currency}} {{ $item->food }}</td>
                                        <td>{{$item->currency}} {{ $item->transport }}</td>
                                        <td>{{ $item->active }}</td>
                                        <td>
                                            <a href="{{ url('/admin/contract/' . $item->id) }}" title="View contract"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/contract/' . $item->id . '/edit') }}" title="Edit contract"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/contract' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete contract" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $contract->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
