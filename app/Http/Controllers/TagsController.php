<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;
use Alert;
use App\Http\Requests\TagRequest;
use Illuminate\Support\Facades\Route;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tags = Tag::Search($request->name)->orderBy('id','ASC')->paginate(5);
        $tags->each(function($tags){
            $tags->articles;
        });
        return view('admin.tags.index')->with('tag',$tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $tags = new Tag($request->all());
        $tags->name = ucwords($request->name);
        flash('Tag Registrado Correctamente','info');
        $tags->save(); 
        return redirect()->route('admin.tags.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tags = Tag::findOrFail($id);
        return view('admin.tags.show')->with('tag',$tags);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::findOrFail($id);
        return view('admin.tags.edit')->with('tag',$tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        $tags = Tag::findOrFail($id);
        $tags ->fill($request->all());
        $tags->name = ucwords($request->name);
        #alert()->info('Tag Editado correctamente', 'Excelente')->persistent('Close');
        Flash('Tag Actualizado Correctamente','info');
        $tags->save();
        return redirect()->route('admin.tags.edit',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tags = Tag::findOrFail($id);
        $tags->delete();
        Flash('Tag Eliminado Correctamente','danger');
        return redirect()->route('admin.tags.index');
    }

    public function destroyall()
    {
        $tags = Tag::all();
        $tags->each(function($tags){
            $tags->delete();
        });
        Flash('Se han Eliminado todos los Tags Correctamente','danger');
        return redirect()->route('admin.tags.index');
    }
}