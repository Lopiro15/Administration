<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Point_livraison;
use App\Ville;
use SebastianBergmann\Environment\Console;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('q') != null) {
            if (request('v') != 0) {
                # code...
                $points = Point_livraison::where('ville', request('v'))->where('nom_point', 'like', '%' . request('q') . '%')->orderBy('nom_point')->paginate(3);
                return response()->json($points);
            } else {
                $points = Point_livraison::where('nom_point', 'like', '%' . request('q') . '%')->orderBy('nom_point')->paginate(3);
                return response()->json($points);
            }
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
        $point = Point_livraison::create($request->all());

        if($point) {
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
        $point = Point_livraison::find($id);
        return response()->json($point);
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
        $point = Point_livraison::find($id);
        $point->nom_point = request('nom_point');
        $point->description = request('description');
        $point->prix = request('prix');
        $point->ville = request('ville');
        $point->save();
        if($point) {
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
        $point = Point_livraison::find($id);
        
        if($point->delete()){
            return $this->refresh();
        }
    }

    private function refresh()
    {
        # code...
        if (request('v') != 0) {
            # code...
            $points = Point_livraison::where('ville', request('v'))->orderBy('nom_point')->paginate(3);
            return response()->json($points);
        } else {
            $points = Point_livraison::orderBy('nom_point')->paginate(3);
            return response()->json($points);
        }
    }

    public function chargeville() 
    {
        $villes = Ville::orderBy('nom_ville')->get();
        return response() ->json($villes);
    }

    public function total()
    {
        $i = 0;
        $villesdata = Ville::orderBy('nom_ville')->get();
        $total[0] = Ville::count();
        $total[1] = Point_livraison::count();
        foreach ($villesdata as $ville) {
            # code...
            $villes[$i] = $ville['nom_ville'];
            $id = $ville['id'];
            $points[$i] = Point_livraison::Where('ville', $id)->count();
            $i++;
        }
        $chartdata =  [
            'labels' => $villes,
            'datasets' => [
                [
                    'label' => 'Nombre de point de livraison',
                    'backgroundColor' => 'rgba(52, 144, 220, 0.3)',
                    'data' => $points
                ],
            ]
        ];
        $options = [
            'responsive' => true,
            'maintainAspectRatio' => false
        ];
        $donnees = [
            'total' => $total,
            'chartdata' => $chartdata,
            'options' => $options
        ];
        return response() ->json($donnees);
    }
}
