  <!-- Modal desenvolver projeto -->
  <div class="modal fade" id="modalDesenvolverProjeto" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
      <!-- style="padding-bottom:80px; Para modal caso nao esteja centralizado-->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDesenvolverProjetoTitulo"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-body-desenvolver-projeto">

          <input type="hidden" id="id_cliente_redirect" name="id_cliente_redirect" val="<?= $this->uri->segment(4) ?>">

          <div class="card">
            <div class="card-body">
              <div class="col-12">
                <div class="mb-3">

                  <div id="alerta-selecione-campos" class="alert alert-secondary" role="alert">
                    Para liberar os campos selecione um dos projetos deste cliente.
                  </div>

                  <div class="col-md-3 mb-3">
                    <label for="select_projeto_cliente" class="form-label">Selecione o Projeto</label>
                    <select id="select_projeto_cliente" class="form-select select2">
                      <option selected disabled value="">Desenvolver Projeto</option>
                      <?php foreach ($projetosAtivos as $projetoAtivo) : ?>
                        <?php if ($projetoAtivo['desenvolvido'] == 0) : ?>
                          <option data-versao-projeto="<?= $projetoAtivo['versao_projeto'] ?>" data-id-projeto="<?= $projetoAtivo['id'] ?>" data-nome-produto="<?= $projetoAtivo['nome_produto'] ?>" data-nome-fantasia="<?= $projetoAtivo['nome_fantasia'] ?>" value="<?= $projetoAtivo['codigo_projeto'] ?>"><?= $projetoAtivo['nome_produto'] ?></option>
                        <?php endif ?>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="container container-modal-desenvolver-projeto d-none">

                    <div class="row ">
                      <hr>
                    </div>

                    <!-- formulacao -->
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

                      <div class="col-md-4 mb-2 inputs-projeto">
                        <label class="text-body-highlight">Quantidade</label>
                        <input name="quantidade_geral_projeto" required type="text" class="input-formulacao mascara-peso form-control modal-desenvolver-input-quantidade campo-obrigatorio">
                        <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                      </div>

                    </div>

                    <hr class="my-3">

                    <!-- materia prima -->
                    <div class="row inputs-materia-prima">

                      <div class="col-md-4 mb-2 div-materia-prima">
                        <label class="form-label" style="padding-left:0;">Matéria-Prima </label>
                        <select id="select_materia_prima_main" name="id_materia_prima" class="input-materia-prima form-control campo-briefing select2 modal-desenvolver-select-materia-prima select-principal-materia-prima campo-obrigatorio" name="select-materia-prima">
                          <!-- js -->
                        </select>
                        <div class="d-none aviso-obrigatorio">Preencha este campo</div>

                      </div>

                      <!-- fase -->
                      <div class="col-md-1 mb-2 div-fase">
                        <label class="form-label" style="padding-left:0;">Fase</label>
                        <input disabled name="fase" type="text" class="mascara-fase inputs-tipo-texto input-materia-prima form-control modal-desenvolver-input-fase modal-desenvolver-input-fase">
                      </div>

                      <!-- Percentual -->
                      <div class="col-md-2 mb-2 div-percentual">
                        <label class="form-label" style="padding-left:0;">Percentual</label>
                        <div class="input-group">
                          <input disabled name="percentual" type="number" class="input-materia-prima form-control modal-desenvolver-input-percentual modal-desenvolver-input-percentual-principal campo-obrigatorio">
                          <span class="input-group-text">%</span>
                          <div class="d-none aviso-obrigatorio">Preencha este campo</div>

                        </div>
                      </div>

                      <!-- Quantidade -->
                      <div class="col-md-2 mb-2 div-quantidade">
                        <label class="form-label" style="padding-left:0;">Quantidade</label>
                        <div class="input-group">
                          <input name="quantidade" type="text" disabled class="input-materia-prima text-1000 mascara-peso form-control modal-desenvolver-input-quantidade-materia-prima">
                          <span class="input-group-text">KG.</span>
                        </div>
                      </div>

                      <!-- Total -->
                      <div class="col-md-2 mb-2 div-total-linha">
                        <label class="form-label" style="padding-left:0;">Total (R$)</label>
                        <input name="total" type="text" disabled class="input-materia-prima text-1000 form-control modal-desenvolver-input-total-materia-prima">
                      </div>

                      <div class="col-md-1">
                        <button disabled class="mt-4 btn btn-phoenix-success novo-input-materia-prima btn-duplica-linha">+</button>
                      </div>
                    </div>

                    <div class="campos-duplicados">
                      <!-- JS -->
                    </div>


                    <hr>
                    <div class="row inputs-projeto">
                      <div class="d-flex" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                        <a type="button" class="btn btn-phoenix-info abre_modal_cadastro_materia_prima" style="position: absolute;left:15px;">+ Cadastrar matéria prima</a>
                        <div class="d-flex align-items-center" style="margin-right: 1rem;">
                          <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem; margin-left: 10px; font-weight: bold;">Porcentagem Total:</p>
                          <div style="display: flex; flex-direction: column; align-items: flex-start; margin-left: 5px;">
                            <input name="porcentagem_total" disabled type="text" class="input-formulacao form-control input-porcentagem-total text-1000" style="max-width: 120px; border-radius: 4px; padding: 0.5rem;">
                            <div class="aviso-porcentagem d-none" style="color: red; margin-top: 5px; font-size: 0.9rem;">Porcentagem excedeu 100%.</div>
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem; font-weight: bold;">Sub-Total 1:</p>
                          <input name="custo_sub_total_1" disabled type="text" class="input-formulacao text-1000 form-control input-sub-total" style="max-width: 120px; border-radius: 4px; padding: 0.5rem;">
                        </div>
                      </div>
                    </div>


                    <hr>



                    <div class="inputs-projeto">
                      <label class="form-label">Modo de Fabricação</label>

                      <textarea class="inputs-tipo-texto form-control input" name="modo_fabricacao" cols="30" rows="5"></textarea>

                      <div class="row">
                        <div class="col-md-6">
                          <label class="form-label">PH Final do Produto:</label>
                          <input class="inputs-tipo-texto form-control" name="ph_final_produto" type="text">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Nome da Fragrância:</label>
                          <input class="inputs-tipo-texto form-control" name="nome_fragancia" type="text">
                        </div>
                      </div>
                    </div>


                    <hr>

                    <div class="row campos-custo-manipulacao">
                      <div class="mb-2">

                        <h5>Custo de Manipulação</h5>

                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="form-label" style="padding-left:0;">Nivel Equipamento</label>
                        <select required id="select-equipamentos-manipulacao" class="campo-obrigatorio form-control modal-desenvolver-input-nivel-produto select2">
                          <option value="" disabled selected>Equipamento Manipulação</option>
                          <?php foreach ($equipamentosManipulacao as $equipamentoManipulacao) : ?>
                            <option data-custo-hora="<?= $equipamentoManipulacao['valor'] ?>" value="<?= $equipamentoManipulacao['id']; ?>">
                              <?= $equipamentoManipulacao['nome']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                        <div class="d-none aviso-obrigatorio">Preencha este campo</div>

                      </div>


                      <!-- Quantd. KG. -->
                      <div class="col-md-2 mb-2 div-percentual">
                        <label class="form-label" style="padding-left:0;">Quant. Kg</label>
                        <div class="input-group">
                          <input type="number" class="campo-obrigatorio text-center form-control input-quantidade-manipulacao text-1000">
                          <span class="input-group-text">KG.</span>
                          <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                        </div>
                      </div>

                      <!-- Tempo -->
                      <div class="col-md-2 mb-2 div-quantidade">
                        <label class="form-label" style="padding-left:0;">Tempo</label>
                        <input type="text" class="campo-obrigatorio mascara-tempo form-control modal-desenvolver-custo-manipulacao-tempo">
                        <div class="d-none aviso-obrigatorio">Preencha este campo</div>

                      </div>

                      <!-- Valor Unit (R$) -->
                      <div class="col-md-2 mb-2 div-total-linha">
                        <label class="form-label" style="padding-left:0;">Valor Unit (R$)</label>
                        <input type="text" value="" disabled class="text-1000 form-control modal-desenvolver-custo-manipulacao-valor-unit">
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-2 inputs-projeto">
                        <label class="form-label" style="padding-left:0;">Total (R$)</label>
                        <input name="custo_manipulacao_total" type="text" value="" disabled class="text-1000 form-control modal-desenvolver-custo-manipulacao-valor-unit">
                      </div>

                    </div>

                    <hr>

                    <div class="d-flex inputs-projeto" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                      <div class="d-flex align-items-center">
                        <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem;">Sub-Total 2:</p>
                        <input name="custo_sub_total_2" disabled type="text" class="text-1000 form-control input-sub-total-2 modal-desenvolver-custo-manipulacao-valor-unit" style="max-width: 120px;">
                      </div>
                    </div>

                    <hr>

                    <div class="row campos-custo-envase-rotulagem">

                      <div class="mb-2">
                        <h5>Custo de Envase + Rotulagem</h5>
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="form-label" style="padding-left:0;">Nível Equipamento</label>
                        <select id="select-equipamentos-envase" class="campo-obrigatorio form-control select2">
                          <option value="" disabled selected>Equipamento Envase</option>
                          <?php foreach ($equipamentosEnvase as $equipamentoEnvase) : ?>
                            <option value="<?= $equipamentoEnvase['id']; ?>" data-pecas-hora-envase="<?= $equipamentoEnvase['pcs_hora'] ?>" data-valores-unit-total-envase="<?= $equipamentoEnvase['valor_mo'] ?>">
                              <?= $equipamentoEnvase['nivel'] . ' - ' . $equipamentoEnvase['nome']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                        <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                      </div>

                      <!-- Quantd. KG. -->
                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Quantidade</label>
                        <div class="input-group">
                          <input disabled class="text-center text-1000 form-control input-quantidade input-quantidade-envase">
                        </div>
                      </div>

                      <!-- Tempo -->
                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Peças / Hora</label>
                        <div class="input-group">
                          <input type="text" disabled class="text-1000 form-control modal-desenvolver-custo-envase-pecas-hora">
                          <span class="input-group-text">PÇ.</span>
                        </div>
                      </div>

                      <!-- Valor Unit (R$) -->
                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Valor Unit (R$)</label>
                        <input type="text" value="" disabled class="text-1000 form-control modal-desenvolver-custo-envase-valor-unit">
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-2 inputs-projeto">
                        <label class="form-label" style="padding-left:0;">Total (R$)</label>
                        <input name="custo_envase_total" type="text" value="" disabled class="text-1000 form-control modal-desenvolver-custo-envase-valor-total">
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-4 mb-2">
                        <select id="select-equipamentos-rotulagem" class="campo-obrigatorio form-control select2">
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
                          <input disabled type="text" class="text-center input-quantidade-rotulagem input-quantidade text-1000 form-control">
                        </div>
                      </div>

                      <!-- Peças Hora -->
                      <div class="col-md-2 mb-2">
                        <div class="input-group">
                          <input disabled type="text" class="text-1000 form-control modal-desenvolver-custo-rotulagem-pecas-hora">
                          <span class="input-group-text">PÇ.</span>
                        </div>
                      </div>

                      <!-- Valor Unit (R$) -->
                      <div class="col-md-2 mb-2">
                        <input type="text" value="" disabled class="text-1000 form-control modal-desenvolver-custo-rotulagem-valor-unit">
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-2 inputs-projeto">
                        <input name="custo_rotulagem_total" type="text" value="" disabled class="text-1000 form-control modal-desenvolver-custo-rotulagem-valor-total">
                      </div>

                    </div>

                    <hr>

                    <div class="d-flex inputs-projeto" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                      <div class="d-flex align-items-center">
                        <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem;">Sub-Total 3:</p>
                        <input name="custo_sub_total_3" disabled type="text" class="text-1000 form-control input-sub-total-3" style="max-width: 120px;">
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
                        <div class="col-md-3 mb-2 div-quantidade-embalagem">
                          <label class="form-label" style="padding-left:0;">Quantidade</label>
                          <div class="input-group ">
                            <input type="number" disabled class="form-control text-1000 text-center input-quantidade">
                            <span class="input-group-text">Un.</span>
                          </div>
                        </div>

                        <!-- Valor Unit (R$) -->
                        <div class=" 5 col-md-3 mb-2 div-valor-unit-embalagem">
                          <label class="form-label" style="padding-left:0;">Valor Unit (R$)</label>
                          <div class="input-group">
                            <input type="text" class="campo-obrigatorio input-valor-unit-embalagem form-control">
                            <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                          </div>

                        </div>

                        <!-- Total (R$) -->
                        <div class="col-md-3 mb-2 div-total-linha-embalagem inputs-projeto">
                          <label class="form-label" style="padding-left:0;">Total (R$)</label>
                          <input name="custo_embalagem_rotulo" type="text" disabled class="text-1000 form-control input-total-linha-embalagem">
                        </div>
                      </div>

                      <div class="row">
                        <!-- Tipo -->
                        <div class="col-md-3 mb-2">
                          <div class="form-control fake-input">Frasco/Pote/Bisnaga/etc.</div>
                        </div>

                        <!-- Quantidade. -->
                        <div class="col-md-3 mb-2 div-quantidade-embalagem">
                          <div class="input-group ">
                            <input type="number" disabled class="form-control text-1000 text-center input-quantidade">
                            <span class="input-group-text">Un.</span>
                          </div>
                        </div>

                        <!-- Valor Unit (R$) -->
                        <div class="4 col-md-3 mb-2 div-valor-unit-embalagem">
                          <div class="input-group ">
                            <input type="text" class="campo-obrigatorio input-valor-unit-embalagem form-control">
                            <div class="d-none aviso-obrigatorio">Preencha este campo</div>

                          </div>
                        </div>

                        <!-- Total (R$) -->
                        <div class="col-md-3 mb-2 div-total-linha-embalagem inputs-projeto">
                          <input name="custo_embalagem_frasco" type="text" disabled class="text-1000 form-control input-total-linha-embalagem">
                        </div>
                      </div>

                      <div class="row">
                        <!-- Tipo -->
                        <div class="col-md-3 mb-2">
                          <div class="form-control fake-input">Tampa / Válvula</div>
                        </div>

                        <!-- Quantidade. -->
                        <div class="col-md-3 mb-2 div-quantidade-embalagem">
                          <div class="input-group ">
                            <input type="number" disabled class="form-control text-1000 text-center input-quantidade">
                            <span class="input-group-text">Un.</span>
                          </div>
                        </div>

                        <!-- Valor Unit (R$) -->
                        <div class="col-md-3 mb-2 div-valor-unit-embalagem">
                          <div class="input-group ">
                            <input type="text" class="campo-obrigatorio input-valor-unit-embalagem form-control">
                            <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                          </div>
                        </div>

                        <!-- Total (R$) -->
                        <div class="col-md-3 mb-2 div-total-linha-embalagem inputs-projeto">
                          <input name="custo_embalagem_tampa" type="text" disabled class="text-1000 form-control input-total-linha-embalagem">
                        </div>
                      </div>

                      <div class="row">
                        <!-- Tipo -->
                        <div class="col-md-3 mb-2">
                          <div class="form-control fake-input">Display / Cartucho</div>
                        </div>

                        <!-- Quantidade. -->
                        <div class="col-md-3 mb-2 div-quantidade-embalagem">
                          <div class="input-group">
                            <input type="number" disabled class="form-control text-1000 text-center input-quantidade">
                            <span class="input-group-text">Un.</span>
                          </div>
                        </div>

                        <!-- Valor Unit (R$) -->
                        <div class="col-md-3 mb-2 div-valor-unit-embalagem">
                          <div class="input-group ">
                            <input type="text" class="campo-obrigatorio input-valor-unit-embalagem form-control">
                            <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                          </div>
                        </div>

                        <!-- Total (R$) -->
                        <div class="col-md-3 mb-2 div-total-linha-embalagem inputs-projeto">
                          <input type="text" name="custo_embalagem_display" disabled class="text-1000 form-control input-total-linha-embalagem">
                        </div>
                      </div>

                      <div class="row">
                        <!-- Tipo -->
                        <div class="col-md-3 mb-2">
                          <div class="form-control fake-input">Caixa de Embarque</div>
                        </div>

                        <!-- Quantidade. -->
                        <div class="col-md-3 mb-2 div-quantidade-embalagem">
                          <div class="input-group ">
                            <input type="number" disabled class="form-control text-1000 text-center input-quantidade">
                            <span class="input-group-text">Un.</span>
                          </div>
                        </div>

                        <!-- Valor Unit (R$) -->
                        <div class="col-md-3 mb-2 div-valor-unit-embalagem">
                          <div class="input-group ">
                            <input type="text" class="campo-obrigatorio input-valor-unit-embalagem form-control">
                            <div class="d-none aviso-obrigatorio">Preencha este campo</div>
                          </div>
                        </div>

                        <!-- Total (R$) -->
                        <div class="col-md-3 mb-2 div-total-linha-embalagem inputs-projeto">
                          <input type="text" name="custo_embalagem_caixa_embarque" disabled class="text-1000 form-control input-total-linha-embalagem">
                        </div>
                      </div>


                      <hr class="my-3">

                      <div class="d-flex inputs-projeto" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                        <div class="d-flex align-items-center">
                          <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem;">Sub-Total 4:</p>
                          <input name="custo_sub_total_4" disabled type="text" class="text-1000 form-control input-sub-total-4" style="max-width: 120px;">
                        </div>
                      </div>

                    </div>

                    <hr>
                    <!-- Custo Final -->
                    <div class="row inputs-custo-final">
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
                        <label class="form-label" style="padding-left:0;">Quantidade</label>
                        <div class="input-group">
                          <input type="number" disabled class="form-control text-1000 text-center input-quantidade">
                          <span class="input-group-text">Un.</span>
                        </div>
                      </div>

                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <label class="form-label" style="padding-left:0;">Valor Unit (R$)</label>
                        <div class="input-group">
                          <input type="text" disabled class="input-custo-final-valor-unit-produto form-control text-1000 text-center">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2 inputs-projeto">
                        <label class="form-label" style="padding-left:0;">Total (R$)</label>
                        <input name="custo_final_produto" type="text" value="" disabled class="input-custo-final-total-produto text-1000 form-control">
                      </div>

                      <!-- Tipo -->
                      <div class="col-md-3 mb-2">
                        <div class="fake-input">Manipulação</div>
                      </div>

                      <!-- Quantidade. -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input type="number" disabled class="form-control text-1000 text-center input-quantidade">
                          <span class="input-group-text">Un.</span>
                        </div>
                      </div>

                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input type="text" disabled class="input-custo-final-valor-unit-manipulacao form-control text-1000 text-center">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2 inputs-projeto">
                        <input name="custo_final_manipulacao" type="text" value="" disabled class="input-custo-final-total-manipulacao text-1000 form-control">
                      </div>

                      <!-- Tipo -->
                      <div class="col-md-3 mb-2">
                        <div class="fake-input">Envase</div>
                      </div>

                      <!-- Quantidade. -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input type="number" disabled class="form-control text-center text-1000 input-quantidade">
                          <span class="input-group-text">Un.</span>
                        </div>
                      </div>

                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input type="text" disabled class="input-custo-final-valor-unit-envase form-control text-1000 text-center">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2 inputs-projeto">
                        <input name="custo_final_envase" type="text" value="" disabled class="input-custo-final-total-envase text-1000 form-control">
                      </div>
                      <!-- Tipo -->
                      <div class="col-md-3 mb-2">
                        <div class="fake-input">Rotulagem</div>
                      </div>


                      <!-- Quantidade. -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input type="number" disabled class="form-control text-center text-1000 input-quantidade">
                          <span class="input-group-text">Un.</span>
                        </div>
                      </div>

                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input type="text" disabled class="input-custo-final-valor-unit-rotulagem text-1000 text-center form-control">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2 inputs-projeto">
                        <input name="custo_final_rotulagem" type="text" value="" disabled class="input-custo-final-total-rotulagem text-1000 form-control">
                      </div>
                      <!-- Tipo -->
                      <div class="col-md-3 mb-2">
                        <div class="fake-input">Embalagem</div>
                      </div>


                      <!-- Quantidade. -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input type="number" disabled class="form-control input-quantidade text-center text-1000">
                          <span class="input-group-text">Un.</span>
                        </div>
                      </div>

                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input type="text" disabled class="input-custo-final-valor-unit-embalagem text-1000 text-center form-control">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2 inputs-projeto">
                        <input name="custo_final_embalagem" type="text" value="" disabled class="input-custo-final-total-embalagem text-1000  form-control">
                      </div>

                      <!-- Tipo -->
                      <div class="col-md-3 mb-2">
                        <div class="fake-input">Outros Custos</div>
                      </div>


                      <!-- Quantidade. -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input type="text" class="mascara-custos input-custo-final-quantidade-outros-custos form-control text-center text-1000">
                          <span class="input-group-text">Un.</span>
                        </div>
                      </div>

                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input type="text" class="mascara-custos input-custo-final-valor-unit-outros-custos text-1000 text-center form-control">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2 inputs-projeto">
                        <input name="custo_final_outros" type="text" value="" disabled class="input-custo-final-total-outros-custos text-1000 form-control">
                      </div>

                      <!-- Tipo -->
                      <div class="col-md-3 mb-2">
                        <div class="fake-input">Percentual de perda</div>
                      </div>


                      <!-- Quantidade. -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input type="text" class="mascara-porcentagem input-quantidade-percentual-perda form-control text-center text-1000">
                          <span class="input-group-text justify-content-center" style="width:53px;"> %</span>
                        </div>
                      </div>

                      <!-- Valor Unit (R$) -->
                      <div class="col-md-3 mb-2">
                        <div class="input-group">
                          <input type="text" disabled class="input-custo-final-valor-unit-percentual-perda text-1000 text-center form-control">
                        </div>
                      </div>

                      <!-- Total (R$) -->
                      <div class="col-md-3 mb-2 inputs-projeto">
                        <input name="custo_final_perda" type="text" value="" disabled class="input-custo-final-total-percentual-perda text-1000 form-control">
                      </div>

                      <hr>

                      <div class="d-flex inputs-projeto" style="flex-grow: 1; justify-content: flex-end; align-items: center;">
                        <div class="d-flex align-items-center">
                          <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem;">Total Unit.:</p>
                          <input name="custo_final_total_valor_unit" disabled type="text" class="text-1000 form-control input-custo-final-total-unit" style="max-width: 120px; margin-right:0.5rem;">
                          <p class="mb-0" style="margin-bottom: 0; margin-right: 0.5rem; margin-left:3rem;"> Total Geral:</p>
                          <input name="custo_final_total" disabled type="text" class="teste text-1000 form-control input-custo-final-total-geral" style="max-width: 120px;">
                        </div>
                      </div>

                    </div>

                    <hr>

                    <!-- Custo Lote Partida -->
                    <div class="row inputs-projeto">
                      <div class="mb-2">
                        <h5>Custo por lote de partida</h5>
                      </div>

                      <div class="col-md-4 mb-2">
                        <label class="form-label" style="padding-left:0;">Lote:</label>
                        <input name="lote_partida" disabled type="text" class="text-1000 text-lote-partida inputs-tipo-texto form-control">
                      </div>

                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Produto</label>
                        <input name="lote_partida_produto" disabled type="text" class="text-1000 input-custo-final-total-produto-lote-partida form-control">
                      </div>

                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Mão de Obra</label>
                        <input name="lote_partida_mao_de_obra" disabled type="text" class="text-1000 input-custo-final-total-mao-de-obra-lote-partida form-control">
                      </div>

                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Embalagem</label>
                        <input name="lote_partida_embalagem" disabled type="text" class="text-1000 input-custo-final-total-embalagem-lote-partida form-control">
                      </div>

                      <div class="col-md-2 mb-2">
                        <label class="form-label" style="padding-left:0;">Perda</label>
                        <input name="lote_partida_perda" disabled type="text" class="text-1000 input-custo-final-total-percentual-perda-lote-partida form-control">
                      </div>
                    </div>




                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer d-flex justify-content-between">

          <button type="button" class="btn btn-phoenix-primary me-2 abre_modal_custo_produtivo">
            <span class="fa-solid fas fa-dollar-sign me-2"></span>
            Custo Produtivo
          </button>

          <div class="ms-auto">
            <button class="btn btn-phoenix-success btn-desenvolver-projeto d-none" type="submit" onclick="desenvolverProjeto(<?= $this->uri->segment(3) ?>)">Vincular Valores</button>
          </div>
        </div>

      </div>
    </div>
  </div>





  <!-- Custo por lote -->
  <!-- <hr>
  <div class="row">

    <div class="mb-2">

      <h5>Custo por lote de partida</h5>

    </div>

    <div class="col-md-4 mb-2">
      <label class="form-label" style="padding-left:0;">Lote:</label>
      <div class="fake-input text-center">Especial 50,000</div>
    </div>


    <div class="col-md-2 mb-2">
      <label class="form-label" style="padding-left:0;">Produto</label>
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <label class="form-label" style="padding-left:0;">Mão de Obra</label>
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <label class="form-label" style="padding-left:0;">Embalagem</label>
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <label class="form-label" style="padding-left:0;">Perda</label>
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

  </div>

  <div class="row">

    <div class="col-md-4 mb-2">
      <div class="fake-input text-center">100,000</div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

  </div>

  <div class="row">

    <div class="col-md-4 mb-2">
      <div class="fake-input text-center">340,000</div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

  </div>

  <div class="row">

    <div class="col-md-4 mb-2">
      <div class="fake-input text-center">560,000</div>
    </div>


    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

  </div>

  <div class="row">

    <div class="col-md-4 mb-2">
      <div class="fake-input text-center">1000,000</div>
    </div>


    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

    <div class="col-md-2 mb-2">
      <div class="input-group">
        <span class="input-group-text">R$</span>
        <input type="number" class="form-control">
      </div>
    </div>

  </div> -->