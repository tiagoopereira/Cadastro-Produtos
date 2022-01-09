@extends('layout')

@section('page-title')
    {{ isset($product) ? 'Atualizar produto' : 'Adicionar produto' }}
@endsection

@section('title')
    {{ isset($product) ? 'Atualizar produto' : 'Adicionar novo produto' }}
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
            <div class="row">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ isset($product) ? $product->name : '' }}">
            </div>
            @if (isset($tags))
                <div class="row product-form-list-tags">
                    <label for="tag">Tags</label>
                    <div class="list-form-tags">
                        @foreach ($tags as $tag)
                            @if (isset($product))
                                <div class="form-check">
                                    <input class="form-check-input" id="tag" type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ $product->tags->contains('id', $tag->id) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $tag->name }}</label>
                                </div>
                            @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="tag" name="tags[]" value="{{ $tag->id }}">
                                    <label class="form-check-label">{{ $tag->name }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <button class="btn btn-dark">{{ isset($product) ? 'Salvar' : 'Adicionar' }}</button>
        <a href="{{ route('products.index') }}" class="btn btn-light">{{ !empty($message) ? 'Voltar' : 'Cancelar '}}</a>
    </form>
@endsection   