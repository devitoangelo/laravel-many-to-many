<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Technology;


class ProjectController extends Controller
{

    //index 
    public function index()
    {
        return view('admin.projects.index', ['projects' => Project::orderByDesc('id')->paginate(10)]);
    }


    // Create
    public function create()
    {

        $technologys = Technology::all();
        $types = Type::all();
        return view('admin.projects.create', compact('types', 'technologys'));
    }

    // store
    public function store(StoreProjectRequest $request)
    {

        $validated = $request->validated();
        $slug = Str::slug($request->title, '-');

        $validated['slug'] = $slug;

        if ($request->has('cover_image')) {

            $image_path = Storage::put('uploads', $validated['cover_image']);
            $validated['cover_image'] = $image_path;
        }


        $project = Project::create($validated);
        //associato i project in technologys
        if($request->has('technology')){
            $project->technology()->attach($validated['technology']);
        }

       
        return to_route('admin.project.index');
    }



    // show
    public function show(Project $project)
    {

        $technologys = Technology::all();
        return view('admin.projects.show', compact('project', 'technologys'));
    }

    // edit
    public function edit(Project $project)
    {

       $technologys = Technology::all();
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologys'));
    }


    // update
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();
        $slug = Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        if ($request->has('cover_image')) {


            if ($project->cover_image) {

                Storage::delete($project->cover_image);
            }

            $image_path = Storage::put('uploads', $validated['cover_image']);

            $validated['cover_image'] = $image_path;
        }


        $project->update($validated);
        return to_route('admin.project.index')->with('message', "Post $project->title update successfully");
    }

    
    // destroy
    public function destroy(Project $project)
    {

        if ($project->cover_image) {

            Storage::delete($project->cover_image);
        }
        $project->delete();
        return to_route('admin.project.index')->with('message', "Post $project->title deleted successfully");
    }
}
