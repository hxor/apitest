<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response([
            'status' => 200,
            'message' => 'List user data',
            'data' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $request['password'] = bcrypt($request->password);

        $user = User::create($request->all());

        if ($user) {
            return response([
                'status' => 201,
                'message' => 'create data success',
                'data' => $user
            ]);
        }

        return response([
            'status' => 500,
            'message' => 'create data fail',
            'data' => ''
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);

        if ($request->has('password')) {
            $request['password'] = bcrypt($request->password);
        } else {
            $request['password'] = $user->password;
        }

        $user->update($request->all());

        if ($user) {
            return response([
                'status' => 201,
                'message' => 'update data success',
                'data' => $user
            ]);
        }

        return response([
            'status' => 500,
            'message' => 'update data fail',
            'data' => ''
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::destroy($id);

        if ($user) {
            return response([
                'status' => 201,
                'message' => 'delete data success',
                'data' => ''
            ]);
        }

        return response([
            'status' => 500,
            'message' => 'delete data fail',
            'data' => ''
        ]);
    }
}
