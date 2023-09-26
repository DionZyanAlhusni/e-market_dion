<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data['pelanggan'] = Pelanggan::orderBy('created_at', 'DESC')->get();
        } catch (QueryException | Expectation | PDOException $error) {
            $this->failResponse($error->getMessage(), $error->getCode());
        }
        return view('pelanggan.index')->with($data);
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
     * @param  \App\Http\Requests\StorePelangganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePelangganRequest $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            DB::table('pelanggan')->insert($validated);
            DB::commit();
            // dd($request->input('nama_produk'));
            return redirect('pelanggan')->with('success', 'data berhasil disimpan');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            //return $this->failResponse($error->getMessage(), $error->getCode());
            // dd($this->failResponse($error->getMessage(), $error->getCode()));
            return redirect()->back()->withErrors(['message' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePelangganRequest  $request
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePelangganRequest $request, $pelanggan)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            DB::table('pelanggan')->where('id',$pelanggan)->update($validated);
            // dd(DB::commit());
            DB::commit();
            // dd($request->input('nama_pelanggan'));
            return redirect('pelanggan')->with('success', 'Data berhasil diubah');
        } catch (QueryException | Exception | PDOException $error) {
            DB::rollBack();
            // dd($this->failResponse($error->getMessage(), $error->getCode()));
            return redirect()->back()->withErrors(['message' => 'salahhh']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect('pelanggan')->with('success', 'Data berhasil dihapus');
    }
}
