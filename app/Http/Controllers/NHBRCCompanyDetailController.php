<?php

namespace App\Http\Controllers;

use App\NHBRCCompanyDetail;
use Illuminate\Http\Request;

class NHBRCCompanyDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $page_title   = 'NHBRC Application Registration| Company Details';
          $id           = $request->user()->id;
          $contacts     = NHBRCCompanyDetail::where('user_id',$id)->first();
          return view('custom.nhbrc.index', ['contacts'=> $contacts,'page_title'=>$page_title]);

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
     * @param  \App\NHBRCCompanyDetail  $nHBRCCompanyDetail
     * @return \Illuminate\Http\Response
     */
    public function show(NHBRCCompanyDetail $nHBRCCompanyDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NHBRCCompanyDetail  $nHBRCCompanyDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(NHBRCCompanyDetail $nHBRCCompanyDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NHBRCCompanyDetail  $nHBRCCompanyDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NHBRCCompanyDetail $nHBRCCompanyDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NHBRCCompanyDetail  $nHBRCCompanyDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(NHBRCCompanyDetail $nHBRCCompanyDetail)
    {
        //
    }
}
