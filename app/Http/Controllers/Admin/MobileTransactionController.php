<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobileBank;
use App\Models\MobileTransaction;
use Illuminate\Http\Request;

class MobileTransactionController extends Controller
{
    private $mobileTransactionObject;

    public function __construct()
    {
        $this->mobileTransactionObject = new MobileTransaction();
    }

    public function index()
    {
        $transactions = $this->mobileTransactionObject->getHotelMobileTransactions();
        return view('backend.admin.mobiletransaction.index', compact('transactions'));
    }

    public function create()
    {
        $banks = MobileBank::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.admin.mobiletransaction.create', compact('banks'));
    }

    public function store(Request $request)
    {
        $request->validate(MobileTransaction::$validateRule);
        $this->mobileTransactionObject->storeMobileTransaction($request);
        return back();
    }

    public function edit(MobileTransaction $mobileTransaction)
    {
        $banks = MobileBank::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.admin.mobiletransaction.edit', compact('banks', 'mobileTransaction'));
    }

    public function update(Request $request, MobileTransaction $mobileTransaction)
    {
        $request->validate(MobileTransaction::$validateRule);
        $this->mobileTransactionObject->updateMobileTransaction($request, $mobileTransaction);
        return redirect()->route('admin.mobile-transactions.index');
    }

    public function destroy(MobileTransaction $mobileTransaction)
    {
        $this->mobileTransactionObject->destroyMobileTransaction($mobileTransaction);
        return back();
    }
}
