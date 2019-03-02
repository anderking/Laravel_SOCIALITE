<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Article;
use Alert;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use File;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        Carbon::setLocale('es');
    }

    public function index(Request $request)
    {
        $users = User::whereNotIn('type',['superadmin'])->Search($request->name)->orderBy('name','ASC')->paginate(5);
        $users->each(function($users){
             $users->articles;
        });
        
        return view('admin.users.index')->with('user',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $users = new User($request->all());
        $users->name = ucwords($request->name);
        $users->password = bcrypt($request->password);
        if($request->type=="admin")
        {
            $users->img_user = "admin.jpg";
        }
        else
        {
            $users->img_user = "user.jpg";
        }
        flash('Usuario Registrado Correctamente','info');
        $users->save(); 
        return redirect()->route('admin.users.create');

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
        
        $date = Carbon::parse($users->fecha);
        $year = intval($date->year);
        $moth = intval($date->month);
        $day = intval($date->day);

        $edad = Carbon::createFromDate($year,$moth,$day)->age;
        return view('admin.users.show')->with(['user'=>$users,'edad'=>$edad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        $idAuth = Auth::user()->id;

        if(Auth::user()->superadmin())
        {
            return view('admin.users.edit')->with('user',$users);
        }
        elseif(Auth::user()->admin())
        {
            if($users->type == "admin")
            {
                if($idAuth == $id)
                    return view('admin.users.edit')->with('user',$users);
                else
                {
                    Flash('No puedes editar información de otro Usuario Administrador y no tienes los permisos para ejecutar esta opción','warning');
                    return redirect()->route('admin.users.index');
                }
            }
            elseif($users->type == "superadmin")
            {
                Flash('No puedes editar información del Super Administrador y no tienes los permisos para ejecutar esta opción','warning');
                return redirect()->route('admin.users.index');
            }
            else
                return view('admin.users.edit')->with('user',$users);
        }
        else
        {
            Flash('No Tienes acceso a esta funcionalidad','warning');
            return redirect()->route('admin.users.index');
        }
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
        $idAuth = Auth::user()->id;
        $users = User::find($id);
        $password = $users->password;
        $users ->fill($request->all());
        $users->name = ucwords($request->name);
        if ($request->password!="")
            $users->password = bcrypt($request->password);
        else
            $users->password = $password ;

        $users->update();
        Flash('Usuario Actualizado Correctamente','info');

        return redirect()->route('admin.users.edit',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        Flash('Usuario Eliminado Correctamente','danger');
        return redirect()->route('admin.users.index');
    }

    public function articles($id){
        $users = User::SearchUser($id)->first();
        $articles = $users->articles()->orderBy('created_at','DESC')->paginate(5);
        $articles->each(function($articles){
            $articles->category;
            $articles->images;
            $articles->tags;
        });
        return view('admin.users.articles')->with(['user'=>$users,'article'=>$articles]);
    }
    public function destroy_article($user_id){
        $users = User::find($user_id);
        $users->articles = Article::find($article_id);
        $users->delete();
        Flash('Articulo Eliminado Correctamente','danger');
        return redirect()->route('admin.users.articles',$user_id,$article_id);
    }

    public function userarticlesdestroy($id)
    {
        $users = User::find($id);
        $articles = $users->articles;

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

            $users->articles()->delete();
            Flash('Se han Eliminado todos los Artículos del usuario Correctamente','danger');
        }
        else
            Flash('Este usuario ya no tiene Artículos para Eliminar','info');

        return redirect()->route('admin.users.articles',$id);
    }

    public function destroyall()
    {
        $id = Auth::user()->id;

        $users = User::all()->except($id);

        if ($users->count()>0)
        {
            $users->each(function($users)
            {
                if (Auth::user()->superadmin())
                {
                    if($users->type=="member" || $users->type=="admin")
                    {
                        $articles = $users->articles;
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
                        $img_user = $users->img_user;
                        $img_bio = $users->img_bio;
                        if($img_user!="superadmin.jpg" && $img_user!="admin.jpg" && $img_user!="member.jpg" && $img_user!="user.jpg" && $img_user!="user_1.jpg" && $img_user!="user_2.jpg" && $img_user!="user_3.jpg" && $img_user!="user_4.jpg" && $img_user!="user_5.jpg" && $img_user!="user_6.jpg" && $img_user!="user_7.jpg" && $img_user!="user_8.jpg" && $img_user!="user_9.jpg" && $img_user!="user_10.jpg" && $img_user!="user_11.jpg" && $img_user!="user_12.jpg" && $img_user!="user_13.jpg" && $img_user!="user_14.jpg" && $img_user!="user_15.jpg" && $img_user!="user_16.jpg" && $img_user!="user_17.jpg" && $img_user!="user_18.jpg" && $img_user!="user_19.jpg" && $img_user!="user_20.jpg")
                        {
                            File::delete('plugins/img/perfil/'.$img_user);
                        }
                        if($img_bio!="portada.jpg")
                        {
                            File::delete('plugins/img/portada/'.$img_bio);
                        }
                        $users->delete();
                        Flash('Se han Eliminado todos los Usuarios Administradores y Miembros Correctamente','danger');
                    }
                    else
                        Flash('No podemos procesar tu petición hay algun problema inesperado','warning');
                }
                elseif(Auth::user()->admin())
                {
                    if($users->type=="member")
                    {
                        $articles = $users->articles;
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
                        $img_user = $users->img_user;
                        $img_bio = $users->img_bio;
                        if($img_user!="superadmin.jpg" && $img_user!="admin.jpg" && $img_user!="member.jpg" && $img_user!="user.jpg" && $img_user!="user_1.jpg" && $img_user!="user_2.jpg" && $img_user!="user_3.jpg" && $img_user!="user_4.jpg" && $img_user!="user_5.jpg" && $img_user!="user_6.jpg" && $img_user!="user_7.jpg" && $img_user!="user_8.jpg" && $img_user!="user_9.jpg" && $img_user!="user_10.jpg" && $img_user!="user_11.jpg" && $img_user!="user_12.jpg" && $img_user!="user_13.jpg" && $img_user!="user_14.jpg" && $img_user!="user_15.jpg" && $img_user!="user_16.jpg" && $img_user!="user_17.jpg" && $img_user!="user_18.jpg" && $img_user!="user_19.jpg" && $img_user!="user_20.jpg")
                        {
                            File::delete('plugins/img/perfil/'.$img_user);
                        }
                        if($img_bio!="portada.jpg")
                        {
                            File::delete('plugins/img/portada/'.$img_bio);
                        }
                        $users->delete();
                        Flash('Se han Eliminado todos los Usuarios Miembros Correctamente','danger');
                    }
                    elseif($users->type=="admin")
                    {
                        if( $users->where('type','admin')->count()>1 )
                             Flash('Existen varios usuarios Administradores, no puedes eliminarlos y no tienes los permisos para ejecutar esta opción','warning');
                         else
                         {
                            Flash('Eres el usuario Administrador, no podemos eliminarte','warning');
                         }
                    }
                    else
                        Flash('Eres el usuario Administrador, no podemos eliminarte','warning');
                    
                }
                else
                    Flash('No podemos procesar tu petición hay algun problema inesperado','danger');
            });
        }
        else
        {
            Flash('Ya ha eliminado a todos los usuarios, Eres el usuario Administrador, no podemos eliminarte','warning');
        }

        return redirect()->route('admin.users.index');
    }

    public function destroyselect(Request $request)
    {
        $selectedIds = $request->input('users');
        $users = User::whereIn('id', $selectedIds)->get();

        if( $selectedIds )
        {
            $users->each(function($users)
            {
                if (Auth::user()->superadmin())
                {
                    if($users->type=="member" || $users->type=="admin")
                    {
                        $articles = $users->articles;
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
                        $img_user = $users->img_user;
                        $img_bio = $users->img_bio;
                        if($img_user!="superadmin.jpg" && $img_user!="admin.jpg" && $img_user!="member.jpg" && $img_user!="user.jpg" && $img_user!="user_1.jpg" && $img_user!="user_2.jpg" && $img_user!="user_3.jpg" && $img_user!="user_4.jpg" && $img_user!="user_5.jpg" && $img_user!="user_6.jpg" && $img_user!="user_7.jpg" && $img_user!="user_8.jpg" && $img_user!="user_9.jpg" && $img_user!="user_10.jpg" && $img_user!="user_11.jpg" && $img_user!="user_12.jpg" && $img_user!="user_13.jpg" && $img_user!="user_14.jpg" && $img_user!="user_15.jpg" && $img_user!="user_16.jpg" && $img_user!="user_17.jpg" && $img_user!="user_18.jpg" && $img_user!="user_19.jpg" && $img_user!="user_20.jpg")
                        {
                            File::delete('plugins/img/perfil/'.$img_user);
                        }
                        if($img_bio!="portada.jpg")
                        {
                            File::delete('plugins/img/portada/'.$img_bio);
                        }
                        $users->delete();
                        Flash('Se han Eliminado todos los Usuarios Administradores y Miembros Correctamente','danger');
                    }
                    else
                        Flash('No podemos procesar tu petición hay algun problema inesperado','warning');
                }
                elseif(Auth::user()->admin())
                {
                    if($users->type=="member")
                    {
                        $articles = $users->articles;
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
                        $img_user = $users->img_user;
                        $img_bio = $users->img_bio;
                        if($img_user!="superadmin.jpg" && $img_user!="admin.jpg" && $img_user!="member.jpg" && $img_user!="user.jpg" && $img_user!="user_1.jpg" && $img_user!="user_2.jpg" && $img_user!="user_3.jpg" && $img_user!="user_4.jpg" && $img_user!="user_5.jpg" && $img_user!="user_6.jpg" && $img_user!="user_7.jpg" && $img_user!="user_8.jpg" && $img_user!="user_9.jpg" && $img_user!="user_10.jpg" && $img_user!="user_11.jpg" && $img_user!="user_12.jpg" && $img_user!="user_13.jpg" && $img_user!="user_14.jpg" && $img_user!="user_15.jpg" && $img_user!="user_16.jpg" && $img_user!="user_17.jpg" && $img_user!="user_18.jpg" && $img_user!="user_19.jpg" && $img_user!="user_20.jpg")
                        {
                            File::delete('plugins/img/perfil/'.$img_user);
                        }
                        if($img_bio!="portada.jpg")
                        {
                            File::delete('plugins/img/portada/'.$img_bio);
                        }
                        $users->delete();
                        Flash('Se han Eliminado todos los Usuarios Miembros Seleccionados Correctamente','danger');
                    }
                    else
                    {
                        if($users->type=="admin" || $users->type=="superadmin")
                        {
                            Flash('Los Usuarios Administradores no pueden ser eliminados y no tienes los permisos para ejecutar esta opción','warning');
                        }
                    }
                }
                else
                    Flash('No podemos procesar tu petición hay algun problema inesperado','warning');
            });
        } 
        else
            Flash('Seleccione al menos un usuario si desea eliminar','warning');

        return redirect()->route('admin.users.index');
    }
}
