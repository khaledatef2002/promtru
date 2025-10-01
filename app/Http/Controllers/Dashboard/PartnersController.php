<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TopCustomer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Encoders\AutoEncoder;

class PartnersController extends Controller implements HasMiddleware
{
    public static function Middleware()
    {
        return [
            new Middleware('can:partners_show', only: ['index']),
            new Middleware('can:partners_create', only: ['create', 'store']),
            new Middleware('can:partners_edit', only: ['edit', 'update']),
            new Middleware('can:partners_delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $top_customer = TopCustomer::get();
            return datatables()::of($top_customer)
            ->rawColumns(['action'])
            ->addColumn('action', function($row){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>"
                .
                (Auth::user()->hasPermissionTo('partners_edit') ?
                "<a class='remove_button text-success' data-id='".$row['id']."' href='" . route('dashboard.partners.edit', $row['id']) . "'><i class='ri-pencil-line fs-4' type='submit'></i></a>"
                :"")
                .  
                (Auth::user()->hasPermissionTo('partners_delete') ?
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
            ->editColumn('image', function(TopCustomer $partner){
                return "<img src='" . asset($partner->customer_image) ."' width='40' height='40' class='rounded-5'>";
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
        }
        return view('dashboard.partners.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => ['required'],
            'customer_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp|max:10240'],
        ]);

        if($request->hasFile('customer_image')) {
            $image = $request->file('customer_image');
            $imagePath = 'storage/partners/' . uniqid() . '.webp';

            $manager = new ImageManager(new GdDriver());
            $manager->read($image)
                    ->scale(width: 130)
                    ->encode(new AutoEncoder('webp', quality: 75))
                    ->save($imagePath);

            $data['customer_image'] = $imagePath;
        }

        TopCustomer::create($data);

        return response()->json([
            'message' => __('response.partners-createed'),
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
    public function edit(TopCustomer $partner)
    {
        return view('dashboard.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TopCustomer $partner)
    {
        $data = $request->validate([
            'customer_name' => ['required'],
            'customer_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg|max:10240'],
        ]);

        if($request->hasFile('customer_image')) {
            if ($partner->customer_image && Storage::disk('public')->exists(str_replace('storage/', '', $partner->customer_image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $partner->customer_image));
            }

            $image = $request->file('customer_image');
            $imagePath = 'storage/partners/' . uniqid() . '.webp';

            $manager = new ImageManager(new GdDriver());
            $manager->read($image)
                    ->scale(width: 130)
                    ->encode(new AutoEncoder('webp', quality: 75))
                    ->save($imagePath);

            $data['customer_image'] = $imagePath;
        }
        else
        {
            unset($data['customer_image']);
        }

        $partner->update($data);

        return response()->json([
            'message' => __('response.partners-updated'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TopCustomer $partner)
    {
        if($partner->customer_image && Storage::disk('public')->exists(str_replace('storage/', '', $partner->customer_image)))
        {
            Storage::disk('public')->delete(str_replace('storage/', '', $partner->customer_image));
        }

        $partner->delete();

        return response()->json([
            'message' => __('response.partners-deleted'),
        ]);
    }
}
