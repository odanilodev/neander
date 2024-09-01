<div class="content">


    <div class="row-selects-preco-venda row mb-3">

        <div id="alerta-selecione-campos" class="alert alert-secondary" role="alert">
            Para liberar os campos, selecione um cliente, seu projeto e lote.
        </div>
        
        <!-- Select Cliente -->
        <div class="div_selects_preco_venda col-md-3">
            <label for="select_cliente" class="form-label">Cliente</label>
            <select class="form-select select2" id="select_cliente" name="select_cliente">
                <option value="" selected disabled>Selecione o cliente</option>
                <?php foreach ($clientes as $cliente) : ?>
                    <option value="<?= $cliente['id'] ?>"><?= $cliente['nome_fantasia'] ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <!-- Select Projeto (inicialmente apagado) -->
        <div class="div_selects_preco_venda col-md-3 inactive div_select_projeto_cliente">
            <label for="select_projetos_cliente" class="form-label">Projeto</label>
            <select class="form-select select2 select_projetos_cliente" name="select_projetos_cliente">
                <option value="" selected disabled>Selecione o Projeto</option>
                <!-- Manipulado J.S. -->
            </select>
        </div>

        <!-- Select tipo de lote (inicialmente apagado) -->
        <div class="div_selects_preco_venda col-md-3 inactive div_select_valor_lote">
            <label for="select_lote_projeto" class="form-label">Lote</label>
            <select class="form-select select2 select_lote_projeto" name="select_lote_projeto">
                <option value="" selected disabled>Selecione o cliente</option>
                <option value="50">Especial 50</option>
                <option value="100">100</option>
                <option value="340">340</option>
                <option value="560">560</option>
                <option value="1000">1000</option>
            </select>
        </div>
    </div>

    <div class="container-fluid p-4 bg-light shadow rounded container_campos_preco_venda">
        <div class="row mb-4 rows_preco_venda">
            <!-- Linha 1 -->
            <div class="col-md-3 div_input_preco_venda">
                <label for="descricao_produto" class="form-label">Descrição do Produto</label>
                <textarea class="form-control descricao_produto" name="descricao_produto" placeholder="Digite a descrição" rows="1"></textarea>
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="ncm" class="form-label">NCM</label>
                <input type="text" disabled class="form-control ncm" name="ncm">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="descricao_ncm" class="form-label">Descrição do NCM</label>
                <input type="text" disabled class="form-control descricao_ncm" name="descricao_ncm">
            </div>
            <div class="col-md-1 div_input_preco_venda">
                <label for="lote_partida" class="form-label">Lote Partida</label>
                <input type="text" disabled class="form-control lote_partida" name="lote_partida">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_custo_produto" class="form-label">Custo do Produto</label>
                <input disabled type="text" class="form-control text-1000 input_custo_produto" name="input_custo_produto">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_custo_mao_de_obra" class="form-label">Custo Mão de Obra</label>
                <input disabled type="text" class="form-control text-1000 input_custo_mao_de_obra" name="input_custo_mao_de_obra">
            </div>
        </div>

        <div class="row mb-4 rows_preco_venda">
            <!-- Linha 2 -->
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_embalagem" class="form-label">Custo Embalagem</label>
                <input disabled type="text" class="form-control text-1000 input_embalagem" name="input_embalagem">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_perda" class="form-label">Perda</label>
                <input disabled type="text" class="form-control text-1000 input_perda" name="input_perda">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_frete_porcentagem" class="form-label">Frete</label>
                <div class="input-group">
                    <input type="text" class="form-control input_frete_porcentagem input_porcentagem_disabled" name="input_frete_porcentagem" style="flex: 1 1 auto; max-width: 70px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="form-control input_frete_calculado text-1000" name="input_frete_calculado">
                </div>
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_custo_financeiro_porcentagem" class="form-label">Custo Financeiro</label>
                <div class="input-group">
                    <input type="text" class="form-control input_custo_financeiro_porcentagem input_porcentagem_disabled" name="input_custo_financeiro_porcentagem" style="flex: 1 1 auto; max-width: 70px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="form-control input_custo_financeiro_calculado text-1000" name="input_custo_financeiro_calculado">
                </div>
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="input_margem_porcentagem" class="form-label">Margem (% - R$)</label>
                <div class="input-group">
                    <input type="text" class="form-control input_margem_porcentagem input_porcentagem_disabled" name="input_margem_porcentagem" style="flex: 1 1 auto; max-width: 70px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="form-control text-1000 input_margem_reais">
                </div>
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="sub_total" class="form-label">Sub-Total</label>
                <input type="text" disabled class="form-control sub_total" name="sub_total">
            </div>
        </div>

        <div class="row mb-4 rows_preco_venda">
            <!-- Linha 3 -->
            <div class="col-md-2 div_input_preco_venda">
                <label for="comissao_percentual" class="form-label">Comissão (%)</label>
                <div class="input-group">
                    <input type="text" class="form-control comissao_percentual input_porcentagem_disabled" name="comissao_percentual" style="flex: 1 1 auto; max-width: 70px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="form-control comissao_calculada" name="comissao_calculada">
                </div>
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="total_sem_imposto" class="form-label">Total Sem Imposto</label>
                <input type="text" disabled class="form-control total_sem_imposto" name="total_sem_imposto">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="imposto_percentual" class="form-label">Imposto (%)</label>
                <div class="input-group">
                    <input type="text" class="form-control imposto_percentual input_porcentagem_disabled" name="imposto_percentual" style="flex: 1 1 auto; max-width: 70px;">
                    <span class="input-group-text">%</span>
                    <input type="text" disabled class="form-control imposto_calculado" name="imposto_calculado">
                </div>
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="total_unitario" class="form-label">Total Unit. (R$)</label>
                <input type="text" disabled class="form-control total_unitario" name="total_unitario">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="st_estado_percentual" class="form-label">ST do Estado (%)</label>
                <input type="text" disabled class="form-control st_estado_percentual" name="st_estado_percentual">
            </div>
            <div class="col-md-2 div_input_preco_venda">
                <label for="total_com_imposto" class="form-label">Total com Imposto (R$)</label>
                <input type="text" disabled class="form-control total_com_imposto" name="total_com_imposto">
            </div>
        </div>
        <div class="row mb-4 rows_preco_venda">
            <!-- Linha 4 -->
            <div class="col-md-2 div_input_preco_venda ms-auto">
                <label for="margem_lucro" class="form-label">Margem de Lucro (%)</label>
                <input type="text" disabled class="form-control margem_lucro" name="margem_lucro">
            </div>
        </div>
    </div>

    <div class="campos-preco-venda-duplicado row mb-3">
        <!-- Manipulado J.S. -->
    </div>

    <!-- Tabela Investimento -->
    <div class="row mt-4">
        <div class="col-md-4">
            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th colspan="2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="mx-auto">Investimento</span>
                                <button class="btn btn-phoenix-warning" style="float: right; margin-right: 5px;" onclick="limparCamposInvestimento()">
                                    <span class="fas fa-brush"></span>
                                </button>
                            </div>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="table-titulo-td">Artes:</td>
                        <td><input type="text" class="input_preco_venda_investimento" id="input-investimento-artes"></td>
                    </tr>
                    <tr>
                        <td class="table-titulo-td">Laudos / Testes :</td>
                        <td><input type="text" class="input_preco_venda_investimento" id="input-investimento-laudos-testes"></td>
                    </tr>
                    <tr>
                        <td class="table-titulo-td">Notificações por produto:</td>
                        <td><input type="text" class="input_preco_venda_investimento" id="input-investimento-notificacao"></td>
                    </tr>
                    <tr>
                        <td class="table-titulo-td">Clichês:</td>
                        <td><input type="text" class="input_preco_venda_investimento" id="input-investimento-cliche"></td>
                    </tr>
                    <tr>
                        <td class="table-titulo-td">Embalagens:</td>
                        <td><input type="text" class="input_preco_venda_investimento" id="input-investimento-embalagem"></td>
                    </tr>
                    <tr>
                        <td class="table-titulo-td">Caixas de Embarque:</td>
                        <td><input type="text" class="input_preco_venda_investimento" id="input-investimento-caixa-embarque"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>