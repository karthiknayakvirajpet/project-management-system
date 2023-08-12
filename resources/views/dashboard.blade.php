@extends('base')

@section('content')
<div class="container p-3">
    <div class="justify-content-center align-items-center" style="height: 80vh;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Dashboard</h4>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" style="background-color: #FCFCFC;">
                        <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Project Description</th>
                                <th>Total Tasks</th>
                                <th>Completed Tasks</th>
                                <th>Pending Tasks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->description }}</td>
                                <td>{{ $project->total_tasks }}</td>
                                <td>{{ $project->completed_tasks }}</td>
                                <td>{{ $project->pending_tasks }}</td>
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