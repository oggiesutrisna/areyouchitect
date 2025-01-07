<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return Service::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required'],
            'slug' => ['required'],
            'description' => ['required'],
            'icon' => ['required'],
            'price' => ['required', 'numeric'],
            'is_featured' => ['boolean'],
        ]);

        return Service::create($data);
    }

    public function show(Service $service)
    {
        return $service;
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => ['required'],
            'slug' => ['required'],
            'description' => ['required'],
            'icon' => ['required'],
            'price' => ['required', 'numeric'],
            'is_featured' => ['boolean'],
        ]);

        $service->update($data);

        return $service;
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return response()->json();
    }
}
