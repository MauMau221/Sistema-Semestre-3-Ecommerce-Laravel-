<?php

namespace App\Services;

use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Support\Facades\DB;

class EstoqueService
{
    public function verificarDisponibilidade($produtoId, $quantidade, $cor = null, $tamanho = null)
    {
        $estoque = Estoque::where('produto_id', $produtoId)
            ->when($cor, function ($query) use ($cor) {
                return $query->where('cor', $cor);
            })
            ->when($tamanho, function ($query) use ($tamanho) {
                return $query->where('tamanho', $tamanho);
            })
            ->first();

        return $estoque && $estoque->quantidade >= $quantidade;
    }

    public function atualizarEstoque($produtoId, $quantidade, $cor = null, $tamanho = null)
    {
        try {
            DB::beginTransaction();

            $estoque = Estoque::where('produto_id', $produtoId)
                ->when($cor, function ($query) use ($cor) {
                    return $query->where('cor', $cor);
                })
                ->when($tamanho, function ($query) use ($tamanho) {
                    return $query->where('tamanho', $tamanho);
                })
                ->first();

            if (!$estoque) {
                throw new \Exception('Estoque não encontrado');
            }

            if ($estoque->quantidade < $quantidade) {
                throw new \Exception('Quantidade indisponível em estoque');
            }

            $estoque->quantidade -= $quantidade;
            $estoque->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function adicionarEstoque($produtoId, $quantidade, $cor = null, $tamanho = null)
    {
        try {
            DB::beginTransaction();

            $estoque = Estoque::where('produto_id', $produtoId)
                ->when($cor, function ($query) use ($cor) {
                    return $query->where('cor', $cor);
                })
                ->when($tamanho, function ($query) use ($tamanho) {
                    return $query->where('tamanho', $tamanho);
                })
                ->first();

            if (!$estoque) {
                $estoque = new Estoque([
                    'produto_id' => $produtoId,
                    'cor' => $cor,
                    'tamanho' => $tamanho,
                    'quantidade' => 0
                ]);
            }

            $estoque->quantidade += $quantidade;
            $estoque->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
} 