<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\CreateProductService;
use App\Http\Requests\ProductFormRequest;

class ProductsController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::all();
        $message = $request->session()->get('message');

        return view('products.index', compact('products', 'message'));
    }

    public function find(Request $request): View
    {
        $product = Product::find($request->id);
        $tags = Tag::all();
        $message = $request->session()->get('message');

        return view('products.form', compact('product', 'tags', 'message'));
    }

    public function create(): View
    {
        $tags = Tag::all();
        return view('products.form', compact('tags'));
    }

    public function store(ProductFormRequest $request, CreateProductService $service): RedirectResponse
    {
        $product = $service->create($request->name, $request->tags);
        $request->session()->flash('message', "O produto {$product->name} foi adicionado com sucesso!");

        return redirect()->route('products.index');
    }

    public function update(int $id, Request $request, CreateProductService $service): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('products', 'name')->ignore($id)
            ]
        ]);

        $name = $request->name;
        $tags = $request->tags;

        $product = Product::find($id);
        $product->name = $name;
        $product->save();

        $service->addTagsToProduct($product, $tags);

        $request->session()->flash('message', "O produto {$product->name} foi atualizado com sucesso!");

        return redirect()->route('products.find', ['id' => $id]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $product = Product::findOrFail($request->id);
        $product->delete();

        $request->session()->flash('message', "O produto {$product->name} foi removido com sucesso!");

        return redirect()->route('products.index');
    }
}