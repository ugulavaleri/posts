<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function index()
    {
        $followers = auth()->user()->followers;
        return view('users.followers', compact('followers'));
    }

    public function toggleFollow(User $user){
        if ($user->haveAlreadyFollowed()){
            auth()->user()->followings()->detach($user->id);
        }else{
            auth()->user()->followings()->attach($user->id);
        }
        return redirect()->route('users.show',$user);
    }

//    /**
//     * Show the form for creating a new resource.
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     */
//    public function show(Follower $follower)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(Follower $follower)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(Request $request, Follower $follower)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(Follower $follower)
//    {
//        //
//    }
}
