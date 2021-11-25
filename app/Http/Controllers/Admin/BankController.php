<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    private $bankObject;

    public function __construct()
    {
        $this->bankObject = new Bank();
    }

    public function index()
    {
        $banks = Bank::where('hotel_id', auth()->user()->hotel_id)->get();
        return view('backend.admin.bank', compact('banks'));
    }

    public function store(Request $request)
    {
        $request->validate(Bank::$validateRule);
        $this->bankObject->storeBank($request);
        return back();
    }

    public function update(Request $request)
    {
        $request->validate(Bank::$validateRule);
        $this->bankObject->updateBank($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->bankObject->destroyBank($id);
        return back();
    }
}
