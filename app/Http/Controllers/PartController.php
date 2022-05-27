<?php

namespace App\Http\Controllers;
use App\Models\Parts;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allParts = Parts::all();
        return view('parts.parts-index', [
            'allParts' => $allParts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parts.parts-new');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        Parts::create($input);

        return redirect('/parts/create')->with('success', 'Part is successfully saved');    }

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
    public function edit(int $partID)
    {
        $part = Parts::find($partID);
        return view('parts.parts-new', compact('part'));

    }

    public function update(int $partID, Request $request, Parts $parts)
    {
        $part = Parts::find($partID);
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
            $part->update(['image' => $profileImage]);

        }
        $part->update($input);

        return redirect()->route('parts.index')->with('status', 'Part updated');

    }

    public function destroy(int $partID, Parts $parts)
    {
        $part = Parts::find($partID);
        $parts->destroy($partID);
        return redirect()->route('parts.index')
                         ->withSuccess(__('Post delete successfully.'));
    }

}
