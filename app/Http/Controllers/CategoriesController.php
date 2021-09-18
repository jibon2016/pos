<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->data['main_manu'] = 'Products';
        $this->data['sub_manu'] = 'Categories';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['categories'] = Category::all();

        return view('category.categories', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['headline'] = 'Add New Categories';
        $this->data['mode'] = 'create';

        return view('category.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        if ( Category::create($data)){
            Session::flash('success_message', $data['title'].' Created Successfully');
        };
        return redirect()->to('categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['category']     = Category::findOrFail($id);
        $this->data['mode']     = 'edit';
        $this->data['headline'] = 'Update Category';

        return view('category.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->title     = $request->get('title');

        if (  $category->save()){
            Session::flash('success_message', 'Categories Updated Successfully');
        };
        return redirect()->to('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Category::find($id)->delete()){
            Session::flash('error_message', 'Category Deleted Successfully');
        };
        return redirect()->to('categories');
    }
}
