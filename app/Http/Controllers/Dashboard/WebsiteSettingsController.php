<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Encoders\AutoEncoder;

class WebsiteSettingsController extends Controller implements HasMiddleware
{
    public static function Middleware()
    {
        return [
            new Middleware('can:website_settings_show', only: ['index']),
            new Middleware('can:website_settings_edit', only: ['edit', 'update']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.website_settings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function update(Request $request, WebsiteSetting $websiteSetting)
    {
        $data = $request->validate([
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg|max:10240'],
            'favicon' => ['nullable', 'image', 'mimes:jpeg,png,jpg|max:10240'],
            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg|max:10240'],
            'title' => ['required', 'min:2'],
            'keywords' => ['required'],
            'description' => ['required'],
            'facebook_url' => ['required', 'url'],
            'instagram_url' => ['required', 'url'],
            'twitter_url' => ['required', 'url'],
            'youtube_url' => ['required', 'url'],
            'linkedin_url' => ['required', 'url'],
            'tiktok_url' => ['required', 'url'],
            'snapchat_url' => ['required', 'url'],
            'email' => ['required', 'email'],
            'location' => ['required', 'string'],
            'phone_number' => ['required', 'numeric', 'digits_between:7,13'],
            'whatsapp' => ['nullable', 'numeric', 'digits_between:7,13'],
        ]);

        if($request->hasFile('logo')) {
            if($websiteSetting->logo && Storage::disk('public')->exists(str_replace('storage/', '', $websiteSetting->logo))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $websiteSetting->logo));
            }

            $image = $request->file('logo');
            $imagePath = 'storage/logo/' . uniqid() . '.jpg';

            $manager = new ImageManager(new GdDriver());
            $manager->read($image)
                    ->scale(height: 60)
                    ->encode(new AutoEncoder('jpg', quality: 75))
                    ->save($imagePath);

            $data['logo'] = $imagePath;
        }

        if($request->hasFile('favicon')) {
            if($websiteSetting->logo && Storage::disk('public')->exists(str_replace('storage/', '', $websiteSetting->favicon))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $websiteSetting->favicon));
            }

            $image = $request->file('favicon');
            $imagePath = 'storage/logo/' . uniqid() . '.jpg';

            $manager = new ImageManager(new GdDriver());
            $manager->read($image)
                    ->scale(height: 60)
                    ->encode(new AutoEncoder('jpg', quality: 75))
                    ->save($imagePath);

            $data['favicon'] = $imagePath;
        }

        if($request->hasFile('cover')) {
            if($websiteSetting->cover && Storage::disk('public')->exists(str_replace('storage/', '', $websiteSetting->cover))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $websiteSetting->cover));
            }
            $image = $request->file('cover');
            $imagePath = 'storage/cover/' . uniqid() . '.webp';

            $manager = new ImageManager(new GdDriver());
            $manager->read($image)
                    ->scale(height: 300)
                    ->encode(new AutoEncoder('webp', quality: 75))
                    ->save($imagePath);

            $data['cover'] = $imagePath;
        }


        $websiteSetting->update($data);

        return response()->json([
            'message' => __('response.website-settings-updated'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
