<?php

namespace App\Http\Controllers;

use App\Http\Requests\KaryawanStoreRequest;
use App\Models\Karyawan;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            // Validasi
            $validator = Validator::make($request->all(), [
                // 'nip' => ['required','string','min:5','unique:karyawans,nip'],
                'nip' => ['required','string','min:5', Rule::unique('karyawans','nip')],
                'nama' => ['required','string','min:3'],
                'jabatan_id' => ['required']
            ]);
     
            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)->withInput();
            }

            // Simpan Data karyawan 
            $this->karyawanModel->create($validator->validate());
            
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
        try {
            $cariKaryawan = $this->karyawanModel->whereId($id)->first();
    
            throw_if(empty($cariKaryawan), new \Exception("Error Processing Request", 1));
            
            $daftarJabatan = $this->jabatanModel->get();

            return view('edit', compact('cariKaryawan', 'daftarJabatan'));
        } catch (\Exception $th) {
            return redirect()->route('home')
            ->with('error', 'Data tidak valid'); 
        }
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
        try {

            $validator = Validator::make($request->all(), [
                // 'nip' => ['required','string','min:5','unique:karyawans,nip'],.
                'nip' => ['required','string','min:5', Rule::unique('karyawans','nip')->ignore($id)],
                'nama' => ['required','string','min:3'],
                'jabatan_id' => ['required']
            ]);
     
            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)->withInput();
            }

            $cariKaryawan = $this->karyawanModel->whereId($id)->first();

            throw_if(empty($cariKaryawan), new \Exception("Error Processing Request", 1));

            $cariKaryawan->update($validator->validate());

            return redirect()->route('home')
            ->with('success', 'Data berhasil di update'); 
        } catch (\Throwable $th) {
            return redirect()->route('home')
            ->with('error', 'Data tidak valid'); 
        }
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
