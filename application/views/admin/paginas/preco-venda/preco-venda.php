<div class="content">
    <div class="row mb-3">
        <!-- Select Cliente -->
        <div class="col-md-3">
            <label for="select_cliente" class="form-label">Cliente</label>
            <select class="form-select select2" id="select_cliente" name="select_cliente">
                <option value="" selected disabled>Selecione o cliente</option>
                <?php foreach ($clientes as $cliente) : ?>
                    <option value="<?= $cliente['id'] ?>"><?= $cliente['nome_fantasia'] ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <!-- Select Projeto (inicialmente oculto) -->
        <div class="col-md-3 d-none" id="projeto-container">
            <label for="select_projetos_cliente" class="form-label">Projeto</label>
            <select class="form-select select2" id="select_projetos_cliente" name="select_projetos_cliente">
                <!-- Manipulado J.S. -->
            </select>
        </div>
    </div>
    <div class="container-fluid p-4 bg-light shadow rounded">
        <div class="row mb-4">
            <!-- Linha 1 -->
            <div class="col-md-3">
                <label for="descricao_produto" class="form-label">Descrição do Produto</label>
                <textarea class="form-control" id="descricao_produto" name="descricao_produto" placeholder="Digite a descrição" rows="1"></textarea>
            </div>
            <div class="col-md-3">
                <label for="ncm" class="form-label">NCM</label>
                <input type="text" disabled class="form-control" id="ncm" name="ncm">
            </div>
            <div class="col-md-2">
                <label for="descricao_ncm" class="form-label">Descrição do NCM</label>
                <input type="text" disabled class="form-control" id="descricao_ncm" name="descricao_ncm">
            </div>
            <div class="col-md-2">
                <label for="lote_partida" class="form-label">Lote de Partida</label>
                <input type="text" disabled class="form-control" id="lote_partida" name="lote_partida">
            </div>
            <div class="col-md-2">
                <label for="custo_produto" class="form-label">Custo do Produto</label>
                <input type="text" class="form-control" id="custo_produto" name="custo_produto" placeholder="Digite o custo do produto">
            </div>
        </div>

        <div class="row mb-4">
            <!-- Linha 2 -->
            <div class="col-md-3">
                <label for="custo_mo" class="form-label">Custo M.O.</label>
                <input type="text" class="form-control" id="custo_mo" name="custo_mo" placeholder="Digite o custo de M.O.">
            </div>
            <div class="col-md-3">
                <label for="embalagem" class="form-label">Embalagem</label>
                <input type="text" class="form-control" id="embalagem" name="embalagem" placeholder="Digite a embalagem">
            </div>
            <div class="col-md-2">
                <label for="perda" class="form-label">Perda</label>
                <input type="text" class="form-control" id="perda" name="perda" placeholder="Digite a perda">
            </div>
            <div class="col-md-2">
                <label for="frete_porcentagem" class="form-label">Frete</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="frete_porcentagem" name="frete_porcentagem" style="flex: 1 1 auto; max-width: 56px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="form-control" id="frete_calculado" name="frete_calculado">
                </div>
            </div>
            <div class="col-md-2">
                <label for="custo_financeiro" class="form-label">Custo Financeiro</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="custo_financeiro" name="custo_financeiro" style="flex: 1 1 auto; max-width: 56px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="form-control" id="custo_financeiro-calculado" name="custo_financeiro-calculado">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <!-- Linha 3 -->
            <div class="col-md-3">
                <label for="margem_percentual" class="form-label">Margem (%)</label>
                <input type="text" class="form-control" id="margem_percentual" name="margem_percentual" placeholder="Digite a margem (%)">
            </div>
            <div class="col-md-3">
                <label for="margem_reais" class="form-label">Margem (R$)</label>
                <input type="text" disabled class="form-control" id="margem_reais" name="margem_reais">
            </div>
            <div class="col-md-2">
                <label for="sub_total" class="form-label">Sub-Total</label>
                <input type="text" class="form-control" id="sub_total" name="sub_total" placeholder="Digite o sub-total">
            </div>
            <div class="col-md-2">
                <label for="comissao_percentual" class="form-label">Comissão (%)</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="comissao_percentual" name="comissao_percentual" style="flex: 1 1 auto; max-width: 56px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="form-control" id="comissao_calculada" name="comissao_calculada">
                </div>
            </div>
            <div class="col-md-2">
                <label for="total_sem_imposto" class="form-label">Total Sem Imposto</label>
                <input type="text" class="form-control" id="total_sem_imposto" name="total_sem_imposto" placeholder="Digite o total sem imposto">
            </div>
        </div>

        <div class="row mb-4">
            <!-- Linha 4 -->
            <div class="col-md-3">
                <label for="imposto_percentual" class="form-label">Imposto (%)</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="imposto_percentual" name="imposto_percentual" style="flex: 1 1 auto; max-width: 70px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="form-control" id="imposto_calculado" name="imposto_calculado">
                </div>
            </div>

            <div class="col-md-3">
                <label for="total_unitario" class="form-label">Total Unit. (R$)</label>
                <input type="text" class="form-control" id="total_unitario" name="total_unitario" placeholder="Digite o total unit. (R$)">
            </div>
            <div class="col-md-2">
                <label for="st_estado_percentual" class="form-label">ST do Estado (%)</label>
                <input type="text" class="form-control" id="st_estado_percentual" name="st_estado_percentual" placeholder="Digite o ST do estado (%)">
            </div>
            <div class="col-md-2">
                <label for="st_reais" class="form-label">ST em R$</label>
                <input type="text" class="form-control" id="st_reais" name="st_reais" placeholder="Digite o ST em R$">
            </div>
            <div class="col-md-2">
                <label for="valor_total_com_st" class="form-label">Valor Total com ST</label>
                <input type="text" class="form-control" id="valor_total_com_st" name="valor_total_com_st" placeholder="Digite o valor total com ST">
            </div>
        </div>
    </div>