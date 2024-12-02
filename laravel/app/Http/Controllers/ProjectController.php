<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{

    // get all projects
    public function getAllProjects(){
        $projects = Project::all();

        return response()->json([
            "projects"=> $projects
        ]);
    }

    // get all projects with their members
    public function getProjectsWithMembers(){
        // joining projects with members table based on the project id, and then with users based on user id to get the name, this query returns a lot of queries with a lot of projects ids with different members id
        $projects = Project::join('members','projects.id', '=', 'members.project_id')
                    ->join('users', 'users.id', '=', 'members.user_id')
                    ->select('projects.id as id', 'projects.name as name', 'projects.description as description', 'users.name as member_name')
                    ->get();

        //$allProjects = [];
        // now i need to get the projects with the list of members name inside it
        /*$groupingProjects = $projects->groupBy("id")->map(function($project) {
            return [
                "id" => $project->id,
                "name" => $project->name,
                "description" => $project->description,
                "members"
            ]
        })*/ 
        
        return response()->json([
            'projects'=> $projects,
        ]);
    }

    // create a project
    public function createProject(Request $request){
        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        
        $success = $project->save();
        if(!$success){
            return response()->json([
                'status'=> 'error creating project'
            ]);
        }

        return response()->json([
            'status'=> 'success',
            'project' => $project
        ]);
    }

    // update a project
    public function updateProject(Request $request){
        $project = Project::find($request->id);
        if ($request->name)
            $project->name = $request->name;
        if ($request->description)
            $project->description = $request->description;
        $success = $project->save();
        if(!$success){
            return response()->json([
                'status'=> 'error updating project'
            ]);
        }

        return response()->json([
            'status'=> 'success',
            'project' => $project
        ]);
    }

    // delete a project
    public function deleteProject($id){
        $project = Project::find($id);
        try{
            $project->delete();
        }
        catch(error){
            return response()->json([
                'status'=> 'error deleting project',
                'message'=> 'can not delete the project'
            ]);
        }
        return response()->json([
            'status'=> 'success',
            'message'=> 'deleteing project successfully',
        ]);
    }
}
