<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ReqReimbursementRequest;
use App\Http\Requests\User\AddUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\VerifikasiRequest;
use App\Models\Reimbursement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class PostController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $request->authorize();

            $login = Auth::attempt(['nip' => $request['nip'], 'password' => $request['password']]);
            if (!$login) throw new \ErrorException('Data not valid');
            return response()->json([
                'status' => true,
                'message' => 'Success Login'
            ]);
        } catch (\ErrorException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function hapusFunc(Request $request)
    {
        try {
            if ($request['module'] == "req-reimbursement") {
                $insert = Reimbursement::where('id', $request['id'])->delete();
                if (!$insert) throw new \ErrorException('Terjadi kesalahan dalam menghapus reimbursement');
                $message = "Berhasil menghapus reimbursement";
            } else if ($request['module'] == "users") {
                $insert = User::where('id', $request['id'])->delete();
                if (!$insert) throw new \ErrorException('Terjadi kesalahan dalam menghapus user');
                $message = "Berhasil menghapus user";
            } else {
                throw new \ErrorException('Invalid Action >.<');
            }
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        } catch (\ErrorException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function ReqReimbursement(ReqReimbursementRequest $request)
    {
        try {
            if ($request['action'] == "add") {
                if (!$request->hasFile('attachment')) throw new \ErrorException('Attachment required');
                $dataName = time() . '-' . Uuid::uuid7()->toString() . '.' . $request->attachment->extension();
                $request->attachment->move(public_path('upload/data/reimbursement'), $dataName);

                $dataInsert = [
                    'user_id' => auth()->user()->id,
                    'name' => $request['name'],
                    'deskripsi' => $request['deskripsi'],
                    'attachment' => 'upload/data/reimbursement/' . $dataName,
                    'status' => 'PENDING'
                ];
                $insert = Reimbursement::create($dataInsert);
                if (!$insert) throw new \ErrorException('Terjadi kesalahan dalam menambahkan reimbursement');
                $message = "Berhasil menambahkan reimbursement";
            } else if ($request['action'] == "edit") {
                if (!$request->hasFile('attachment')) {
                    $getName = Reimbursement::where('id', $request['id'])->first();
                } else {
                    $dataName = time() . '-' . Uuid::uuid7()->toString() . '.' . $request->attachment->extension();
                    $request->attachment->move(public_path('upload/data/reimbursement'), $dataName);
                    $getName = 'upload/data/reimbursement/' . $dataName;
                }

                $dataInsert = [
                    'name' => $request['name'],
                    'deskripsi' => $request['deskripsi'],
                    'attachment' => $getName,
                    'status' => 'PENDING'
                ];
                $insert = Reimbursement::where('id', $request['id'])->update($dataInsert);
                if (!$insert) throw new \ErrorException('Terjadi kesalahan dalam mengupdate reimbursement');
                $message = "Berhasil mengupdate reimbursement";
            } else {
                throw new \ErrorException('Invalid Action >.<');
            }
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        } catch (\ErrorException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function verifikasi(VerifikasiRequest $request)
    {
        try {
            if ($request['action'] === "verifikasiDirektur") {
                $status = "ACC_DIREKTUR";
            } else if ($request['action'] === "tolak") {
                $status = "DECLINE";
            } else if ($request['action'] === "verifikasiFinance") {
                $status = "ACC_PROCESS";
            }
            Reimbursement::where('id', $request['id'])->update([
                'status' => $status,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Action Success'
            ]);
        } catch (\ErrorException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function users(UserRequest $request)
    {
        try {
            $request->authorize();
            if ($request['action'] === "add") {
                $getNip = User::where('nip', $request['nip'])->count();
                if ($getNip) throw new \ErrorException('NIP already taken');
                $dataInsert = [
                    'nip' => $request['nip'],
                    'name' => $request['name'],
                    'password' => Hash::make($request['password']),
                    'role' => $request['role']
                ];
                $insert = User::create($dataInsert);
                if (!$insert) throw new \ErrorException('Terjadi kesalahan dalam membuat user');
                $message = "Berhasil dalam membuat user";
            } else if ($request['action'] === "edit") {
                $getOld = User::where('id', $request['id'])->first();
                $dataInsert = [
                    'nip' => $request['nip'],
                    'name' => $request['name'],
                    'role' => $request['role'],
                    'password' => $request['password'] ? Hash::make($request['password']) : $getOld['password'],
                ];
                $insert = $getOld->update($dataInsert);
                if (!$insert) throw new \ErrorException('Terjadi kesalahan dalam mengupdate user');
                $message = "Berhasil dalam mengupdate user";
            }
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        } catch (\ErrorException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
