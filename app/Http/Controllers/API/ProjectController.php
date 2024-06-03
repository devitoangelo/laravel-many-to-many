<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{


    public function index()
    {


        $projects = Project::with('technologys', 'type')->paginate(6);
        return response()->json([

            'success' => true,
            'projects' => $projects
        ]);
    }

    public function latest()
    {

        $projects = Project::with('technologys', 'type')->orderByDesc('id')->take(3)->get();
        return response()->json([

            'success' => true,
            'projects' => $projects
        ]);
    }

    public function show($id)
    {


        
        $projects = Project::with('technologys', 'type')->where('id', $id)->first();

        if ($projects) {
            return response()->json(

                [

                    'success' => true,
                    'response' => $projects,
                ]
            );

        } else {

            return response()->json(

                [
                    'success' => false,
                    'response' => 'Sprry not projects'


                ]


            );
        }
    }
}
