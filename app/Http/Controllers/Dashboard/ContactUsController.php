<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\ContactStatus;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller implements HasMiddleware
{
    public static function Middleware()
    {
        return [
            new Middleware('can:contact_us_show', only: ['index']),
            new Middleware('can:contact_us_action', only: ['approve', 'declince']),
            new Middleware('can:contact_us_delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $contact_us = Contact::get();
            return datatables()::of($contact_us)
            ->rawColumns(['action'])
            ->addColumn('action', function($row){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>"
                .
                "<button class='remove_button show_contact' data-id='".$row['id']."'><i class='ri-eye-line fs-4' type='submit'></i></button>"
                .
                ($row['status'] == ContactStatus::PENDING->value && Auth::user()->hasPermissionTo('contact_us_action') ?
                "
                    <button class='remove_button approve' data-id='".$row['id']."'><i class='ri-check-double-line fs-4 text-success' type='submit'></i></button>
                    <button class='remove_button declince' data-id='".$row['id']."'><i class='ri-close-line fs-4 text-danger' type='submit'></i></button>
                "
                : "")
                .  
                (Auth::user()->hasPermissionTo('contact_us_delete') ?
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
            ->editColumn('status', function($row){
                return match($row['status']){
                    ContactStatus::PENDING->value => '<span class="badge bg-warning">Pending</span>',
                    ContactStatus::ACCEPTED->value => '<span class="badge bg-success">Accepted</span>',
                    ContactStatus::DECLINED->value => '<span class="badge bg-danger">Rejected</span>',
                };
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
        }
        return view('dashboard.contact-us.index');
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

    public function approve(Contact $contact_us) {
        if ($contact_us->status != ContactStatus::PENDING->value) {
            return response()->json([
                'message' => __('response.contact-us-not-found'),
            ], 404);
        }

        $contact_us->status = ContactStatus::ACCEPTED->value;
        $contact_us->save();

        return response()->json([
            'message' => __('response.contact-us-approved'),
            'contact_us' => $contact_us
        ]);
    }

    public function declince(Contact $contact_us) {
        if ($contact_us->status != ContactStatus::PENDING->value) {
            return response()->json([
                'message' => __('response.contact-us-not-found'),
            ], 404);
        }

        $contact_us->status = ContactStatus::ACCEPTED->value;
        $contact_us->save();

        return response()->json([
            'message' => __('response.contact-us-approved'),
            'contact_us' => $contact_us
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact_u)
    {
        return response()->json([
            'message' => __('response.contact-us-found'),
            'contact_us' => $contact_u
        ]);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact_u)
    {
        $contact_u->delete();

        return response()->json([
            'message' => __('response.contact-us-approved'),
        ]);
    }
}
