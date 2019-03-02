<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Category;
use App\Tag;
use App\Article;
use App\Image;

class AdminController extends Controller
{
    public function index()
    {
        $porc_admin = User::all()->where('type', 'admin')->count()*100/User::all()->count();
        $porc_member = User::all()->where('type', 'member')->count()*100/User::all()->count();
        $users = User::whereNotIn('type',['superadmin'])->get();
        $articles = Article::all();
        $articles->each(function($articles){
        	$articles->tags;
        });
        $categories = Category::all();
        $tags = Tag::all();
        $images = Image::all();
        return view('admin.home')->with(['user' => $users,'article'=>$articles, 'category' => $categories,'tag'=>$tags,'img'=>$images,'porc_admin'=>$porc_admin,'porc_member'=>$porc_member]);
    }
}
