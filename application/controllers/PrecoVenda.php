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
    $this->load->model('PrecoVenda_model');
  }

  /**
   * Carrega a página inicial de Preço de Venda.
   * Inclui scripts padrão e específicos da página.
   */
  public function index()
  {
    $this->load->model('Clientes_model');
    $this->load->model('CondicaoPagamento_model');
    // Scripts padrão
    $scriptsPadraoHead = scriptsPadraoHead();
    $scriptsPadraoFooter = scriptsPadraoFooter();

    // Scripts específicos para Preço de Venda
    $scriptsCustoPrecoVendaHead = scriptsCustoPrecoVendaHead();
    $scriptsPrecoVendaFooter = scriptsPrecoVendaFooter();

    $data['clientes'] = $this->Clientes_model->recebeClientes();

    $data['condicoes'] = $this->CondicaoPagamento_model->recebeCondicoesPagamento();
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

    $retorno = $this->Projetos_model->recebeProjetoCliente($id_cliente, 1, 1);

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
        'message' => "Nenhum projeto encontrado para este cliente!",
        'type' => "error"
      );
    }
    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function recebeDesenvolvimentoProjeto()
  {
    $this->load->model('DesenvolvimentoProjeto_model');

    $codigo_projeto = $this->input->post('codigoProjeto');

    $retorno = $this->DesenvolvimentoProjeto_model->recebeDesenvolvimentoProjeto($codigo_projeto);


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
        'message' => "O Desenvolvimento deste projeto não foi encontrado! Deseja ir para este Cliente?",
        'type' => "error"
      );
    }
    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function gerarPdfPrecoVenda()
  {
    $dados = $this->input->post('dados');
    $nome_cliente = $this->input->post('nomeCliente');
    $contato_cliente = $this->input->post('contatoCliente');
    $dados_condicoes_fornecimento = $this->input->post('dadosCondicoesFornecimento');

    $this->load->library('gerarPdf');

    $pdfOutput = $this->gerarpdf->gerarPdfPrecoVenda($dados, $nome_cliente, $contato_cliente, $dados_condicoes_fornecimento);

    $this->output->set_content_type('application/pdf')->set_output($pdfOutput);
  }

  public function insereCondicaoFornecimento()
  {
    $this->load->model('CondicaoFornecimento_model');
    $dados_preco_venda = $this->input->post('dadosPrecoVenda');
    $dados_condicao_fornecimento = $this->input->post('dadosCondicoesFornecimento');
    $dados_condicao_fornecimento['id_empresa'] = $this->session->userdata('id_empresa');


    foreach ($dados_preco_venda as $dado_preco_venda) {
      $ultima_versao_preco_venda = $this->PrecoVenda_model->recebeUltimaVersaoPrecoVenda($dado_preco_venda['codigo_projeto']);

      $dados_condicao_fornecimento['versao_preco_venda'] = $ultima_versao_preco_venda;
      $dados_condicao_fornecimento['codigo_projeto'] = $dado_preco_venda['codigo_projeto'];

      $retorno = $this->CondicaoFornecimento_model->insereCondicaoFornecimento($dados_condicao_fornecimento);
    }

    if ($retorno) {
      $response = array(
        'success' => true,
        'title' => "Sucesso!",
        'message' => "Preço de Venda e Condições de fornecimento salvos com sucesso!",
        'type' => "success"
      );
    } else {
      $response = array(
        'success' => false,
        'title' => "Algo deu errado!",
        'message' => "Erro ao salvar Condições de Fornecimento!",
        'type' => "error"
      );
    }

    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function inserePrecoVenda()
  {
    $id_cliente = $this->input->post('idCliente');
    $dados_precos_vendas = $this->input->post('dadosPrecoVenda');


    $this->db->trans_start();

    foreach ($dados_precos_vendas as $dado_preco_venda) {
      $codigo_projeto = $dado_preco_venda['codigo_projeto'];

      $ultima_versao_preco_venda = $this->PrecoVenda_model->recebeUltimaVersaoPrecoVenda($codigo_projeto);

      $dado_preco_venda['versao_preco_venda'] = $ultima_versao_preco_venda + 1;

      $dado_preco_venda['id_cliente'] = $id_cliente;
      $dado_preco_venda['id_empresa'] = $this->session->userdata('id_empresa');

      $retorno = $this->PrecoVenda_model->inserePrecoVenda($dado_preco_venda);

      if (!$retorno) {
        log_message('error', 'Erro ao inserir preço de venda para o cliente: ' . $id_cliente);
        break;
      }
    }

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
      $response = array(
        'success' => false,
        'title' => 'Erro!',
        'message' => "Falha ao salvar os Preços de Venda. Nenhum dado foi salvo!",
        'type' => 'error'
      );
    } else {
      $response = array(
        'success' => true,
        'title' => 'Sucesso!',
        'message' => count($dados_precos_vendas) > 1 ? 'Todos os Preços de Venda foram salvos com sucesso, defina as condiçoes de fornecimento!' : 'Preço de Venda salvo com sucesso, defina as condições de fornecimento!',
        'type' => 'success'
      );
    }

    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
  
}
