@extends('base')

@section('content')
<div class="container p-3">
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Edit Task</h4>
                        </div>
                        <div class="col-md-4">
                            <a href="/index-task">
                                <button type="button" class="btn btn-dark float-right">Back</button>
                            </a>
                        </div>
                    </div>
                </div>

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

                <form action="{{ route('task.update', $task->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <b>Project: {{ $project->name }}</b> | 
                                    <b>Team Member: {{ $member->name }}</b>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="2" required>{{ $task->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleDropdown">Priority</label>
                                    <select class="form-control" id="priority" name="priority" required>
                                        <option value="">Select Priority</option>
                                        <option value="1" @if($task->priority == 1) selected @endif>High</option>
                                        <option value="2" @if($task->priority == 2) selected @endif>Medium</option>
                                        <option value="3" @if($task->priority == 3) selected @endif>Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deadline" class="form-control-label">Deadline</label>
                                    <input class="form-control" id="deadline" type="text" name="deadline" required value="{{ $task->deadline }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary">Update Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
    //datepicker
    $("#deadline").datepicker({    
        format: 'yyyy-mm-dd',
        startDate: new Date()
    });
});    
</script>