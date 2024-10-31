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
                  <div class="d-flex bg-info-100 rounded flex-center me-3 mb-sm-3 mb-md-0 mb-xl-3 mb-xxl-0" style="width:32px; height:32px">
                    <span class="text-info-600 dark__text-info-300" data-feather="bar-chart-2" style="width:24px; height:24px"></span>
                  </div>
                  <div>
                    <p class="fw-bold mb-1">Exemplo info. projetos</p>
                    <h4 class="fw-bolder text-nowrap">1000</h4>
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
          <!-- Filtro por Nome e Data -->
          <!-- <div class="mb-4 d-flex">
            <form action="<?= base_url('clientes/detalhes') ?>" method="POST" id="addEventForm" autocomplete="off" style="display:contents;">

              <div class="col-md-3 me-2">
                <input name="nome_produto" type="text" class="form-control" placeholder="Digite o nome do projeto">
              </div>

              <div class="col-md-3 mb-3 me-2">
                <input autocomplete="off" class="form-control datetimepicker data-inicio-filtro" required
                  type="text" placeholder="Data Inicio"
                  data-options='{"disableMobile":true,"allowInput":true}' style="cursor: pointer;" />
              </div>

              <div class="col-md-3 mb-3 me-2">
                <input autocomplete="off" class="form-control datetimepicker data-fim-filtro" required
                  type="text" placeholder="Data Fim"
                  data-options='{"disableMobile":true,"allowInput":true}' style="cursor: pointer;" />
              </div>

              <div class="col-md-3 mb-3">
                <button class="btn btn-phoenix-primary w-100" type="submit">Buscar clientes</button>
              </div>
            </form>
          </div> -->


          <hr class="mb-0">

          <!-- Início dos Accordions -->
          <div class="accordion" id="accordionProjetos">

            <?php if ($projetos): ?>
              <?php foreach ($projetosAgrupados as $codigoProjeto => $projetos): ?>
                <!-- Accordion por Código de Projeto -->
                <div class="accordion-item">

                  <h2 class="accordion-header" id="heading<?= $codigoProjeto ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $codigoProjeto ?>" aria-expanded="false" aria-controls="collapse<?= $codigoProjeto ?>">
                      Código do Projeto: <?= $codigoProjeto ?>
                    </button>
                  </h2>

                  <div id="collapse<?= $codigoProjeto ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $codigoProjeto ?>" data-bs-parent="#accordionProjetos">
                    <div class="card card-body">
                      <div class="accordion-body">
                        <!-- Projetos Ativos -->
                        <h5 class="text-success">Projetos Ativos</h5>
                        <?php
                        $temProjetosAtivos = false;
                        foreach ($projetos as $projeto) {

                          $inactive = '';
                          if ($projeto['desenvolvido'] == 0) {
                            $inactive = 'inactive';
                          }

                          $reformularInactive = '';
                          if ($projeto['STATUS_PROJETO'] == 0) {
                            $reformularInactive = 'inactive';
                          }

                          if ($projeto['desenvolvido'] == 1) {
                            $nomeProduto = htmlspecialchars($projeto['nome_produto'] . ' | CÓD. ' . $projeto['codigo_projeto']);
                            $onclick = 'onclick="visualizarDesenvolvimentoProjeto(' . $projeto['CODIGO_PROJETO'] . ', ' . $projeto['versao_projeto'] . ', \'' . $nomeProduto . '\')"';
                          } else {
                            $onclick = 'onclick="modalDesenvolverProjeto()" data-bs-toggle="modal" data-bs-target="#modalDesenvolverProjeto"';
                          }

                          if ($projeto['STATUS_PROJETO'] == 1) {
                            $temProjetosAtivos = true;
                            $badgeDesenvolvido = $projeto['desenvolvido'] == 1
                              ? '<span class="badge bg-success ms-2"><i class="fa-solid fa-clipboard-check"></i> Desenvolvido</span>'
                              : '<span class="badge bg-warning ms-2"><i class="fa-solid fa-clipboard-question"></i> Não Desenvolvido</span>';
                        ?>
                            <div class="py-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                  <div class="d-flex bg-primary-100 rounded-circle flex-center me-3" style="width:45px; height:45px">
                                    <span class="fa-solid dark__text-primary-300 text-primary-600 fa-clipboard" style="font-size: 20px;"></span>
                                  </div>
                                  <div class="flex-1">
                                    <h5 class="text-1000">
                                      <a class="text-1000 cursor-pointer nome-projeto d-flex align-items-center" <?= $onclick ?> data-nome-projeto="<?= $projeto['nome_produto'] . ' | CÓD. ' . $projeto['codigo_projeto'] ?>" title="Ver Detalhes" style="text-decoration:none;">
                                        <?= $projeto['nome_produto'] . ' | CÓD. ' . $projeto['codigo_projeto'] ?>
                                        <?= $badgeDesenvolvido ?>
                                      </a>
                                    </h5>
                                    <span class="fw-semi-bold d-flex">
                                      <?= date('d/m/Y', strtotime($projeto['DATA_PROJETO'])) . ' / VERSÃO ' . $projeto['versao_projeto'] ?>
                                    </span>
                                  </div>
                                </div>

                                <!-- Dropdown de Opções -->
                                <div class="dropdown">
                                  <button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fa-solid fa-ellipsis"></span>
                                  </button>
                                  <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                      <a class="dropdown-item cursor-pointer <?= $inactive ?>" <?= $onclick ?> title="Ver Detalhes">
                                        <span class="text-900 fas fa-eye"></span>
                                        <span class="text-900"> Detalhes</span>
                                      </a>
                                    </li>
                                    <li>
                                      <a class="dropdown-item cursor-pointer" href="<?= base_url('projetos/formulario/' . $this->uri->segment(3) . '/' . $projeto['ID_PROJETO']) ?>">
                                        <span class="text-900 fa-solid fa-edit"></span>
                                        <span class="text-900"> Editar Projeto</span>
                                      </a>
                                    </li>
                                    <li>
                                      <a class="dropdown-item cursor-pointer <?= $reformularInactive ?>" onclick="reformularProjeto(<?= $projeto['ID_PROJETO'] ?>, <?= $this->uri->segment(3) ?>)" title="Reformular Projeto">
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
                                <!-- Fim do Dropdown -->
                              </div>
                            </div>
                            <hr>
                          <?php
                          }
                        }
                        if (!$temProjetosAtivos): ?>
                          <p class="text-center text-success alert alert-phoenix-success text-1000" style="font-weight:500;">Não há versões ativas.</p>
                        <?php endif; ?>

                        <!-- Projetos Inativos -->
                        <h5 class="text-danger">Projetos Inativos</h5>
                        <?php
                        $temProjetosInativos = false;
                        foreach ($projetos as $projeto) {

                          $inactive = '';
                          if ($projeto['desenvolvido'] == 0) {
                            $inactive = 'inactive';
                          }

                          if ($projeto['desenvolvido'] == 1) {
                            $nomeProduto = htmlspecialchars($projeto['nome_produto'] . ' | CÓD. ' . $projeto['codigo_projeto']);
                            $onclick = 'onclick="visualizarDesenvolvimentoProjeto(' . $projeto['CODIGO_PROJETO'] . ', ' . $projeto['versao_projeto'] . ', \'' . $nomeProduto . '\')"';
                            $cursor_pointer = 'cursor-pointer';
                          } else {
                            $onclick = '';
                            $cursor_pointer = 'cursor-default';
                          }

                          if ($projeto['STATUS_PROJETO'] == 0) {
                            $temProjetosInativos = true;
                            $badgeDesenvolvido = $projeto['desenvolvido'] == 1
                              ? '<span class="badge bg-success ms-2"><i class="fa-solid fa-clipboard-check"></i> Desenvolvido</span>'
                              : '<span class="badge bg-warning ms-2"><i class="fa-solid fa-clipboard-question"></i> Não Desenvolvido</span>';
                        ?>
                            <div class="py-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                  <div class="d-flex bg-danger-100 rounded-circle flex-center me-3" style="width:45px; height:45px">
                                    <span class="fa-solid dark__text-danger-300 text-danger-600 fa-clipboard" style="font-size: 20px;"></span>
                                  </div>
                                  <div class="flex-1">
                                    <h5 class="text-1000">
                                      <a class="<?= $cursor_pointer ?> nome_projeto d-flex align-items-center" <?= $onclick ?> title="Ver Detalhes" style="text-decoration:none; color:#fff;">
                                        <?= $projeto['nome_produto'] . ' | CÓD. ' . $projeto['codigo_projeto'] ?>
                                        <?= $badgeDesenvolvido ?>
                                      </a>
                                    </h5>
                                    <span class="fw-semi-bold d-flex">
                                      <?= date('d/m/Y', strtotime($projeto['DATA_PROJETO'])) . ' / VERSÃO ' . $projeto['versao_projeto'] ?>
                                    </span>
                                  </div>
                                </div>

                                <!-- Dropdown de Opções -->
                                <div class="dropdown">
                                  <button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fa-solid fa-ellipsis"></span>
                                  </button>
                                  <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                      <a class="dropdown-item cursor-pointer <?= $inactive ?>" <?= $onclick ?> title="Ver Detalhes">
                                        <span class="text-900 fas fa-eye"></span>
                                        <span class="text-900"> Detalhes</span>
                                      </a>
                                    </li>
                                    <li>
                                      <a class="dropdown-item cursor-pointer" href="<?= base_url('projetos/formulario/' . $this->uri->segment(3) . '/' . $projeto['ID_PROJETO']) ?>">
                                        <span class="text-900 fa-solid fa-edit"></span>
                                        <span class="text-900"> Editar Projeto</span>
                                      </a>
                                    </li>
                                    <li>
                                      <a class="dropdown-item cursor-pointer <?= $reformularInactive ?>" onclick="reformularProjeto(<?= $projeto['ID_PROJETO'] ?>, <?= $this->uri->segment(3) ?>)" title="Reformular Projeto">
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
                                <!-- Fim do Dropdown -->
                              </div>
                            </div>
                            <hr>
                          <?php
                          }
                        }
                        if (!$temProjetosInativos): ?>
                          <p class="text-center text-danger alert alert-phoenix-danger text-1000" style="font-weight:500;">Não há versões inativas.</p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
          </div>
        <?php else: ?>

          <p class="text-center alert alert-phoenix-secondary text-1000">Não há projetos para este cliente.</p>
        <?php endif ?>
        </div>
      </div>
    </div>
  </div>