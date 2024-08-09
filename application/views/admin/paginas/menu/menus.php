<div class="content">
    <div id="members" data-list='{"valueNames":["customer","email","mobile_number","city","last_active","joined"],"pagination":false}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <!-- Botão de exportação (não utilizado) -->
                    <button class="btn btn-link text-900 me-4 px-0 d-none">
                        <span class="fa-solid fa-file-export fs--1 me-2"></span>Export
                    </button>
                    <!-- Botão para adicionar um menu -->
                    <a href="<?= base_url("menu/formulario") ?>" class="btn btn-primary">
                        <span class="fas fa-plus me-2"></span>Adicionar Menu
                    </a>
                </div>
            </div>
            <div class="col col-auto">
                <div class="search-box">
                    <!-- Formulário de pesquisa -->
                    <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                        <input class="form-control search-input search" type="search" placeholder="Buscar Menus" aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>
        </div>
        <div class="px-4 px-lg-6 mb-9 bg-white border-y border-300 mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs--1 mb-0">
                    <thead>
                        <tr>
                            <!-- Cabeçalho da tabela -->
                            <th style="margin-left:0px;" class="sort align-middle" scope="col" data-sort="customer">Menu</th>
                            <th style="text-align:right" class="sort pe-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="list" id="members-table-body">
                        <?php function printMenu($menu, $level = 0)
                        {   ?> <!-- Quando o $level é igual a zero significa que a categoria é pai -->

                            <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                <td class="email align-middle white-space-nowrap" style="padding-left: <?= $level * 20 ?>px;">
                                    <?php
                                    // Verifica o nível do menu e formata o nome
                                    if ($level === 0) {

                                        $menu['nome'] = $menu['link'] == null ? '<strong>' . mb_strtoupper($menu['nome']) . '</strong>' : mb_strtoupper($menu['nome']);
                                    } elseif ($level === 1) {
                                        $menu['nome'] = ucwords($menu['nome']);
                                    }
                                    echo ($level > 0 ? '- ' : '') . $menu['nome'];
                                    ?>
                                </td>
                                <td class="align-middle white-space-nowrap text-end pe-0">
                                    <div class="font-sans-serif btn-reveal-trigger position-static">
                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                            <span class="fas fa-ellipsis-h fs--2"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end py-2">
                                            <a href="<?= isset($menu['id']) ? base_url('menu/formulario/' . $menu['id']) : '#' ?>" class="dropdown-item">
                                                <span class="fas fa-pencil ms-1"></span> Editar
                                            </a>
                                            <a href="#" class="dropdown-item" onclick="deletarMenu(<?= isset($menu['id']) ? $menu['id'] : 0 ?>, '<?= isset($menu['link']) ? $menu['link'] : '' ?>')">
                                                <span class="fas fa-trash ms-1"></span> Deletar
                                            </a>
                                        </div>
                                    </div>
                                </td>

                            </tr>

                        <?php
                            if (isset($menu['sub_menus']) && is_array($menu['sub_menus'])) {
                                foreach ($menu['sub_menus'] as $submenu) {
                                    // Chama a função recursivamente para menus aninhados
                                    printMenu($submenu, $level + 1);
                                }
                            }
                        }

                        foreach ($menus as $menu) {
                            if (empty($menu['sub'])) {
                                // Chama a função para imprimir menus principais
                                printMenu($menu);
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>