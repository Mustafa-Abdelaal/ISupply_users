<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(){
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request){
        $user = auth()->user();
        $validatedData = $request->validate([
            'name'=> 'required|string|max:255',
            // Add more validation rules for other fields
        ]);
        $user->name = $validatedData['name'];
        // Update other fields as needed

        $user->save;

        return redirect()->route('profile.edit')->with('success', 'rofile updated successfully.');
    }
}