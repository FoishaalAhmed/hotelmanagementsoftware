<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'bank_id', 'date', 'type', 'amount', 'note', 'booking_payment',
    ];

    public static $validateRule = [
        'bank_id' => ['required', 'min: 1', 'numeric'],
        'date' => ['required', 'date'],
        'type' => ['required', 'string', 'max: 15'],
        'amount' => ['required', 'min: 1', 'numeric'],
        'note' => ['required', 'string'],
    ];

    public function getHotelBankTransactions()
    {
        $transactions = $this::join('banks', 'bank_transactions.bank_id', '=', 'banks.id')
                                ->orderBy('bank_transactions.date', 'desc')
                                ->select('bank_transactions.*', 'banks.name')
                                ->get();
        return $transactions;
    }

    public function storeBankTransaction(Object $request)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->bank_id = $request->bank_id;
        $this->date = date('Y-m-d', strtotime($request->date));
        $this->type = $request->type;
        $this->amount = $request->amount;
        $this->note = $request->note;
        $storeBankTransaction = $this->save();

        $storeBankTransaction
            ? session()->flash('message', 'New Bank Transaction Done Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateBankTransaction(Object $request, object $transaction)
    {
        $transaction->hotel_id = auth()->user()->hotel_id;
        $transaction->bank_id = $request->bank_id;
        $transaction->date = date('Y-m-d', strtotime($request->date));
        $transaction->type = $request->type;
        $transaction->amount = $request->amount;
        $transaction->note = $request->note;
        $updateBankTransaction = $transaction->save();

        $updateBankTransaction
            ? session()->flash('message', 'Bank Transaction Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyBankTransaction(object $transaction)
    {
        $destroyBankTransaction = $transaction->delete();

        $destroyBankTransaction
            ? session()->flash('message', 'Bank Transaction Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
