<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('pages.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ottengo i dati dalla tabella types
        $types = Type::all();
        $technologies = Technology::all();

        return view('pages.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $val_data = $request->validated();

        //Generazione slug
        $slug = Project::generateSlug($request->name);
        $val_data['slug'] = $slug;

        //Gestione immagine
        if($request->hasFile('cover_image')){
            $img_path = Storage::disk('public')->put('project_images', $request->cover_image);

            $val_data['cover_image'] = $img_path;
        }

        $newProject = Project::create($val_data);
        
        if($request->has('technologies')){
            $newProject->technologies()->attach( $request->technologies );
        }

        return redirect()->route('dashboard.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('pages.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();        

        return view('pages.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        $slug = Project::generateSlug($request->name);
        $val_data['slug'] = $slug;

        //Se è presente il file image all'interno della request
        if($request->hasFile('cover_image')){
            //Dobbiamo generare un path
            $img_path = Storage::disk('public')->put('project_images', $request->cover_image);

            $val_data['cover_image'] = $img_path;
        }

        $project->update($val_data);

        if($request->has('technologies')){
            $project->technologies()->sync($request->technologies);
        }

        return redirect()->route('dashboard.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $projects = Project::where('slug', $slug)->firstOrFail();

        $projects->delete();

        return redirect()->route('dashboard.projects.index')->with('success', 'Project deleted successfully.');
    }
}
