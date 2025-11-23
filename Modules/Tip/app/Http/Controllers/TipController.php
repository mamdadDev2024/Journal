<?php

namespace Modules\Tip\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tip::index');
    }

    /**
     * TipShow the form for creating a new resource.
     */
    public function create()
    {
        return view('tip::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * TipShow the specified resource.
     */
    public function show($id)
    {
        return view('tip::show');
    }

    /**
     * TipShow the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('tip::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
