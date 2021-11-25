<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount',
    ];

    public static $validateRule = [

        'discount' => 'required|string|max:10'
    ];

    public function storeDiscount($request)
    {
        $this->discount = $request->discount;
        $storeDiscount  = $this->save();

        $storeDiscount
            ? session()->flash('message', 'Discount Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateDiscount($request, $id)
    {
        $discount           = $this::findOrFail($id);
        $discount->discount = $request->discount;
        $updateDiscount     = $discount->save();

        $updateDiscount
            ? session()->flash('message', 'Discount Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function deleteDiscount($id)
    {
        $discount = $this::findOrFail($id);
        DiscountHotel::where('discount_id', $id)->delete();
        DiscountRoom::where('discount_id', $id)->delete();
        $deleteDiscount = $discount->delete();
        $deleteDiscount
            ? session()->flash('message', 'Discount Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
