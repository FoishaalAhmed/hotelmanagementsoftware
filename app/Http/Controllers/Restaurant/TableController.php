<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    private $tableObject;

    public function __construct()
    {
        $this->tableObject = new Table();
    }

    public function index()
    {
        $tables = Table::where('hotel_id', auth()->user()->hotel_id)->orderBy('number', 'asc')->get();
        return view('backend.restaurant.table', compact('tables'));
    }

    public function store(Request $request)
    {
        $request->validate(Table::$validateRule);
        $this->tableObject->storeTable($request);
        return back();
    }

    public function update(Request $request)
    {
        $request->validate(Table::$validateRule);
        $this->tableObject->updateTable($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->tableObject->destroyTable($id);
        return back();
    }
}
