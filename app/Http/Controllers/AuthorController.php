<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
    public function getAuthors() {
        return $authors = Author::orderBy('author_name', 'asc')->paginate(20);
    }

    public function index() {
        $authors = $this->getAuthors();
        return view('author.index', compact('authors'));
    }

    public function create(Request $request) {
        $data = $this->validate($request, [
            'author_name' => 'required|regex:/^[a-zA-Z]+$/u|max:100']);
        $author = Author::create($data);
        
        $message = "Author Created Successfully ...!";
        return redirect('/author')->with('message', $message);
    }

    public function update(Request $request) {
        $this->validate($request, [
            'author_name' => 'required|regex:/^[a-zA-Z]+$/u|max:100']);
        
       echo  $author_id =$request->get('author_id');
        $author_name =$request->get('author_name');

        $message = "Author Doesn't Exists ...!";
        $author = Author::find($author_id);
        if($author) {
            $message = "Author Updated Successfully ...!";
            $author->author_name = $author_name;
            $author->save();
        } 
        $authors = $this->getAuthors();
        
        return redirect('/author')->with('message', $message);
    }

    public function delete(Request $request) {
        $author_id =$request->get('author_id');
        $message = "Author Doesn't Exists ...!";
        $author = Author::find($author_id);
        if($author) {
            $message = "Author Deleted Successfully ...!";
            $author->delete();
        }
        $authors = $this->getAuthors();
        return redirect('/author')->with('message', $message);
    }
     
}
