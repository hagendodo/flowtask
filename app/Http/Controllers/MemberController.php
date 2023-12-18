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
            $now = now()->setTimezone('Asia/Jakarta');

            $memberData = [
                'nowa' => $request->nowa,
                'nama' => $request->nama,
                'nim' => $request->nim,
                'harapan' => $request->input('harapan', ''),
                'bidang' => $request->input('bidang', ''),
                'created_at' => $now,
                'updated_at' => $now,
            ];

            DB::transaction(function () use ($memberData) {
                DB::table('members')->insert($memberData);

                DB::table('last_members')->limit(1)->delete();

                DB::table('last_members')->insert($memberData);
            });

            return response()->json(['status' => 'success'], 200);
        } catch (QueryException $e) {
            return response()->json(['status' => 'error', 'message' => 'Database error'], 500);
        } catch (\Exception $e) {
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
