<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /************************************************************************
    *Dashboard page
    *************************************************************************/
    public function index()
    {        
        //Fetch Projects Details
        $data = Project::select('projects.*', 'projects.id', 
                DB::raw('COUNT(tasks.id) as total_tasks'),
                DB::raw('SUM(CASE WHEN tasks.is_completed = 1 THEN 1 ELSE 0 END) as completed_tasks'),
                DB::raw('SUM(CASE WHEN tasks.is_completed = 0 THEN 1 ELSE 0 END) as pending_tasks')
            )
            ->groupBy('projects.id')
            ->orderBy('projects.created_at');

        if(auth()->user()->role == 1) { //Project Manager
            $data = $data->leftJoin('tasks', 'projects.id', '=', 'tasks.project_id');
        }
        else if(auth()->user()->role == 2) { //Team Member
            $data = $data->leftJoin('tasks', function ($join) {
                        $join->on('projects.id', '=', 'tasks.project_id')
                        ->where('tasks.assigned_to', '=', auth()->user()->id);
                    })
                    ->leftJoin('project_user', 'projects.id', '=', 'project_user.project_id')
                    ->where('project_user.team_member_id', auth()->user()->id);
        }

        $projects = $data->get();

        return view('dashboard', compact('projects'));
    }
}
