<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return Categoria::all();
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $categoria = Categoria::create($data);

        return $categoria;
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
