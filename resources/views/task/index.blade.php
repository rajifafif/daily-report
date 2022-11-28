@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tasks</h2>
            </div>
            <div class="pull-right">
                @can('task-create')
                <a class="btn btn-success" href="{{ route('task.create') }}"> Create New Task</a>
                @endcan
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
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach($tasks as $task)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $task->subject }}</td>
            <td>{{ $task->detail }}</td>
            <td>
                <form action="{{ route('task.destroy',$task->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('task.show',$task->id) }}">Show</a>
                    @can('task-edit')
                    <a class="btn btn-primary" href="{{ route('task.edit',$task->id) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('task-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $tasks->links() !!}
    <p class="text-center text-primary"><small>Tutorial by LaravelTuts.com</small></p>
@endsection