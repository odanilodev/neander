  <!-- Modal desenvolver projeto -->
  <div class="modal fade" id="modalDesenvolverProjeto" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered" style="padding-bottom:80px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDesenvolverProjetoTitulo"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="card">
            <div class="card-body">
              <div class="col-12">
                <div class="mb-3">

                  <div class="container">

                    <div id="alerta-selecione-campos" class="alert alert-secondary" role="alert">
                      Para liberar os campos selecione um dos projetos deste cliente.
                    </div>


                    <div class="row">

                      <div class="col-md-3 mb-3">
                        <label for="select_projeto_cliente" class="form-label">Selecione o Projeto</label>
                        <select id="select_projeto_cliente" class="form-select select2">
                          <option value="">Desenvolver Projeto</option>
                          <?php foreach ($projetos as $projeto) : ?>
                            <?php if ($projeto['vinculado'] == 0) : ?>
                              <option value="<?= $projeto['codigo_projeto'] ?>"><?= $projeto['nome_produto'] ?></option>
                            <?php endif ?>
                          <?php endforeach ?>
                        </select>
                      </div>

                      <hr>
                    </div>
                    <div class="row">

                      <div class="mb-2">
                        <h5>Formulação do Produto</h5>
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="text-body-highlight">Produto</label>
                        <input type="text" disabled class="form-control modal-desenvolver-input-nome-produto text-1000">
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="text-body-highlight">Produção</label>
                        <input value="1,000 g" type="text" disabled class="form-control modal-desenvolver-input-producao text-1000">
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="text-body-highlight text-center">Data</label>
                        <input type="text" disabled class="form-control modal-desenvolver-input-data text-1000">
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="text-body-highlight">Cliente</label>
                        <input type="text" disabled class="form-control modal-desenvolver-input-nome-cliente text-1000">
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="text-body-highlight">Quantidade</label>
                        <input required type="text" class="mascara-peso form-control modal-desenvolver-input-quantidade">
                      </div>

                      <!-- <div class="col-md-4 mb-2">
                        <label class="text-body-highlight">Nível do Prod.</label>
                        <?= botao_info("1 - Shampoos, Sabonetes liquido de baixa complexidade.<br>
                                            2 - Shampoos, Sabonetes liquido de alta complexidade.<br>
                                            3 - Cremes, Condicionadores, Desodorante Rollon, Serum de baixa complexidade.<br>
                                            4 - Cremes, Condicionadores de alta complexidade.<br>
                                            5 - Cremes, Mascaras, Matizadores de alta complexidade.<br>
                                            6 - Geis.<br>
                                            7 - Produtos liquidos."); ?>

                        <select id="select-nivel" required class="form-control modal-desenvolver-input-nivel-produto select2">
                          <option value="" disabled selected>Selecione o nível</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                        </select>


                      </div> -->

                      <hr class="my-3">
                      <div class="col-md-3 mb-2 div-materia-prima">
                        <label class="form-label" style="padding-left:0;">Matéria-Prima </label>
                        <select class="form-control campo-briefing select2 modal-desenvolver-select-materia-prima" name="select-materia-prima">
                          <option value="" disabled selected>Selecione a matéria prima</option>
                          <?php foreach ($materiasPrimas as $materiaPrima) : ?>
                            <option value="<?= $materiaPrima['id']; ?>" data-valor-materia-prima="<?= $materiaPrima['valor'] ?>">
                              <?= $materiaPrima['nome']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                        <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                      </div>

                      <!-- Percentual -->
                      <div class="col-md-2 mb-2 div-percentual">
                        <label class="form-label" style="padding-left:0;">Percentual</label>
                        <div class="input-group">
                          <input type="number" class="form-control modal-desenvolver-input-percentual modal-desenvolver-input-percentual-principal">
                          <span class="input-group-text">%</span>
                        </div>
                      </div>

                      <!-- Quantidade -->
                      <div class="col-md-2 mb-2 div-quantidade">
                        <label class="form-label" style="padding-left:0;">Quantidade</label>
                        <div class="input-group">
                          <input type="text" class="mascara-peso form-control modal-desenvolver-input-quantidade-materia-prima">
                          <span class="input-group-text">KG.</span>
                        </div>
                      </div>

                      <!-- Valor Matéria Prima -->
                      <div class="col-md-2 mb-2 div-valor-materia-prima">
                        <label class="form-label" style="padding-left:0;">Valor M.P. (R$)</label>
                        <input disabled type="text" value="" class="text-1000 form-control modal-desenvolver-input-valor-materia-prima">
                      </div>

                      <!-- Total -->
                      <div class="col-md-2 mb-2 div-total-linha">
                        <label class="form-label" style="padding-left:0;">Total (R$)</label>
                        <input type="text" value="" disabled class="text-1000 form-control modal-desenvolver-input-total-materia-prima">
                      </div>

                      <div class="col-md-1">
                        <button class="mt-4 btn btn-phoenix-success novo-input-materia-prima btn-duplica-linha">+</button>
                      </div>
                      <div class="campos-duplicados">
                        <!-- JS -->
                      </div>
                    </div>



                    <hr>

                    <div class="d-flex" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                      <div class="d-flex align-items-center" style="margin-right: 1rem;">
                        <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem; margin-left:10px;">Porcentagem Total:</p>
                        <input disabled type="text" class="form-control input-porcentagem-total" style="max-width: 120px;">
                      </div>

                      <div class="d-flex align-items-center">
                        <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem;">Sub-Total 1:</p>
                        <input disabled type="text" class="text-1000 form-control input-sub-total" style="max-width: 120px;">
                      </div>
                    </div>

                    <hr>

                  </div>


                  <label class="form-label">Modo de Fabricação</label>

                  <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>

                  <div class="row">
                    <div class="col-md-6">
                      <label class="form-label">PH Final do Produto:</label>
                      <input class="form-control" type="text">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Nome da Fragrância:</label>
                      <input class="form-control" type="text">
                    </div>
                  </div>

                  <hr>

                  <div class="row campos-custo-manipulacao">
                    <div class="mb-2">

                      <h5>Custo de Manipulação</h5>

                    </div>

                    <div class="col-md-4 mb-2">
                      <label class="form-label" style="padding-left:0;">Nivel Equipamento</label>
                      <select required id="select-equipamentos-manipulacao" class="form-control modal-desenvolver-input-nivel-produto select2">
                        <option value="" disabled selected>Equipamento Manipulação</option>
                        <!-- js -->
                      </select>
                      <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                    </div>


                    <!-- Quantd. KG. -->
                    <div class="col-md-2 mb-2 div-percentual">
                      <label class="form-label" style="padding-left:0;">Quant. Kg</label>
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">KG.</span>
                      </div>
                    </div>

                    <!-- Tempo -->
                    <div class="col-md-2 mb-2 div-quantidade">
                      <label class="form-label" style="padding-left:0;">Tempo</label>
                      <input type="text" class="form-control modal-desenvolver-custo-manipulacao-tempo">
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-2 mb-2 div-total-linha">
                      <label class="form-label" style="padding-left:0;">Valor Unit (R$)</label>
                      <input type="text" value="" disabled class="text-1000 form-control modal-desenvolver-custo-manipulacao-valor-unit">
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-2">
                      <label class="form-label" style="padding-left:0;">Total (R$)</label>
                      <input type="text" value="" disabled class="text-1000 form-control modal-desenvolver-custo-manipulacao-valor-unit">
                    </div>

                  </div>

                  <hr>

                  <div class="d-flex" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                    <div class="d-flex align-items-center">
                      <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem;">Sub-Total 2:</p>
                      <input disabled type="text" class="text-1000 form-control input-sub-total-2 modal-desenvolver-custo-manipulacao-valor-unit" style="max-width: 120px;">
                    </div>
                  </div>

                  <hr>

                  <div class="row campos-custo-envase-rotulagem">

                    <div class="mb-2">
                      <h5>Custo de Envase + Rotulagem</h5>
                    </div>

                    <div class="col-md-4 mb-2">
                      <label class="form-label" style="padding-left:0;">Nível Equipamento</label>
                      <select required id="select-equipamentos-envase" class="form-control modal-desenvolver-input-nivel-produto select2">
                        <option value="" disabled selected>Equipamento Envase</option>
                        <!-- js -->
                      </select>
                      <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                    </div>


                    <!-- Quantd. KG. -->
                    <div class="col-md-2 mb-2">
                      <label class="form-label" style="padding-left:0;">Quant. Kg</label>
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">KG.</span>
                      </div>
                    </div>

                    <!-- Tempo -->
                    <div class="col-md-2 mb-2">
                      <label class="form-label" style="padding-left:0;">Peças / Hora</label>
                      <div class="input-group">
                        <input type="text" class="form-control modal-desenvolver-custo-envase-pecas-hora">
                        <span class="input-group-text">PÇ.</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-2 mb-2">
                      <label class="form-label" style="padding-left:0;">Valor Unit (R$)</label>
                      <input type="text" value="" disabled class="text-1000 form-control modal-desenvolver-custo-envase-valor-unit">
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-2">
                      <label class="form-label" style="padding-left:0;">Total (R$)</label>
                      <input type="text" value="" disabled class="text-1000 form-control modal-desenvolver-custo-envase-valor-unit">
                    </div>

                  </div>
                  <div class="row">

                    <div class="col-md-4 mb-2">
                      <select id="select-equipamentos-rotulagem" class="form-control select2">
                        <option value="" disabled selected>Equipamento Rotulagem</option>
                        <?php foreach ($equipamentosRotulagem as $equipamentoRotulagem) : ?>
                          <option value="<?= $equipamentoRotulagem['id']; ?>" data-pecas-hora-rotulagem="<?= $equipamentoRotulagem['pcs_hora'] ?>" data-valores-unit-total-rotulagem="<?= $equipamentoRotulagem['valor_mo'] ?>">
                            <?= $equipamentoRotulagem['nivel'] . ' - ' . $equipamentoRotulagem['nome']; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                      <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                    </div>

                    <!-- Quantd. KG. -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">KG.</span>
                      </div>
                    </div>

                    <!-- Peças Hora -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <input type="text" class="form-control modal-desenvolver-custo-rotulagem-pecas-hora">
                        <span class="input-group-text">PÇ.</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-2 mb-2">
                      <input type="text" value="" disabled class="text-1000 form-control modal-desenvolver-custo-rotulagem-valor-unit">
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-2">
                      <input type="text" value="" disabled class="text-1000 form-control modal-desenvolver-custo-rotulagem-valor-unit">
                    </div>

                  </div>

                  <hr>

                  <div class="d-flex" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                    <div class="d-flex align-items-center">
                      <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem;">Sub-Total 3:</p>
                      <input disabled type="text" class="text-1000 form-control input-sub-total-3" style="max-width: 120px;">
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="mb-2">

                      <h5>Embalagem</h5>

                    </div>

                    <!-- Tipo -->
                    <div class="col-md-3 mb-2">
                      <label class="form-label" style="padding-left:0;">Tipo</label>
                      <input type="text" class="modal-desenvolver-custo-rotulo form-control text-1000" value="Rótulo (Frente + Verso)" disabled>
                    </div>


                    <!-- Quantidade. -->
                    <div class="col-md-3 mb-2">
                      <label class="form-label" style="padding-left:0;">Quantidade</label>
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">Un.</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-3 mb-2">
                      <label class="form-label" style="padding-left:0;">Valor Unit (R$)</label>
                      <div class="input-group">
                        <input type="text" class="mascara-dinheiro form-control">
                      </div>
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-3 mb-2">
                      <label class="form-label" style="padding-left:0;">Total (R$)</label>
                      <input type="text" value="" disabled class="text-1000 form-control">
                    </div>
                    <!-- Tipo -->
                    <div class="col-md-3 mb-2">
                      <input type="text" class="modal-desenvolver-custo-frasco form-control text-1000" value="Frasco / Pote / Bisnaga / etc." disabled>
                    </div>


                    <!-- Quantidade. -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">Un.</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="text" class="mascara-dinheiro form-control">
                      </div>
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-3 mb-2">
                      <input type="text" value="" disabled class="text-1000 form-control">
                    </div>
                    <!-- Tipo -->
                    <div class="col-md-3 mb-2">
                      <input type="text" class="modal-desenvolver-custo-tampa text-1000 form-control" value="Tampa / Valvula" disabled>
                    </div>


                    <!-- Quantidade. -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">Un.</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="text" class="mascara-dinheiro form-control">
                      </div>
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-3 mb-2">
                      <input type="text" value="" disabled class="text-1000 form-control">
                    </div>

                    <!-- Tipo -->
                    <div class="col-md-3 mb-2">
                      <input type="text" class="text-1000 form-control modal-desenvolver-custo-display" value="Display / Cartucho" disabled>
                    </div>


                    <!-- Quantidade. -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">Un.</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="text" class="mascara-dinheiro form-control">
                      </div>
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-3 mb-2">
                      <input type="text" value="" disabled class="text-1000 form-control">
                    </div>
                    <!-- Tipo -->
                    <div class="col-md-3 mb-2">
                      <input type="text" class="modal-desenvolver-custo-caixa-embarque text-1000 form-control" value="Caixa de Embarque" disabled>
                    </div>


                    <!-- Quantidade. -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">Un.</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="text" class="mascara-dinheiro form-control">
                      </div>
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-3 mb-2">
                      <input type="text" value="" disabled class="text-1000 form-control">
                    </div>

                    <hr class="my-3">

                    <div class="d-flex" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                      <div class="d-flex align-items-center">
                        <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem;">Sub-Total 4:</p>
                        <input disabled type="text" class="text-1000 form-control input-sub-total" style="max-width: 120px;">
                      </div>
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="mb-2">

                      <h5>Custo Final</h5>

                    </div>

                    <!-- Tipo -->
                    <div class="col-md-3 mb-2">
                      <label class="form-label" style="padding-left:0;">Tipo</label>
                      <input type="text" class="form-control text-1000" value="Produto" disabled>
                    </div>


                    <!-- Quantidade. -->
                    <div class="col-md-3 mb-2">
                      <label class="form-label" style="padding-left:0;">Quantidade</label>
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">Un.</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-3 mb-2">
                      <label class="form-label" style="padding-left:0;">Valor Unit (R$)</label>
                      <div class="input-group">
                        <input type="text" class="form-control">
                      </div>
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-3 mb-2">
                      <label class="form-label" style="padding-left:0;">Total (R$)</label>
                      <input type="text" value="" disabled class="text-1000 form-control">
                    </div>

                    <!-- Tipo -->
                    <div class="col-md-3 mb-2">
                      <input type="text" class="form-control text-1000" value="Manipulação" disabled>
                    </div>

                    <!-- Quantidade. -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">Un.</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="text" class="form-control">
                      </div>
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-3 mb-2">
                      <input type="text" value="" disabled class="text-1000 form-control">
                    </div>
                    <!-- Tipo -->
                    <div class="col-md-3 mb-2">
                      <input type="text" class="form-control text-1000" value="Envase" disabled>
                    </div>


                    <!-- Quantidade. -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">Un.</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="text" class="form-control">
                      </div>
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-3 mb-2">
                      <input type="text" value="" disabled class="text-1000 form-control">
                    </div>
                    <!-- Tipo -->
                    <div class="col-md-3 mb-2">
                      <input type="text" class="form-control text-1000" value="Rotulagem" disabled>
                    </div>


                    <!-- Quantidade. -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">Un.</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="text" class="form-control">
                      </div>
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-3 mb-2">
                      <input type="text" value="" disabled class="text-1000 form-control">
                    </div>
                    <!-- Tipo -->
                    <div class="col-md-3 mb-2">
                      <input type="text" class="form-control text-1000" value="Embalagem" disabled>
                    </div>


                    <!-- Quantidade. -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">Un.</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="text" class="form-control">
                      </div>
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-3 mb-2">
                      <input type="text" value="" disabled class="text-1000 form-control">
                    </div>

                    <!-- Tipo -->
                    <div class="col-md-3 mb-2">
                      <input type="text" class="form-control text-1000" value="Outros Custos" disabled>
                    </div>


                    <!-- Quantidade. -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">Un.</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="text" class="form-control">
                      </div>
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-3 mb-2">
                      <input type="text" value="" disabled class="text-1000 form-control">
                    </div>

                    <!-- Tipo -->
                    <div class="col-md-3 mb-2">
                      <input type="text" class="form-control text-1000" value="Percentual de perda" disabled>
                    </div>


                    <!-- Quantidade. -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="number" class="form-control">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>

                    <!-- Valor Unit (R$) -->
                    <div class="col-md-3 mb-2">
                      <div class="input-group">
                        <input type="text" class="form-control">
                      </div>
                    </div>

                    <!-- Total (R$) -->
                    <div class="col-md-3 mb-2">
                      <input type="text" value="" disabled class="text-1000 form-control">
                    </div>

                    <hr>

                    <div class="d-flex" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                      <div class="d-flex align-items-center">
                        <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem;">Total Unit.:</p>
                        <input disabled type="text" class="text-1000 form-control input-sub-total" style="max-width: 120px; margin-right:0.5rem;">
                        <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem; margin-left:3rem;"> Total Geral:</p>

                        <input disabled type="text" class="text-1000 form-control input-sub-total" style="max-width: 120px;">
                      </div>
                    </div>

                  </div>

                  <hr>

                  <div class="row">
                    <div class="mb-2">

                      <h5>Custo por lote de partida</h5>

                    </div>

                    <!-- Lote -->
                    <div class="col-md-4 mb-2">
                      <label class="form-label" style="padding-left:0;">Lote:</label>
                      <input type="text" disabled class="text-1000 text-center form-control" value="Especial 50,000">
                    </div>


                    <!-- Produto. -->
                    <div class="col-md-2 mb-2">
                      <label class="form-label" style="padding-left:0;">Produto</label>
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Mão de Obra(R$) -->
                    <div class="col-md-2 mb-2">
                      <label class="form-label" style="padding-left:0;">Mão de Obra</label>
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Embalagem (R$) -->
                    <div class="col-md-2 mb-2">
                      <label class="form-label" style="padding-left:0;">Embalagem</label>
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Perda (R$) -->
                    <div class="col-md-2 mb-2">
                      <label class="form-label" style="padding-left:0;">Perda</label>
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                  </div>

                  <div class="row">

                    <!-- Lote -->
                    <div class="col-md-4 mb-2">
                      <input type="text" disabled class="text-1000 text-center form-control" value="100,000">
                    </div>


                    <!-- Produto. -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Mão de Obra(R$) -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Embalagem (R$) -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Perda -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                  </div>

                  <div class="row">

                    <!-- Lote -->
                    <div class="col-md-4 mb-2">
                      <input type="text" disabled class="text-1000 text-center form-control" value="340,000">
                    </div>


                    <!-- Produto. -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Mão de Obra(R$) -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Embalagem (R$) -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Perda -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                  </div>
                  <div class="row">

                    <!-- Lote -->
                    <div class="col-md-4 mb-2">
                      <input type="text" disabled class="text-1000 text-center form-control" value="560,000">
                    </div>


                    <!-- Produto. -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Mão de Obra (R$) -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Embalagem (R$) -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Perda (R$) -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                  </div>
                  <div class="row">

                    <!-- Lote -->
                    <div class="col-md-4 mb-2">
                      <input type="text" disabled class="text-1000 text-center form-control" value="1000,000">
                    </div>


                    <!-- Produto. -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Mão de Obra -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Embalagem -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                    <!-- Perda (R$) -->
                    <div class="col-md-2 mb-2">
                      <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control">
                      </div>
                    </div>

                  </div>


                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">

          <button type="button" class="btn btn-phoenix-primary me-2" data-bs-toggle="modal" data-bs-target="#modalCustoProdutivo">
            <span class="fa-solid fas fa-dollar-sign me-2"></span>
            Custo Produtivo
          </button>

          <div class="ms-auto">
            <button class="btn btn-phoenix-success" type="submit" onclick="vincularValores()">Vincular Valores</button>
          </div>
        </div>

      </div>
    </div>
  </div>