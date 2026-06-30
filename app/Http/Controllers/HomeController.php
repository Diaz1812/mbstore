<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AccountService;
use App\Services\TestimonialService;

class HomeController extends Controller
{
    public function index(
        AccountService $accountService,
        TestimonialService $testimonialService
    )
    {
        $accounts = $accountService->all();

        $testimonials = collect(
            $testimonialService->all()
        )->where('approved', true);

        return view(
            'pages.home.index',
            compact('accounts', 'testimonials')
        );
    }

    public function testimonials(TestimonialService $service)
{
    $testimonials = collect($service->all())
        ->where('status', 'approved');

    return view('pages.testimonials', compact('testimonials'));
}

    public function testimonialForm()
    {
        return view('pages.testimonial-form');
    }

    public function storeTestimonial(
        Request $request,
        TestimonialService $service
    )
    {
        $request->validate([
            'name' => 'required',
            'game' => 'required',
            'rating' => 'required',
            'message' => 'required'
        ]);

        $service->create([
            'name' => $request->name,
            'game' => $request->game,
            'rating' => $request->rating,
            'message' => $request->message,
        ]);

        return redirect('/home')
            ->with('success', 'Terima kasih atas testimoninya!');
    }
}