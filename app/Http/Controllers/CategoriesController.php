<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Alert;
use App\Http\Requests\CategoryRequest;
use File;
use DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::Search($request->name)->orderBy('name','ASC')->paginate(5);
        $categories->each(function($categories){
            $categories->articles;
        });
        return view('admin.categories.index')->with('category',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $categories = new Category($request->all());
        $categories->name = ucwords($request->name);
        Flash('Categoría Registrada Correctamene', 'info');
        $categories->save();
        return redirect()->route('admin.categories.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::findOrFail($id);
        return view('admin.categories.show')->with('category',$categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $categories = Category::findOrFail($id);
        return view('admin.categories.edit')->with('category',$categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $categories = Category::findOrFail($id);
        $categories->fill($request->all());
        $categories->name = ucwords($request->name);
        Flash('Categoría Actualizada Correctamente','info');
        $categories->save();
        return redirect()->route('admin.categories.edit',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::findOrFail($id);

        $articles = $categories->articles;
        if ($articles->count()>0)
        {
            $articles->each(function($articles){
                if($articles->images->count()>0)
                {
                    foreach ($articles->images as $images) {
                        $name = $images->name;
                        File::delete('plugins/img/articles/'.$name);
                    }
                    DB::table('articles')->where('id', $articles->id)->update(['img_dest' => ""]);
                }
            });
        }

        $categories->delete();
        Flash('Categoría Eliminada Correctamente','danger');
        return redirect()->route('admin.categories.index');
    }

    public function destroyall()
    {
        $categories = Category::all();

        $categories->each(function($categories)
        {
            $articles = $categories->articles;
            if ($articles->count()>0)
            {
                $articles->each(function($articles){
                    if($articles->images->count()>0)
                    {
                        foreach ($articles->images as $images) {
                            $name = $images->name;
                            File::delete('plugins/img/articles/'.$name);
                        }
                        DB::table('articles')->where('id', $articles->id)->update(['img_dest' => ""]);
                    }
                });
            }
            $categories->delete();

        });

        Flash('Se han Eliminado todas las Categorías Correctamente','danger');
        return redirect()->route('admin.categories.index');
    }
}
