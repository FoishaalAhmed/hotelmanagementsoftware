<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'mobile_bank_id', 'date', 'type', 'amount', 'note', 'booking_payment',
    ];

    public static $validateRule = [
        'mobile_bank_id' => ['required', 'min: 1', 'numeric'],
        'date' => ['required', 'date'],
        'type' => ['required', 'string', 'max: 15'],
        'amount' => ['required', 'min: 1', 'numeric'],
        'note' => ['required', 'string'],
    ];

    public function getHotelMobileTransactions()
    {
        $transactions = $this::join('mobile_banks', 'mobile_transactions.mobile_bank_id', '=', 'mobile_banks.id')
            ->orderBy('mobile_transactions.date', 'desc')
            ->select('mobile_transactions.*', 'mobile_banks.name')
            ->get();
        return $transactions;
    }

    public function storeMobileTransaction(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->mobile_bank_id = $request->mobile_bank_id;
        $this->date = date('Y-m-d', strtotime($request->date));
        $this->type = $request->type;
        $this->amount = $request->amount;
        $this->note = $request->note;
        $storeMobileTransaction = $this->save();

        $storeMobileTransaction
            ? session()->flash('message', 'New Mobile Bank Transaction Done Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateMobileTransaction(Object $request, object $transaction)
    {
        $transaction->hotel_id = auth()->user()->hotel_id;
        $transaction->mobile_bank_id = $request->mobile_bank_id;
        $transaction->date = date('Y-m-d', strtotime($request->date));
        $transaction->type = $request->type;
        $transaction->amount = $request->amount;
        $transaction->note = $request->note;
        $updateMobileTransaction = $transaction->save();

        $updateMobileTransaction
            ? session()->flash('message', 'Mobile Bank Transaction Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyMobileTransaction(object $transaction)
    {
        $destroyMobileTransaction = $transaction->delete();

        $destroyMobileTransaction
            ? session()->flash('message', 'Mobile Bank Transaction Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
