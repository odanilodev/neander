<div class="content">
    <div class="row mb-9">

        <div class="col-12">
            <div class="card shadow-none border border-300 my-4" data-component-card="data-component-card">
                <div class="card-header p-4 border-bottom border-300 bg-soft">
                    <div class="row g-3 justify-content-between align-items-center">
                        <div class="col-12 col-md">
                            <h4 class="text-900 mb-0">
                                <?= $this->uri->segment(3) ? "Editar Menu" : "Adicionar novo menu" ?>
                            </h4>

                            <input type="hidden" class="input-id-menu" value="<?= $menu['id'] ?? "" ?>">

                            <?php

                            // tipo de menu para exibir quando editar (js)
                            if (!empty($this->uri->segment(3))) {

                                if (empty($menu['link']) && empty($menu['sub'])) {

                                    $tipoMenu = 'pai';
                                } elseif (!empty($menu['link']) && empty($menu['sub'])) {

                                    $tipoMenu = 'padrao';
                                } else {

                                    $tipoMenu = 'submenu';
                                }

                                echo '<input type="hidden" class="tipo-menu" value="' . $tipoMenu . '">';
                            }
                            ?>

                            <div class="row mt-4 tipos-menu">
                                <div class="col-md-2 col-lg-2 col-12">
                                    <button class="accordion-button accordion-padrao" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="uil-plus-circle ms-1" data-fa-transform="shrink-3"> Categoria</span>
                                    </button>
                                </div>

                                <div class="col-md-2 col-lg-2 col-12">
                                    <button class="accordion-button collapsed accordion-pai" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <span class="uil-plus-circle ms-1" data-fa-transform="shrink-3"> Categoria Pai</span>
                                    </button>
                                </div>

                                <div class="col-md-2 col-lg-2 col-12">
                                    <button class="accordion-button collapsed accordion-sub" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <span class="uil-plus-circle ms-1" data-fa-transform="shrink-3"> Sub Categoria</span>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-body p-0">

                    <div class="accordion" id="accordionExample">

                        <div class="accordion-item" style="border: none !important;">

                            <div class="accordion-collapse collapse <?= !$this->uri->segment(3) ? "show" : "" ?>" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body pt-0">
                                    <div class="p-4 code-to-copy">
                                        <div class="card theme-wizard mb-5" data-theme-wizard="data-theme-wizard">

                                            <!-- Menu categoria -->
                                            <div class="card-body pt-4 pb-0">
                                                <form id="form-categoria" class="row" method="post">

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Nome</label>
                                                        <input required class="form-control input-nome input-obrigatorio" required name="nome" type="text" placeholder="Nome" value="<?= $menu['nome'] ?? "" ?>">
                                                        <div class="d-none aviso-obrigatorio">Preencha este campo.</div>
                                                    </div>


                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Ícone</label>
                                                        <input required class="form-control input-icone" name="icone" type="text" placeholder="Icone" value="<?= $menu['icone'] ?? "" ?>">
                                                    </div>


                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Link</label>
                                                        <input required class="form-control input-link input-obrigatorio" name="link" type="text" placeholder="Link" value="<?= $menu['link'] ?? "" ?>">
                                                        <div class="d-none aviso-obrigatorio">Preencha este campo.</div>
                                                    </div>


                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Ordem</label>
                                                        <input class="form-control input-ordem" name="ordem" type="text" placeholder="Ordem" value="<?= $menu['ordem'] ?? "" ?>">
                                                    </div>


                                                    <div class="flex-1 text-end my-5">
                                                        <button type="submit" class="btn btn-primary px-6 px-sm-6 btn-envia"><?= $this->uri->segment(3) ? 'Editar' : 'Cadastrar'; ?>
                                                            <span class="fas fa-chevron-right" data-fa-transform="shrink-3"> </span>
                                                        </button>
                                                        <div class="spinner-border text-primary load-form d-none" role="status"></div>
                                                    </div>

                                                </form>

                                            </div>
                                            <!-- Final Menu categoria -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" style="border: none !important;">

                            <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body pt-0">
                                    <div class="p-4 code-to-copy">
                                        <div class="card theme-wizard mb-5" data-theme-wizard="data-theme-wizard">

                                            <!-- Menu Categoria Pai -->
                                            <div class="card-body pt-4 pb-0">
                                                <form id="form-categoria-pai" class="row" method="post">
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Nome</label>
                                                        <input class="form-control input-nome input-obrigatorio" required name="nome" type="text" placeholder="Nome" value="<?= $menu['nome'] ?? "" ?>">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Ícone</label>
                                                        <input class="form-control input-icone" name="icone" type="text" placeholder="Icone" value="<?= $menu['icone'] ?? "" ?>">
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Ordem</label>
                                                        <input class="form-control input-ordem" name="ordem" type="text" placeholder="Ordem" value="<?= $menu['ordem'] ?? "" ?>">
                                                    </div>


                                                    <div class="flex-1 text-end my-5">
                                                        <button type="submit" class="btn btn-primary px-6 px-sm-6 btn-envia">Cadastrar
                                                            <span class="fas fa-chevron-right" data-fa-transform="shrink-3"> </span>
                                                        </button>
                                                        <div class="spinner-border text-primary load-form d-none" role="status"></div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Final Categoria Pai -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" style="border: none !important;">

                            <div class="accordion-collapse collapse" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body pt-0">
                                    <div class="p-4 code-to-copy">
                                        <div class="card theme-wizard mb-5" data-theme-wizard="data-theme-wizard">

                                            <!-- Sub Categoria  -->
                                            <div class="card-body pt-4 pb-0">
                                                <form id="form-sub-categoria" class="row" method="post">

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Nome</label>
                                                        <input class="form-control input-nome input-obrigatorio" required name="nome" type="text" placeholder="Nome" value="<?= $menu['nome'] ?? "" ?>">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Categoria Pai</label>
                                                        <select class="form-select input-sub input-obrigatorio" name="sub">

                                                            <option selected disabled value="">Selecione</option>

                                                            <?php foreach ($categoriasPai as $v) { ?>

                                                                <option value="<?= $v['id']; ?>" <?= (isset($menu['sub'])) && $menu['sub'] == $v['id'] ? "selected" : "" ?>>
                                                                    <?= $v['nome']; ?>
                                                                </option>

                                                            <?php } ?>

                                                        </select>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Link</label>
                                                        <input class="form-control input-link input-obrigatorio" name="link" type="text" placeholder="Link" value="<?= $menu['link'] ?? "" ?>">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Ordem</label>
                                                        <input class="form-control input-ordem" name="ordem" type="text" placeholder="Ordem" value="<?= $menu['ordem'] ?? "" ?>">
                                                    </div>


                                                    <div class="flex-1 text-end my-5">
                                                        <button type="button" onclick="cadastraMenu()" class="btn btn-primary px-6 px-sm-6 btn-envia">Cadastrar
                                                            <span class="fas fa-chevron-right" data-fa-transform="shrink-3"> </span>
                                                        </button>
                                                        <div class="spinner-border text-primary load-form d-none" role="status"></div>
                                                    </div>

                                                </form>

                                            </div>
                                            <!-- Final Sub Categoria -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>

    </div>