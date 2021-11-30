<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'gender', 'age', 'phone', 'email', 'address', 'photo',
    ];

    public function storeGuide(Object $request)
    {
        $image = $request->file('photo');
        if ($image) {
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $image_url       = 'https://amarlodge.com/public/images/guides/' . $image_full_name;
            $success         = $image->storeAs('guides', $image_full_name, 'parent_disk');
            $this->photo     = $image_url;
        }

        $this->hotel_id = auth()->user()->hotel_id;
        $this->name = $request->name;
        $this->gender = $request->gender;
        $this->age = $request->age;
        $this->phone = $request->phone;
        $this->email = $request->email;
        $this->address = $request->address;
        $storeGuide = $this->save();

        $storeGuide
            ? session()->flash('message', 'New Guide Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateGuide(Object $request, Object $guide)
    {
        $image = $request->file('photo');
        if ($image) {
            if (file_exists($guide->photo)) unlink($guide->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $image_url       = 'https://amarlodge.com/public/images/guides/' . $image_full_name;
            $success         = $image->storeAs('guides', $image_full_name, 'parent_disk');
            $guide->photo     = $image_url;
        }
        $guide->hotel_id = auth()->user()->hotel_id;
        $guide->name = $request->name;
        $guide->gender = $request->gender;
        $guide->age = $request->age;
        $guide->phone = $request->phone;
        $guide->email = $request->email;
        $guide->address = $request->address;
        $updateGuide = $guide->save();

        $updateGuide
            ? session()->flash('message', 'Guide Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyGuide(Object $guide)
    {
        if (file_exists($guide->photo)) unlink($guide->photo);
        $destroyGuide = $guide->delete();

        $destroyGuide
            ? session()->flash('message', 'Guide Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
