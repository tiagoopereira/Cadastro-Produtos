@extends('layout')

@section('page-title')
    Tags
@endsection

@section('title')
    Tags
@endsection

@section('header-buttons')
    <a href="{{ route('tags.create') }}" class="btn btn-dark">Adicionar Tag</a>
@endsection

@section('content')
    @if (!empty($message))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    @if (!count($tags))
        <div class="not-found">
            <p class="not-found-message">Nenhuma tag encontrada :(</p>
            <p class="not-found-message">Adicione novas tags para visualizá-las aqui!</p>
        </div>
    @endif

    <ul class="list-group">
        @foreach ($tags as $tag)
            <li class="list-group-item d-flex justify-content-between">
                <a href="{{ route('tags.find', ['id' => $tag->id]) }}">{{ $tag->name }}</a>
                <div>
                    <form method="post" action="/tags/{{ $tag->id }}" onsubmit="return confirm('Tem certeza que deseja excluir a tag {{ $tag->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection