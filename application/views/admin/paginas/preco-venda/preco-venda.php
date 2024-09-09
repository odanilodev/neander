<div class="content">

    <div class="container-fluid container_duplicar_campos">

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
                <select class="form-select select2 select_projetos_cliente" name="select_projetos_cliente" id="select_projetos_cliente">
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

            <div class="col-md-1 ms-auto d-flex justify-content-end">
                <button class="mt-4 btn btn-phoenix-success btn_duplica_div">+</button>
            </div>

        </div>

        <div class="p-4 bg-light shadow rounded container_campos_preco_venda mb-4 batata">
            <div class="row mb-4 rows_preco_venda">
                <input type="hidden" class="input_hidden_fator" value="1">

                <!-- Linha 1 -->
                <div class="col-md-3 div_input_preco_venda">
                    <label for="descricao_produto" class="form-label">Descrição do Produto</label>
                    <textarea class="form-control descricao_produto input_porcentagem_disabled" name="descricao_produto" placeholder="Digite a descrição" rows="1"></textarea>
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_ncm" class="form-label">NCM</label>
                    <input type="text" disabled class="form-control input_ncm text-1000" name="input_ncm">
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_descricao_ncm" class="form-label">Descrição do NCM</label>
                    <input type="text" disabled class="form-control input_descricao_ncm text-1000" name="input_descricao_ncm">
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
                        <input type="text" disabled class="form-control text-1000 input_margem_calculado">
                    </div>
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_sub_total" class="form-label">Sub-Total</label>
                    <input type="text" disabled class="form-control input_sub_total text-1000" name="input_sub_total">
                </div>
            </div>

            <div class="row mb-4 rows_preco_venda">
                <!-- Linha 3 -->
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_comissao_porcentagem" class="form-label">Comissão (%)</label>
                    <div class="input-group">
                        <input type="text" class="form-control input_comissao_porcentagem input_porcentagem_disabled" name="comissao_porcentagem" style="flex: 1 1 auto; max-width: 70px;">
                        <span class="input-group-text">%</span>
                        <input type="text" disabled class="form-control input_comissao_calculada text-1000" name="input_comissao_calculada">
                    </div>
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_total_sem_imposto" class="form-label">Total Sem Imposto</label>
                    <input type="text" disabled class="text-1000 form-control input_total_sem_imposto" name="input_total_sem_imposto">
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_imposto_porcentagem" class="form-label">Imposto (%)</label>
                    <div class="input-group">
                        <input type="text" class="form-control input_imposto_porcentagem input_porcentagem_disabled" name="input_imposto_porcentagem" style="flex: 1 1 auto; max-width: 70px;">
                        <span class="input-group-text">%</span>
                        <input type="text" disabled class="text-1000 form-control input_imposto_calculado" name="input_imposto_calculado">
                    </div>
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_total_unitario" class="form-label">Total Unit. (R$)</label>
                    <input type="text" disabled class="text-1000 form-control input_total_unitario" name="input_total_unitario">
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_st_estado_porcentagem" class="form-label">ST do Estado (%)</label>
                    <div class="input-group">
                        <input type="text" class="input_porcentagem_disabled form-control input_st_estado_porcentagem" name="input_st_estado_porcentagem" style="flex: 1 1 auto; max-width: 70px;">
                        <span class="input-group-text">%</span>
                        <input type="text" disabled class="text-1000 form-control input_st_estado_calculado" name="input_st_estado_calculado">
                    </div>
                </div>
                <div class="col-md-2 div_input_preco_venda ms-auto">
                    <label for="input_total_st_estado" class="form-label">Valor total com ST</label>
                    <input type="text" disabled class="text-1000 form-control input_total_st_estado" name="input_total_st_estado">
                </div>
            </div>

        </div>

        <div class="col-md-2 ms-auto d-flex justify-content-end">
            <button class="mt-2 btn btn-phoenix-success btn_gerar_pdf"><span class="far fa-file-pdf me-2"></span>Gerar PDF</button>
        </div>

        <div class="container_campos_preco_venda_duplicado">
            <!-- Manipulado J.S. -->
        </div>
    </div>
