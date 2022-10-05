<?php

namespace App\Http\Controllers\Api\HRD;

use App\Http\Controllers\Controller;
use App\Models\Loker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LokerController extends Controller
{
    public function tambahLoker(Request $request)
    {
        //create loker
        $loker = Loker::create([
            'judul' => $request->judul,
            'employe' => $request->employe,
            'alamat' => $request->alamat,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'gaji' => $request->gaji,
            'role' => $request->role,
            'penulis' => $request->penulis,
            'pengalaman' => $request->pengalaman,
            'skill' =>$request->skill,
        ]);

        if ($loker) {
            return response()->json([
                'success' => true,
                'message' => 'Loker Berhasil ditambahkan',
                'data' => $loker,
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Loker gagal ditambahkan',
        ], 409);
    }

    public function editLoker(Request $request, $id)
    {
        $loker = Loker::findOrFail($id);
        $loker->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Loker berhasil diupdate',
            'data' => $loker
        ], 200);
    }

    public function GetLoker(Request $request) {
        $id = $request->input('id');
        $judul = $request->input('judul');
        $employe = $request->input('employe');
        $alamat = $request->input('alamat');
        $tanggal = $request->input('tanggal');
        $deskripsi = $request->input('deskripsi');
        $gaji = $request->input('gaji');
        $role = $request->input('role');
        $penulis = $request->input('penulis');
        $pengalaman = $request->input('pengalaman');
        $skill = $request->input('skill');

        if($id) {
            $loker = Loker::find($id);

            if($loker) {
                return response()->json([
                    'success' => true,
                    'message' => 'Loker Berhasil diambil'
                ], 200);
            }else {
                return response()->json([
                    'message' => 'Data user tidak ditemukan'
                ], 409);
            }
        }

        $loker = Loker::query();
        
        if($judul) {
            $loker->where('judul', 'like', '%' .$judul. '%');
        }
        if($employe) {
            $loker->where('employe', 'like', '%' .$employe. '%');
        }
        if($alamat) {
            $loker->where('alamat', 'like', '%' .$alamat. '%');
        }
        if($tanggal) {
            $loker->where('tanggal', 'like', '%' .$tanggal. '%');
        }
        if($deskripsi) {
            $loker->where('deskripsi', 'like', '%' .$deskripsi. '%');
        }
        if($gaji) {
            $loker->where('gaji', 'like', '%' .$gaji. '%');
        }
        if($role) {
            $loker->where('role', 'like', '%' .$role. '%');
        }
        if($penulis) {
            $loker->where('penulis', 'like', '%' .$penulis. '%');
        }
        if($pengalaman) {
            $loker->where('pengalaman', 'like', '%' .$pengalaman. '%');
        }
        if($skill) {
            $loker->where('skill', 'like', '%' .$skill. '%');
        }

        return response()->json([
            'success' => true,
            'message' => 'Data list loker berhasil diambil',
            'data' => $loker->get(),
        ], 200);


    }
}
