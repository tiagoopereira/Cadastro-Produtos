@extends('layout')

@section('page-title')
    Produtos
@endsection

@section('title')
    Produtos
@endsection

@section('header-buttons')
    <a href="{{ route('products.create') }}" class="btn btn-dark">Adicionar Produto</a>
@endsection

@section('content')
    @if (!empty($message))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    @if (!count($products))
        <div class="not-found">
            <p class="not-found-message">Nenhum produto encontrado :(</p>
            <p class="not-found-message">Adicione novos produtos para visualizá-los aqui!</p>
        </div>
    @else
        <table class="table table-bordered table-hover products-table">
            <tr class="table-dark">
                <th scope="col" class="col col-2">Nome</th>
                <th scope="col" class="col col-9">Tags</th>
                <th scope="col" class="col col-1">Ações</th>
            </tr>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <a href="{{ route('products.find', ['id' => $product->id]) }}">
                                {{ $product->name }}
                            </a>
                        </td>
                        <td>
                            @if (count($product->tags))
                                <ul class="list-inline products-list-tags"> 
                                    @foreach ($product->tags as $tag)
                                        <li class="list-inline-item">
                                            <div class="products-list-tag-name">{{ $tag->name }}</div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                -
                            @endif
                        </td>
                        <td class="product-table-actions">
                            <form method="post" action="/products/{{ $product->id }}" onsubmit="return confirm('Tem certeza que deseja excluir o produto {{ $product->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection