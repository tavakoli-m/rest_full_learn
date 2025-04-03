<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $usersQuery = User::query();
        if($request->has('email'))
            $usersQuery = $usersQuery->whereEmail($request->get('email'));

        $users = $usersQuery->paginate();
        return response()->json([
            'data' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => ['required','string','min:1','max:255'],
            'last_name' => ['required','string','min:1','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','string','min:8','max:255']
        ]);

        if($validator->fails())
            return response()->json([
                'errors' => $validator->errors()
            ],422);

        $inputs = $validator->validated();

        $inputs['password'] = Hash::make($inputs['password']);

        $user = User::create($inputs);

        return response()->json([
           "message" => 'User created successfully',
            "data" => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
