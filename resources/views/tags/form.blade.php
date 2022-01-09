@extends('layout')

@section('page-title')
    {{ isset($tag) ? 'Atualizar tag' : 'Adicionar tag' }}
@endsection

@section('title')
    {{ isset($tag) ? 'Atualizar tag' : 'Adicionar nova tag' }}
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-group">
                @foreach ($errors->all() as $error)
                    <li style="list-style: none;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (!empty($message))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <form method="post">
        @csrf
        <div class="row">
            <div class="col col-9">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ isset($tag) ? $tag->name : '' }}">
            </div>
            <div class="col col-3 form-tag-buttons">
                <button class="btn btn-dark">{{ isset($tag) ? 'Salvar' : 'Adicionar' }}</button>
                <a href="{{ route('tags.index') }}" class="btn btn-light">{{ !empty($message) ? 'Voltar' : 'Cancelar '}}</a>
            </div>
        </div>
    </form>
@endsection   