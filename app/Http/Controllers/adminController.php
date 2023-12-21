<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class admincontroller extends Controller
{
    public function index()
    {
    $userCount = User::count();
    $users = User::all();
    $data = [
        'userCount' => $userCount,
        'users' => $users
    ];
    return view('admin')->with($data);
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }

    public function create()
    {
        return view('admin');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
            'role' => ['required', 'string', 'in:client,moderateur'],
            'departement'=> 'required',
            'societe'=> 'required',
            
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
            'departement' => $validatedData['departement'],
            'societe' => $validatedData['societe'],
        ]);

        return redirect()->route('admin');
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => ['required', 'string', 'in:client,moderateur'],
            'departement'=> 'required',
            'societe'=> 'required',

        ]);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'departement' => $validatedData['departement'],
            'societe' => $validatedData['societe'],

        ]);

        return redirect()->route('admin');
    }
    

}
