<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    //index getAll
    function index() {
        $posts = Post::get();
        return response()->json($posts);
    }
    // show getFind solo uno
    function show($id) {
        $post = Post::where("id", $id)->first();
        return response()->json($post);        
    }
    // store guarda post
    function store(Request $request) {
        $post = new Post([
            'titulo' => $request->get("titulo"),
            'contenido' => $request->get('contenido')
        ]);
        $post->save();
        return response()->json($post); 
    }
    //update parametro, objecto 
    function update(Request $request, $id) {        
        $post = Post::where("id", $id)->first();
        $post->titulo = $request->get('titulo');
        $post->contenido = $request->get('contenido');
        $post->save(); 
        return response()->json($post);        
    }
    //detroy parametro
    function destroy($id) {
        $post = Post::where("id", $id)->first();
        if(!$post) return response()->json("Este post no existe");  
        $post->delete();
        return response()->json($post);  
    }
}
