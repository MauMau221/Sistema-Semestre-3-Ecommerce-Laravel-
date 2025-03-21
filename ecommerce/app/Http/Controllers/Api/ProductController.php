<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return Produto::all();
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $produto = Produto::create($data);

        return $produto;
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
