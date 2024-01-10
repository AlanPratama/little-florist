<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $test = Test::all();

        return view('test', compact('test'));
    }


    public function post(Request $request)
    {
        $data = $request->validate([
            'name' => '',
            'image' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $uploadFile = $request->file('image');
            $extension = $uploadFile->getClientOriginalExtension();
            $storeName = $uploadFile->getClientOriginalName() . '-' . $extension;
            $path = $uploadFile->storeAs('test', $storeName);
            $data['image'] = $path;
            $data['name'] = $storeName;
        }

        Test::create($data);

        return redirect()->route('testIndex')->with('berhasil', 'BERHASIL TESTING');
    }
}
