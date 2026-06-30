<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TestimonialService;

class TestimonialController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Form Testimoni
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('testimonials.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Testimoni
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, TestimonialService $service)
    {
        $request->validate([
            'name' => 'required',
            'game' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $photo = null;

        if ($request->hasFile('photo')) {

            $photo = time().'_'.$request->photo->getClientOriginalName();

            $request->photo->move(
                public_path('uploads/testimonials'),
                $photo
            );

        }

        $service->create([

            'name' => $request->name,
            'game' => $request->game,
            'rating' => $request->rating,
            'message' => $request->message,
            'photo' => $photo,

        ]);

        return redirect('/')
            ->with('success', 'Terima kasih! Testimoni Anda sedang menunggu persetujuan admin.');
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard Admin
    |--------------------------------------------------------------------------
    */

    public function index(TestimonialService $service)
    {
        $testimonials = $service->all();

        return view(
            'admin.testimonials.index',
            compact('testimonials')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Approve
    |--------------------------------------------------------------------------
    */

    public function approve($id, TestimonialService $service)
    {
        $service->update((int)$id, [

            'status' => 'approved'

        ]);

        return back()
            ->with('success', 'Testimoni berhasil disetujui.');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy($id, TestimonialService $service)
    {
        $testimonial = $service->find((int)$id);

        if (!$testimonial) {
            abort(404);
        }

        if (!empty($testimonial['photo'])) {

            $path = public_path(
                'uploads/testimonials/'.$testimonial['photo']
            );

            if (file_exists($path)) {
                unlink($path);
            }

        }

        $service->delete((int)$id);

        return back()
            ->with('success', 'Testimoni berhasil dihapus.');
    }
}