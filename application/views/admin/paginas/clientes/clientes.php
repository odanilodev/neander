<div class="content">

    <div class="pb-8">
        <div id="reports">
            <div class="row g-3 justify-content-between mb-2">
                <div class="col-12">
                    <div class="d-md-flex justify-content-between">

                        <div class="mb-3">
                            <a href="<?= base_url('clientes/formulario') ?>" class="btn btn-phoenix-primary me-4">
                                <span class="fas fa-plus me-2"></span> Adicionar Cliente
                            </a>
                        </div>

                        <div class="d-flex mb-3">
                            <div class="search-box me-2">
                                <form action="<?= base_url('clientes') ?>" method="POST" class="position-relative" data-bs-toggle="search" data-bs-display="static">
                                    <input name="nome" value="<?= $cookie_filtro_clientes['nome'] ?? null ?>" class="form-control search-input search" type="search" placeholder="Buscar Clientes" aria-label="Search">
                                    <span class="fas fa-search search-box-icon"></span>
                                </form>
                            </div>

                            <button class="btn px-3 btn-phoenix-secondary filtros-clientes" type="button" data-bs-toggle="modal" data-bs-target="#reportsFilterModal" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                <span class="fa-solid fa-filter text-primary" data-fa-transform="down-3"></span>
                            </button>

                            <div class="modal fade" id="reportsFilterModal" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border">
                                        <form action="<?= base_url('clientes') ?>" method="POST" id="addEventForm" autocomplete="off">
                                            <div class="modal-header border-200 p-4">
                                                <h5 class="modal-title text-1000 fs-2 lh-sm">Filtrar</h5>
                                                <button class="btn p-1 text-danger" type="button" data-bs-dismiss="modal" aria-label="Close">
                                                    <span class="fas fa-times fs--1"></span>
                                                </button>
                                            </div>
                                            <div class="modal-body pt-4 pb-2 px-4">

                                                <div class="mb-3"><label class="fw-bold mb-2 text-1000">Status</label>
                                                    <select name="status" class="form-select select2">
                                                        <option value="all" selected>--</option>
                                                        <option <?= ($cookie_filtro_clientes['status'] ?? null) == '1' ? 'selected' : '' ?> value="1">Ativo</option>
                                                        <option <?= ($cookie_filtro_clientes['status'] ?? null) == '3' ? 'selected' : '' ?> value="3">Inativo</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3"><label class="fw-bold mb-2 text-1000" for="createDate">Cidades</label>
                                                    <select name="cidade" class="form-select select2">
                                                        <option value="all" selected>--</option>
                                                        <?php foreach ($cidades as $v) { ?>
                                                            <option <?= ($cookie_filtro_clientes['cidade'] ?? null) == $v['cidade'] ? 'selected' : '' ?> value="<?= $v['cidade'] ?>"><?= $v['cidade'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="modal-footer d-flex justify-content-end align-items-center px-4 pb-4 border-0 pt-3">
                                                <button class="btn btn-sm btn-primary px-9 fs--2 my-0" type="submit">Buscar clientes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 list" id="reportsList">

                <?php foreach ($clientes as $v) { ?>

                    <div class="col-12 col-xs-12 col-xl-4 col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center" style="position: absolute; top: 10px; left: 10px">
                                    <?php if ($v['status'] == '1') { ?>
                                        <span class="fw-bold fs--1 text-light lh-2 mr-5 badge rounded-pill bg-success">Ativo</span>
                                    <?php } else { ?>
                                        <span class="fw-bold fs--1 text-light lh-2 mr-5 badge rounded-pill bg-danger">Inativo</span>
                                    <?php } ?>
                                </div>
                                <div class="border-bottom">
                                    <div class="d-flex align-items-start mb-1 mt-3">
                                        <div class="d-sm-flex align-items-center ps-2">
                                            <a title="<?= mb_strtoupper($v['nome_fantasia']) ?>" class="fw-bold fs-1 lh-sm title line-clamp-1 me-sm-4" href="<?= base_url('clientes/detalhes/' . $v['id']); ?>">
                                                <?= mb_strtoupper($v['nome_fantasia']) ?>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="fs--1 fw-semi-bold text-900 text mb-4 ps-2">
                                        <strong>Contato:</strong> <?= $v['contato'] ?><br>
                                        <strong>Email:</strong> <?= $v['email'] ?>
                                    </p>
                                    <div class="d-flex align-items-center mt-2">
                                        <span class="fas fa-phone-square me-2"></span>
                                        <p class="mb-0 fs--1 fw-semi-bold text-700"><?= $v['telefone'] ?></p>
                                    </div>
                                    <div class="d-flex align-items-center" style="position: absolute; top: 5px; right: 10px">
                                        <div class="col-12 col-sm-auto flex-1 text-truncate">
                                            <div class="font-sans-serif btn-reveal-trigger position-static">
                                                <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                                    <span class="fas fa-ellipsis-h fs--2"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end py-2">
                                                    <a class="dropdown-item" href="<?= base_url('clientes/detalhes/' . $v['id']); ?>">
                                                        <span class="text-900 uil uil-eye"></span>
                                                        <span class="text-900"> Detalhes</span>
                                                    </a>
                                                    <a class="dropdown-item" href="<?= base_url('projetos/formulario/' . $v['id']); ?>">
                                                        <span class="text-900 fa-solid far fa-calendar-plus"></span>
                                                        <span class="text-900"> Criar Projeto</span>
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="<?= base_url('clientes/formulario/' . $v['id']) ?>">
                                                        <span class="text-900 uil uil-pen"></span>
                                                        <span class="text-900"> Editar Cliente</span>
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="#" onclick="deletaCliente(<?= $v['id'] ?>)">
                                                        <span class="text-900 uil uil-trash"></span>
                                                        <span class="text-900"> Excluir</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>

            <!-- Links de Paginação usando classes Bootstrap -->
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Page navigation" style="display: flex; float: right">
                        <ul class="pagination mt-5">
                            <?= $this->pagination->create_links(); ?>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>