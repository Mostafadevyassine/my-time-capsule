<?php

namespace App\Services\User;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

use Carbon\Carbon;

use App\Models\Capsule;

class CapsuleService
{
    static function getAllCapsules(){
        return Capsule::all();
    }


    // static function getPublicWallCapsules(){
    //     return Capsule::where('reveal_date','<=', now())
    //         ->where('privacy', 'public')
    //         ->get();
    // }

    static function getPublicWallCapsules($mood = null, $country = null, $sort = 'asc') {
        $query = Capsule::where('reveal_date', '<=', now())
            ->where('privacy', 'public');
    
        if ($mood) {
            $query->where('mood', $mood);
        }
    
        if ($country) {
            $query->where('country', $country);
        }
    
        $query->orderBy('reveal_date', $sort);
    
        return $query->get();
    }






    static function getUserWallCapsules($user_id) {
        return Capsule::where('user_id', $user_id)
            ->where(function ($query) {
                $query->where('is_surprise', 0)
                      ->orWhere('reveal_date', '<=', now());
            })
            ->get();
    }


    static public function createCapsule(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'message' => 'required|string',
        'reveal_date' => 'required|date',
        'mood' => 'nullable|in:happy,sad,Excited,Angry,Lonely,Tired,Bored,Calm',
        'privacy' => 'required|in:public,private',
        'is_surprise' => 'required|boolean',
        'file' => 'nullable|file|mimetypes:image/jpeg,image/png,image/gif,video/mp4,audio/mpeg,audio/wav|max:20480',
    ]);

    //$ip = $request->ip(); // will be used really and work fine when deployment , now in local host it is returning null 
    $ip = '8.8.8.8';
    $position = Location::get($ip);
    $country = $position ? $position->countryName : null;

    $fileName = null;
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('capsules', $fileName, 'private');
    }

    $capsule = new Capsule();
    $capsule->user_id = $validated['user_id'];
    $capsule->message = $validated['message'];
    $capsule->reveal_date = $validated['reveal_date'];
    $capsule->country = $country;
    $capsule->mood = $validated['mood'] ?? null;
    $capsule->privacy = $validated['privacy'];
    $capsule->is_surprise = $validated['is_surprise'];
    $capsule->file_name = $fileName;
    $capsule->save();

    return $capsule;

    
}







    // static function autoRevealCapsules()
    // {
    //     $now = Carbon::now();

    //     $capsules = Capsule::where('is_revealed', 0)
    //         ->where('reveal_date', '<=', $now)
    //         ->get();

    //     foreach ($capsules as $capsule) {
    //         $capsule->is_revealed = true;
    //         $capsule->save(); // will trigger 'updated' model event
    //     }

    //     return $capsules->count(); // return how many were revealed
    // }
    









    /**
     * Create a new class instance.
     */
    // public function __construct()
    // {
    //     //
    // }
}
