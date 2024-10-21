<!-- Modal visualizar desenvolvimento projeto -->
<div class="modal fade" id="modalVisualizarDesenvolvimentoProjeto" tabindex="-1" aria-labelledby="modalVisualizarDesenvolvimentoProjetoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalVisualizarDesenvolvimentoProjetoLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modal-body-visualizar">
        <div class="card">
          <div class="card-body">
            <div class="col-12">
              <div class="mb-3">
                <div class="modal-body modal-body-visualizar p-0 m-0">

                  <div id="alerta-apenas-visualizacao" class="text-center d-none alert alert-phoenix-warning alert-link text-1000" role="alert" style="color:sandybrown !important;">
                    Você está no modo visualização, nenhuma informação pode ser alterada.
                  </div>

                  <div class="container container-modal-visualizar">

                    <!-- formulacao -->
                    <div class="row">

                      <div class="mb-2">
                        <h5>Formulação do Produto</h5>
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="text-body-highlight">Produto</label>
                        <input type="text" disabled class="form-control modal-visualizar-nome-produto text-1000">
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="text-body-highlight">Produção</label>
                        <input value="1,000 g" type="text" disabled class="form-control text-1000">
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="text-body-highlight text-center">Data</label>
                        <input type="text" disabled class="form-control modal-visualizar-criado-em text-1000">
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="text-body-highlight">Cliente</label>
                        <input type="text" disabled class="form-control modal-visualizar-cliente-nome-fantasia text-1000">
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="text-body-highlight">Quantidade</label>
                        <input required type="text" class="mascara-peso form-control modal-visualizar-quantidade-geral-projeto">
                      </div>

                    </div>

                    <hr class="my-3">

                    <!-- materia prima -->
                    <div class="row">

                      <div class="col-md-4 mb-2">
                        <label class="form-label" style="padding-left:0;">Matéria-Prima </label>
                        <select class="form-control select2 modal-visualizar-select-materia-prima modal-visualizar-select-materia-prima-main">
                          <?php foreach ($materiasPrimas as $materiaPrima) { ?>
                            <option value="<?= $materiaPrima['id'] ?>"><?= $materiaPrima['nome'] ?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <!-- fase -->
                      <div class="col-md-1 mb-2">
                        <label class="form-label" style="padding-left:0;">Fase</label>
                        <input disabled type="text" class="mascara-fase form-control modal-visualizar-fase">
                      </div>

                      <!-- Percentual -->
                      <div class="col-md-2 mb-2">
                        <label class="form-label" for="percentualInput" style="padding-left: 0;">Percentual</label>
                        <div class="input-group">
                          <input id="percentualInput" type="number" class="form-control modal-visualizar-input-percentual text-1000" disabled aria-describedby="percentual-addon">
                          <span class="input-group-text" id="percentual-addon">%</span>
                        </div>
                      </div>

                      <!-- Quantidade -->
                      <div class="col-md-2 mb-2">
                        <label class="form-label" for="quantidadeInput" style="padding-left: 0;">Quantidade</label>
                        <div class="input-group">
                          <input id="quantidadeInput" type="text" class="form-control text-1000 mascara-peso modal-visualizar-input-quantidade-materia-prima" disabled aria-describedby="quantidade-addon">
                          <span class="input-group-text" id="quantidade-addon">KG.</span>
                        </div>
                      </div>

                      <!-- Total -->
                      <div class="col-md-3 mb-2">
                        <label class="form-label" style="padding-left:0;">Total (R$)</label>
                        <input type="text" disabled class="text-1000 form-control modal-visualizar-input-total-materia-prima">
                      </div>

                        <button disabled class="mt-4 btn btn-phoenix-success novo-btn-duplicar-linhas d-none">+</button>
                    </div>

                    <div class="campos-duplicados-visualizar">
                      <!-- JS -->
                    </div>

                    <hr>

                    <div class="row" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                      <div class="col-auto">
                        <div class="d-flex flex-column" style="align-items: flex-end;">
                          <div class="d-flex align-items-center">
                            <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem; margin-left: 10px; font-weight: bold;">Porcentagem Total:</p>
                            <div class="input-group" style="max-width: 150px; margin-left: 5px;">
                              <input disabled type="text" class="form-control modal-visualizar-porcentagem-total text-1000" style="border-radius: 4px; padding: 0.5rem;">
                              <span class="input-group-text">%</span>
                            </div>
                          </div>
                          <span class="modal-visualizar-aviso-porcentagem d-none" style="color: red; font-size: 0.9rem; margin-top: 5px; text-align: right; width: 100%;">Porcentagem excedeu 100%.</span>
                        </div>
                      </div>
                      <div class="col-auto d-flex align-items-center">
                        <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem; font-weight: bold;">Sub-Total 1:</p>
                        <input disabled type="text" class="text-1000 form-control modal-visualizar-custo-sub-total-1" style="max-width: 120px; border-radius: 4px; padding: 0.5rem;">
                      </div>
                    </div>


                    <hr>

                    <div>
                      <label class="form-label">Modo de Fabricação</label>
                      <textarea class="form-control modal-visualizar-modo-fabricacao" cols="30" rows="5"></textarea>
                      <div class="row">
                        <div class="col-md-6">
                          <label class="form-label">PH Final do Produto:</label>
                          <input class="form-control modal-visualizar-ph-final-produto" type="text">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Nome da Fragrância:</label>
                          <input class="form-control modal-visualizar-fragrancia" type="text">
                        </div>
                      </div>
                    </div>

                    <hr>

                    <div class="row">
                      <div class="mb-2">

                        <h5>Custo de Manipulação</h5>

                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="form-label" style="padding-left:0;">Nivel Equipamento</label>
                        <select required class=" form-control modal-visualizar-id-equipamento-manipulacao select2">
                          <option value="" disabled selected>Equipamento Manipulação</option>
                          <?php foreach ($equipamentosManipulacao as $equipamentoManipulacao) : ?>
                            <option data-custo-hora="<?= $equipamentoManipulacao['valor'] ?>" value="<?= $equipamentoManipulacao['id']; ?>">
                              <?= $equipamentoManipulacao['nome']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <!-- Quantd. KG. -->
                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left: 0;">Quant. Kg</label>
                        <div class="input-group">
                          <input type="number" class="text-center form-control modal-visualizar-quantidade-manipulacao text-1000" aria-describedby="kg-addon">
                          <span class="input-group-text" id="kg-addon">KG.</span>
                        </div>
                      </div>


                      <!-- Tempo -->
                      <div class="col-md-2 mb-2 ">
                        <label class="form-label" style="padding-left:0;">Tempo</label>
                        <input type="text" class="mascara-tempo form-control modal-visualizar-tempo-manipulacao">
                      </div>

                      <!-- Valor Unit (R$) -->
                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Valor Unit (R$)</label>
                        <input type="text" value="" disabled class="text-1000 form-control modal-visualizar-valor-unit-manipulacao">
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-2">
                        <label class="form-label" style="padding-left:0;">Total (R$)</label>
                        <input type="text" value="" disabled class="text-1000 form-control modal-visualizar-custo-manipulacao-total">
                      </div>

                    </div>

                    <hr>

                    <div class="d-flex" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                      <div class="d-flex align-items-center">
                        <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem;">Sub-Total 2:</p>
                        <input disabled type="text" class="text-1000 form-control modal-visualizar-custo-sub-total-2" style="max-width: 120px;">
                      </div>
                    </div>

                    <hr>

                    <div class="row">

                      <div class="mb-2">
                        <h5>Custo de Envase + Rotulagem</h5>
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="form-label" style="padding-left:0;">Nível Equipamento</label>
                        <select class="modal-visualizar-id-equipamento-envase form-control select2">
                          <option value="" disabled selected>Equipamento Envase</option>
                          <?php foreach ($equipamentosEnvase as $equipamentoEnvase) : ?>
                            <option value="<?= $equipamentoEnvase['id']; ?>" data-pecas-hora-envase="<?= $equipamentoEnvase['pcs_hora'] ?>" data-valores-unit-total-envase="<?= $equipamentoEnvase['valor_mo'] ?>">
                              <?= $equipamentoEnvase['nivel'] . ' - ' . $equipamentoEnvase['nome']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>

                      </div>

                      <!-- Quantd. KG. -->
                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Quantidade</label>
                        <div class="group">
                          <input disabled class="text-center text-1000 form-control modal-visualizar-quantidade-final">
                        </div>
                      </div>

                      <!-- PCS HORA -->
                      <div class="col-md-2 mb-2">
                        <label class="form-label" for="pecasHoraInput" style="padding-left: 0;">Peças / Hora</label>
                        <div class="input-group">
                          <input id="pecasHoraInput" type="text" class="text-1000 form-control modal-visualizar-pcs-hora-envase" disabled aria-describedby="pecas-addon">
                          <span class="input-group-text" id="pecas-addon">PÇ.</span>
                        </div>
                      </div>


                      <!-- Valor Unit (R$) -->
                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Valor Unit (R$)</label>
                        <input type="text" value="" disabled class="text-1000 form-control modal-visualizar-valor-unit-envase">
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-2">
                        <label class="form-label" style="padding-left:0;">Total (R$)</label>
                        <input type="text" value="" disabled class="text-1000 form-control modal-visualizar-custo-envase-total">
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-4 mb-2">
                        <select class="modal-visualizar-id-equipamento-rotulagem form-control select2">
                          <option value="" disabled selected>Equipamento Rotulagem</option>
                          <?php foreach ($equipamentosRotulagem as $equipamentoRotulagem) : ?>
                            <option value="<?= $equipamentoRotulagem['id']; ?>" data-pecas-hora-rotulagem="<?= $equipamentoRotulagem['pcs_hora'] ?>" data-valores-unit-total-rotulagem="<?= $equipamentoRotulagem['valor_mo'] ?>">
                              <?= $equipamentoRotulagem['nivel'] . ' - ' . $equipamentoRotulagem['nome']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>

                      </div>

                      <!-- Quantd. KG. -->
                      <div class="col-md-2 mb-2">
                        <div class="group">
                          <input disabled type="text" class="text-center modal-visualizar-quantidade-final text-1000 form-control">
                        </div>
                      </div>

                      <!-- Peças Hora -->
                      <div class="col-md-2 mb-2">
                        <div class="input-group">
                          <input id="custoRotulagemInput" type="text" class="text-1000 form-control modal-visualizar-pcs-hora-rotulagem" disabled aria-describedby="pecas-addon">
                          <span class="input-group-text" id="pecas-addon">PÇ.</span>
                        </div>
                      </div>


                      <!-- Valor Unit (R$) -->
                      <div class="col-md-2 mb-2">
                        <input type="text" value="" disabled class="text-1000 form-control modal-visualizar-valor-unit-rotulagem">
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-2">
                        <input type="text" value="" disabled class="text-1000 form-control modal-visualizar-custo-rotulagem-total">
                      </div>

                    </div>

                    <hr>

                    <div class="d-flex" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                      <div class="d-flex align-items-center">
                        <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem;">Sub-Total 3:</p>
                        <input disabled type="text" class="text-1000 form-control modal-visualizar-custo-sub-total-3" style="max-width: 120px;">
                      </div>
                    </div>

                    <hr>

                    <div class="row">
                      <div class="mb-2">

                        <h5>Embalagem</h5>

                      </div>

                      <div class="row">
                        <!-- Tipo -->
                        <div class="col-md-3 mb-2">
                          <label class="form-label" style="padding-left:0;">Tipo</label>
                          <div class="fake-input form-control">Rótulo (Frente + Verso)</div>
                        </div>


                        <!-- Quantidade. -->
                        <div class="col-md-3 mb-2">
                          <label class="form-label" for="quantidadeInput" style="padding-left: 0;">Quantidade</label>
                          <div class="input-group">
                            <input id="quantidadeInput" type="number" disabled class="form-control text-1000 text-center modal-visualizar-quantidade-final" aria-describedby="un-addon">
                            <span class="input-group-text" id="un-addon">Un.</span>
                          </div>
                        </div>

                        <!-- Valor Unit (R$) -->
                        <div class=" 5 col-md-3 mb-2">
                          <label class="form-label" style="padding-left:0;">Valor Unit (R$)</label>
                          <div class="group">
                            <input type="text" class="modal-visualizar-valor-unit-rotulo form-control">

                          </div>

                        </div>

                        <!-- Total (R$) -->
                        <div class="col-md-3 mb-2">
                          <label class="form-label" style="padding-left:0;">Total (R$)</label>
                          <input type="text" disabled class="text-1000 form-control modal-visualizar-custo-embalagem-rotulo">
                        </div>
                      </div>

                      <div class="row">
                        <!-- Tipo -->
                        <div class="col-md-3 mb-2">
                          <div class="form-control fake-input">Frasco/Pote/Bisnaga/etc.</div>
                        </div>

                        <!-- Quantidade. -->
                        <div class="col-md-3 mb-2">
                          <div class="input-group">
                            <input id="quantidadeInput" type="number" disabled class="form-control text-1000 text-center modal-visualizar-quantidade-final" aria-describedby="un-addon">
                            <span class="input-group-text" id="un-addon">Un.</span>
                          </div>
                        </div>


                        <!-- Valor Unit (R$) -->
                        <div class="4 col-md-3 mb-2">
                          <div class="group ">
                            <input type="text" class="modal-visualizar-valor-unit-frasco form-control">
                          </div>
                        </div>

                        <!-- Total (R$) -->
                        <div class="col-md-3 mb-2">
                          <input type="text" disabled class="text-1000 form-control modal-visualizar-custo-embalagem-frasco">
                        </div>
                      </div>

                      <div class="row">
                        <!-- Tipo -->
                        <div class="col-md-3 mb-2">
                          <div class="form-control fake-input">Tampa / Válvula</div>
                        </div>

                        <!-- Quantidade. -->
                        <div class="col-md-3 mb-2">
                          <div class="input-group">
                            <input id="quantidadeInput" type="number" disabled class="form-control text-1000 text-center modal-visualizar-quantidade-final" aria-describedby="un-addon">
                            <span class="input-group-text" id="un-addon">Un.</span>
                          </div>
                        </div>

                        <!-- Valor Unit (R$) -->
                        <div class="col-md-3 mb-2">
                          <div class="group ">
                            <input type="text" class="modal-visualizar-valor-unit-tampa form-control">
                          </div>
                        </div>

                        <!-- Total (R$) -->
                        <div class="col-md-3 mb-2">
                          <input type="text" disabled class="text-1000 form-control modal-visualizar-custo-embalagem-tampa">
                        </div>
                      </div>

                      <div class="row">
                        <!-- Tipo -->
                        <div class="col-md-3 mb-2">
                          <div class="form-control fake-input">Display / Cartucho</div>
                        </div>

                        <!-- Quantidade. -->
                        <div class="col-md-3 mb-2">
                          <div class="input-group">
                            <input id="quantidadeInput" type="number" disabled class="form-control text-1000 text-center modal-visualizar-quantidade-final" aria-describedby="un-addon">
                            <span class="input-group-text" id="un-addon">Un.</span>
                          </div>
                        </div>


                        <!-- Valor Unit (R$) -->
                        <div class="col-md-3 mb-2">
                          <div class="group ">
                            <input type="text" class="modal-visualizar-valor-unit-display form-control">
                          </div>
                        </div>

                        <!-- Total (R$) -->
                        <div class="col-md-3 mb-2">
                          <input type="text" disabled class="text-1000 form-control modal-visualizar-custo-embalagem-display">
                        </div>
                      </div>

                      <div class="row">
                        <!-- Tipo -->
                        <div class="col-md-3 mb-2">
                          <div class="form-control fake-input">Caixa de Embarque</div>
                        </div>

                        <!-- Quantidade. -->
                        <div class="col-md-3 mb-2">
                          <div class="input-group">
                            <input id="quantidadeInput" type="number" disabled class="form-control text-1000 text-center modal-visualizar-quantidade-final" aria-describedby="un-addon">
                            <span class="input-group-text" id="un-addon">Un.</span>
                          </div>
                        </div>


                        <!-- Valor Unit (R$) -->
                        <div class="col-md-3 mb-2">
                          <div class="group ">
                            <input type="text" class="modal-visualizar-valor-unit-caixa-embarque form-control">

                          </div>
                        </div>

                        <!-- Total (R$) -->
                        <div class="col-md-3 mb-2">
                          <input type="text" disabled class="text-1000 form-control modal-visualizar-custo-embalagem-caixa-embarque">
                        </div>
                      </div>


                      <hr class="my-3">

                      <div class="d-flex" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                        <div class="d-flex align-items-center">
                          <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem;">Sub-Total 4:</p>
                          <input disabled type="text" class="text-1000 form-control modal-visualizar-custo-sub-total-4" style="max-width: 120px;">
                        </div>
                      </div>

                    </div>

                    <hr>
                    <!-- Custo Final -->
                    <div class="row">
                      <div class="mb-2">

                        <h5>Custo Final</h5>

                      </div>

                      <!-- Tipo -->
                      <div class="col-md-3 mb-2">
                        <label class="form-label" style="padding-left:0;">Tipo</label>
                        <div class="fake-input">Produto</div>
                      </div>


                      <!-- Quantidade. -->
                      <div class="col-md-3 mb-2">
                        <label class="form-label" for="quantidadeInput" style="padding-left: 0;">Quantidade</label>
                        <div class="input-group">
                          <input id="quantidadeInput" type="number" disabled class="form-control text-1000 text-center modal-visualizar-quantidade-final" aria-describedby="un-addon">
                          <span class="input-group-text" id="un-addon">Un.</span>
                        </div>
                      </div>


                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <label class="form-label" style="padding-left:0;">Valor Unit (R$)</label>
                        <div class="group">
                          <input type="text" disabled class="modal-visualizar-custo-final-valor-unit-produto form-control text-1000 text-center">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2">
                        <label class="form-label" style="padding-left:0;">Total (R$)</label>
                        <input type="text" value="" disabled class="modal-visualizar-custo-final-produto text-1000 form-control">
                      </div>

                      <!-- Tipo -->
                      <div class="col-md-3 mb-2">
                        <div class="fake-input">Manipulação</div>
                      </div>

                      <!-- Quantidade. -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input id="quantidadeInput" type="number" disabled class="form-control text-1000 text-center modal-visualizar-quantidade-final" aria-describedby="un-addon">
                          <span class="input-group-text" id="un-addon">Un.</span>
                        </div>
                      </div>

                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <div class="group">
                          <input type="text" disabled class="modal-visualizar-custo-final-valor-unit-manipulacao form-control text-1000 text-center">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2">
                        <input type="text" value="" disabled class="modal-visualizar-custo-final-manipulacao text-1000 form-control">
                      </div>

                      <!-- Tipo -->
                      <div class="col-md-3 mb-2">
                        <div class="fake-input">Envase</div>
                      </div>

                      <!-- Quantidade. -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input id="quantidadeInput" type="number" disabled class="form-control text-center text-1000 modal-visualizar-quantidade-final" aria-describedby="un-addon">
                          <span class="input-group-text" id="un-addon">Un.</span>
                        </div>
                      </div>


                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <div class="group">
                          <input type="text" disabled class="modal-visualizar-custo-final-valor-unit-envase form-control text-1000 text-center">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2">
                        <input type="text" value="" disabled class="modal-visualizar-custo-final-envase text-1000 form-control">
                      </div>

                      <!-- Tipo -->
                      <div class="col-md-3 mb-2">
                        <div class="fake-input">Rotulagem</div>
                      </div>

                      <!-- Quantidade. -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input id="quantidadeInput" type="number" disabled class="form-control text-center text-1000 modal-visualizar-quantidade-final" aria-describedby="un-addon">
                          <span class="input-group-text" id="un-addon">Un.</span>
                        </div>
                      </div>


                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <div class="group">
                          <input type="text" disabled class="modal-visualizar-custo-final-valor-unit-rotulagem text-1000 text-center form-control">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2">
                        <input type="text" value="" disabled class="modal-visualizar-custo-final-rotulagem text-1000 form-control">
                      </div>

                      <!-- Tipo -->
                      <div class="col-md-3 mb-2">
                        <div class="fake-input">Embalagem</div>
                      </div>

                      <!-- Quantidade. -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input id="quantidadeInput" type="number" disabled class="form-control modal-visualizar-quantidade-final text-center text-1000" aria-describedby="un-addon">
                          <span class="input-group-text" id="un-addon">Un.</span>
                        </div>
                      </div>


                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <div class="group">
                          <input type="text" disabled class="modal-visualizar-custo-final-valor-unit-embalagem text-1000 text-center form-control">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2">
                        <input type="text" disabled class="modal-visualizar-custo-final-embalagem text-1000 form-control">
                      </div>

                      <!-- Tipo -->
                      <div class="col-md-3 mb-2">
                        <div class="fake-input">Outros Custos</div>
                      </div>


                      <!-- Quantidade. -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input id="custoFinalQuantidadeInput" type="text" class="mascara-custos modal-visualizar-custo-outros form-control text-center text-1000" aria-describedby="un-addon">
                          <span class="input-group-text" id="un-addon">Un.</span>
                        </div>
                      </div>

                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <div class="group">
                          <input type="text" class="mascara-custos modal-visualizar-custo-final-valor-unit-outros text-1000 text-center form-control">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2">
                        <input type="text" value="" disabled class="modal-visualizar-custo-final-outros text-1000 form-control">
                      </div>

                      <!-- Tipo -->
                      <div class="col-md-3 mb-2">
                        <div class="fake-input">Percentual de perda</div>
                      </div>


                      <!-- Quantidade. -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input id="percentualInput" type="text" class="mascara-porcentagem modal-visualizar-custo-perda form-control text-center text-1000" aria-describedby="percentual-addon">
                          <span class="input-group-text" id="percentual-addon" style="width:53px;">%</span>
                        </div>
                      </div>


                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <div class="group">
                          <input type="text" disabled class="modal-visualizar-custo-final-valor-unit-perda text-1000 text-center form-control">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2">
                        <input type="text" value="" disabled class="modal-visualizar-custo-final-perda text-1000 form-control">
                      </div>

                      <hr>

                      <div class="d-flex" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                        <div class="d-flex align-items-center">
                          <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem;">Total Unit.:</p>
                          <input disabled type="text" class="text-1000 form-control modal-visualizar-custo-final-total-valor-unit" style="max-width: 120px; margin-right:0.5rem;">
                          <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem; margin-left:3rem;"> Total Geral:</p>
                          <input disabled type="text" class="text-1000 form-control modal-visualizar-custo-final-total" style="max-width: 120px;">
                        </div>
                      </div>

                    </div>

                    <hr>

                    <!-- Custo Lote Partida -->
                    <div class="row">
                      <div class="mb-2">
                        <h5>Custo por lote de partida</h5>
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="form-label" style="padding-left:0;">Lote:</label>
                        <input disabled type="text" class="text-1000 modal-visualizar-lote-partida form-control">
                      </div>

                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Produto</label>
                        <input disabled type="text" class="text-1000 modal-visualizar-lote-partida-produto form-control">
                      </div>

                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Mão de Obra</label>
                        <input disabled type="text" class="text-1000 modal-visualizar-lote-partida-mao-de-obra form-control">
                      </div>

                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Embalagem</label>
                        <input disabled type="text" class="text-1000 modal-visualizar-lote-partida-embalagem form-control">
                      </div>

                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Perda</label>
                        <input disabled type="text" class="text-1000 modal-visualizar-lote-partida-perda form-control">
                      </div>
                    </div>

                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <!-- Aqui você pode adicionar botões ou outras informações -->
      </div>
    </div>
  </div>
</div>