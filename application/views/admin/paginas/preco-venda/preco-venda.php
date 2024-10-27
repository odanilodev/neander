<div class="content view-preco-venda">

    <div class="container-fluid container_duplicar_campos">

        <div class="row-selects-preco-venda row mb-3">

            <div id="alerta-selecione-campos" class="alert alert-phoenix-secondary text-1000" role="alert">
                Para liberar os campos, selecione um cliente e seu projeto.
            </div>

            <!-- Select Cliente -->
            <div class="div_selects_preco_venda col-md-3">
                <label for="select_cliente" class="form-label">Cliente</label>
                <select class="form-select select2" id="select_cliente" name="select_cliente">
                    <option value="" selected disabled>Selecione o cliente</option>
                    <?php foreach ($clientes as $cliente) : ?>
                        <option data-contato-cliente="<?= $cliente['contato'] ?>" value="<?= $cliente['id'] ?>"><?= $cliente['nome_fantasia'] ?></option>
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
            <!-- <div class="div_selects_preco_venda col-md-3 inactive div_select_valor_lote">
                <label for="select_lote_projeto" class="form-label">Lote</label>
                <select class="form-select select2 select_lote_projeto" name="select_lote_projeto">
                    <option value="" selected disabled>Selecione o cliente</option>
                    <option value="50">Especial 50</option>
                    <option value="100">100</option>
                    <option value="340">340</option>
                    <option value="560">560</option>
                    <option value="1000">1000</option>
                </select>
            </div> -->

            <div class="col-md-1 ms-auto d-flex justify-content-end">
                <button class="mt-4 btn btn-phoenix-success btn_duplica_div">+</button>
            </div>

        </div>

        <div class="p-4 bg-light shadow rounded container_campos_preco_venda mb-4 container_pdf inputs-preco-venda">
            <div class="row mb-4 rows_preco_venda">

                <input type="hidden" class="input_hidden_fator" value="1">

                <!-- Linha 1 -->
                <div class="col-md-3 div_input_preco_venda">
                    <label for="input_nome_produto" class="form-label">Descrição do Produto</label>
                    <input type="text" disabled class="text-1000 input_nome_produto form-control" rows="1"></textarea>
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
                    <label for="input_lote_partida" class="form-label">Lote Partida</label>
                    <input name="lote" type="text" disabled class="input-gravar-banco inputs-tipo-texto form-control input_lote_partida text-1000" name="lote_partida">
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
                        <input name="porcentagem_frete" type="text" class="form-control input-gravar-banco input_frete_porcentagem input_porcentagem_disabled" name="input_frete_porcentagem" style="flex: 1 1 auto; max-width: 50px;">
                        <span class="input-group-text">%</span>
                        <input name="valor_frete" type="text" disabled class="form-control input-gravar-banco input_frete_calculado text-1000" name="input_frete_calculado" style="flex: 1 1 auto; max-width: 100px;">
                    </div>
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_custo_financeiro_porcentagem" class="form-label">Custo Financeiro</label>
                    <div class="input-group">
                        <input name="porcentagem_custo_financeiro" type="text" class="form-control input-gravar-banco input_custo_financeiro_porcentagem input_porcentagem_disabled" name="input_custo_financeiro_porcentagem" style="flex: 1 1 auto; max-width: 50px;">
                        <span class="input-group-text">%</span>
                        <input name="valor_custo_financeiro" type="text" disabled class="form-control input-gravar-banco input_custo_financeiro_calculado text-1000" name="input_custo_financeiro_calculado">
                    </div>
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_margem_porcentagem" class="form-label">Margem (% - R$)</label>
                    <div class="input-group">
                        <input name="porcentagem_margem" type="text" class="input-gravar-banco form-control input_margem_porcentagem input_porcentagem_disabled" name="input_margem_porcentagem" style="flex: 1 1 auto; max-width: 50px;">
                        <span class="input-group-text">%</span>
                        <input name="valor_margem" type="text" disabled class="input-gravar-banco form-control text-1000 input_margem_calculado">
                    </div>
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_sub_total" class="form-label">Sub-Total</label>
                    <input name="sub_total" type="text" disabled class="input-gravar-banco form-control input_sub_total text-1000" name="input_sub_total">
                </div>
            </div>

            <div class="row mb-4 rows_preco_venda">
                <!-- Linha 3 -->
                <div class="col-md-2 div_input_preco_venda ">
                    <label for="input_comissao_porcentagem" class="form-label">Comissão (%)</label>
                    <div class="input-group">
                        <input name="porcentagem_comissao" type="text" class="input-gravar-banco form-control input_comissao_porcentagem input_porcentagem_disabled" name="comissao_porcentagem" style="flex: 1 1 auto; max-width: 50px;">
                        <span class="input-group-text">%</span>
                        <input name="valor_comissao" type="text" disabled class="input-gravar-banco form-control input_comissao_calculada text-1000" name="input_comissao_calculada">
                    </div>
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_total_sem_imposto" class="form-label">Total Sem Imposto</label>
                    <input name="total_sem_imposto" type="text" disabled class="input-gravar-banco text-1000 form-control input_total_sem_imposto" name="input_total_sem_imposto">
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_imposto_porcentagem" class="form-label">Imposto (%)</label>
                    <div class="input-group">
                        <input name="porcentagem_imposto" type="text" class="input-gravar-banco form-control input_imposto_porcentagem input_porcentagem_disabled" name="input_imposto_porcentagem" style="flex: 1 1 auto; max-width: 50px;">
                        <span class="input-group-text">%</span>
                        <input name="valor_imposto" type="text" disabled class="input-gravar-banco text-1000 form-control input_imposto_calculado" name="input_imposto_calculado">
                    </div>
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_total_unitario" class="form-label">Total Unit. (R$)</label>
                    <input name="total_unit" type="text" disabled class="input-gravar-banco text-1000 form-control input_total_unitario" name="input_total_unitario">
                </div>
                <div class="col-md-2 div_input_preco_venda">
                    <label for="input_st_estado_porcentagem" class="form-label">ST do Estado (%)</label>
                    <div class="input-group">
                        <input name="porcentagem_st_estado" type="text" class="input-gravar-banco input_porcentagem_disabled form-control input_st_estado_porcentagem" name="input_st_estado_porcentagem" style="flex: 1 1 auto; max-width: 50px;">
                        <span class="input-group-text">%</span>
                        <input name="valor_st_estado" type="text" disabled class="input-gravar-banco text-1000 form-control input_st_estado_calculado" name="input_st_estado_calculado">
                    </div>
                </div>
                <div class="col-md-2 div_input_preco_venda div_input_outros inactive">
                    <label for="input_outros" class="form-label">Outros</label>
                    <input disabled type="text" class="input-gravar-banco form-control text-1000 input_outros" name="outros">
                </div>
            </div>

            <div class="row mb-4 rows_preco_venda">
                <div class="col-md-2 div_input_preco_venda ms-auto">
                    <label for="input_total_st_estado" class="form-label">Valor total com ST</label>
                    <input name="total_st" type="text" disabled class="input-gravar-banco text-1000 form-control input_total_st_estado" name="input_total_st_estado">
                </div>
            </div>

        </div>

        <div class="col-md-2 ms-auto d-flex justify-content-end">
            <div class="p-3">
                <div class="spinner-border text-primary load-form d-none" role="status"></div>
            </div>
            <button disabled class="mt-2 btn btn-phoenix-success btn-finalizar-preco-venda" data-bs-toggle="modal" data-bs-target="#condicoesModal">Finalizar</button>

        </div>

    </div>

    <div class="container_campos_preco_venda_duplicado">
        <!-- Manipulado J.S. -->
    </div>


    <!-- Modal condições de pagamento -->
    <div class="modal fade" id="condicoesModal" tabindex="-1" aria-labelledby="modalLabel" aria-label="hidden">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Condições Gerais de Fornecimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mt-3 mb-5 mx-auto col-md-12">
                            <!-- Condições Gerais de Fornecimento -->
                            <div class="row">
                                <div class="col-md-3">
                                    <h5 class="form-text text-1000">Matéria-Prima</h5>
                                    <div class="form-check">
                                        <input type="checkbox" id="check_materia_prima" class="form-check-input" name="check_materia_prima">
                                        <label for="check_materia_prima" class="form-check-label">Pago pelo cliente.</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <h5 class="form-text text-1000">Embalagem</h5>
                                    <div class="form-check">
                                        <input type="checkbox" id="check_embalagem" class="form-check-input" name="check_embalagem">
                                        <label for="check_embalagem" class="form-check-label">Pago pelo cliente.</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <h5 class="form-text text-1000">Rótulo</h5>
                                    <div class="form-check">
                                        <input type="checkbox" id="check_rotulo" class="form-check-input" name="check_rotulo">
                                        <label for="check_rotulo" class="form-check-label">Pago pelo cliente.</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <h5 class="form-text text-1000">Transporte</h5>
                                    <div class="form-check">
                                        <input type="checkbox" id="check_transporte" class="form-check-input" name="check_transporte">
                                        <label for="check_transporte" class="form-check-label">Pago pelo cliente.</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Condição de Pagamento -->
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="condicao_pagamento" class="form-label">Condição de Pagamento</label>
                                        <select id="condicao_pagamento" class="campo-obrigatorio form-select">
                                            <option selected disabled value="">Selecione uma condição</option>
                                            <?php foreach ($condicoes as $condicao) : ?>
                                                <option value="<?= $condicao['id'] ?>"><?= $condicao['nome'] ?></option>
                                                <!-- Adicione mais opções conforme necessário -->
                                            <?php endforeach ?>
                                        </select>
                                        <div class="aviso-obrigatorio d-none">Preencha este campo!</div>
                                    </div>
                                </div>

                                <!-- Impostos -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="impostos" class="form-label">Impostos</label>
                                        <input type="text" id="impostos" class="campo-obrigatorio form-control" placeholder="Informe os impostos aplicáveis">
                                        <div class="aviso-obrigatorio d-none">Preencha este campo!</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Observações Importantes -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="observacoes" class="form-label">Observações Importantes</label>
                                        <textarea id="observacoes" class="form-control" rows="4" placeholder="Digite suas observações aqui"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-phoenix-danger btn-fecha-modal-condicao-fornecimento" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-phoenix-success btn-gera-pdf" onclick="gerarPdfPrecoVenda()"><span class="far fa-file-pdf me-2"></span>Gerar PDF</button>
                    <div class="p-3">
                        <div class="spinner-border text-primary load-form-gera-pdf d-none" role="status"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>