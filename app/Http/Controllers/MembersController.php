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
use App\like;
use Alert;
use Carbon\Carbon;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\MemberRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Cache;
use File;
use Storage;
use DB;

class MembersController extends Controller
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
        $articles = Article::whereNotIn('user_id',['1'])->orderBy('updated_at','DESC')->paginate(15);
        $articles->each(function($articles){
            $articles->category;
            $articles->User;
            $articles->images;
            $articles->tags;
            $articles->likes;
        });
        $users = User::all();
        
        return view('member.home')->with('article',$articles)->with('user',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {

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

        $images = DB::table('articles')
            ->join('users', 'users.id', '=', 'articles.user_id')
            ->join('images', 'images.article_id', '=', 'articles.id')
            ->where('users.id','=',$id)
            ->count();
        return view('member.profiel')->with(['user'=>$users,'images'=>$images]);
        
    }

    public function profielpublic($id)
    {
        $users = User::findOrFail($id);
        return view('member.profielpublic')->with('user',$users);
    }

    public function dashboard($id)
    {
        $users = User::findOrFail($id);
        $articles = $users->articles;
        $coments = $users->coments;

        $date = Carbon::parse($users->fecha);
        $year = intval($date->year);
        $moth = intval($date->month);
        $day = intval($date->day);
        $edad = Carbon::createFromDate($year,$moth,$day)->age;

        $coments_articles = DB::table('coments')
            ->join('users', 'users.id', '=', 'coments.user_id')
            ->join('articles', 'articles.id', '=', 'coments.article_id')
            ->where('users.id','=',$id)
            ->groupBy('articles.id')
            ->orderBy('articles.updated_at','DESC')
            ->select('articles.title','articles.img_dest','articles.updated_at','articles.slug')
            ->get();

        $con_coments = DB::table('articles')
            ->join('users', 'users.id', '=', 'articles.user_id')
            ->join('coments', 'coments.article_id', '=', 'articles.id')
            ->where('users.id','=',$id)
            ->groupBy('articles.id')
            ->orderBy('articles.updated_at','DESC')
            ->select('articles.title','articles.img_dest','articles.updated_at','articles.slug')
            ->get();

        #dd($con_coments);

        $articles_likes = DB::table('users')
            ->join('likes', 'likes.user_id', '=', 'users.id')
            ->join('articles', 'articles.user_id', '=', 'users.id')
            ->where('users.id','=','articles.user_id')
            ->where('users.id','=',$id)
            ->count();

        return view('member.dashboard')->with(['user'=>$users,'edad'=>$edad,'coments'=>$coments,'coments_articles'=>$coments_articles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $users = User::find($id);

        $password = $users->password;
        $users ->fill($request->all());
        $users->name = ucwords($request->name);
        if ($request->password!="")
            $users->password = bcrypt($request->password);
        else
            $users->password = $password ;
            #alert()->info('Usuario Editado correctamente', 'Excelente')->persistent('Close');
        Flash('Datos Actualizado Correctamente','info');
        $users->update();
        return redirect()->route('member.config',$id);
    }

    public function biodescriptionupdate(Request $request, $id){
        $users = User::find($id);
        $users->bio_description = $request->bio_description;
        #alert()->success('Descripción Actualizada Correctamente', 'Excelente')->persistent('Close');
        $users->update();
        return redirect()->route('member.profiel.show',$id);
    }

    public function photoupdate(MemberRequest $request, $id){
        
        $users = User::find($id);

        if ($request->file('img_user'))
        {
            $file = $request->file('img_user');
            $name = 'app_laravel_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\plugins\img\perfil';
            $file->move($path,$name);
            $previous = $users->img_user;

            $users->img_user = $name;
            $users->update();
            if($previous!="superadmin.jpg" && $previous!="admin.jpg" && $previous!="member.jpg" && $previous!="user.jpg" && $previous!="user_1.jpg" && $previous!="user_2.jpg" && $previous!="user_3.jpg" && $previous!="user_4.jpg" && $previous!="user_5.jpg" && $previous!="user_6.jpg" && $previous!="user_7.jpg" && $previous!="user_8.jpg" && $previous!="user_9.jpg" && $previous!="user_10.jpg" && $previous!="user_11.jpg" && $previous!="user_12.jpg" && $previous!="user_13.jpg" && $previous!="user_14.jpg" && $previous!="user_15.jpg" && $previous!="user_16.jpg" && $previous!="user_17.jpg" && $previous!="user_18.jpg" && $previous!="user_19.jpg" && $previous!="user_20.jpg")
            
            File::delete('plugins/img/perfil/'.$previous);
            #alert()->success('Foto de Perfil Actualizada Correctamente', 'Excelente')->persistent('Close');
            #Flash('Foto de Perfil Actualizada Correctamente','info');
            return redirect()->route('member.profiel.show',$id);
        }
    }

    public function photobioupdate(MemberRequest $request, $id){
        
        $users = User::find($id);

        if ($request->file('img_bio'))
        {
            $file = $request->file('img_bio');
            $name = 'app_laravel_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '\plugins\img\portada';
            $file->move($path,$name);
            $previous = $users->img_bio;

            $users->img_bio = $name;
            $users->update();
            if($previous!="portada.jpg")
                File::delete('plugins/img/portada/'.$previous);

            #alert()->success('Foto de Portada Actualizada Correctamente', 'Excelente')->persistent('Close');
            #Flash('Foto de Perfil Actualizada Correctamente','info');
            return redirect()->route('member.profiel.show',$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function searchcategories($name){
        $categories = Category::SearchCategory($name)->firstOrFail();
        $articles = $categories->articles()->whereNotIn('user_id',['1'])->distinct()->groupBy('articles.id')->orderBy('updated_at','DESC')->paginate(5);
        $articles->each(function($articles){
            $articles->category;
            $articles->images;
            $articles->tags;
        });
        return view('member.searchcategories')->with(['category_search'=>$categories,'article'=>$articles]);
    }

    public function searchtags($name){
        $tags = Tag::SearchTag($name)->firstOrFail();
        $articles = $tags->articles()->whereNotIn('user_id',['1'])->distinct()->groupBy('articles.id')->orderBy('updated_at','DESC')->paginate(5);
        $articles->each(function($articles){
            $articles->category;
            $articles->images;
            $articles->tags;
        });
        return view('member.searchtags')->with(['tag_search'=>$tags,'article'=>$articles]);
    }

    public function config($id){
        $id = Auth::user()->id;
        $users = User::findOrFail($id);
        return view('member.config')->with('user',$users);
    }

    public static function isLikedByMe($id)
    {
        $post = Article::findOrFail($id);
        if (Like::whereUserId(Auth::id())->whereArticleId($post->id)->exists()){
            return 'true';
        }
        return 'false';
    }

    public function like(Request $request,$id)
    {
        $article_existing = Article::findOrFail($id);
        if ($article_existing)
        {
            $existing_like = Like::whereArticleId($id)->whereUserId(Auth::id())->first();

            if (is_null($existing_like)) {
                Like::create([
                    'article_id' => $id,
                    'user_id' => Auth::id()
                ]);
                alert()->success('', 'Gracias por tu like')->persistent('Close');
            } else {
                if (is_null($existing_like->deleted_at)) {
                    $existing_like->delete();
                } else {
                    $existing_like->restore();
                }
                #alert()->warning('', 'Pajuo')->persistent('Close');
            }

            $slug = Article::findOrFail($id)->slug;

            return redirect()->route('member.article.showarticles',$slug);
        }
        else
        {
            return abort(404);
        }
    }
    
}
