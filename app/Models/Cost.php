<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'date', 'amount', 'cause',
    ];

    public static $validateRule = [
        'type' => ['required', 'numeric'],
        'payment_method' => ['required', 'string', 'max: 255'],
        'date' => ['required', 'date'],
        'amount' => ['required', 'numeric', 'min: 1'],
        'cause' => ['required', 'string', 'max: 255'],
    ];

    public function storeCost(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->type = $request->type;
        $this->date = date('Y-m-d', strtotime($request->date));
        $this->amount = $request->amount;
        $this->cause = $request->cause;
        $storeCost = $this->save();

        if ($request->payment_method == 'Bank') {
            $bankTransaction = new BankTransaction();
            $bankTransaction->hotel_id = auth()->user()->hotel_id;
            $bankTransaction->bank_id = $request->bank;
            $bankTransaction->date = date('Y-m-d');
            $bankTransaction->type = 'Withdraw';
            $bankTransaction->amount = $request->amount;
            $bankTransaction->note = 'Daily Cost Payment';
            $bankTransaction->save();

        } elseif ($request->payment_method == 'MFS') {

            $mobileTransaction = new MobileTransaction();
            $mobileTransaction->hotel_id = auth()->user()->hotel_id;
            $mobileTransaction->mobile_bank_id = $request->mfs_payment_type;
            $mobileTransaction->date = date('Y-m-d');
            $mobileTransaction->type = 'Cash Out';
            $mobileTransaction->amount = $request->amount;
            $mobileTransaction->note = 'Daily Cost Payment';
            $mobileTransaction->save();
        }

        $storeCost
            ? session()->flash('message', 'Daily Cost Added Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateCost(Object $request, Object $cost)
    {
        $cost->type = $request->type;
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->amount = $request->amount;
        $cost->cause = $request->cause;
        $updateCost = $cost->save();

        $updateCost
            ? session()->flash('message', 'Daily Cost Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyCost(Object $cost)
    {
        $destroyCost = $cost->delete();

        $destroyCost
            ? session()->flash('message', 'Daily Cost Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
