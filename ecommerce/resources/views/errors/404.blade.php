@extends('master')
<style>
    .ghost {
        font-size: 6rem;
        animation: bounce 2s infinite;
    }
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
</style>
<div class="container">
    <div class="row min-vh-100 align-items-center justify-content-center">
        <div class="col-md-8 text-center">
            <div class="ghost mb-4">👻</div>
            <h1 class="display-4 fw-bold mb-4">404 - Page Not Found / Pagina não encontrada</h1>
            <p class="lead mb-5">
                Ops! Parece que você se aventurou em território desconhecido.
            </p>
            <a href="/" class="btn btn-dark btn-lg">Return to Home</a>
        </div>
    </div>
</div>