<?php

namespace App\Http\Controllers;

use App\Models\NhaDong;
use Illuminate\Http\Request;

class NhaDongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_nha_dong = NhaDong::with('getUser')
            ->withCount('tuSi')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('nha_dong.all', compact('all_nha_dong'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NhaDong  $nhaDong
     * @return \Illuminate\Http\Response
     */
    public function show(NhaDong $nhaDong)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NhaDong  $nhaDong
     * @return \Illuminate\Http\Response
     */
    public function edit(NhaDong $nhaDong)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NhaDong  $nhaDong
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NhaDong $nhaDong)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NhaDong  $nhaDong
     * @return \Illuminate\Http\Response
     */
    public function destroy(NhaDong $nhaDong)
    {
        //
    }
}
