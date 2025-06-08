@extends('master')

@section('content')
    <section>
        <div class="login d-flex justify-content-center mt-5">
            <div class="form-container form-login">
                <p class="title">Cadastre-se</p>
                <form class="form" action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <label for="name">Nome</label>
                        <input type="name" name="name" id="name" placeholder="Informe seu nome">
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="input-group">
                        <label for="password">Senha</label>
                        <input type="password" name="password" id="password" placeholder="Senha">
                        <label for="passwordConfirma">Repita senha</label>
                        <input class="mb-3" type="password" name="password_confirmation" id="password_confirmation" placeholder="Cofirmar senha">
                    </div>
                    <button class="sign" type="submit">Cadastrar</button>
                </form>
                <div class="social-message">
                    <div class="line"></div>
                    <p class="message">Login com redes sociais</p>
                    <div class="line"></div>
                </div>
                <div class="social-icons">
                    <button aria-label="Login com Google" class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
                            <path
                                d="M16.318 13.714v5.484h9.078c-0.37 2.354-2.745 6.901-9.078 6.901-5.458 0-9.917-4.521-9.917-10.099s4.458-10.099 9.917-10.099c3.109 0 5.193 1.318 6.38 2.464l4.339-4.182c-2.786-2.599-6.396-4.182-10.719-4.182-8.844 0-16 7.151-16 16s7.156 16 16 16c9.234 0 15.365-6.49 15.365-15.635 0-1.052-0.115-1.854-0.255-2.651z">
                            </path>
                        </svg>
                    </button>
                </div>
                <p class="signup">Já tem conta?
                    <a rel="noopener noreferrer" href="{{ route('home.login') }}" class="">Faça seu login aqui</a>
                </p>
            </div>
        </div>
    </section>
@endsection
