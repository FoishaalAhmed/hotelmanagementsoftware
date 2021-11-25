<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodayMenu extends Model
{
    protected $fillable = [
        'date', 'item_id', 'food_category_id', 'food_type_id', 'hotel_id',
    ];

    public static $validateStoreRule = [
        'food_category_id' => ['required', 'numeric'],
        'food_type_id' => ['required', 'numeric'],
        'item_id.*' => ['nullable', 'numeric'],
    ];

    public static $validateUpdateRule = [
        'food_category_id.*' => ['required', 'numeric'],
        'food_type_id.*' => ['required', 'numeric'],
        'item_id.*' => ['nullable', 'numeric'],
    ];

    public function getTodayMenusByFoodType($food_type_id)
    {
        $menus = $this->join('items', 'today_menus.item_id', '=', 'items.id')
            ->where('today_menus.hotel_id', auth()->user()->hotel_id)
            ->where('today_menus.food_type_id', $food_type_id)
            ->where('today_menus.date', date('Y-m-d'))
            ->select('today_menus.*', 'items.name')
            ->get();
        return $menus;
    }

    public function storeTodayMenu(Object $request)
    {
        if ($request->item_id != null) {
            foreach ($request->item_id as $key => $value) {
                $data[] = [
                    'hotel_id' => auth()->user()->hotel_id,
                    'item_id' => $value,
                    'food_category_id' => $request->food_category_id,
                    'food_type_id' => $request->food_type_id,
                    'date' => date('Y-m-d'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }

        $storeTodayMenu = $this::insert($data);

        $storeTodayMenu
            ? session()->flash('message', 'Todays Menu Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateTodayMenu(Object $request, Int $id)
    {

        if ($request->item_id != null) {
            foreach ($request->item_id as $key => $value) {
                $data[] = [
                    'hotel_id' => auth()->user()->hotel_id,
                    'item_id' => $value,
                    'food_category_id' => $request->food_category_id[$key],
                    'food_type_id' => $request->food_type_id[$key],
                    'date' => date('Y-m-d'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }

        $this->where('hotel_id', auth()->user()->hotel_id)->where('date', date('Y-m-d'))->where('food_type_id', $id)->delete();
        $updateTodayMenu = $this::insert($data);

        $updateTodayMenu
            ? session()->flash('message', 'Todays Menu Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyTodayMenu(Int $id)
    {
        //$menu = $this::findOrFail($id);
        $destroyTodayMenu = $this::where('hotel_id', auth()->user()->hotel_id)->where('date', date('Y-m-d'))->where('food_type_id', $id)->delete();

        $destroyTodayMenu
            ? session()->flash('message', 'Todays Menu Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
