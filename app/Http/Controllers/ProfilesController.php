<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function profile(User $user)
    {

        $follows = (auth()->user()) ?
            auth()->user()->following->contains($user->id) : false;
        $postCount = Cache::remember(
            'count.posts' . $user->id,
            now()->addSeconds(1),
            function () use ($user) {
                return  $user->posts->count();
            }
        );
        $followerCount = Cache::remember(
            'count.followers' . $user->id,
            now()->addSeconds(1),
            function () use ($user) {
                return  $user->profile->followers->count();
            }
        );
        $followingCount = Cache::remember(
            'count.following' . $user->id,
            now()->addSeconds(1),
            function () use ($user) {
                return  $user->following->count();
            }
        );
        // $followingCount =  $user->following->count();
        return view('profile.profile', compact(['user', 'follows', 'postCount', 'followerCount', 'followingCount']));
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profile.edit', compact('user'));
    }
    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',

        ]);
        //    $imagePath = null;
        try {

            if (request('image')) {
                $imagePath = request('image')->store('profile', 'public');
                $image = Image::make(public_path("storage/{$imagePath}"))->fit(350, 300);
                $image->save();
                $imageArray = ['image' => $imagePath];
            }
            auth()->user()->profile->update(array_merge(
                $data,
                $imageArray ?? [],

            ));
        } catch (\Throwable $th) {
            //throw $th;
        }
        return redirect()->to('profile/' . auth()->user()->id);
    }
}
