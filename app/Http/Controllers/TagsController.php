<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\View\View;
use App\Http\Requests\TagFormRequest;
use Illuminate\Http\RedirectResponse;

class TagsController extends Controller
{
    public function index(Request $request): View
    {
        $tags = Tag::all();
        $message = $request->session()->get('message');

        return view('tags.index', compact('tags', 'message'));
    }

    public function find(Request $request): View
    {
        $tag = Tag::find($request->id);
        $message = $request->session()->get('message');

        return view('tags.form', compact('tag', 'message'));
    }

    public function create(): View
    {
        return view('tags.form');
    }

    public function store(TagFormRequest $request): RedirectResponse
    {
        $tag = Tag::create($request->all());
        $request->session()->flash('message', "A tag {$tag->name} foi adicionada com sucesso!");

        return redirect()->route('tags.index');
    }

    public function update(int $id, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('tags', 'name')->ignore($id)
            ]
        ]);

        $name = $request->name;

        $tag = Tag::find($id);
        $tag->name = $name;
        $tag->save();

        $request->session()->flash('message', "A tag {$tag->name} foi atualizada com sucesso!");

        return redirect()->route('tags.find', ['id' => $id]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $tag = Tag::findOrFail($request->id);
        $tag->delete();

        $request->session()->flash('message', "A tag {$tag->name} foi removida com sucesso!");

        return redirect()->route('tags.index');
    }
}