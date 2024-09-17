<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Mpdf\Mpdf;

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
    $this->load->model('CondicoesPagamento_model');
    // Scripts padrão
    $scriptsPadraoHead = scriptsPadraoHead();
    $scriptsPadraoFooter = scriptsPadraoFooter();

    // Scripts específicos para Preço de Venda
    $scriptsCustoPrecoVendaHead = scriptsCustoPrecoVendaHead();
    $scriptsPrecoVendaFooter = scriptsPrecoVendaFooter();

    $data['clientes'] = $this->Clientes_model->recebeClientes();

    $data['condicoes'] = $this->CondicoesPagamento_model->recebeCondicoes();
    // Adicionando scripts ao header e footer
    add_scripts('header', array_merge($scriptsPadraoHead, $scriptsCustoPrecoVendaHead));
    add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsPrecoVendaFooter));

    // Carregando as views com os dados
    $this->load->view('admin/includes/painel/cabecalho');
    $this->load->view('admin/paginas/preco-venda/preco-venda', $data);
    $this->load->view('admin/includes/painel/rodape');
  }

  public function recebeProjetosCliente()
  {
    $this->load->model('Projetos_model');

    $id_cliente = $this->input->post('idCliente');

    $retorno = $this->Projetos_model->recebeProjetoCliente($id_cliente);

    if ($retorno) {
      $response = array(
        'success' => true,
        'projeto' => $retorno,
        'type' => "success"
      );
    } else {
      $response = array(
        'success' => false,
        'title' => "Algo deu errado!",
        'message' => "Nenhum projeto encontrado para este cliente, tente novamente mais tarde!",
        'type' => "error"
      );
    }
    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function recebeCustoProjeto()
  {
    $this->load->model('CustoProducaoProjeto_model');

    $codigo_projeto = $this->input->post('codigoProjeto');
    $lote_projeto = $this->input->post('loteProjeto');

    $retorno = $this->CustoProducaoProjeto_model->recebeCustoProducaoProjeto($codigo_projeto, $lote_projeto);

    if ($retorno) {
      $response = array(
        'success' => true,
        'projeto' => $retorno,
        'type' => "success"
      );
    } else {
      $response = array(
        'success' => false,
        'title' => "Algo deu errado!",
        'message' => "O Custo deste Projeto em questão não foi encontrado, tente novamente mais tarde!",
        'type' => "error"
      );
    }
    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function gerarPdfPrecoVenda()
  {
      $this->load->library('gerarPdf');
      $dados_preco_venda = $this->input->post('dadosPrecoVenda');
      $dados_condicoes_fornecimento = $this->input->post('dadosCondicoesFornecimento');
  
      $dados = [
          'precoVenda' => $dados_preco_venda,
          'condicoesFornecimento' => $dados_condicoes_fornecimento
      ];
  
      // Gera o PDF
      $pdfOutput = $this->gerarpdf->gerarPdfPrecoVenda($dados);
  
      // Envia o PDF diretamente para o navegador
      $this->output->set_content_type('application/pdf')->set_output($pdfOutput);
  }
  
}
