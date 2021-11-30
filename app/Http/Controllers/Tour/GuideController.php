<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuideRequest;
use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    protected $guideObject;

    public function __construct()
    {
        $this->guideObject = new Guide();
    }

    public function index()
    {
        $guides = Guide::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.tour.guides.index', compact('guides'));
    }

    public function create()
    {
        return view('backend.tour.guides.create');
    }

    public function store(GuideRequest $request)
    {
        $this->guideObject->storeGuide($request);
        return back();
    }

    public function edit(Guide $guide)
    {
        return view('backend.tour.guides.edit', compact('guide'));
    }

    public function update(Request $request, Guide $guide)
    {
        $this->guideObject->updateGuide($request, $guide);
        return redirect()->route('tour.guides.index');
    }

    public function destroy(Guide $guide)
    {
        $this->guideObject->destroyGuide($guide);
        return back();
    }
}
