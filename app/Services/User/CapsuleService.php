<?php

namespace App\Services\User;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Storage;
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



    static function getPublicWallCapsules(Request $request) {
        $mood = $request->mood;
        $country = $request->country;
        $sort = $request->sort ?? 'asc';
    
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






    static public function getCapsuleById( $capsule){
        return Capsule::find( $capsule);
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
        'file' => 'nullable|string',
    ]);

    //$ip = $request->ip(); // will be used really and work fine when deployment , now in local host it is returning null 
    $ip = '8.8.8.8';
    $position = Location::get($ip);
    $country = $position ? $position->countryName : null;

    // $fileName = null;
    // if ($request->hasFile('file')) {
    //     $file = $request->file('file');
    //     $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
    //     $file->storeAs('capsules', $fileName, 'private');
    // }
    
    $fileName = null;
    if (!empty($validated['file'])) {
        // to get the base 64 
        $base64Image = $validated['file'];

        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
            $extension = strtolower($type[1]); 
        } else {
            $extension = 'png';
        }

        $base64Image = str_replace(' ', '+', $base64Image);
        $imageData = base64_decode($base64Image);

        if ($imageData === false) {
            return response()->json(['status' => 'error', 'message' => 'Invalid base64 image data'], 400);
        }

        $fileName = uniqid() . '.' . $extension;
        $filePath = "capsules/$fileName";

        // to sav a file in :  storage/app/public/capsules
        Storage::disk('public')->put($filePath, $imageData);
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

   
}
