<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Create a new user
     */
    public function createUser(Request $request)
    {
        //validate
        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users,email',
            'password' => 'required'
        ]);

        // creating the record
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        // overide user variable to contain record from the DB
        $user = User::find($user->id);

        // return the response
        if ($user) {
            return response()->json(['message' => 'User created successfully', 'status' => 200]);
        } else {
            return response()->json(['message' => 'User not created', 'status' => 404]);
        }
    }

    // Login the User
    public function userLogin(Request $request)
    {

        try {
            // validate the data from the frontend
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required']
            ]);

            // attempt to login the user
            if (!Auth::attempt($credentials)) {
                return response([
                    'message' => 'Email or Password is wrong'
                ], Response::HTTP_UNAUTHORIZED);
            }

            // authenticate user on successful login
            $user = Auth::user();

            // create a token to pass data to the frontend
            $token = $user->createToken('api_token')->plainTextToken;

            // Return the token and user data 
            return response([
                'user' => $user,
                'token' => $token,
                'message' => 'Login successful'
            ]);
        } catch (ValidationException $e) {
            //throw $th;
            return response()->json($e->validator->errors(), 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
