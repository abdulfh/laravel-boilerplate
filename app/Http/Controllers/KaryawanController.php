<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    private $karyawanModel;
    private $jabatanModel;
    
    public function __construct()
    {
       $this->karyawanModel = new Karyawan(); 
       $this->jabatanModel = new Jabatan();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarKaryawan = $this->karyawanModel->paginate(10);
        // return json_encode($daftarKaryawan);
        return view('home', compact('daftarKaryawan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftarJabatan = $this->jabatanModel->get();
        return view('create', compact('daftarJabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Simpan Data karyawan 
            $karyawan = [
                'nip' => $request['nip'],
                'nama' => $request['nama'],
                'jabatan_id' => $request['jabatan_id'],
            ];
            $this->karyawanModel->create($karyawan);
            
            return redirect()->route('home')
            ->with('success', 'Success Store Data');
        } catch (\Exception $th) {
            return redirect()->route('home')
            ->with('error', 'Internal Server Error');    
        }
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
        try {
            $cariKaryawan = $this->karyawanModel->whereId($id)->first();
            $cariKaryawan->delete();

            return redirect()->route('home')
            ->with('success', 'Success Delete Data'); 
        } catch (\Exception $th) {
            return redirect()->route('home')
            ->with('error', 'Internal Server Error'); 
        }
    }
}
