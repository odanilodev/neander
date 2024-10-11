<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CondicaoPagamento extends CI_Controller
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

    // Carregando o modelo CondicaoPagamento_model
    $this->load->model('CondicaoPagamento_model');
  }

  /**
   * Carrega a página inicial de Condição de Pagamento.
   * Inclui scripts padrão e específicos da página.
   */
  public function index()
  {
    // Scripts padrão
    $scriptsPadraoHead = scriptsPadraoHead();
    $scriptsPadraoFooter = scriptsPadraoFooter();

    // Scripts específicos para Condição de Pagamento
    $scriptsCondicaoPagamentoFooter = scriptsCondicaoPagamentoFooter();

    // Adicionando scripts ao header e footer
    add_scripts('header', array_merge($scriptsPadraoHead));
    add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsCondicaoPagamentoFooter));

    // Obtendo todas as Condições de Pagamento
    $data['condicoesPagamento'] = $this->CondicaoPagamento_model->recebeCondicoesPagamento();

    // Carregando as views com os dados
    $this->load->view('admin/includes/painel/cabecalho', $data);
    $this->load->view('admin/paginas/condicao-pagamento/condicao-pagamento');
    $this->load->view('admin/includes/painel/rodape');
  }

  /**
   * Carrega o formulário de cadastro/edição de Condição de Pagamento.
   * Inclui scripts padrão e específicos da página.
   */
  public function formulario()
  {
    // Scripts padrão
    $scriptsPadraoHead = scriptsPadraoHead();
    $scriptsPadraoFooter = scriptsPadraoFooter();

    // Scripts específicos para Condição de Pagamento
    $scriptsCondicaoPagamentoHead = scriptsCondicaoPagamentoHead();
    $scriptsCondicaoPagamentoFooter = scriptsCondicaoPagamentoFooter();

    // Adicionando scripts ao header e footer
    add_scripts('header', array_merge($scriptsPadraoHead, $scriptsCondicaoPagamentoHead));
    add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsCondicaoPagamentoFooter));

    // Obtendo o ID da condição de pagamento da URL
    $id = $this->uri->segment(3);

    // Obtendo a condição de pagamento específica
    $data['condicaoPagamento'] = $this->CondicaoPagamento_model->recebeCondicaoPagamento($id);

    // Carregando as views com os dados
    $this->load->view('admin/includes/painel/cabecalho', $data);
    $this->load->view('admin/paginas/condicao-pagamento/cadastra-condicao-pagamento');
    $this->load->view('admin/includes/painel/rodape');
  }

  /**
   * Processa o cadastro ou edição de uma Condição de Pagamento.
   * Verifica se o nome da Condição de Pagamento já existe e insere ou edita conforme necessário.
   * Retorna uma resposta JSON para o JavaScript do lado do cliente.
   */
  public function cadastraCondicaoPagamento()
  {
    $id = (int) $this->input->post('id');

    // Obtendo os dados do formulário e atribuindo ao array $dados
    $dados = array(
      'nome' => trim($this->input->post('nomeCondicaoPagamento')),
      'id_empresa' => (int) $this->session->userdata('id_empresa')
    );

    // Verificando se a condição de pagamento já existe
    $condicaoPagamento = $this->CondicaoPagamento_model->recebeNomeCondicaoPagamento($dados['nome'], $id);

    if ($condicaoPagamento) {
      // Resposta caso a condição de pagamento já exista
      $response = array(
        'title' => "Algo deu errado!",
        'type' => "error",
        'success' => false,
        'message' => "Esta Condição de Pagamento já existe! Tente cadastrar uma diferente."
      );

      return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    // Inserindo ou editando a condição de pagamento
    $retorno = $id ? $this->CondicaoPagamento_model->editaCondicaoPagamento($id, $dados) : $this->CondicaoPagamento_model->insereCondicaoPagamento($dados);

    if ($retorno) {
      // Resposta de sucesso
      $response = array(
        'success' => true,
        'title' => 'Sucesso!',
        'message' => $id ? 'Condição de Pagamento editada com sucesso!' : 'Condição de Pagamento cadastrada com sucesso!',
        'type' => 'success'
      );
    } else {
      // Resposta de erro
      $response = array(
        'success' => false,
        'title' => 'Algo deu errado!',
        'message' => $id ? "Erro ao editar a Condição de Pagamento!" : "Erro ao cadastrar a Condição de Pagamento!",
        'type' => 'error'
      );
    }

    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  /**
   * Processa a exclusão de uma Condição de Pagamento.
   * Retorna uma resposta JSON para o JavaScript do lado do cliente.
   */
  public function deletaCondicaoPagamento()
  {
    // Obtendo o ID da condição de pagamento do formulário
    $id = (int) $this->input->post('id');

    // Deletando a condição de pagamento
    $retorno = $this->CondicaoPagamento_model->deletaCondicaoPagamento($id);

    if ($retorno) {
      // Resposta de sucesso
      $response = array(
        'success' => true,
        'title' => "Sucesso!",
        'message' => "Condição de Pagamento deletada com sucesso!",
        'type' => "success"
      );
    } else {
      // Resposta de erro
      $response = array(
        'success' => false,
        'title' => "Algo deu errado!",
        'message' => "Não foi possível deletar a Condição de Pagamento!",
        'type' => "error"
      );
    }

    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

}
