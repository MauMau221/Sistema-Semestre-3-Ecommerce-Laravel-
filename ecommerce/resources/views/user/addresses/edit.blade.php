@extends('master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Editar Endereço</h2>
    
    <div class="row">
        <div class="col-md-3">
            <!-- Menu lateral -->
            <div class="list-group mb-4">
                <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-user me-2"></i> Meus Dados
                </a>
                <a href="{{ route('user.addresses.index') }}" class="list-group-item list-group-item-action active">
                    <i class="fa-solid fa-location-dot me-2"></i> Meus Endereços
                </a>
                <a href="{{ route('user.orders') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-box me-2"></i> Meus Pedidos
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Editar Endereço</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.addresses.update', $address->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="cep" class="form-label">CEP*</label>
                                <input type="text" class="form-control @error('cep') is-invalid @enderror" id="cep" name="cep" value="{{ old('cep', $address->cep) }}" required>
                                @error('cep')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank" class="text-decoration-none text-dark small">
                                    <i class="fa-solid fa-search me-1"></i> Não sei meu CEP
                                </a>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="logradouro" class="form-label">Logradouro*</label>
                                <input type="text" class="form-control @error('logradouro') is-invalid @enderror" id="logradouro" name="logradouro" value="{{ old('logradouro', $address->logradouro) }}" required>
                                @error('logradouro')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="numero" class="form-label">Número*</label>
                                <input type="text" class="form-control @error('numero') is-invalid @enderror" id="numero" name="numero" value="{{ old('numero', $address->numero) }}" required>
                                @error('numero')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="complemento" class="form-label">Complemento</label>
                                <input type="text" class="form-control @error('complemento') is-invalid @enderror" id="complemento" name="complemento" value="{{ old('complemento', $address->complemento) }}">
                                @error('complemento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="bairro" class="form-label">Bairro*</label>
                                <input type="text" class="form-control @error('bairro') is-invalid @enderror" id="bairro" name="bairro" value="{{ old('bairro', $address->bairro) }}" required>
                                @error('bairro')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="cidade" class="form-label">Cidade*</label>
                                <input type="text" class="form-control @error('cidade') is-invalid @enderror" id="cidade" name="cidade" value="{{ old('cidade', $address->cidade) }}" required>
                                @error('cidade')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="estado" class="form-label">Estado*</label>
                                <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                                    <option value="" disabled>UF</option>
                                    <option value="AC" {{ old('estado', $address->estado) == 'AC' ? 'selected' : '' }}>AC</option>
                                    <option value="AL" {{ old('estado', $address->estado) == 'AL' ? 'selected' : '' }}>AL</option>
                                    <option value="AP" {{ old('estado', $address->estado) == 'AP' ? 'selected' : '' }}>AP</option>
                                    <option value="AM" {{ old('estado', $address->estado) == 'AM' ? 'selected' : '' }}>AM</option>
                                    <option value="BA" {{ old('estado', $address->estado) == 'BA' ? 'selected' : '' }}>BA</option>
                                    <option value="CE" {{ old('estado', $address->estado) == 'CE' ? 'selected' : '' }}>CE</option>
                                    <option value="DF" {{ old('estado', $address->estado) == 'DF' ? 'selected' : '' }}>DF</option>
                                    <option value="ES" {{ old('estado', $address->estado) == 'ES' ? 'selected' : '' }}>ES</option>
                                    <option value="GO" {{ old('estado', $address->estado) == 'GO' ? 'selected' : '' }}>GO</option>
                                    <option value="MA" {{ old('estado', $address->estado) == 'MA' ? 'selected' : '' }}>MA</option>
                                    <option value="MT" {{ old('estado', $address->estado) == 'MT' ? 'selected' : '' }}>MT</option>
                                    <option value="MS" {{ old('estado', $address->estado) == 'MS' ? 'selected' : '' }}>MS</option>
                                    <option value="MG" {{ old('estado', $address->estado) == 'MG' ? 'selected' : '' }}>MG</option>
                                    <option value="PA" {{ old('estado', $address->estado) == 'PA' ? 'selected' : '' }}>PA</option>
                                    <option value="PB" {{ old('estado', $address->estado) == 'PB' ? 'selected' : '' }}>PB</option>
                                    <option value="PR" {{ old('estado', $address->estado) == 'PR' ? 'selected' : '' }}>PR</option>
                                    <option value="PE" {{ old('estado', $address->estado) == 'PE' ? 'selected' : '' }}>PE</option>
                                    <option value="PI" {{ old('estado', $address->estado) == 'PI' ? 'selected' : '' }}>PI</option>
                                    <option value="RJ" {{ old('estado', $address->estado) == 'RJ' ? 'selected' : '' }}>RJ</option>
                                    <option value="RN" {{ old('estado', $address->estado) == 'RN' ? 'selected' : '' }}>RN</option>
                                    <option value="RS" {{ old('estado', $address->estado) == 'RS' ? 'selected' : '' }}>RS</option>
                                    <option value="RO" {{ old('estado', $address->estado) == 'RO' ? 'selected' : '' }}>RO</option>
                                    <option value="RR" {{ old('estado', $address->estado) == 'RR' ? 'selected' : '' }}>RR</option>
                                    <option value="SC" {{ old('estado', $address->estado) == 'SC' ? 'selected' : '' }}>SC</option>
                                    <option value="SP" {{ old('estado', $address->estado) == 'SP' ? 'selected' : '' }}>SP</option>
                                    <option value="SE" {{ old('estado', $address->estado) == 'SE' ? 'selected' : '' }}>SE</option>
                                    <option value="TO" {{ old('estado', $address->estado) == 'TO' ? 'selected' : '' }}>TO</option>
                                </select>
                                @error('estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="endereco_principal" name="endereco_principal" value="1" {{ old('endereco_principal', $address->endereco_principal) ? 'checked' : '' }}>
                            <label class="form-check-label" for="endereco_principal">Definir como endereço principal</label>
                        </div>
                        
                        <div class="d-flex mt-4">
                            <button type="submit" class="btn btn-dark me-2">Atualizar Endereço</button>
                            <a href="{{ route('user.addresses.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Adicione scripts para consulta de CEP via API (como ViaCEP) aqui
    document.getElementById('cep').addEventListener('blur', function() {
        const cep = this.value.replace(/\D/g, '');
        
        if (cep.length !== 8) {
            return;
        }
        
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('logradouro').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('estado').value = data.uf;
                    // Foca no campo número após preencher os dados
                    document.getElementById('numero').focus();
                }
            })
            .catch(error => console.error('Erro ao buscar CEP:', error));
    });
</script>
@endpush 