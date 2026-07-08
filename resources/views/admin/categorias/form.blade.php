<div class="form-group">

    <label>Nome</label>

    <input type="text" name="nome" class="form-control" value="{{ old('nome', $categoria->nome ?? '') }}" required>

</div>

<div class="form-group">

    <label>Descrição</label>

    <textarea name="descricao" class="form-control" rows="4">{{ old('descricao', $categoria->descricao ?? '') }}</textarea>

</div>

<div class="form-group">

    <label>Status</label>

    <select name="status" class="form-control">

        <option value="ativo">
            Ativo
        </option>

        <option value="inativo">
            Inativo
        </option>

    </select>

</div>

<button class="btn-primary">

    Salvar

</button>

<button class="btn-secondary" type="button" onclick="window.history.back()">

    Cancelar

</button>
