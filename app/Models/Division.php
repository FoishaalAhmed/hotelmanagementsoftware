<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = [
        'name', 'photo', 'priority',
    ];

    public static $validateRule = [
        'name' => ['string', 'required', 'max:255'],
        'priority' => ['numeric', 'required', 'min:1'],
        'photo' => ['mimes:jpeg,jpg,png,gif,webp', 'required', 'max:100'],
    ];
    public function getDivisionImage()
    {
        $image = $this::leftJoin('hotels', 'divisions.id', '=', 'hotels.division_id')
            ->orderBy('divisions.priority', 'desc')
            ->groupBy('divisions.id')
            ->selectRaw('divisions.*, count(hotels.id) as howMany')
            ->get();
        return $image;
    }

    public function updateDivision(Object $request, Int $id)
    {
        $division = $this::findOrFail($id);
        $image = $request->file('photo');

        if ($image) {
            if (file_exists($division->photo)) unlink($division->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path     = 'public/images/users/';
            $image_url       = $upload_path . $image_full_name;
            $success         = $image->move($upload_path, $image_full_name);
            $division->photo     = $image_url;
        }

        $division->name     = $request->name;
        $division->priority = $request->priority;
        $updateDivision     = $division->save();

        $updateDivision
            ? session()->flash('message', 'Division Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
