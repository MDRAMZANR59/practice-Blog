<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{

    public function __invoke(){
        $blog = DB::table('blogs')->orderBy('id','DESC')->get();
        return view('frontend.layout.home', compact('blog'));

    }


    public function showBlog(){
        $data = DB::table('blogs')->get();
        return view('frontend.layout.blogList', compact('data') );
    }

    public function singleblog($id){
    //    $blog=DB::table('blogs')->where('id',$id)->value('description');
    //    $blog=DB::table('blogs')->chunk(10,'title');
    //    $blog=DB::table('blogs')->count();
    //    $blog=DB::table('blogs')->where('id',$id)->select('title','description')->first();
       $blog=DB::table('blogs')->where('id',$id)->dump();
    //    $blog=DB::table('blogs')->where('id',$id)->increment('id')->first();
    //    $blog=DB::table('blogs')->where('id',$id)->select('title')->addSelect('title','image')->first();
        return view('frontend.layout.singleBlog',compact('blog'));
    }



    // public function login(){
    //     return view('auth.login');
    // }
}
