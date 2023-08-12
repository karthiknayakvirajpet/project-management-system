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
                            <a href="/index-member-task">
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

                <form action="{{ route('member.task.update', $task->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <b>Project: {{ $project->name }}</b> | 
                                    <b>Assigned By: {{ $manager->name }}</b>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="progress" class="form-control-label">Progress</label>
                                    <textarea class="form-control" name="progress" id="progress" rows="2" required>{{ $task->progress }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleDropdown">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="0" @if($task->status == 0) selected @endif>Pending</option>
                                        <option value="1" @if($task->status == 1) selected @endif>Completed</option>
                                    </select>
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