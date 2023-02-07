<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DataBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Contracts\Encryption\DecryptException;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cats = Category::orderBy('order')->get();
        return view('backend.category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:category|max:255',
            'order' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->route('dashboard.category_create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $userid=Auth::user()->id;
        Category::create([
            'name' => $request->name,
            'order' => $request->order,
            'user_id' => $userid,
        ]);
        return redirect()->route('dashboard.category');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::find($id);
        if (Auth::user()->id == $cat->user_id) {
            return view('backend.category_edit')->with('cat', $cat);
        }
        return redirect()->route('dashboard.category');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->route('dashboard.category')
                        ->withErrors($validator)
                        ->withInput();
        }

        Category::where(['id'=> $request->id, 'user_id'=> Auth::user()->id])
            ->update([
                'name' => $request->name,
                'order' => $request->order
            ]);

        return redirect()->route('dashboard.category');

    }

    public function destroy($id)
    {
        $cat = Category::find($id);
        $userid=Auth::user()->id;
        if ($userid == $cat->user_id) {
            $cat->delete(); // Easy right?
            DataBox::where('cat_id', $cat->id )->delete();
        }
        return redirect()->route('dashboard.category');
    }


    //updating list order
    public function edit_listorder()
    {
        $userid=Auth::user()->id;
        $cats = Category::where('user_id',$userid)->orderBy('order')->get();
        return view('backend.category_editlistorder')->with('cats', $cats);
    }
    public function update_listorder(Request $request)
    {
        $list = json_decode($request->list);
        $userid=Auth::user()->id;
        foreach ($list as $cat) {
            Category::where(['id'=> $cat->id, 'user_id' => $userid])
            ->update(['order' => $cat->order]);
        }
        return redirect()->route('dashboard.category');
    }


    //databox
    public function data_list($id)
    {
        $userid = Auth::user()->id;
        $data = DataBox::where(['cat_id' => $id, 'user_id' => $userid])->orderBy('order')->get();
        foreach ($data as $row)
        {
            $row->username = Crypt::decryptString($row->username);
            $row->password = Crypt::decryptString($row->password);
        }
        $cats = Category::orderBy('order')->get();

        return view('backend.category_data')->with(['cats' => $cats, 'catid' => $id, 'databoxs' => $data ]);
    }


    public function data_create($id)
    {
        $userid=Auth::user()->id;
        $length = Category::where([ 'id' => $id,'user_id' => $userid])->get()->count();
        // return $length;
        if ($length > 0) {
            return view('backend.category_data_create')->with(['catid' => $id]);
        }
        return redirect()->route('dashboard.category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function data_store(Request $request)
    {
        $catid = $request->cat_id;
        $userid = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'password' => 'required|max:255',
            'order' => 'required|max:255',
            'cat_id' => 'required|max:255',
            'user_id' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard.category_data_create', ["id" => $catid])
                        ->withErrors($validator)
                        ->withInput();
        }
        $username=Crypt::encryptString($request->username);
        $password=Crypt::encryptString($request->password);
        DataBox::create([
            'name' => $request->name,
            'username' => $username,
            'password' => $password,
            'order' => $request->order,
            'cat_id' => $catid,
            'user_id' => $userid,
        ]);
        return redirect()->route('dashboard.category_data_list', ["id" => $catid]);
    }
    public function data_edit($id)
    {
        $length = DataBox::where(['user_id' => Auth::user()->id, 'id'=> $id])->get()->count();
        if ($length > 0) {
            $userid= Auth::user()->id;
            $cat = DataBox::where(['user_id' => $userid, 'id'=> $id])->first();
            $cat->username = Crypt::decryptString($cat->username);
            $cat->password = Crypt::decryptString($cat->password);
            $cats = Category::where('user_id', $userid)->orderBy('order')->get();
            return view('backend.category_data_edit')->with(['cat' => $cat, 'cats' => $cats]);
        }
        return redirect()->route('dashboard.category');
    }

    public function data_update(Request $request)
    {
        $id=$request->id;
        $length = DataBox::where(['user_id' => Auth::user()->id, 'id'=> $id])->get()->count();
        if ($length > 0) {
            $catid=$request->cat_id;
            $id=$request->id;
            $username = Crypt::encryptString($request->username);
            $password = Crypt::encryptString($request->password);

            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:category|max:255',
                'username' => 'required|max:255',
                'password' => 'required|max:255',
                'order' => 'required|numeric|max:255',
                'cat_id' => 'required|numeric|max:100',
            ]);

            if ($validator->fails()) {
                return redirect()->route('dashboard.category_data_edit', ["id" => $request->id])
                            ->withErrors($validator)
                            ->withInput();
            }

            DataBox::where('id', $id)
                ->update([
                'name' => $request->name,
                'username' => $username,
                'password' => $password,
                'order' => $request->order,
                'cat_id' => $catid,
            ]);

            return redirect()->route('dashboard.category_data_list', ["id" => $catid]);
        }

    }
    public function data_delete($postid)
    {
        $data = DataBox::where(['user_id' => Auth::user()->id, 'id' => $postid])->first();
        $catid=$data->cat_id;
        $data->delete();

        return redirect()->route('dashboard.category_data_list', ["id" => $catid]);
    }

    public function data_edit_listorder($id)
    {
        $length = DataBox::where(['user_id' => Auth::user()->id, 'cat_id'=> $id])->get()->count();
        if ($length > 0) {
            $section_name=Category::where('id', $id)->first()->name;
            $databoxs = DataBox::where(['user_id' => Auth::user()->id, 'cat_id' => $id])->orderBy('order')->get();
            return view('backend.category_data_editlistorder')->with(['databoxs' => $databoxs, 'id' => $id, 'section_name' => $section_name ]);
        }
        return redirect()->route('dashboard.category');
    }

    public function data_update_listorder(Request $request, $sectionid)
    {
        $list = json_decode($request->list);
        $userid=Auth::user()->id;
        foreach ($list as $data) {
            Databox::where(['id' => $data->id, 'user_id' => $userid])
            ->update(['order' => $data->order]);
        }
        // return $list;
        return redirect()->route('dashboard.category_data_list', ['id' => $sectionid]);
    }
}
