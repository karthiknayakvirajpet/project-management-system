@extends('base')

@section('content')
<div class="container p-3">
    <div class="justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Tasks</h4>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" style="background-color: #FCFCFC;">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Assigned By</th>
                                <th>Description</th>
                                <th>Priority</th>
                                <th>Deadline</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->project_name }}</td>
                                <td>{{ $task->assigned_by }}</td>
                                <td>{{ $task->description }}</td>
                                <td>
                                    @if($task->priority == 1)
                                        High
                                    @elseif($task->priority == 2)
                                        Medium
                                    @elseif($task->priority == 3)
                                        Low
                                    @endif
                                </td>
                                <td>{{ $task->deadline }}</td>
                                <td>{{ $task->progress }}</td>
                                <td>
                                    @if($task->is_completed == 1)
                                        Completed
                                    @else
                                        Pending
                                    @endif
                                </td>
                                <td>{{ $task->created_at }}</td>
                                <td>
                                    <a href="/edit-member-task/{{$task->id}}">
                                        <button type="button" class="btn btn-info" data-original-title="" title="Edit" name="edit">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                    </a>
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
@endsection


<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {


});
</script>