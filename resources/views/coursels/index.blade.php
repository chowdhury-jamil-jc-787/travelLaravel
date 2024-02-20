@extends('admin.layout')

@section('content')
<div class="container-fluid">
     
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Coursel Crud Operation</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="/admin/coursels/create"> Create New Product</a>
            </div>
        </div>
    </div>

    <br>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($coursels as $coursel)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/image/{{ $coursel->image }}" width="100px"></td>
            <td>{{ $coursel->name }}</td>
            <td>{{ $coursel->detail }}</td>
            <td>
                <form action="/admin/coursels/destroy/{{ $coursel->id }}" method="POST">
     
                    <a class="btn btn-info" href="/admin/coursels/show/{{ $coursel->id }}">Show</a>
      
                    <a class="btn btn-primary" href="/admin/coursels/edit/{{ $coursel->id }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $coursels->links() !!}
        
</div>
@endsection