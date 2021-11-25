<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static $validateRule = [
        'name' => ['required', 'string', 'max: 255']
    ];

    public function storeBank(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->name = $request->name;
        $storeBank = $this->save();

        $storeBank
            ? session()->flash('message', 'New Bank Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateBank(Object $request, Int $id)
    {
        $bank = $this::findOrFail($id);
        $bank->hotel_id = auth()->user()->hotel_id;
        $bank->name = $request->name;
        $updateBank = $bank->save();

        $updateBank
            ? session()->flash('message', 'Bank Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyBank(Int $id)
    {
        $bank = $this::findOrFail($id);
        $destroyBank = $bank->delete();

        $destroyBank
            ? session()->flash('message', 'Bank Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
