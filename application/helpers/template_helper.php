<?php

function add_scripts($pos, $params)
{
    $ci = &get_instance();

    if (!is_array($params)) {
        $params = array($params);
    }

    $ci->config->set_item($pos, $params);

    return;
}

function header_scripts($str = '')
{
    $ci = &get_instance();
    $headers = $ci->config->item('header');

    foreach ($headers as $item) {
        $str .= $item . "\n";
    }

    echo $str;
}


function footer_scripts($str = '')
{
    $ci = &get_instance();
    $footers = $ci->config->item('footer');

    foreach ($footers as $item) {
        $str .= $item . "\n";
    }

    echo $str;
}

function scriptsPadraoHead()
{
    return array(

        '<script src="' . base_url('assets/js/config.js') . '"></script>',
        '<link href="' . base_url('vendors/flatpickr/flatpickr.min.css') . '" rel="stylesheet">',
        '<link href="' . base_url('vendors/dropzone/dropzone.min.css') . '" rel="stylesheet">',
        '<link href="' . base_url('vendors/prism/prism-okaidia.css') . '" rel="stylesheet">',
        '<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">',
        '<link href="' . base_url('vendors/simplebar/simplebar.min.css') . '" rel="stylesheet">',
        '<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">',
        '<link href="' . base_url('assets/css/theme-rtl.min.css') . '" type="text/css" rel="stylesheet" id="style-rtl">',
        '<link href="' . base_url('assets/css/theme.css') . '" type="text/css" rel="stylesheet" id="style-default">',
        '<link href="' . base_url('assets/css/user-rtl.min.css') . '" type="text/css" rel="stylesheet" id="user-style-rtl">',
        '<link href="' . base_url('assets/css/user.min.css') . '" type="text/css" rel="stylesheet" id="user-style-default">',

    );
}

function scriptsPadraoFooter()
{
    return array(

        '<script src="' . base_url('vendors/jquery/jquery.min.js') . '"></script>',
        '<script src="' . base_url('vendors/popper/popper.min.js') . '"></script>',
        '<script src="' . base_url('vendors/bootstrap/bootstrap.min.js') . '"></script>',
        '<script src="' . base_url('vendors/anchorjs/anchor.min.js') . '"></script>',
        '<script src="' . base_url('vendors/is/is.min.js') . '"></script>',
        '<script src="' . base_url('vendors/fontawesome/all.min.js') . '"></script>',
        '<script src="' . base_url('vendors/lodash/lodash.min.js') . '"></script>',
        '<script src="' . base_url('vendors/feather-icons/feather.min.js') . '"></script>',
        '<script src="' . base_url('vendors/dayjs/dayjs.min.js') . '"></script>',
        '<script src="' . base_url('vendors/dropzone/dropzone.min.js') . '"></script>',
        '<script src="' . base_url('vendors/prism/prism.js') . '"></script>',
        '<script src="' . base_url('assets/js/phoenix.js') . '"></script>',
        '<script src="' . base_url('vendors/list.js/list.min.js') . '"></script>',
        '<script src="' . base_url('node_modules/sweetalert2/dist/sweetalert2.all.min.js') . '"></script>',
        '<script src="' . base_url('assets/js/alertas/alertas-retornos.js') . '"></script>',
        '<script src="' . base_url('assets/js/aprovacao-inativos/helper-aprovacao-inativos.js') . '"></script>'
    );
}

function scriptsMenuFooter()
{
    return array(
        '<script src="' . base_url('assets/js/menu/formulario-menu.js') . '"></script>'
    );
}

// pagina de usuario
function scriptsUsuarioHead()
{
    return array(

        '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />',
        '<link href="' . base_url('assets/css/upload-arquivo.css') . '" type="text/css" rel="stylesheet" id="user-style-default">',
        '<link href="' . base_url('assets/css/usuario/usuarios.css') . '" type="text/css" rel="stylesheet" id="user-style-default">'

    );
}

function scriptsUsuarioFooter()
{
    return array(

        '<script src="' . base_url('assets/js/usuarios/formulario-usuario.js') . '"></script>',
        '<script src="' . base_url('assets/js/helpers-js/upload-imagem.js') . '"></script>',
        '<script src="' . base_url('node_modules/jquery-mask-plugin/src/jquery.mask.js') . '"></script>',
        '<script src="' . base_url('assets/js/helpers-js/validacoes.js') . '"></script>',
        '<script src="' . base_url('assets/js/mascaras/mascaras-input.js') . '"></script>',
        '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>'

    );
}




