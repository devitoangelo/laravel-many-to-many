<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.projects.index', ['projects' => Project::orderByDesc('id')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();



        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {



        $validated = $request->validated();
        $slug = Str::slug($request->title, '-');

        $validated['slug'] = $slug;

       

        if ($request->has('cover_image')) {

            $image_path = Storage::put('uploads', $validated['cover_image']);
            // dd($image_path);
            $validated['cover_image'] = $image_path;
        }


        Project::create($validated);
        return to_route('admin.project.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();
        $slug = Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        if($request->has('cover_image')){


            if($project->cover_image){

                Storage::delete($project->cover_image);
            }



            $image_path = Storage::put('uploads', $validated['cover_image']);
            // dd($image_path);
            $validated['cover_image'] = $image_path;

        }


        $project->update($validated);
        return to_route('admin.project.index')->with('message', "Post $project->title update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if($project->cover_image){

            Storage::delete($project->cover_image);
        }
        $project->delete();
        return to_route('admin.project.index')->with('message', "Post $project->title deleted successfully");
    }
}
