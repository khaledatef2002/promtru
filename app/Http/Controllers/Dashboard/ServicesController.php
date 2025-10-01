<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;

class ServicesController extends Controller implements HasMiddleware
{
    public static function Middleware()
    {
        return [
            new Middleware('can:services_show', only: ['index']),
            new Middleware('can:services_create', only: ['create', 'store']),
            new Middleware('can:services_edit', only: ['edit', 'update']),
            new Middleware('can:services_delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $service = Service::get();
            return datatables()::of($service)
            ->rawColumns(['action'])
            ->addColumn('action', function($row){
                return 
                    "<div class='d-flex align-items-center justify-content-center gap-2'>"
                    .
                    (Auth::user()->hasPermissionTo('services_edit') ?
                    "<a class='remove_button text-success' data-id='".$row['id']."' href='" . route('dashboard.services.edit', $row['id']) . "'><i class='ri-pencil-line fs-4' type='submit'></i></a>"
                    :"")
                    .  
                    (Auth::user()->hasPermissionTo('services_delete') ?
                    "
                        <form data-id='".$row['id']."'>
                            <input type='hidden' name='_method' value='DELETE'>
                            <input type='hidden' name='_token' value='" . csrf_token() . "'>
                            <button class='remove_button remove_button_action' type='button'><i class='ri-delete-bin-5-line text-danger fs-4'></i></button>
                        </form>
                    "
                    :"")
                    .
                    "</div>";
            })
            ->editColumn('image', function(Service $service){
                return "<img src='" . asset($service->display_image) ."' width='40' height='40' class='rounded-5'>";
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
        }
        return view('dashboard.services.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $service_data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp|max:10240'],
            'ar.title' => ['required', 'string', 'max:300'],
            'en.title' => ['required', 'string', 'max:300'],
            'ar.description' => ['required', 'string', 'max:500'],
            'en.description' => ['required', 'string', 'max:500'],
        ]);

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'storage/services/' . uniqid() . '.webp';

            $manager = new ImageManager(new Driver());
            $manager->read($image)
                    ->scale(width: 450)
                    ->encode(new AutoEncoder('webp', quality: 75))
                    ->save($imagePath);

            $service_data['image'] = $imagePath;
        }

        $service = Service::create($service_data);

        return response()->json([
            'message' => __('response.service-createed'),
            'redirectUrl' => route('dashboard.services.edit', $service->id),
        ]);
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
    public function edit(Service $service)
    {
        return view('dashboard.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $service_data = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp|max:10240'],
            'ar.title' => ['required', 'string', 'max:300'],
            'en.title' => ['required', 'string', 'max:300'],
            'ar.description' => ['required', 'string', 'max:500'],
            'en.description' => ['required', 'string', 'max:500'],
        ]);

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'storage/services/' . uniqid() . '.webp';

            $manager = new ImageManager(new Driver());
            $manager->read($image)
                    ->scale(width: 450)
                    ->encode(new AutoEncoder('webp', quality: 75))
                    ->save($imagePath);

            $service_data['image'] = $imagePath;
        }

        return response()->json([
            'message' => __('response.service-createed'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if($service->image && Storage::disk('public')->exists(str_replace('storage/', '', $service->image)))
        {
            Storage::disk('public')->delete(str_replace('storage/', '', $service->image));
        }

        $service->delete();

        return response()->json([
            'message' => __('response.service-deleted'),
        ]);
    }
}
