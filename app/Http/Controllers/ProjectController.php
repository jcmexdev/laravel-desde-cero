<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\ProjectSaved;
use App\Http\Requests\SaveProjectRequest;
use App\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    /**
     * ProjectController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('projects.index', [
            'projects' => Project::with('category')->latest()->paginate()
        ]);
    }

    /**
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Project $project)
    {
        return view('projects.show', [
            'project' => $project
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('projects.create', [
            'project' => new Project,
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    /**
     * @param SaveProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveProjectRequest $request)
    {
        $project = new Project($request->validated());
        $project->image = $request->file('image')->store('images');
        $project->save();

        ProjectSaved::dispatch($project);

        return redirect()->route('projects.index')->with('status', 'El proyecto fue creado con éxito');
    }

    /**
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Project $project)
    {

        return view('projects.edit', [
            'project' => $project,
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    /**
     * @param Project $project
     * @param SaveProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Project $project, SaveProjectRequest $request)
    {
        if ($request->hasFile('image')) {
            Storage::delete($project->image);
            $project->fill($request->validated());
            $project->image = $request->file('image')->store('images');
            $project->save();

            ProjectSaved::dispatch($project);

        } else {
            $project->update(array_filter($request->validated()));
        }

        return redirect()->route('projects.show', $project)->with('status', 'El proyecto fue actualizado con éxito.');
    }

    /**
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Project $project)
    {
        Storage::delete($project->image);
        $project->delete();

        return redirect()->route('projects.index')->with('status', 'El proyecto fue eliminado con éxito.');
    }
}
