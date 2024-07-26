<?php

namespace App\Http\Controllers;

use App\Models\Reimbursement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function reimbursement()
    {
        if (request()->ajax()) {
            $data = Reimbursement::with('user');
            if (auth()->user()->role === "FINANCE") {
                $data->where('status', 'ACC_DIREKTUR');
            }
            return datatables()->of($data->get())
                ->addIndexColumn()
                ->addColumn('user_name', function ($reimbursement) {
                    return $reimbursement->user ? $reimbursement->user->name : 'Unknown';
                })
                ->editColumn('attachment', function ($row) {
                    return "<a class='btn waves-effect btn-info' target='_blank' href='" . url($row['attachment']) . "'>Lihat Attachment</a>";
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = "";
                    if ($row['status'] == "PENDING" && auth()->user()->role === "DIREKTUR") {
                        $actionBtn .= "<a class='btn waves-effect btn-warning' href='javascript:;' onclick='verifikasiPending(" . $row['id'] . ")'><i class='fa fa-check mr-3''></i> Verifikasi Direktur</a>";
                    }
                    if ($row['status'] == "ACC_DIREKTUR" && auth()->user()->role === "FINANCE") {
                        $actionBtn .= "<a class='btn waves-effect btn-info' href='javascript:;' onclick='verifikasiFinance(" . $row['id'] . ")'><i class='fa fa-check mr-3''></i> Verifikasi Finance</a>";
                    }
                    if ($row['status'] == "PENDING" && auth()->user()->role !== "STAFF") {
                        $actionBtn .= "<a class='btn waves-effect btn-danger' href='javascript:;' onclick='tolak(" . $row['id'] . ")'><i class='fa fa-times''></i> Tolak Pengajuan</a>";
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action', 'attachment'])
                ->make(true);
        }
    }
    public function reqreimbursement()
    {
        if (request()->ajax()) {
            $data = Reimbursement::query()->where('user_id', auth()->user()->id);
            return datatables()->of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = "<a class='btn waves-effect btn-warning' href='javascript:;' onclick='edit(`req-reimbursement`, " . $row['id'] . ")'><i class='fa fa-edit''></i> Edit</a> ";
                    $actionBtn .= "<a class='btn waves-effect btn-danger' href='javascript:;' onclick='hapus(`req-reimbursement`, " . $row['id'] . ")'><i class='fa fa-trash''></i> Hapus</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function getreqreimbursement(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
            ]);
            $data = Reimbursement::where([
                ['id', $request['id']],
                ['user_id', auth()->user()->id]
            ])->first();
            if (empty($data)) throw new \ErrorException('Tidak dapat mengambil data');
            return response()->json([
                'status' => true,
                'message' => 'Berhasil',
                'data' => $data
            ]);
        } catch (\ErrorException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function user()
    {
        if (request()->ajax()) {
            $data = User::query();
            return datatables()->of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row['created_at'])->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = "<a class='btn waves-effect btn-warning' href='javascript:;' onclick='edit(`users`, " . $row['id'] . ")'><i class='fa fa-edit''></i> Edit</a> ";
                    $actionBtn .= "<a class='btn waves-effect btn-danger' href='javascript:;' onclick='hapus(`users`, " . $row['id'] . ")'><i class='fa fa-trash''></i> Hapus</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function getuser(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
            ]);
            $data = User::where([
                ['id', $request['id']],
            ])->first();
            if (empty($data)) throw new \ErrorException('Tidak dapat mengambil data');
            return response()->json([
                'status' => true,
                'message' => 'Berhasil',
                'data' => $data
            ]);
        } catch (\ErrorException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
