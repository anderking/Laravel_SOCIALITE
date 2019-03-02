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
use App\Coment;
use Alert;
use Carbon\Carbon;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;
use Cache;

class MemberComentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        Carbon::setLocale('es');
    }
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coments = new Coment($request->all());
        
        $id = $request->article_id;
        $articles = Article::findOrFail($id);
        $slug = $articles->slug;
        Flash('Comentario Publicado Correctamente','info');
        $coments->save();
        if(Auth::user()->admin())
            return redirect()->route('admin.article.showslug',$slug);
        elseif (Auth::user()->superadmin())
        {
            $referer = request()->headers->get('referer');
            $parts = explode('/localhost:8000/', $referer);
            $path_array = array_slice($parts,1);
            $path = implode('/',$path_array);

            if ($path == 'admin/article/'.$slug.'')
            {

                return redirect()->route('admin.article.showslug',$slug);
            }

            else
            {

                if ($path == 'member/article/'.$slug.'')
                {
                    
                    return redirect()->route('member.article.showarticles',$slug);
                }
            }
        }
        else
            return redirect()->route('member.article.showarticles',$slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $coments = Coment::findOrFail($id);
        $coments ->fill($request->all());

        $article_id = $coments->article_id;
        $articles = Article::findOrFail($article_id);
        $slug = $articles->slug;

        $coments->update();
        Flash('Comentario Actualizado Correctamente','info');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coments = Coment::find($id);
        $article_id = $coments->article_id;
        $articles = Article::findOrFail($article_id);
        $slug = $articles->slug;
        $coments->delete();
        Flash('Comentario Eliminado Correctamente','danger');

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

    public function destroyall(Request $request){
        $id = $request->article_id;
        $articles = Article::find($id);
        $slug = $articles->slug;
        $coments = $articles->coments;
        $coments->each(function($coments)
        {
            $coments->delete();
        });
        Flash('Se han Eliminado todos los Comentarios Correctamente','danger');
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
