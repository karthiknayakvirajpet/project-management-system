@extends('base')

@section('content')
<div class="container p-3">
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Add Task</h4>
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

                <form action="{{ route('task.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="project">Select Project</label>
                                    <select class="form-control" id="project" name="project" required>
                                        <option value="">Select Project</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="team_member">Select Team Member</label>
                                    <select class="form-control" id="team_member" name="team_member" required>
                                        <!-- <option value="">Select Team Member</option> -->
                                        <!-- dynamic data -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="2" required>{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleDropdown">Priority</label>
                                    <select class="form-control" id="priority" name="priority" required>
                                        <option value="">Select Priority</option>
                                        <option value="1">High</option>
                                        <option value="2">Medium</option>
                                        <option value="3">Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deadline" class="form-control-label">Deadline</label>
                                    <input class="form-control" id="deadline" type="text" name="deadline" required value="{{ old('deadline') }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary">Create Task</button>
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

    //Load team members on change of project
    $('#project').change(function () {
            var project_id = $(this).val(); // Get the selected project ID
            var team_member = $('#team_member'); // Assigned team members dropdown

            // Get team members based on the project ID
            $.ajax({
                url: '/get-project-team-members/' + project_id,
                type: 'GET',
                success: function (data) {
                    team_member.empty(); // Clear dropdown

                    team_member.append('<option value="">Select Team Member</option>');
                    $.each(data, function (index, member) {
                        team_member.append($('<option>').text(member.name).attr('value', member.id));
                    });
                }
            });
        });
});    
</script>