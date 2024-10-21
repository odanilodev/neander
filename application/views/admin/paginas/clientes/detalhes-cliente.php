<div class="content">

  <div class="pb-9">
    <div class="row align-items-center justify-content-between g-3 mb-4">
      <div class="col-12 col-md-auto">
        <h2 class="mb-0">Detalhes do Cliente</h2>
      </div>
      <div class="col-12 col-md-auto d-flex">

        <a href="<?= base_url('clientes/formulario/' . $cliente['id'] ?? "") ?>" class="btn btn-phoenix-secondary px-3 px-sm-5 me-2">
          <span class="fa-solid fa-edit me-sm-2"></span>
          <span class="d-none d-sm-inline">Editar Cliente </span>
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
            <?php if (count($projetos) > 0) :  ?>
              <a class="btn btn-phoenix-warning me-2" title="Desenvolver Projeto" type="button" onclick="modalDesenvolverProjeto()" data-bs-toggle="modal" data-bs-target="#modalDesenvolverProjeto">
                <span class="fa-solid fa-clipboard-question me-2"></span>
                Desenvolver Projeto
              </a>

              <button type="button" class="btn btn-phoenix-primary me-2 btn-abre-modal-custo-produtivo" data-bs-toggle="modal" data-bs-target="#modalCustoProdutivo">
                <span class="fa-solid fas fa-dollar-sign me-2"></span>
                Custo Produtivo
              </button>
            <?php endif  ?>

            <a href="<?= base_url('projetos/formulario/' . $this->uri->segment(3)) ?>" class="btn btn-phoenix-success px-3 px-sm-5">
              <span class="fa-solid far fa-calendar-plus me-2"></span>
              <span class="d-none d-sm-inline">+ Novo Projeto</span>
            </a>

          </div>
        </h2>

        <div class="container">
          <hr>

          <!-- Filtros
        
          <div class="row align-items-center g-3 justify-content-between justify-content-start">
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
          <?php if ($projetos): ?>
            <?php foreach ($projetos as $projeto): ?>

              <div class="py-2">
                <div class="d-flex">
                  <?php
                  $statusBg = $projeto['STATUS_PROJETO'] == 1 ? 'bg-primary-100' : 'bg-danger-100';
                  $statusTxt = $projeto['STATUS_PROJETO'] == 1 ? 'dark__text-primary-300 text-primary-600' : 'dark__text-danger-300 text-danger-600';
                  ?>
                  <div class="d-flex <?= $statusBg ?> rounded-circle flex-center me-3" style="width:45px; height:45px">
                    <span class="fa-solid <?= $statusTxt ?> fa-clipboard" style="font-size: 20px;"></span>
                  </div>

                  <div class="flex-1">
                    <div class="d-flex justify-content-between flex-column flex-xl-row mb-2">
                      <div>
                        <h5 class="text-1000">
                          <?php
                          $on_click = $projeto['desenvolvido'] == 1
                            ? 'onclick="visualizarDesenvolvimentoProjeto(' . $projeto['codigo_projeto'] . ', ' . $projeto['versao_projeto'] . ')"'
                            : 'onclick="modalDesenvolverProjeto()" data-bs-toggle="modal" data-bs-target="#modalDesenvolverProjeto"';
                          $pointer = 'cursor-pointer';
                          $badge = $projeto['desenvolvido'] == 1
                            ? '<span class="ms-2 badge bg-success"><i class="fa-solid fa-clipboard-check me-1"></i>Desenvolvido</span>'
                            : '<span class="ms-2 badge bg-warning"><i class="fa-solid fa-clipboard-question"></i></span>';
                          ?>

                          <a class="<?= $pointer ?> nome_projeto d-flex align-items-center" <?= $on_click ?> title="Ver Detalhes" style="text-decoration:none; color:#fff;">
                            <span class="texto-titulo">
                              <?= $projeto['nome_produto'] . ' | CÓD. ' . $projeto['codigo_projeto'] ?>
                            </span>
                            <?= $projeto['STATUS_PROJETO'] == 0 ? ' - INATIVO' : '' ?>
                            <?= $badge ?>
                          </a>
                        </h5>

                        <span class="fw-semi-bold d-flex">
                          <?= date('d/m/Y', strtotime($projeto['DATA_PROJETO'])) . ' / VERSÃO ' . $projeto['versao_projeto'] ?>
                        </span>
                      </div>

                      <div class="d-flex align-items-center">
                        <button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <span class="fa-solid fa-ellipsis"></span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end" style="z-index: 9999;">
                          <?php if ($projeto['desenvolvido'] == 1): ?>
                            <li>
                              <a class="dropdown-item cursor-pointer" onclick="visualizarDesenvolvimentoProjeto(<?= $projeto['ID_PROJETO'] ?>)" title="Ver Detalhes" data-bs-toggle="modal" data-bs-target="#modal-visualizar-projeto">
                                <span class="text-900 fas fa-eye"></span>
                                <span class="text-900"> Detalhes</span>
                              </a>
                            </li>
                          <?php endif; ?>

                          <li>
                            <a class="dropdown-item cursor-pointer" href="<?= base_url('projetos/formulario/' . $this->uri->segment(3) . '/' . $projeto['ID_PROJETO']) ?>">
                              <span class="text-900 fa-solid fa-edit"></span>
                              <span class="text-900"> Editar Projeto</span>
                            </a>
                          </li>

                          <li>
                            <a class="dropdown-item cursor-pointer <?= $projeto['STATUS_PROJETO'] == 0 ? 'inactive' : '' ?>" onclick="reformularProjeto(<?= $projeto['ID_PROJETO'] ?>, <?= $this->uri->segment(3)?>)" title="Reformular Projeto">
                              <span class="text-900 fas fa-user-edit"></span>
                              <span class="text-900"> Reformular</span>
                            </a>
                          </li>

                          <?php
                          $statusAction = $projeto['STATUS_PROJETO'] == 1
                            ? ['onclick' => "inativaProjetoCliente('{$projeto['ID_PROJETO']}', '{$this->uri->segment(3)}')", 'title' => 'Inativar Projeto', 'icon' => 'fas fa-toggle-off', 'text' => 'Inativar Projeto']
                            : ['onclick' => "ativarProjetoCliente('{$projeto['ID_PROJETO']}', '{$this->uri->segment(3)}')", 'title' => 'Ativar Projeto', 'icon' => 'fas fa-toggle-on', 'text' => 'Ativar Projeto'];
                          ?>
                          <li>
                            <a class="dropdown-item cursor-pointer" onclick="<?= $statusAction['onclick'] ?>" title="<?= $statusAction['title'] ?>">
                              <span class="text-900 fas <?= $statusAction['icon'] ?>"></span>
                              <span class="text-900"> <?= $statusAction['text'] ?></span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>

            <?php endforeach; ?>
          <?php else: ?>
            <div class="alert alert-phoenix-secondary text-1000" role="alert">
              Não existe nenhum projeto criado para este cliente no momento.
            </div>
          <?php endif; ?>




        </div>
      </div>


    </div>