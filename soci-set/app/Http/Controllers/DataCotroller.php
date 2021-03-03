<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
class DataCotroller extends Controller
{
    function __construct()
    {
        session_start();
        // if(User::where('password', $_SESSION['psswrd'])->get()->count() == 0 || !$_SESSION['psswrd']){
        //     unset($_SESSION['psswrd']);
        // }
    }
    function signUp(Request $request){
        $res = $request->all();
        unset($res['_token']);
        unset($res['submit']);
        if(User::where('name', $res['name'])->get()->count() == 0){
            $res['password'] = md5($res['password'].$res['name']);
            $_SESSION['psswrd'] = $res['password'];
            $_SESSION['name'] = $res['name'];
            User::create($res);
            return redirect()->route('main');
        }
        $err_signup = 'this name already taken';
        return view('first-page', compact('err_signup'));
    }
    function logIn(Request $request){
        $res = $request->all();
        $find_psswrd = User::where('password', md5($res['password'].$res['name']));
        $find_name = User::where('name', $res['name']);
        if(!$find_psswrd && !$find_name){
            $err_login = 'The password or username is incorrect';
            return view('first-page', compact('err_login'));    
        }
        $_SESSION['psswrd'] = md5($res['password'].$res['name']);
        return redirect()->route('main');
}
    function distributor(){
        if(array_key_exists('psswrd', $_SESSION)){
            return redirect()->route('main');
        }
        return view('first-page');
    }
    function main_render(Request $req){
        if(empty($_SESSION['psswrd'])){
            return view('first-page');
        }
        $vars = [   
        'users' => User::where('password',$_SESSION['psswrd'])->get(),
        ];
        $req = $req->all();
        if(!array_key_exists('disable', $req)){
            if(array_key_exists('filters',$req)&&$req['filters']!='no'){
                $vars['posts'] = Post::where('category', $req['filters'])->get();
            }elseif(array_key_exists('filters',$req)){
                $vars['posts'] = Post::where('author', $req['author'])->get();
            }elseif(array_key_exists('filters',$req) && (array_key_exists('filters',$req)&&$req['filters']!='no')){
                $vars['posts'] = Post::where([['author', $req['author']],['category', $req['filters']]]);
            }else{
                $vars['posts'] =Post::get();
            }
        }else{
            $vars['posts'] = Post::get();
        }
        // echo '<pre>';
        // var_dump($vars['posts']);
        // echo '</pre>';
        // echo $_SESSION['psswrd'];
        return view('main', compact('vars'));
    }
    function dropSession(){
        unset($_SESSION['psswrd']);
        unset($_SESSION['name']);
    }
    function profile(Request $request){
        $res = $request->all();
        $vars = [
            'user'=>User::where('name', $res['name'])->get(),
            'us_posts'=>Post::where('author', $res['name'])->get()
        ];
        if($_SESSION['psswrd']==$vars['user'][0]['password']){
            $vars['your_acc'] = true;
        }
        if($vars){
            return view('profile', compact('vars'));
        }
    }
    function write_post($err=false){
        $author = User::where('password', $_SESSION['psswrd'])->get();
        if($err){
            return view('write-post', [compact('err'), compact('author')]);
        }
        return view('write-post', compact('author'));
    }
    function add_post(Request $req){
        $req = $req->all();
        unset($req['_token']);
        unset($req['submit']);
        if(Post::where('title', $req['title'])->get()->count() == 0){
            $req['short_text'] = mb_substr($req['text'], 0, 30);
            User::where('password', $_SESSION['psswrd'])->update(['posts_count'=>User::raw('posts_count +1')]);
            Post::create($req);
            return redirect()->route('main');
        }
        return $this->write_post('this title is already using');
    }
    function post_render(Request $req){
        $req = $req->all();
        $render = [
            'render'=> Post::where('title', $req['title'])->get(),
            'top' => User::where('password', $_SESSION['psswrd'])->get(),
        ];
        if(Comment::where('post_id', $render['render'][0]['id'])->get()->count()!=0){
            $render['comment'] = Comment::where('post_id', $render['render'][0]['id'])->get();
        }else{
            $render['comment'] = false;
        }
        // echo '<pre>';
            // var_dump($render['comment']);
        // echo '</pre>';
        return view('read', compact('render'));
    }
    function add_comment(Request $req){
        $req = $req->all();
        unset($req['_token']);
        unset($req['submit']);
        // $rend = $req['rend'];
        // unset($req['rend']);
        Comment::create($req);
        return redirect(url()->previous());
    }
    // function upload(Request $req){
    //     $reqq = $req->all();
    //     $file = $req->file('userfile');
    //     $upload_folder = 'public/storage';
    //     $filename = $reqq['name'].$file->getClientMimeType(); // image.jpg
    //     $req->validate([
    //         'userfile' => 'image',
    //     ]);
    //     User::where('password', $_SESSION['psswrd'])->update(['avatar' => $filename]);
    //     Storage::putFileAs($upload_folder, $file, $filename);
    // }
}
