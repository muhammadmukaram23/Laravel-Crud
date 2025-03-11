@extends('students.layout')
@section('content')
    <div class="container">
        <div class="row">
 
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2>Laravel 9 Crud</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/student/create') }}" class="btn btn-success btn-sm" title="Add New Student">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Address</th>
            <th>Mobile</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($students as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->address }}</td>
            <td>{{ $item->mobile }}</td>
            <td>
                @if($item->image)
                    <img src="{{ asset($item->image) }}" width="50">
                @endif
            </td>
            <td>
                <a href="{{ url('/student/' . $item->id) }}" title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</button></a>
                <a href="{{ url('/student/' . $item->id . '/edit') }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</button></a>
                <form method="POST" action="{{ url('/student/' . $item->id) }}" style="display:inline">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

                        </div>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection