<x-layout title="Editar serie '{!!$serie->nome!!}'">


       <form action="{{route('series.update', $serie->id)}}" method="post">
        @csrf
         <div class="row mb-3">
            <div class="col-8">
               <label for="nome" class="form-label">Nome:</label>
               <input type="text" id="nome" name="nome" class="form-control" value="{{$serie->nome}}">
            </div>

            <div class="col-2">
               <label for="seasonQty" class="form-label">N° Temporadas:</label>
               <input type="text" id="seasonQty" name="seasonQty" class="form-control" value="{{$serie->seasons->count()}}">
            </div>

            <div class="col-2">
               <label for="episodesPerSeason" class="form-label">Eps / Temporada:</label>
               <input type="text" id="episodesPerSeason" name="episodesPerSeason" class="form-control" value="{{$serie->episodes}}">
            </div>
         </div>

        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>    

</x-layout>