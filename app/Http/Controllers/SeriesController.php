<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Season;
use App\Models\Episode;

class SeriesController extends Controller{
           public function index(Request $request){

            $series = Serie::all();
            $mensagemSucesso = session('mensagem.sucesso');
            
            return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create(){

        return view('series.create');
        
    }

    public function store (SeriesFormRequest $request){

        $serie = DB::transaction(function() use ($request){
        $serie = Serie::create($request->all());
        $seasons = [];

        for ($i = 1; $i <=$request->seasonQty; $i++){
            $seasons[]= [
                'series_id' => $serie->id,
                'number' => $i,  
            ];
        }
        Season::insert($seasons);

        $episodes = [];

        foreach($serie->seasons as $season){
            for ($j = 1; $j <= $request->episodesPerSeason; $j++){
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j,
                ];
            }
        }
        Episode::insert($episodes);
        return $serie;
    });

        return to_route('series.index')->with('mensagem.sucesso', "Serie '{$serie->nome}' adicionada com sucesso!");
        
    }


    public function destroy(Serie $series){

        $series->delete();

        return to_route('series.index')->with('mensagem.sucesso', "Serie '{$series->nome}' deletada com sucesso!");
        
    }

       public function edit(Serie $series){

        return view('series.edit')->with('serie', $series);
        
    }

    public function update(Serie $series, SeriesFormRequest $request){

        $series->nome = $request->nome;
        $series->save();
        return to_route('series.index')->with('mensagem.sucesso', "Serie '{$series->nome}' editada com sucesso!");
    }
}
