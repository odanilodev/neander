<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PrecoVenda extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // Controle de sessão
    $this->load->library('Controle_sessao');
    $res = $this->controle_sessao->controle();
    if ($res === 'erro') {
      if ($this->input->is_ajax_request()) {
        $this->output->set_status_header(403);
        exit();
      } else {
        redirect('login/erro', 'refresh');
      }
    }

    // // Carregando o modelo PrecoVenda_model
    // $this->load->model('PrecoVenda_model');
  }

  /**
   * Carrega a página inicial de Preço de Venda.
   * Inclui scripts padrão e específicos da página.
   */
  public function index()
  {
    $this->load->model('Clientes_model');
    // Scripts padrão
    $scriptsPadraoHead = scriptsPadraoHead();
    $scriptsPadraoFooter = scriptsPadraoFooter();

    // Scripts específicos para Preço de Venda
    $scriptsCustoPrecoVendaHead =scriptsCustoPrecoVendaHead();
    $scriptsPrecoVendaFooter = scriptsPrecoVendaFooter();

    $data['clientes'] = $this->Clientes_model->recebeClientes();
  

    // Adicionando scripts ao header e footer
    add_scripts('header', array_merge($scriptsPadraoHead, $scriptsCustoPrecoVendaHead));
    add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsPrecoVendaFooter));

    // Carregando as views com os dados
    $this->load->view('admin/includes/painel/cabecalho');
    $this->load->view('admin/paginas/preco-venda/preco-venda', $data);
    $this->load->view('admin/includes/painel/rodape');
  }
}
