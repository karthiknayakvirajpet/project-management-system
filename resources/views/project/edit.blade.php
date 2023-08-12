@extends('base')

@section('content')
<div class="container p-3">
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Edit Project - {{ $project->name }}</h4>
                        </div>
                        <div class="col-md-4">
                            <a href="/index-project">
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

                <form action="{{ route('project.update', $project->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name" id="name" required value="{{ $project->name }}">
                                </div>
                            </div>
                        </div>                                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="2" required>{{ $project->description }}</textarea>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="team_members" class="form-control-label">Select Team Members</label>
                                </div>
                                @foreach ($new_members as $member)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="team_members[]" id="team_members" value="{{ $member->id }}" @if($member->id && in_array($member->id, $current_members)) checked @endif>
                                        <label class="form-check-label">{{ $member->name }}</label>
                                    </div>
                                @endforeach
                                <br>
                            </div>
                        </div>                 
                        <button type="submit" id="submit" class="btn btn-primary">Update</button>
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
    //Add at least one Team Member
    $('#submit').click(function (){
        const checkboxes = document.querySelectorAll('input[name="team_members[]"]');
        let atLeastOneChecked = false;

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                atLeastOneChecked = true;
            }
        });

        if (!atLeastOneChecked) {
            event.preventDefault();
            alert('Add at least one Team Member.');
        }
    });
});    
</script>