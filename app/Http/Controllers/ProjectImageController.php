<?php

namespace App\Http\Controllers;

use App\Models\ProjectImage;
use Illuminate\Http\Request;

class ProjectImageController extends Controller
{
    public function index()
    {
        return ProjectImage::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => ['required', 'exists:projects'],
            'image_path' => ['required'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        return ProjectImage::create($data);
    }

    public function show(ProjectImage $projectImage)
    {
        return $projectImage;
    }

    public function update(Request $request, ProjectImage $projectImage)
    {
        $data = $request->validate([
            'project_id' => ['required', 'exists:projects'],
            'image_path' => ['required'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $projectImage->update($data);

        return $projectImage;
    }

    public function destroy(ProjectImage $projectImage)
    {
        $projectImage->delete();

        return response()->json();
    }
}
