<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /************************************************************************
    *Task index page
    *************************************************************************/
    public function index()
    {        
        //Fetch Tasks
        $tasks = Task::select('tasks.*', 'projects.name as project_name', 'users.name as assigned_to')
        ->leftJoin('projects', 'tasks.project_id', '=', 'projects.id')
        ->leftJoin('users', 'tasks.assigned_to', '=', 'users.id')
        ->orderBy('tasks.deadline')
        ->orderBy('tasks.priority')
        ->get();

        return view('task.index', compact('tasks'));
    }

    /************************************************************************
    *Task Add view page
    *************************************************************************/
    public function add()
    {        
        $projects = Project::orderBy('created_at')->get(); //Fetch Projects  
        return view('task.create', compact('projects'));
    }

    /************************************************************************
    *Task store function
    *************************************************************************/
    public function store(Request $request)
    {        
        //Validate input values
        $validator = Validator::make($request->all(), [
            'project' => 'required|integer|exists:projects,id',
            'team_member' => 'required|integer|exists:users,id',
            'description' => 'required',
            'priority' => 'required|integer',
            'deadline' => 'required|date',
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Save Task details
        $task = new Task();
        $task->project_id = $request->project;
        $task->assigned_by = auth()->user()->id;
        $task->assigned_to = $request->team_member;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->deadline = $request->deadline;
        $task->save();

        //Email notification to the team member
        $member = User::find($request->team_member);
        $project = Project::find($request->project);
        $manager = User::find(auth()->user()->id);

        $email = $member->email;
        //$email = 'karthiknykb@gmail.com';
        
        try
        {
            $data = array(
                    'team_member' => $member->name,
                    'project' => $project->name,
                    'manager_name' => $manager->name,
                    'priority' => $request->priority,
                    'deadline' => $request->deadline,
                );

            \Mail::send('emails.task_created', $data, function ($message) use($email)
            {
                $message->to($email)->subject('New Task Assigned');
            });

            \Log::debug('Email sent successfully : '. $email);
        }
        catch (\Exception $e) 
        {
            \Log::error("Error while sending email : ". $e->getMessage());
        }

        return redirect()->route('task.index')->with('success', 'Task created successfully.');
    }

    /************************************************************************
    *Task edit view page
    *************************************************************************/
    public function edit($id)
    {        
        $task = Task::find($id);
        $member = User::where('id', $task->assigned_to)->first();
        $project = Project::where('id', $task->project_id)->first();
        return view('task.edit', compact('project', 'task', 'member'));
    }

    /************************************************************************
    *Task update function
    *************************************************************************/
    public function update(Request $request)
    {        
        //Validate input values
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'priority' => 'required|integer',
            'deadline' => 'required|date',
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Save Task details
        $task = Task::where('id', $request->task_id)->first();
        $task->assigned_by = auth()->user()->id;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->deadline = $request->deadline;
        $task->save();

        return redirect()->route('task.index')->with('success', 'Task updated successfully.');
    }

    /************************************************************************
    *Task delete function
    *************************************************************************/
    public function delete($id)
    {        
        Task::where('id', $id)->delete();
        return response()->json(['success'=>'Task deleted successfully.']);
    }


    /************************************************************************
    *Get Project Team Members
    *************************************************************************/
    public function getProjectTeamMembers($project_id)
    {        
        $project_members = ProjectUser::select('users.id', 'users.name')
                            ->where('project_id', $project_id)
                            ->leftJoin('users', 'project_user.team_member_id', '=', 'users.id')
                            ->get();

        return response()->json($project_members);
    }

    /************************************************************************
    *Member task index page
    *************************************************************************/
    public function indexMemberTask()
    {        
        //Fetch Member Tasks
        $tasks = Task::select('tasks.*', 'projects.name as project_name', 'users.name as assigned_by')
        ->leftJoin('projects', 'tasks.project_id', '=', 'projects.id')
        ->leftJoin('users', 'tasks.assigned_by', '=', 'users.id')
        ->where('tasks.assigned_to', auth()->user()->id)
        ->orderBy('tasks.deadline')
        ->orderBy('tasks.priority')
        ->get();

        return view('task.index_member', compact('tasks'));
    }

    /************************************************************************
    *Member Task edit view page
    *************************************************************************/
    public function editMemberTask($id)
    {        
        $task = Task::find($id);
        $manager = User::where('id', $task->assigned_by)->first();
        $project = Project::where('id', $task->project_id)->first();
        return view('task.edit_member', compact('project', 'task', 'manager'));
    }

    /************************************************************************
    *Member Task update function
    *************************************************************************/
    public function updateMemberTask(Request $request)
    {        
        //Validate input values
        $validator = Validator::make($request->all(), [
            'progress' => 'required',
            'status' => 'required|integer',
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Save Task details
        $task = Task::where('id', $request->task_id)->first();
        $task->progress = $request->progress;
        $task->is_completed = $request->status;
        $task->save();

        return redirect()->route('member.task.index')->with('success', 'Task updated successfully.');
    }
}
