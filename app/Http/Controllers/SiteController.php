<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| SiteController
|--------------------------------------------------------------------------
|
| Работа с индивидуальным сайтом пользователя
|
*/

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $site = Site::where('id', 1)->first();
   
        return view('cabinet_site', compact('site'));
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        $site = Site::where('id', 1)->first();
   
        return view('site', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        //
    }
}
