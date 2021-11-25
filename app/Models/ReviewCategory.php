<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static $validateRule = [
        'name' => ['required', 'string', 'max:255']
    ];

    public function rating()
    {
        return $this->hasMany('App\Models\HotelRating');
    }

    public function storeReviewCategory(Object $request)
    {
        $this->name = $request->name;
        $storeReviewCategory = $this->save();

        $storeReviewCategory
            ? session()->flash('message', 'New Review Category Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateReviewCategory(Object $request, Int $id)
    {
        $category = $this::findOrFail($id);
        $category->name = $request->name;
        $updateReviewCategory = $category->save();

        $updateReviewCategory
            ? session()->flash('message', 'Review Category Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyReviewCategory(Int $id)
    {
        $category = $this::findOrFail($id);
        $destroyReviewCategory = $category->delete();

        $destroyReviewCategory
            ? session()->flash('message', 'Review Category Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
