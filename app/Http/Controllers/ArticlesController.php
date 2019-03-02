<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use App\Category;
use App\Tag;
use App\Image;
use App\Like;
use Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;
use Cache;
use SoftDeletes;
use File;
use DB;

class ArticlesController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::Search($request->name)->orderBy('updated_at','DESC')->paginate(5);
        $articles->each(function($articles){
            $articles->category;
            $articles->User;
            $articles->images;
            $articles->tags()->distinct()->get();
        });
        return view('admin.articles.index')->with('article', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_all= Category::all();
        $categories = Category::orderBy('name','ASC')->lists('name','id');
        $categories->prepend('Seleccione una categoría','');
        $tags = Tag::orderBy('name','ASC')->lists('name','id');
        return view('admin.articles.create')->with(['category' => $categories,'tag'=>$tags,'category_all' => $categories_all]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $articles = new Article($request->all());
        $articles->title = ucfirst($request->title);

        if ($request->file('img'))
        {
            $file = $request->file('img');
            $name = 'app_laravel_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\plugins\img\articles';
            $file->move($path,$name);
            $articles->img_dest = $name;

        }

        $articles->save();
        
        if ($request->file('img'))
        {
            $imagen = new Image();
            $imagen->name = $name;
            $imagen->article()->associate($articles);
            $imagen->save();
        }

        $articles->tags()->sync($request->get('tags', []));

        Flash('Artículo Creado Correctamente','info');
        return redirect()->route('admin.articles.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articles = Article::findOrFail($id);
        $articles->tags;
        $articles->user;
        $articles->category;
        $articles->images;
        $articles->coments;
        return view('admin.articles.show')->with('articles',$articles);
    }

    public function showslug($slug)
    {
        $articles = Article::findBySlugOrFail($slug);
        $articles->tags;
        $articles->user;
        $articles->category;
        $articles->images;
        return view('admin.articles.show')->with('articles',$articles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articles = Article::findOrFail($id);
        $articles->category;
        $categories = Category::orderBy('name','ASC')->lists('name','id');
        $tags = Tag::orderBy('name','ASC')->lists('name','id');
        $my_tags = $articles->tags->lists('id')->ToArray();
        return view('admin.articles.edit')->with(['article'=> $articles,'category'=>$categories,'tag'=>$tags,'my_tag'=>$my_tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $articles = Article::findOrFail($id);
        $articles->slug = null;
        $articles->fill($request->all());

        if ($request->hasFile('img'))
        {
            $file = $request->file('img');
            $name = 'app_laravel_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\plugins\img\articles';
            $file->move($path,$name);
            $articles->img_dest = $name;
            $imagen = new Image();
            $imagen->name = $name;
            $imagen->article()->associate($articles);
            $imagen->save();
        }

        $articles->title = ucfirst($request->title);
        $articles->update();
        
        $articles->tags()->sync($request->get('tags', []));

        Flash('Artículo Actualizado Correctamente','info');

        return redirect()->route('admin.articles.edit',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articles = Article::findOrFail($id);

        if($articles->images->count()>0)
        {
            foreach ($articles->images as $images) {
                $name = $images->name;
                File::delete('plugins/img/articles/'.$name);
            }
            DB::table('articles')->where('id', $id)->update(['img_dest' => ""]);
        }

        $articles->delete();
        
        Flash('Artículo Eliminado Correctamente','danger');
        return redirect()->route('admin.articles.index');
    }

    public function destroyall()
    {
        $articles = Article::all();
        $articles->each(function($articles)
        {
            if($articles->images->count()>0)
            {
                foreach ($articles->images as $images) {
                    $name = $images->name;
                    File::delete('plugins/img/articles/'.$name);
                }
                DB::table('articles')->where('id', $articles->id)->update(['img_dest' => ""]);
            }
            
            $articles->delete();
        });
        Flash('Se han Eliminado todos los Artículos Correctamente','danger');
        return redirect()->route('admin.articles.index');
    }

}
