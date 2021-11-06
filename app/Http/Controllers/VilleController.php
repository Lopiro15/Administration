<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ville;

class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('q') != null) {
            $villes = Ville::where('nom_ville', 'like', '%' . request('q') . '%')->orderBy('nom_ville')->paginate(4);
            return response()->json($villes);
        } else {
            return $this->refresh();
        }
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
        $ville = Ville::create($request->all());

        if($ville) {
            return $this->refresh();
        }else {
            return response()->json();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function edit($id)
    {
        $ville = Ville::find($id);
        return response()->json($ville);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $ville = Ville::find($id);
        $ville->nom_ville = request('nom_ville');
        $ville->save();
        if($ville) {
            return $this->refresh();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ville = Ville::find($id);
        
        if($ville->delete()){
            return $this->refresh();
        }
    }

    private function refresh()
    {
        # code...
        $villes = Ville::orderBy('nom_ville')->paginate(4);
        return response()->json($villes);
    }
}
