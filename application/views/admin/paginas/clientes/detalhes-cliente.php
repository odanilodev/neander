<div class="content">

  <div class="pb-9">
    <div class="row align-items-center justify-content-between g-3 mb-4">
      <div class="col-12 col-md-auto">
        <h2 class="mb-0">Detalhes do Cliente</h2>
      </div>
      <div class="col-12 col-md-auto d-flex">

        <a href="<?= base_url('clientes/formulario/' . $cliente['id'] ?? "") ?>" class="btn btn-phoenix-secondary px-3 px-sm-5 me-2">
          <span class="fa-solid fa-edit me-sm-2"></span>
          <span class="d-none d-sm-inline">Editar </span>
        </a>

        <button class="btn btn-phoenix-danger me-2" onclick="deletaCliente(<?= $cliente['id'] ?>)">
          <span class="fa-solid fa-trash me-2"></span>
          <span>Excluir Cliente</span>
        </button>
      </div>
    </div>

    <div class="row g-4 g-xl-6">
      <div class="col-xl-5 col-xxl-4">
        <div class="sticky-leads-sidebar">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row align-items-center justify-content-between g-3">
                <div class="col-12 col-md">
                  <div class="d-flex align-items-center justify-content-between">
                    <h3 class="fw-bolder mb-2 line-clamp-1 me-3">
                      <?= ucfirst($cliente['nome_fantasia']) ?? ""; ?>
                    </h3>
                    <?php if (permissaoComponentes('select-status-clientes')) { ?>
                      <div class="form-check form-switch">
                        <input class="form-check-input switch-status <?= $cliente['status'] == 1 ? 'bg-success' : 'bg-secondary' ?>" type="checkbox" id="statusSwitch" data-id="<?= $cliente['id'] ?>" <?= $cliente['status'] == 1 ? 'checked' : ''; ?>>
                        <label class="form-check-label text-primary" for="statusSwitch">
                          <?= $cliente['status'] == 1 ? 'Ativo' : 'Inativo'; ?>
                        </label>
                      </div>
                    <?php } ?>
                  </div>

                  <p class="fs--1 fw-semi-bold text-900 text mb-4 w-50">
                    <?php echo "{$cliente['cidade']} / {$cliente['estado']}"; ?>
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h4 class="mb-3">Outras informações</h4>
              <div class="row g-3">
                <div class="col-12">
                  <div class="mb-7">
                    <div class="row mx-0 mx-sm-3 mx-lg-0 px-lg-0">
                      <div class="col-sm-12 col-xxl-12 border-bottom py-3">
                        <table class="w-100 table-stats">
                          <tr>
                            <td class="py-2">
                              <div class="d-inline-flex align-items-center">
                                <div class="d-flex bg-primary-100 rounded-circle flex-center me-3" style="width:24px; height:24px">
                                  <span class="text-primary-600 dark__text-primary-300" data-feather="phone" style="width:16px; height:16px"></span>
                                </div>
                                <p class="fw-bold mb-0">Telefone</p>
                              </div>
                            </td>
                            <td class="py-2 d-none d-sm-block pe-sm-2">:</td>
                            <td class="py-2">
                              <a class="ps-6 ps-sm-0 fw-semi-bold mb-0 pb-3 pb-sm-0 text-900 text-break" href="tel:<?= $cliente['telefone'] ?>">
                                <?= $cliente['telefone'] ?>
                              </a>
                            </td>
                          </tr>

                          <tr>
                            <td class="py-2">
                              <div class="d-flex align-items-center">
                                <div class="d-flex bg-warning-100 rounded-circle flex-center me-3" style="width:24px; height:24px">
                                  <span class="text-warning-600 dark__text-warning-300" data-feather="mail" style="width:16px; height:16px"></span>
                                </div>
                                <p class="fw-bold mb-0">Email Principal</p>
                              </div>
                            </td>
                            <td class="py-2 d-none d-sm-block pe-sm-2">:</td>
                            <td class="py-2">
                              <a class="ps-6 ps-sm-0 fw-semi-bold mb-0 text-900 w-100 text-break" href="mailto:<?= $cliente['email'] ?>"><?= !empty($cliente['email']) ? $cliente['email'] : 'Não cadastrado' ?></a>
                            </td>
                          </tr>

                          <?php if ($cliente['cnpj']) { ?>
                            <tr>
                              <td class="py-2">
                                <div class="d-flex align-items-center">
                                  <div class="d-flex bg-primary-100 rounded-circle flex-center me-3" style="width:24px; height:24px">
                                    <span class="text-primary-600 dark__text-primary-300 far fa-address-card" style="width:16px; height:16px"></span>
                                  </div>
                                  <p class="fw-bold mb-0">CNPJ</p>
                                </div>
                              </td>
                              <td class="py-2 d-none d-sm-block pe-sm-2">:</td>
                              <td class="py-2">
                                <div class="ps-6 ps-sm-0 fw-semi-bold mb-0 pb-sm-0 text-break"><?= $cliente['cnpj']; ?>
                                </div>
                              </td>
                            </tr>
                          <?php } ?>

                          <tr>
                            <td class="py-2">
                              <div class="d-flex align-items-center">
                                <div class="d-flex bg-secondary rounded-circle flex-center me-3" style="width:24px; height:24px">
                                  <span class="text-success-600 dark__text-success-300" data-feather="calendar" style="width:16px; height:16px"></span>
                                </div>
                                <p class="fw-bold mb-0">Data de Cadastro</p>
                              </div>
                            </td>
                            <td class="py-2 d-none d-sm-block pe-sm-2">:</td>
                            <td class="py-2">
                              <span class="d-inline-block lh-sm"><?= date('d/m/Y', strtotime($cliente['criado_em'])) ?></span>
                            </td>
                          </tr>

                        </table>
                      </div>

                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-7 col-xxl-8">
        <div class="card mb-5">
          <div class="card-body">
            <div class="row g-4 g-xl-1 g-xxl-3 justify-content-between">

              <div class="col-md-4">
                <div class="d-sm-block d-inline-flex d-md-flex flex-xl-column flex-xxl-row align-items-center align-items-xl-start align-items-xxl-center pe-sm-5">
                  <div class="d-flex bg-info-100 rounded flex-center me-3 mb-sm-3 mb-md-0 mb-xl-3 mb-xxl-0" style="width:32px; height:32px"><span class="text-info-600 dark__text-info-300" data-feather="bar-chart-2" style="width:24px; height:24px"></span></div>
                  <div>
                    <p class="fw-bold mb-1">Exemplo info. projetos</p>
                    <h4 class="fw-bolder text-nowrap">Exemplo
                    </h4>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="d-sm-block d-inline-flex d-md-flex flex-xl-column flex-xxl-row align-items-center align-items-xl-start align-items-xxl-center border-start-sm ps-sm-5">
                  <div class="d-flex bg-danger-100 rounded flex-center me-3 mb-sm-3 mb-md-0 mb-xl-3 mb-xxl-0" style="width:32px; height:32px">
                    <span class="text-danger-600 dark__text-danger-300" data-feather="alert-triangle" style="width:24px; height:24px"></span>
                  </div>
                  <div>
                    <p class="fw-bold mb-1">Exemplo info. projetos</p>
                    <h4 class="fw-bolder text-nowrap">1000</h4>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="d-sm-block d-inline-flex d-md-flex flex-xl-column flex-xxl-row align-items-center align-items-xl-start align-items-xxl-center border-start-sm ps-sm-5">
                  <div class="d-flex bg-success-100 rounded flex-center me-3 mb-sm-3 mb-md-0 mb-xl-3 mb-xxl-0" style="width:32px; height:32px">
                    <span class="text-success-600 dark__text-success-300" data-feather="check-circle" style="width:24px; height:24px"></span>
                  </div>
                  <div>
                    <p class="fw-bold mb-1">Exemplo info. projetos</p>
                    <h4 class="fw-bolder text-nowrap">1000</h4>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <h2 class="mb-6 d-flex justify-content-between align-items-center">
          <span>Histórico de projetos</span>
          <div class="d-flex">
            <a class="btn btn-phoenix-warning btn-sm me-2" title="Desenvolver Projeto" type="button" onclick="desenvolverProjeto()" data-bs-toggle="modal" data-bs-target="#modalDesenvolverProjeto">
              <span class="far fa-id-card me-2"></span>
              Desenvolver Projeto
            </a>
            <button type="button" class="btn btn-phoenix-primary me-2" data-bs-toggle="modal" data-bs-target="#modalCustoProdutivo">
              <span class="fa-solid fas fa-dollar-sign me-2"></span>
              Custo Produtivo
            </button>
            <a href="<?= base_url('projetos/formulario/' . $this->uri->segment(3)) ?>" class="btn btn-phoenix-success px-3 px-sm-5">
              <span class="fa-solid far fa-calendar-plus me-2"></span>
              <span class="d-none d-sm-inline">+ Novo Projeto</span>
            </a>
          </div>
        </h2>



        <div class="container">
          <!-- <div class="row align-items-center g-3 justify-content-between justify-content-start">



            <div class="col-md-3">
              <input class="form-control datetimepicker data-inicio-coleta" required name="data_coleta_inicio" type="text" placeholder="Data Inicio" data-options='{"disableMobile":true,"allowInput":true}' style="cursor: pointer;" />

            </div>

            <div class="col-md-3">

              <input class="form-control datetimepicker data-fim-coleta" required name="data_coleta_fim" type="text" placeholder="Data Fim" data-options='{"disableMobile":true,"allowInput":true}' style="cursor: pointer;" />

            </div>

            <div class="col-md-3">

              <select class="form-select w-100 select2 id-residuo-coleta" name="residuos">

                <option disabled selected value="">Filtro Exemplo</option>
                <option value="">Todos</option>

              </select>
            </div>

            <div class="col-md-3">

              <button onclick="" class="btn btn-phoenix-primary px-6">Filtrar</button>

            </div>



          </div> -->

          <?php foreach ($projetos as $projeto) { ?>

            <div class="py-2">

              <div class="d-flex">
                <?php
                $statusBg = $projeto['status'] == 1 ? 'bg-primary-100' : 'bg-danger-100';
                $statusTxt = $projeto['status'] == 1 ? 'dark__text-primary-300 text-primary-600' : 'dark__text-danger-300 text-danger-600';
                ?>
                <div class="d-flex <?= $statusBg ?> rounded-circle flex-center me-3" style="width:25px; height:25px">
                  <span class="fa-solid <?= $statusTxt ?> fs--1 fa-clipboard"></span>
                </div>


                <div class="flex-1">

                  <div class="d-flex justify-content-between flex-column flex-xl-row mb-2">
                    <div>
                      <h5 class="text-1000">
                        <h5><?= $projeto['nome_produto'] ?> <?= $projeto['status'] == 0 ? ' - INATIVO' : '' ?> </h5>
                        <span class="fw-semi-bold"><?= date('d/m/Y', strtotime($projeto['criado_em'])) . ' / VERSÃO ' . $projeto['versao'] ?> </span>
                      </h5>
                    </div>

                    <div class="d-flex align-items-center">

                      <button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                        <span class="fa-solid fa-ellipsis"></span>
                      </button>

                      <ul class="dropdown-menu dropdown-menu-end" style="z-index: 9999;">
                        <li>
                          <a class="dropdown-item cursor-pointer" onclick="detalhesProjeto(<?= $projeto['id'] ?>)" title="Ver Detalhes" data-bs-toggle="modal" data-bs-target="#modal-visualizar-projeto">
                            <span class="text-900 fas fa-eye"></span>
                            <span class="text-900"> Detalhes</span>
                          </a>
                        </li>

                        <li>
                          <a class="dropdown-item cursor-pointer" href="<?= base_url('projetos/formulario/' . $projeto['codigo_projeto'] ?? "") ?>">
                            <span class="text-900 fa-solid fa-edit"></span>
                            <span class="text-900"> Editar Projeto</span>
                          </a>
                        </li>

                        <li>
                          <a class="dropdown-item cursor-pointer" onclick="reformularProjeto(<?= $projeto['id'] ?>)" title="Reformular Projeto">
                            <span class="text-900 fas fa-pen-square"></span>
                            <span class="text-900"> Reformular</span>
                          </a>
                        </li>
                        <?php
                        $statusAction = $projeto['status'] == 1 ?
                          ['onclick' => "inativaProjetoCliente('{$projeto['id']}', '{$this->uri->segment(3)}')", 'title' => 'Inativar Projeto', 'icon' => 'fas fa-toggle-off', 'text' => 'Inativar Projeto'] :
                          ['onclick' => "ativarProjetoCliente('{$projeto['id']}', '{$this->uri->segment(3)}')", 'title' => 'Ativar Projeto', 'icon' => 'fas fa-toggle-on', 'text' => 'Ativar Projeto'];
                        ?>
                        <li>
                          <a class="dropdown-item cursor-pointer" onclick="<?= $statusAction['onclick'] ?>" title="<?= $statusAction['title'] ?>">
                            <span class="text-900 fas <?= $statusAction['icon'] ?>"></span>
                            <span class="text-900"> <?= $statusAction['text'] ?></span>
                          </a>
                        </li>
                        <?php if ($projeto['status'] == 0): ?>
                          <li>
                            <a class="dropdown-item cursor-pointer" onclick="excluirProjeto(<?= $projeto['codigo_projeto'] ?>)" title="Excluir Projeto">
                              <span class="text-900 fas fa-trash-alt"></span>
                              <span class="text-900"> Excluir Projeto</span>
                            </a>
                          </li>
                        <?php endif; ?>
                      </ul>
                    </div>
                  </div>

                </div>

              </div>
              <hr>
            <?php } ?>

            </div>
        </div>

      </div>
    </div>

  </div>


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
                          <option value="">Selecione o Projeto</option>
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

          <div class="ms-auto">
            <button class="btn btn-phoenix-success" type="submit" onclick="vincularValores()">Vincular Valores</button>
          </div>
        </div>

      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="modalCustoProdutivo" tabindex="-1" aria-labelledby="modalCustoProdutivo" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCustoProdutivoLabel">Definir Custo Manipulação, Envase e Rotulagem</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Coloque todo o conteúdo aqui -->
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
                              <input value="<?= $equipamentoEnvase['pcs_hora'] == 0 ? '' : $equipamentoEnvase['pcs_hora'] ?>" data-mo-envase="<?= $equipamentoEnvase['mo'] ?>" data-id-equipamento-envase="<?= $equipamentoEnvase['id'] ?>" class="input-custo-producao input-equipamento-envase" type="text" placeholder="00">
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
          <div class="modal-footer">
            <button type="button" class="btn btn-phoenix-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-phoenix-primary">Salvar alterações</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
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