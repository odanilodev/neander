<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustoProdutivo extends CI_Controller
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
    $this->load->model('CustoProdutivo_model');
  }

  /**
   * Carrega a página inicial de Custo Produtivo.
   * Inclui scripts padrão e específicos da página.
   */
  public function index()
  {
    $this->load->model('EquipamentosManipulacao_model');
    $this->load->model('EquipamentosEnvase_model');
    $this->load->model('EquipamentosRotulagem_model');

    // Scripts padrão
    $scriptsPadraoHead = scriptsPadraoHead();
    $scriptsPadraoFooter = scriptsPadraoFooter();

    // Scripts específicos para Custo Produtivo
    $scriptsCustoProdutivoHead = scriptsCustoProdutivoHead();
    $scriptsCustoProdutivoFooter = scriptsCustoProdutivoFooter();

    // Adicionando scripts ao header e footer
    add_scripts('header', array_merge($scriptsPadraoHead, $scriptsCustoProdutivoHead));
    add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsCustoProdutivoFooter));

    $data['equipamentosManipulacao'] = $this->EquipamentosManipulacao_model->recebeEquipamentosManipulacao();
    $data['equipamentosEnvase'] = $this->EquipamentosEnvase_model->recebeEquipamentosEnvase();
    $data['equipamentosRotulagem'] = $this->EquipamentosRotulagem_model->recebeEquipamentosRotulagem();

    // Carregando as views com os dados
    $this->load->view('admin/includes/painel/cabecalho', $data);
    $this->load->view('admin/paginas/custo-produtivo/custo-produtivo');
    $this->load->view('admin/includes/painel/rodape');
  }

  public function insereCustoProdutivo()
  {
    $idEquipamento = $this->input->post('idEquipamento');
    $tipo = $this->input->post('tipo');

    // Preparar os dados para inserção com base no tipo
    $dados = array(
      'valor_mo' => $this->input->post('custoProducao'),
      'valor_base' => $this->input->post('valorBase')
    );


    // Verificar o tipo e adicionar a coluna correta
    if ($tipo === 'manipulacao') {
      $dados['tempo_prod'] = $this->input->post('tempoProd');
    } else {
      $dados['pcs_hora'] = $this->input->post('tempoProd');
    }

    // Inserir dados no modelo
    $retorno = $this->CustoProdutivo_model->insereCustoProdutivo($idEquipamento, $tipo, $dados);

    // Preparar a resposta
    $response = array(
      'success' => $retorno,
      'type' => $retorno ? 'success' : 'error',
      'message' => $retorno ? 'Dados inseridos com sucesso!' : 'Erro ao inserir dados.'
    );

    // Enviar a resposta JSON
    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
}
