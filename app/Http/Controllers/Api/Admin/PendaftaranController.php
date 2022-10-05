<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PendaftaranController extends Controller
{
    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
            'id_jabatan' => 'required',
            'jk' => 'required',
            'foto_user' => 'required|image|mimes:jpeg,jpg,png|max:5048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create foto 
        $foto_user = $request->file('foto_user');
        $extensions = $foto_user->getClientOriginalExtension();
        $photoUser = Str::random(10).".".$extensions;
        $uploadPath = env('UPLOAD_PATH')."/users";

        //create user
        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => bcrypt($request->password),
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'id_jabatan' => $request->id_jabatan,
            'jk' => $request->jk,
            'foto_user' => $request->file('foto_user')->move($uploadPath, $photoUser),
            'verifikasi' => '2',
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Karyawan berhasil ditambahkan',
                'data' => $user,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Karyawan gagal ditambahkan'
        ], 409);

    }

    public function pendaftaran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
            'jk' => 'required',
            'foto_user' => 'required|image|mimes:jpeg,jpg,png|max:5048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create foto 
        $foto_user = $request->file('foto_user');
        $extensions = $foto_user->getClientOriginalExtension();
        $photoUser = Str::random(10).".".$extensions;
        $uploadPath = env('UPLOAD_PATH')."/users";

        //create user
        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => bcrypt($request->password),
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'jk' => $request->jk,
            'foto_user' => $request->file('foto_user')->move($uploadPath, $photoUser),
            'verifikasi' => '1',
            'id_loker' => $request->id_loker,
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Karyawan berhasil ditambahkan',
                'data' => $user,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Karyawan gagal ditambahkan'
        ], 409);
    }

    public function listInverif(Request $request)
    {
        $id = $request->input('id');
        $verifikasi = $request->input('verifikasi');
        $name = $request->input('name');
        $idJabatan = $request->input('id_jabatan');

        if($id) {
            $user = User::find($id);

            if($user) {
                return response()->json([
                    'data' => $user,
                ], 200);
            }
            return response()->json([
                'message' => 'Data user tidak ditemukan'
            ], 409);
        }
        

        $user = User::query();
        if ($verifikasi) {
            $user->where('verifikasi', 'like','%' .$verifikasi. '%')->with('jabatan', 'loker');
            
        }
        if ($name) {
            $user->where('name', 'like','%' .$name. '%')->with('jabatan', 'loker');
            
        }
        if ($idJabatan) {
            $user->where('id_jabatan', $idJabatan)->with('jabatan');
            
        }
        return response()->json([
            'success' => true,
            'data' => $user->get(),
        ]);
    }

    public function editProfile(Request $request, $id)
    {
        $user = User::with(['jabatan'])->findOrFail($id);
        $data = $request->all();

        if($request->hasFile('foto_user')) {
            if($request->file('foto_user')->isValid()) {
                Storage::disk('upload')->delete($request->foto_user);
                $foto_user = $request->file('foto_user');
                $extensions = $foto_user->getClientOriginalExtension();
                $photoUser = Str::random(10).".".$extensions;
                $uploadPath = env('UPLOAD_PATH')."/users";
                $request->file('foto_user')->move($uploadPath, $photoUser);
                $data['foto_user'] = $photoUser;
            }
        }

        $user->update($data);
        return response()->json([
            'success' => true,
            'message' => 'User berhasil diubah',
            'data' => $user,
        ]);
    }
}
