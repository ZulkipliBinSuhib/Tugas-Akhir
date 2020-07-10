<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $data['dosen'] = DB::table('dosen')->get();
        $id = Auth::user()->prodi;
        $get_prodiAndDosen = DB::table('dosen')
                            ->join('prodi', 'dosen.prodi', '=', 'prodi.id')
                            ->select('dosen.name','dosen.nidn','dosen.jenis_kelamin','dosen.status','prodi.nama','dosen.id');

    if(!empty($id)){
        $get_prodiAndDosen = $get_prodiAndDosen->where('dosen.prodi',$id);
        }
        $get_prodiAndDosen = $get_prodiAndDosen->get();
        $data['get_prodiAndDosen'] = $get_prodiAndDosen;

        return view('dosen.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('dosen')->insert(['name'=>$request->name,
                                    'nidn'=>$request->nidn,
                                    'jenis_kelamin'=>$request->jenis_kelamin,
                                    'status'=>$request->status,
                                    'prodi'=>$request->prodi ?? $request->user()->prodi ]);
        return redirect('dosen');
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
        $data['dosen'] = DB::table('dosen')->where('id',$id)->first();
        return view('dosen.edit',$data);
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
        DB::table('dosen')->where('id',$id)->update(['name'=>$request->name,
                                                    'nidn'=>$request->nidn,
                                                    'jenis_kelamin'=>$request->jenis_kelamin,
                                                    'status'=>$request->status]);
                                                    return redirect('dosen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('dosen')->where('id',$id)->delete();
        return redirect('dosen');
    }
}
