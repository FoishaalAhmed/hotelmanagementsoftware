<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'hotel_id', 'food_category_id', 'food_type_id', 'name', 'description', 'price', 'photo',
    ];

    public function getAllHotelItems()
    {
        $items = $this::join('food_categories', 'items.food_category_id', '=', 'food_categories.id')
            ->join('food_types', 'items.food_type_id', '=', 'food_types.id')
            ->where('items.hotel_id', auth()->user()->hotel_id)
            ->orderBy('items.name', 'asc')
            ->select('items.*', 'food_categories.name as category', 'food_types.name as type')
            ->get();
        return $items;
    }

    public function storeItem(Object $request)
    {
        $image = $request->file('photo');

        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $image_url       = 'https://amarlodge.com/public/images/items/' . $image_full_name;
            $success         = $image->storeAs('items', $image_full_name, 'parent_disk');
            $this->photo     = $image_url;
        }

        $this->food_category_id = $request->food_category_id;
        $this->food_type_id     = $request->food_type_id;
        $this->name             = $request->name;
        $this->description      = $request->description;
        $this->price            = $request->price;
        $this->hotel_id         = auth()->user()->hotel_id;
        $storeItem              = $this->save();

        $storeItem
            ? session()->flash('message', 'New Food Item Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateItem(Object $request, Int $id)
    {
        $item = $this::findOrFail($id);
        $image = $request->file('photo');
        if ($image) {
            if (file_exists($item->photo)) unlink($item->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $image_url       = 'https://amarlodge.com/public/images/items/' . $image_full_name;
            $success         = $image->storeAs('items', $image_full_name, 'parent_disk');
            $this->photo     = $image_url;
        }

        $item->food_category_id = $request->food_category_id;
        $item->food_type_id     = $request->food_type_id;
        $item->name             = $request->name;
        $item->description      = $request->description;
        $item->price            = $request->price;
        $item->hotel_id         = auth()->user()->hotel_id;
        $updateItem             = $item->save();

        $updateItem
            ? session()->flash('message', 'Food Item Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyItem(Int $id)
    {
        $item = $this::findOrFail($id);
        if (file_exists($item->photo)) unlink($item->photo);
        $destroyItem = $item->delete();

        $destroyItem
            ? session()->flash('message', 'Food Item Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
