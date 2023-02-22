<?php

namespace App\Http\Controllers;

use App\Http\Requests\Proyect\ProyectStoreRequest;
use App\Models\Proyect;
use Illuminate\Http\Request;

class ProyectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyects = Proyect::all();
        return view('proyect.index', compact('proyects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proyect.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProyectStoreRequest $request)
    {
        $proyect = Proyect::create($request->all());
        return redirect()->route('proyect.edit',$proyect)->with('success', 'Proyecto creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proyect  $proyect
     * @return \Illuminate\Http\Response
     */
    public function show(Proyect $proyect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proyect  $proyect
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyect $proyect)
    {
        return view('proyect.edit', compact('proyect'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proyect  $proyect
     * @return \Illuminate\Http\Response
     */
    public function update(ProyectStoreRequest $request, Proyect $proyect)
    {
        $proyect->update($request->validated());
        return redirect()->back()->with('success', 'Proyecto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proyect  $proyect
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyect $proyect)
    {
        $proyect->delete();
        return response('Registro eliminado con éxito');
    }

}
