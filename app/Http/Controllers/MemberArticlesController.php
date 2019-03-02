<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Article;
use App\Category;
use App\Tag;
use App\Image;
use App\Like;
use Alert;
use Carbon\Carbon;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Cache;
use SoftDeletes;
use File;
use DB;

class MemberArticlesController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return view('member.myarticlescreate')->with(['category' => $categories,'tag'=>$tags,'category_all' => $categories_all]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $id = Auth::user()->id;

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


        Flash('Articulo Publicado Correctamente','info');
        return redirect()->route('member.articles.show',$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::findOrFail($id);
        $users->articles;
        $categories = Category::all();
        $category_all = Category::orderBy('name','ASC')->lists('name','id');
        $category_all->prepend('Seleccione una categoría','');
        $tags_all = Tag::orderBy('name','ASC')->lists('name','id');
        return view('member.myarticles')->with(['user'=> $users,'category_all' => $category_all,'tag_all'=>$tags_all,'category'=>$categories]);
    }

    public function showarticles($slug)
    {
        $articles = Article::findBySlugOrFail($slug);
        $articles->tags;
        $users=$articles->user;
        $articles->category;
        $articles->images;
        $articles->coments;

        
        if(Cache::has($slug)==false){
            Cache::add($slug,'contador',0.01);
            $articles->visitas++;
            $articles->timestamps = false;
            $articles->update();
            $articles->timestamps = true;
        }
        return view('member.showarticles')->with(['articles'=>$articles,'user'=>$users]);
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
        return view('member.articlesedit')->with(['article'=> $articles,'category'=>$categories,'tag'=>$tags,'my_tag'=>$my_tags]);
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


        Flash('Articulo Actualizado Correctamente','info');

        return redirect()->route('member.articles.edit',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = Auth::user()->id;
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
        
        Flash('Articulo Eliminado Correctamente','danger');
        return redirect()->route('member.articles.show',$user_id);
    }

    public function destroy_articles_images($article_id,$image_id)
    {
        $articles = Article::find($article_id);
        $slug = $articles->slug;
        $articles->images = Image::find($image_id);

        if ( $articles->img_dest == $articles->images->name )
        {
            $img_dest = $articles->img_dest;
            $articles->images->delete();
            File::delete('plugins/img/articles/'.$img_dest);
            DB::table('articles')->where('id', $articles->id)->update(['img_dest' => ""]);
        }
        else
        {
            $name = $articles->images->name;
            $articles->images->delete();
            File::delete('plugins/img/articles/'.$name);
        }

        Flash('Imagen Eliminada Correctamente','danger');


        if(Auth::user()->admin())
            return redirect()->route('admin.article.showslug',$slug);
        elseif (Auth::user()->superadmin())
        {
            $referer = request()->headers->get('referer');
            $parts = explode('/localhost:8000/', $referer);
            $path_array = array_slice($parts,1);
            $path = implode('/',$path_array);
            
            if ($path == 'admin/article/'.$slug.'')
                return redirect()->route('admin.article.showslug',$slug);
            else
            {
                if ($path == 'member/article/'.$slug.'')
                    return redirect()->route('member.article.showarticles',$slug);
            }
        }
        else
            return redirect()->route('member.article.showarticles',$slug);
        
    }

}
