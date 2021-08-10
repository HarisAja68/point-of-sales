<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.index');
    }

    public function data()
    {
        $member = Member::orderBy('kode_member')->get();

        return datatables()
            ->of($member)
            ->addIndexColumn()
            ->addColumn('select_all', function ($member) {
                return '
                    <input type="checkbox" name="id_member[]" value="' . $member->id_member . '">
                ';
            })
            ->addColumn('kode_member', function ($member) {
                return '<span class="badge badge-info">' . $member->kode_member . '</span>';
            })
            ->addColumn('aksi', function ($member) {
                return '
                    <button type="button" onclick="editForm(`' . route('member.update', $member->id_member) . '`)" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</button>
                    <button type="button" onclick="deleteData(`' . route('member.destroy', $member->id_member) . '`)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                ';
            })
            ->rawColumns(['aksi', 'kode_member', 'select_all'])
            ->make(true);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = Member::latest()->first() ?? new Member();
        $kode_member = (int)$member->kode_member + 1 ?? 1;

        $member = new Member();
        $member->kode_member = tambahNolDepan($kode_member, 5);
        $member->nama = $request->nama;
        $member->telepon = $request->telepon;
        $member->alamat = $request->alamat;
        $member->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);

        return response()->json($member);
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
        $member = Member::find($id)->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();

        return response(null, 204);
    }

    public function cetakMember(Request $request)
    {
        // $datamember = collect(array());
        // foreach ($request->id_member as $id) {
        //     $member = Member::find($id);
        //     $datamember[] = $member;
        // }

        // $datamember = $datamember->chunk(2);

        // $no  = 1;
        // $pdf = PDF::loadView('member.cetak', compact('datamember', 'no'));
        // $pdf->setPaper(array(0, 0, 566.93, 850.39), 'potrait');
        // return $pdf->stream('member.pdf');

        $datamember = collect(array());
        foreach ($request->id_member as $id) {
            $member = Member::find($id);
            $datamember[] = $member;
        }

        $datamember = $datamember->chunk(2);
        $no  = 1;
        $pdf = PDF::loadView('member.cetak', compact('datamember', 'no'));
        $pdf->setPaper(array(0, 0, 566.93, 850.39), 'potrait');
        return $pdf->stream('member.pdf');
    }
}
