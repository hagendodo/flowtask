<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = DB::table('members as t1')
            ->select([
                'nim',
                'nowa',
                'nama',
                'harapan',
                'bidang',
                DB::raw("CONVERT_TZ(created_at, 'UTC', 'Asia/Jakarta') AS waktu_pendaftaran"),
            ])
            ->where('created_at', function ($query) {
                $query->select(DB::raw('MIN(created_at)'))
                    ->from('members as t2')
                    ->whereColumn('t1.nim', 't2.nim')
                    ->whereRaw('LENGTH(t1.nim) > 8 AND LENGTH(t1.nowa) > 8');
            })
            ->get();

        return view('member.index', compact('datas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $attributes = [
                'nowa' => $request->nowa,
                'nama' => $request->nama,
                'nim' => $request->nim,
                'harapan' => "",
                'bidang' => ""
            ];

            if (isset($request->harapan)) {
                $attributes['harapan'] = $request->harapan;
            }

            if (isset($request->bidang)) {
                $bidangValues = is_array($request->bidang) ? implode(', ', $request->bidang) : '';

                if (isset($request->bidang_lainnya)) {
                    $bidangValues .= ($bidangValues ? ', ' : '') . $request->bidang_lainnya;
                }

                $attributes['bidang'] = $bidangValues;
            }

            Member::create($attributes);

            return response()->json(['status' => 'success'], 200);
        } catch (QueryException $e) {
            // Handle database-related exceptions
            return response()->json(['status' => 'error', 'message' => 'Database error'], 500);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $label)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $label)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $label)
    {
        //
    }
}
