  <!-- Modal Custo Produtivo -->
  <div class="modal fade" id="modalCustoProdutivo" tabindex="-1" aria-labelledby="modalCustoProdutivo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" style="max-width: 800px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCustoProdutivoLabel">Definir Custo Manipulação, Envase e Rotulagem</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="overflow-x:hidden;">
          <div class="card theme-wizard mb-5">

            <div class="card-header bg-100 pt-3 pb-2 border-bottom-0">
              <ul class="nav justify-content-between nav-wizard">
                <li class="nav-item">
                  <a class="nav-link active fw-semi-bold btn-etapas btn-manipulation" href="#tab-manipulacao" data-bs-toggle="tab" data-wizard-step="1">
                    <div class="text-center d-inline-block">
                      <span class="nav-item-circle-parent" style="left:-10px;">
                        <span class="nav-item-circle">
                          <span class="fas fa-info-circle"></span>
                        </span>
                      </span>
                      <span class="d-none d-md-block mt-1 fs--1">Manipulação</span>
                    </div>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link fw-semi-bold btn-etapas" href="#tab-envase" data-bs-toggle="tab" data-wizard-step="2">
                    <div class="text-center d-inline-block">
                      <span class="nav-item-circle-parent">
                        <span class="nav-item-circle">
                          <span class="fas fa-pen-square"></span>
                        </span>
                      </span>
                      <span class="d-none d-md-block mt-1 fs--1">Envase</span>
                    </div>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link fw-semi-bold btn-etapas" href="#tab-rotulagem" data-bs-toggle="tab" data-wizard-step="3">
                    <div class="text-center d-inline-block">
                      <span class="nav-item-circle-parent">
                        <span class="nav-item-circle">
                          <span class="fas fa-money-check-alt"></span>
                        </span>
                      </span>
                      <span class="d-none d-md-block mt-1 fs--1">Rotulagem</span>
                    </div>
                  </a>
                </li>
              </ul>
            </div>

            <div class="row">
              <div class="card-body pt-4 pb-0">
                <div class="d-flex justify-content-between pb-3">
                  <!-- Botão para abrir o modal de níveis -->
                  <button type="button" class="btn btn-secondary abre_modal_niveis">
                    Verificar Níveis
                  </button>
                </div>

                <div class="tab-content col-md-12">
                  <!-- Manipulação Tab -->
                  <div class="tab-pane active" role="tabpanel" aria-labelledby="tab-manipulacao" id="tab-manipulacao">
                    <div class="mb-3">
                      <label for="inputCustoHoraManipulacao" class="form-label">Custo Hora (R$):</label>
                      <input type="text" value="<?= number_format(($custoHoraManipulacao['valor'] ?? 0), 2, ',', '.') ?>" class="form-control mascara-dinheiro" id="inputCustoHoraManipulacao" placeholder="Insira o valor base">
                    </div>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Equipamento</th>
                          <!-- <th>Nível</th> -->
                        </tr>
                      </thead>
                      <!-- <tbody>
                          <?php foreach ($equipamentosManipulacao as $equipamentoManipulacao) : ?>
                            <tr>
                              <td class="no-padding" style="padding-left: 10px;"><?= $equipamentoManipulacao['nome'] ?></td>
                              <td class="no-padding"><?= $equipamentoManipulacao['nivel'] . ' - ' . $equipamentoManipulacao['tanque'] ?> &nbsp; KG</td>
                            </tr>
                          <?php endforeach ?>
                        </tbody> -->
                      <tbody class="text-center">
                        <tr>
                          <td class="ps-2">Artesanal</td>
                        </tr>
                        <tr>
                          <td class="ps-2">100 KG</td>
                        </tr>
                        <tr>
                          <td class="ps-2">340 KG</td>
                        </tr>
                        <tr>
                          <td class="ps-2">560 KG</td>
                        </tr>
                        <tr>
                          <td class="ps-2">1000 KG</td>
                        </tr>
                      </tbody>

                    </table>
                  </div>

                  <div class="tab-pane" role="tabpanel" aria-labelledby="tab-envase" id="tab-envase">
                    <label for="inputCustoHoraEnvase" class="form-label">Custo Hora(R$):</label>
                    <div class="mb-3">
                      <div class="mb-3 col-md-12">
                        <input type="text" value="<?= number_format(($equipamentosEnvase[0]['valor_base'] ?? '0'), 2, ',', '.') ?>" class="form-control mascara-dinheiro" id="inputCustoHoraEnvase" placeholder="Insira o valor base">
                      </div>
                    </div>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Equipamento</th>
                          <th>Nível</th>
                          <th>PÇs/Hora</th>
                          <th>Valor MO</th>
                        </tr>
                      </thead>
                      <tbody style="font-size:15px;">
                        <?php foreach ($equipamentosEnvase as $equipamentoEnvase) : ?>
                          <tr>
                            <td class="no-padding" style="padding-left: 10px;"><?= $equipamentoEnvase['nome'] ?></td>
                            <td class="no-padding"><?= $equipamentoEnvase['nivel'] ?> </td>
                            <td class="editable no-padding">
                              <input value="<?= $equipamentoEnvase['pcs_hora'] == 0 ? '' : $equipamentoEnvase['pcs_hora'] ?>" data-mo-envase="<?= $equipamentoEnvase['mo'] ?>" data-id-equipamento-envase="<?= $equipamentoEnvase['id'] ?>" class="input-custo-producao input-equipamento-envase equipamento-envase-<?= $equipamentoEnvase['id'] ?>" type="text" placeholder="00">
                            </td>
                            <td class="no-padding valores-totais-envase valor-total-envase-<?= $equipamentoEnvase['id'] ?>">R$ <?= number_format($equipamentoEnvase['valor_mo'] ?? 0.00, 2, ',', '.') ?></td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>

                  <div class="tab-pane" role="tabpanel" aria-labelledby="tab-rotulagem" id="tab-rotulagem">
                    <div class="mb-3">
                      <label for="inputCustoHoraRotulagem" class="form-label">Custo Hora (R$):</label>
                      <input type="text" value="<?= number_format(($equipamentosRotulagem[0]['valor_base'] ?? 0), 2, ',', '.') ?>" class="form-control mascara-dinheiro" id="inputCustoHoraRotulagem" placeholder="Insira o valor base">
                    </div>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Equipamento</th>
                          <th>Nível</th>
                          <th>PÇs/Hora</th>
                          <th>Valor MO</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($equipamentosRotulagem as $equipamentoRotulagem) : ?>
                          <tr>
                            <td class="no-padding" style="padding-left: 10px;"><?= $equipamentoRotulagem['nome'] ?></td>
                            <td class="no-padding"><?= $equipamentoRotulagem['nivel'] . ' - ' . $equipamentoRotulagem['tipo'] ?></td>
                            <td class="editable no-padding">
                              <input value="<?= $equipamentoRotulagem['pcs_hora'] == 0 ? '' : $equipamentoRotulagem['pcs_hora'] ?>" data-id-equipamento-rotulagem="<?= $equipamentoRotulagem['id'] ?>" class="input-custo-producao input-equipamento-rotulagem" type="text" placeholder="00">
                            </td>
                            <td class="no-padding valores-totais-rotulagem valor-total-rotulagem-<?= $equipamentoRotulagem['id'] ?>">R$ <?= number_format($equipamentoRotulagem['valor_mo'] ?? 0.00, 2, ',', '.') ?></td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <div class="modal-footer">
          <a class="btn btn-phoenix-warning btn-abre-modal-desenvolver-projeto" title="Desenvolver Projeto" type="button" data-bs-toggle="modal" data-bs-target="#modalDesenvolverProjeto" onclick="modalDesenvolverProjeto()">
            <span class="far fa-id-card me-2"></span>
            Desenvolver Projeto
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Niveis-->
  <div class="modal fade" id="modalNiveisProdutos" tabindex="-1" aria-labelledby="modalNiveisProdutosLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalNiveisProdutosLabel">Níveis e Produtos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">Nível</th>
                <th>Produto</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">1</td>
                <td>Shampoos, Sabonetes líquidos de baixa complexidade</td>
              </tr>
              <tr>
                <td class="text-center">2</td>
                <td>Shampoos, Sabonetes líquidos de alta complexidade</td>
              </tr>
              <tr>
                <td class="text-center">3</td>
                <td>Cremes, Condicionadores, Desodorante Rollon, Serum de baixa complexidade</td>
              </tr>
              <tr>
                <td class="text-center">4</td>
                <td>Cremes, Condicionadores de alta complexidade</td>
              </tr>
              <tr>
                <td class="text-center">5</td>
                <td>Cremes, Máscaras, Matizadores de alta complexidade</td>
              </tr>
              <tr>
                <td class="text-center">6</td>
                <td>Géis</td>
              </tr>
              <tr>
                <td class="text-center">7</td>
                <td>Produtos líquidos</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>