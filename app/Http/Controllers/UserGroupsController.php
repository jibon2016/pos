<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use yii\web\View;

class UserGroupsController extends Controller
{

    public function __construct()
    {
        $this->data['main_manu'] = 'Users';
        $this->data['sub_manu'] = 'Groups';
    }

    public function index()
    {
        $this->data['gorups'] = Group::all();
        return View('groups.group', $this->data);
    }


    public function create()
    {
        return View('groups.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fromData = $request->all() ;
        if (Group::create($fromData)){
            Session::flash('success_message', 'Group Created Successfully');
        };
        return redirect()->to('groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Group::find($id)->delete()){
            Session::flash('error_message', 'Group Deleted Successfully');
        };
        return redirect()->to('groups');
    }
}
