<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
   public function index(){
   	return view('post');
   }
   public function store(Request $request){

   	$post = new post();
   	$post->name = $request->name;

   	$post->save();



   }
}
