<?php

namespace App\Http\Controllers;

use Auth;
use App\Cabinet;
use App\Request as UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index()
    {
      $cal_array = Cabinet::generateCalendar();
      return view('cabinet', [
        'weeks'       => $cal_array['weeks'],
        'prev'        => $cal_array['prev'],
        'next'        => $cal_array['next'],
        'html_title'  => $cal_array['html_title']
      ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
          UserRequest::create($request->all(), Auth::user()->id);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
