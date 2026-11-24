@csrf

<div class="endereco-form-grid">

    <div class="endereco-campo">
        <label for="nome_destinatario">Nome do destinatário *</label>
        <input type="text" id="nome_destinatario" name="nome_destinatario"
            value="{{ old('nome_destinatario', $endereco->nome_destinatario ?? '') }}" placeholder="Nome completo"
            required>
    </div>

    <div class="endereco-campo">
        <label for="telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $endereco->telefone ?? '') }}"
            placeholder="(00) 00000-0000">
    </div>

    <div class="endereco-campo">
        <label for="cep">CEP *</label>
        <input type="text" id="cep" name="cep" value="{{ old('cep', $endereco->cep ?? '') }}"
            placeholder="00000-000" maxlength="9" required>
        <small id="cep-feedback" style="color: #aaa; font-size: 12px;"></small>
    </div>

    <div class="endereco-campo">
        <label for="rua">Rua *</label>
        <input type="text" id="rua" name="rua" value="{{ old('rua', $endereco->rua ?? '') }}"
            placeholder="Nome da rua" required>
    </div>

    <div class="endereco-campo">
        <label for="numero">Número *</label>
        <input type="text" id="numero" name="numero" value="{{ old('numero', $endereco->numero ?? '') }}"
            placeholder="Número" required>
    </div>

    <div class="endereco-campo">
        <label for="complemento">Complemento</label>
        <input type="text" id="complemento" name="complemento"
            value="{{ old('complemento', $endereco->complemento ?? '') }}" placeholder="Apartamento, bloco etc.">
    </div>

    <div class="endereco-campo">
        <label for="bairro">Bairro *</label>
        <input type="text" id="bairro" name="bairro" value="{{ old('bairro', $endereco->bairro ?? '') }}"
            placeholder="Bairro" required>
    </div>

    <div class="endereco-campo">
        <label for="cidade">Cidade *</label>
        <input type="text" id="cidade" name="cidade" value="{{ old('cidade', $endereco->cidade ?? '') }}"
            placeholder="Cidade" required>
    </div>

    <div class="endereco-campo">
        <label for="estado">Estado *</label>
        <input type="text" id="estado" name="estado" value="{{ old('estado', $endereco->estado ?? '') }}"
            placeholder="UF" maxlength="2" required>
    </div>

</div>

<label class="endereco-principal">
    <input type="checkbox" name="principal" value="1"
        {{ old('principal', $endereco->principal ?? false) ? 'checked' : '' }}>
    Definir como endereço principal
</label>

<div class="endereco-acoes">
    <a href="{{ route('enderecos.index') }}">Cancelar</a>
    <button type="submit">{{ $botao }}</button>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const campoCep = document.getElementById('cep');
            const feedback = document.getElementById('cep-feedback');

            if (!campoCep) return;

            campoCep.addEventListener('input', function() {
                let valor = this.value.replace(/\D/g, '').substring(0, 8);

                if (valor.length > 5) {
                    valor = valor.replace(/^(\d{5})(\d)/, '$1-$2');
                }

                this.value = valor;
            });

            campoCep.addEventListener('blur', async function() {
                const cep = this.value.replace(/\D/g, '');

                if (cep.length !== 8) {
                    feedback.textContent = cep.length ? 'Digite um CEP válido.' : '';
                    return;
                }

                feedback.textContent = 'Consultando CEP...';

                try {
                    const resposta = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                    const dados = await resposta.json();

                    if (dados.erro) {
                        feedback.textContent = 'CEP não encontrado.';
                        return;
                    }

                    document.getElementById('rua').value = dados.logradouro || '';
                    document.getElementById('bairro').value = dados.bairro || '';
                    document.getElementById('cidade').value = dados.localidade || '';
                    document.getElementById('estado').value = dados.uf || '';

                    feedback.textContent = 'Endereço encontrado com sucesso!';
                } catch (erro) {
                    feedback.textContent = 'Não foi possível consultar o CEP. Tente novamente.';
                }
            });

            const estado = document.getElementById('estado');

            estado?.addEventListener('input', function() {
                this.value = this.value.toUpperCase().substring(0, 2);
            });
        });
    </script>
@endpush
