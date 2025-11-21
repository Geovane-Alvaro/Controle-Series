
<x-layout title="Series">
    <a href="{{route('series.create') }}" class="btn btn-dark mb-3">Adicionar</a>

    @isset($mensagemSucesso)
    <div class="alert alert-success">
    {{$mensagemSucesso}}
    </div>
    @endisset

    <ul class="list-group">
         @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center"><a href="{{route('seasons.index', $serie->id)}}">{{ $serie->nome }}</a>
            <div class="d-flex gap-1">

                <a href="{{route('series.edit', $serie->id)}}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>

                <form action="{{route('series.destroy', $serie->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                
            </div>
        </li>
         @endforeach

    </ul>

</x-layout>