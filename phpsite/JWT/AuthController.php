<?php
public function register(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ]);

    $validatedData['password'] = bcrypt($validatedData['password']);
    $user = User::create($validatedData);

    $token = JWTAuth::fromUser($user);

    return response()->json(['token' => $token], 201);
}
