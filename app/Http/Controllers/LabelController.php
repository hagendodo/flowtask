<?php

namespace App\Http\Controllers;

use App\Models\HistoryLabel;
use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Label::with('history')->get();
        return view('label.index', compact(['datas']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('label.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $label = Label::create([
           'name' => $request->name,
           'description' => $request->description
        ]);

        HistoryLabel::create([
            'label_id' => $label->id,
            'estimation' => $request->estimation,
            'reality' => $request->estimation
        ]);

        return redirect()->route('label.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Label $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        $data = Label::with('history')->where('id', $label->id)->first();

        return view('label.form', compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        $label->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        HistoryLabel::create([
            'label_id' => $label->id,
            'estimation' => $request->estimation,
            'reality' => $request->reality
        ]);

        return redirect()->route('label.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        //
    }
}
