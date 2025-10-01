<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogImage;
use App\Services\SiteMapService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;

class BlogController extends Controller implements HasMiddleware
{
    public static function Middleware()
    {
        return [
            new Middleware('can:blogs_show', only: ['index']),
            new Middleware('can:blogs_create', only: ['create', 'store']),
            new Middleware('can:blogs_edit', only: ['edit', 'update']),
            new Middleware('can:blogs_delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $blogs = Blog::get();
            return datatables()::of($blogs)
            ->rawColumns(['action'])
            ->addColumn('action', function($row){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>"
                .
                (Auth::user()->hasPermissionTo('blogs_edit') ?
                "<a class='remove_button text-success' data-id='".$row['id']."' href='" . route('dashboard.blogs.edit', $row['id']) . "'><i class='ri-pencil-line fs-4' type='submit'></i></a>"
                :"")
                .  
                (Auth::user()->hasPermissionTo('blogs_delete') ?
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
            ->editColumn('cover', function(Blog $blog){
                return "<div style='height: 100px;display: flex;justify-content: center;aspect-ratio: 1 / 0.45;overflow: hidden;'><img src='" . $blog->display_image ."' style='min-width: 100%;min-height: 100%;object-fit: cover;'></div>";
            })
            ->rawColumns(['cover', 'action'])
            ->make(true);
        }
        return view('dashboard.blogs.index');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        
        $image = $request->file('upload');
        $imagePath = 'blogs/images/' . uniqid() . '.webp';

        $manager = new ImageManager(new Driver());
        $manager->read($image)
            ->scale(height: 350)
            ->encode(new AutoEncoder('webp', quality: 75))
            ->save('storage/' . $imagePath);
            
        $url = Storage::url($imagePath);

        $blogImage = BlogImage::create([
            'path' => $imagePath,
        ]);

        return response()->json(['url' => $url, 'id' => $blogImage->id]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'keywords' => 'required|string|max:255',
            'images.*' => 'required|exists:blog_images,id',
        ]);
        
        $image = $request->file('cover');
        $imagePath = 'blogs/covers/' . uniqid() . '.webp';

        $manager = new ImageManager(new Driver());
        $manager->read($image)
            ->scale(height: 450)
            ->encode(new AutoEncoder('webp', quality: 75))
            ->save('storage/' . $imagePath);

        $url = $imagePath;

        $data['cover'] = $url;

        $data['user_id'] = Auth::id();
        
        $blog = Blog::create($data);        

        if($request->images)
        {
            foreach ($request->images as $image) {
                $imageModel = BlogImage::find($image);
                if ($imageModel) {
                    $imageModel->update([
                        'blog_id' => $blog->id,
                    ]);
                }
            }
        }

        SiteMapService::generate();

        return response()->json([
            'status' => 'success',
            'message' => __('response.create-blog-success'),
            'redirectUrl' => route('dashboard.blogs.edit', $blog),
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
    public function edit(Blog $blog)
    {  
        return view('dashboard.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'keywords' => 'required|string|max:255',
            'images.*' => 'required|exists:blog_images,id',
        ]);
        
        if($image = $request->file('cover'))
        {
            $image = $request->file('cover');
            $imagePath = 'blogs/covers/' . uniqid() . '.webp';
        
            $manager = new ImageManager(new Driver());
            $manager->read($image)
                ->scale(height: 450)
                ->encode(new AutoEncoder('webp', quality: 75))
                ->save('storage/' . $imagePath);
                
            $url = $imagePath;
            
            $data['cover'] = $url;
        }
        
        $blog->update($data); 
        
        $blog->images()->whereNotIn('id', $request->images ?? []);
        foreach ($blog->images as $image) {
            if(Storage::disk('public')->exists($image->path))
            {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }
        
        if($request->images)
        {
            foreach ($request->images as $image) {
                $imageModel = BlogImage::find($image);
                if ($imageModel) {
                    $imageModel->update([
                        'blog_id' => $blog->id,
                    ]);
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => __('response.update-blog-success'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        foreach($blog->images as $image) {
            if(Storage::disk('public')->exists($image->path))
            {
                Storage::disk('public')->delete($image->path);
            }
            $image->delete();
        }

        $blog->delete();

        return response()->json([
            'status' => 'success',
            'message' => __('response.delete-blog-success'),
        ]);
    }
}
