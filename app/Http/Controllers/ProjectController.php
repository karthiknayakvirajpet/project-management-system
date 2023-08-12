<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /************************************************************************
    *Project index page
    *************************************************************************/
    public function index()
    {      
        //Fetch Projects  
        $projects = Project::select('projects.*', 'projects.id', 
            DB::raw('COUNT(tasks.id) as total_tasks'),
            DB::raw('SUM(CASE WHEN tasks.is_completed = 1 THEN 1 ELSE 0 END) as completed_tasks'),
            DB::raw('SUM(CASE WHEN tasks.is_completed = 0 THEN 1 ELSE 0 END) as pending_tasks')
        )
        ->leftJoin('tasks', 'projects.id', '=', 'tasks.project_id')
        ->groupBy('projects.id')
        ->orderBy('projects.created_at')
        ->get();
        return view('project.index', compact('projects'));
    }

    /************************************************************************
    *Project Add view page
    *************************************************************************/
    public function add()
    {      
        $team_members = User::where('role', 2)->orderBy('created_at')->get(); //Fetch Team Members  
        return view('project.create', compact('team_members'));
    }

    /************************************************************************
    *Project store function
    *************************************************************************/
    public function store(Request $request)
    {        
        //Validate input values
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'team_members' => 'required|array',
            'team_members.*' => 'exists:users,id', // Validate each team member ID exists in users table
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Save Project details
        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->save();

        //Save Project-User data
        foreach ($request->team_members as $team_member) {
            $project_user = new ProjectUser();
            $project_user->project_id = $project->id;
            $project_user->team_member_id = $team_member;
            $project_user->save();
        }

        return redirect()->route('project.index')->with('success', 'Project created successfully.');
    }

    /************************************************************************
    *Project edit view page
    *************************************************************************/
    public function edit($id)
    {        
        $project = Project::find($id);
        $current_members = ProjectUser::where('project_id', $id)
                            ->leftJoin('users', 'project_user.team_member_id', '=', 'users.id')
                            ->pluck('project_user.team_member_id')
                            ->toArray();
        $new_members = User::where('role', 2)->orderBy('created_at')->get();
        return view('project.edit', compact('project', 'current_members', 'new_members'));
    }

    /************************************************************************
    *Project update function
    *************************************************************************/
    public function update(Request $request)
    {
        //Validate input values
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'team_members' => 'required|array',
            'team_members.*' => 'exists:users,id', // Validate each team member ID exists in users table
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Save Project details
        $project = Project::where('id', $request->project_id)->first();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->save();

        //Save Project-User data
        ProjectUser::where('project_id', $request->project_id)->delete();
        foreach ($request->team_members as $team_member) {
            $project_user = new ProjectUser();
            $project_user->project_id = $request->project_id;
            $project_user->team_member_id = $team_member;
            $project_user->save();
        }
        
        return redirect()->route('project.index')->with('success', 'Project updated successfully.');
    }

    /************************************************************************
    *Project delete function
    *************************************************************************/
    public function delete($id)
    {        
        Project::where('id', $id)->delete();
        return response()->json(['success'=>'Project deleted successfully.']);
    }
}
