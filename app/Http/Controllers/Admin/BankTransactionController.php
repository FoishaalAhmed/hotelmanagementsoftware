<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankTransaction;
use Illuminate\Http\Request;

class BankTransactionController extends Controller
{
    private $bankTransactionObject;

    public function __construct()
    {
        $this->bankTransactionObject = new BankTransaction();
    }

    public function index()
    {
        $transactions = $this->bankTransactionObject->getHotelBankTransactions();
        return view('backend.admin.banktransaction.index', compact('transactions'));
    }

    public function create()
    {
        $banks = Bank::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.admin.banktransaction.create', compact('banks'));
    }

    public function store(Request $request)
    {
        $request->validate(BankTransaction::$validateRule);
        $this->bankTransactionObject->storeBankTransaction($request);
        return back();
    }

    public function edit(BankTransaction $bankTransaction)
    {
        $banks = Bank::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.admin.banktransaction.edit', compact('banks', 'bankTransaction'));
    }

    public function update(Request $request, BankTransaction $bankTransaction)
    {
        $request->validate(BankTransaction::$validateRule);
        $this->bankTransactionObject->updateBankTransaction($request, $bankTransaction);
        return redirect()->route('admin.bank-transactions.index');
    }

    public function destroy(BankTransaction $bankTransaction)
    {
        $this->bankTransactionObject->destroyBankTransaction($bankTransaction);
        return back();
    }
}
