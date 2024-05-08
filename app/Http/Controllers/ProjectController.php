<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Models\Investor;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::get();
        $investors = Investor::get();
        return view('modules.projects.index', compact('projects', 'investors'));
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request)
    {
        Project::create($request->all());
        return redirect()->route('project.index')->with('success', 'Proyecto creado exitosamente.');
    }

    public function show(Project $project)
    {
        //
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('modules.projects.update', compact('project'));
    }

    public function update(UpdateRequest $request, Project $project)
    {
        $project->update($request->all());
        return redirect()->route("project.index")->with("success", "Proyecto actualizado exitosamente.");
    }

    public function destroy($id)
    {
        Project::destroy($id);
        return redirect()->route('project.index')->with('success', 'Inversionista eliminado exitosamente.');
    }
}