// Pagina de clientes
function scriptsClientesHead()
{
    return array(

        '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />'

    );
}

function scriptsClientesFooter()
{
    return array(

        '<script src="' . base_url('assets/js/clientes/formulario-cliente.js') . '"></script>',
        '<script src="' . base_url('node_modules/jquery-mask-plugin/src/jquery.mask.js') . '"></script>',
        '<script src="' . base_url('assets/js/mascaras/mascaras-input.js') . '"></script>',
        '<script src="' . base_url('assets/js/helpers-js/validacoes.js') . '"></script>',
        '<script src="' . base_url('assets/js/helpers-js/viacep-input.js') . '"></script>',
        '<script src="' . base_url('assets/js/helpers-js/formatar-data.js') . '"></script>',
        '<script src="' . base_url('assets/js/helpers-js/formatar-moeda-real.js') . '"></script>',
        '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>'

    );
}

// Pagina de Fornecedores
function scriptsFornecedoresHead()
{
    return array(

        '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />'

    );
}

function scriptsFornecedoresFooter()
{
    return array(

        '<script src="' . base_url('assets/js/fornecedores/formulario-fornecedores.js') . '"></script>',
        '<script src="' . base_url('node_modules/jquery-mask-plugin/src/jquery.mask.js') . '"></script>',
        '<script src="' . base_url('assets/js/mascaras/mascaras-input.js') . '"></script>',
        '<script src="' . base_url('assets/js/helpers-js/validacoes.js') . '"></script>',
        '<script src="' . base_url('assets/js/helpers-js/viacep-input.js') . '"></script>',
        '<script src="' . base_url('assets/js/helpers-js/formatar-data.js') . '"></script>',
        '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>'

    );
}


// pagina de login
function scriptsLoginFooter()
{
    return array(

        '<script src="' . base_url('assets/js/login/recupera-senha.js') . '"></script>'
    );
}


// pagina de permissoes

function scriptsPermissaoFooter()
{
    return array(

        '<script src="' . base_url('assets/js/permissao/componentes.js') . '"></script>',
    );
}

// pagina de materias primas

function scriptsMateriaPrimaHead()
{
    return array(

        '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />'

    );
}

function scriptsMateriaPrimaFooter()
{
    return array(

        '<script src="' . base_url('assets/js/materia-prima/formulario-materia-prima.js') . '"></script>',
        '<script src="' . base_url('node_modules/jquery-mask-plugin/src/jquery.mask.js') . '"></script>',
        '<script src="' . base_url('assets/js/mascaras/mascaras-input.js') . '"></script>',
        '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>'

    );
}

// Pagina de projetos
function scriptsProjetoHead()
{
    return array(

        '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />'

    );
}

function scriptsProjetoFooter()
{
    return array(

        '<script src="' . base_url('assets/js/helpers-js/carregar-select2.js') . '"></script>',
        '<script src="' . base_url('assets/js/projetos/formulario-projetos.js') . '"></script>',
        '<script src="' . base_url('node_modules/jquery-mask-plugin/src/jquery.mask.js') . '"></script>',
        '<script src="' . base_url('assets/js/mascaras/mascaras-input.js') . '"></script>',
        '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>'

    );
}

// Pagina de custo produtivo
function scriptsCustoProdutivoHead()
{
    return array(

        '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />'

    );
}

function scriptsCustoProdutivoFooter()
{
    return array(

        '<script src="' . base_url('assets/js/custo-produtivo/formulario-custo-produtivo.js') . '"></script>',
        '<script src="' . base_url('node_modules/jquery-mask-plugin/src/jquery.mask.js') . '"></script>',
        '<script src="' . base_url('assets/js/mascaras/mascaras-input.js') . '"></script>',
        '<script src="' . base_url('assets/js/helpers-js/validacoes.js') . '"></script>',
        '<script src="' . base_url('assets/js/helpers-js/viacep-input.js') . '"></script>',
        '<script src="' . base_url('assets/js/helpers-js/formatar-data.js') . '"></script>',
        '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>'

    );
}

// Pagina de Preço de Venda
function scriptsCustoPrecoVendaHead()
{
    return array(

        '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />',
        '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />'

    );
}

function scriptsPrecoVendaFooter()
{
    return array(

        '<script src="' . base_url('assets/js/preco-venda/formulario-preco-venda.js') . '"></script>',
        '<script src="' . base_url('node_modules/jquery-mask-plugin/src/jquery.mask.js') . '"></script>',
        '<script src="' . base_url('assets/js/mascaras/mascaras-input.js') . '"></script>',
        '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>'

    );
}
