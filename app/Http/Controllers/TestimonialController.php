<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        return Testimonial::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_name' => ['required'],
            'position' => ['required'],
            'company' => ['required'],
            'content' => ['required'],
            'rating' => ['required'],
            'image' => ['required'],
            'is_active' => ['boolean'],
        ]);

        return Testimonial::create($data);
    }

    public function show(Testimonial $testimonial)
    {
        return $testimonial;
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'client_name' => ['required'],
            'position' => ['required'],
            'company' => ['required'],
            'content' => ['required'],
            'rating' => ['required'],
            'image' => ['required'],
            'is_active' => ['boolean'],
        ]);

        $testimonial->update($data);

        return $testimonial;
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return response()->json();
    }
}
