<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static $validateRule = [
        'name' => ['required', 'string', 'max: 255']
    ];

    public function storeMobileBank(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->name = $request->name;
        $storeMobileBank = $this->save();

        $storeMobileBank
            ? session()->flash('message', 'New Mobile Bank Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateMobileBank(Object $request, Int $id)
    {
        $bank = $this::findOrFail($id);
        $bank->hotel_id = auth()->user()->hotel_id;
        $bank->name = $request->name;
        $updateMobileBank = $bank->save();

        $updateMobileBank
            ? session()->flash('message', 'Mobile Bank Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyMobileBank(Int $id)
    {
        $bank = $this::findOrFail($id);
        $destroyMobileBank = $bank->delete();

        $destroyMobileBank
            ? session()->flash('message', 'Mobile Bank Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
