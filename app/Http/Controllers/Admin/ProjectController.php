<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Http\Requests\ProjectRequest;
use App\Functions\Helper;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['toSearch'])){
            $projects=Project::where('title', 'LIKE' , '%'. $_GET['toSearch'].'%')->paginate(10);
        }else{
            $projects = Project::orderBy('id','desc')->paginate(10);
        }

        $direction = 'desc';
        $toSearch = '';
        return view('admin.projects.index', compact('projects', 'direction'));
    }

    public function orderBy($direction, $column){
        $direction = $direction == 'desc'? 'asc':'desc';
        $projects = Project::orderBy($column, $direction)->paginate(10);
        $toSearch = '';
        return view('admin.projects.index', compact('projects', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //visto che ho fuso create e edit gli passo i valori
        $method = 'POST';
        $project = null;
        $route = route('admin.projects.store');
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.create', compact ('method', 'route', 'project', 'technologies', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();
        $new_project = new Project();
        $form_data['slug']=Helper::generateSlug($form_data['title'], Project::class);

        return redirect()->route('admin.projects.show', $new_project)->with('success', 'Progetto inserito con successo');

        $new_project ->fill($form_data);
        $new_project -> save();

        if(array_key_exists('types', $form_data)){
            $new_project -> types()->attach($form_data['types']);
        }

        return redirect()->route('admin.projects.show', $new_project);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function edit(Project $project)
     {
        $project->load('types');
         //visto che ho fuso create e edit gli passo i valori
         $method = 'PUT';
         $route = route('admin.projects.update', $project);
         $technologies = Technology::all();
         $types = Type::all();

         // Passa anche il $project e $types alla vista
         return view('admin.projects.create', compact('method', 'route', 'technologies', 'project', 'types'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data=$request->all();
        if($form_data['title'] != $project->title){
            $form_data['slug']=Helper::generateSlug($form_data['title'], Project::class);
        }else{
            $form_data['slug']=$project->slug;
        }

        $project->update($form_data);

        if(array_key_exists('types', $form_data)){
            $project->types()->sync($form_data['types']);
        }else{
            $project->types()->detach();
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
