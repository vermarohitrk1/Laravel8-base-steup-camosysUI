<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TestController extends Controller
{

    public function index(){
      $data = Test::all();
        return view('test', compact('data'));
    }

    public function store(Request $request)
    { 
        $test = new Test;
        
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $exe = $imagePath->getClientOriginalExtension();
            $image =uniqid() . '.'.$exe;
            $path = $request->file('image')->storeAs('uploads/images', $image, 'public');
          }
          if ($request->file('cover')) {
            $imagePath = $request->file('cover');
            $exe = $imagePath->getClientOriginalExtension();
            $coverimage =uniqid() . '.'.$exe;
            $path = $request->file('cover')->storeAs('uploads/cover', $coverimage, 'public');
          }
            $test['name']= $request->name;
            $test['image']= $image;
            $test['description']= $request->description;
            $test['status']= $request->status;
            $test['country']= $request->country;
            $test['cover']= $coverimage;
        
        $test->save();
        $data = Test::all();
        return back()->with('data');
        
    }
}