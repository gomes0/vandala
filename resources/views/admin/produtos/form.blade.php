<div class="form-container">

    <div class="form-group">

        <label>Nome do Produto</label>

        <input
            type="text"
            name="nome"
            class="form-control"
            value="{{ old('nome', $produto->nome ?? '') }}"
            required
        >

    </div>

    <div class="form-group">

        <label>Descrição</label>

        <textarea
            name="descricao"
            class="form-control"
            rows="5"
        >{{ old('descricao', $produto->descricao ?? '') }}</textarea>

    </div>

    <div class="form-row">

        <div class="form-group">

            <label>Categoria</label>

            <select
                name="categoria_id"
                class="form-control"
                required
            >

                <option value="">Selecione</option>

                @foreach($categorias as $categoria)

                    <option
                        value="{{ $categoria->id }}"
                        @selected(old('categoria_id', $produto->categoria_id ?? '') == $categoria->id)
                    >
                        {{ $categoria->nome }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="form-group">

            <label>Preço</label>

            <input
                type="number"
                step="0.01"
                name="preco"
                class="form-control"
                value="{{ old('preco', $produto->preco ?? '') }}"
                required
            >

        </div>

    </div>

    <div class="form-row">

        <div class="form-group">

            <label>Estoque</label>

            <input
                type="number"
                name="estoque"
                class="form-control"
                value="{{ old('estoque', $produto->estoque ?? 0) }}"
            >

        </div>

        <div class="form-group">

            <label>Status</label>

            <select
                name="status"
                class="form-control"
            >

                <option value="ativo"
                    @selected(old('status', $produto->status ?? '') == 'ativo')>

                    Ativo

                </option>

                <option value="inativo"
                    @selected(old('status', $produto->status ?? '') == 'inativo')>

                    Inativo

                </option>

            </select>

        </div>

    </div>

    <div class="form-actions">

        <a
            href="{{ route('produtos.index') }}"
            class="btn-secondary"
        >

            Cancelar

        </a>

        <button
            type="submit"
            class="btn-primary"
        >

            Salvar Produto

        </button>

    </div>

</div>