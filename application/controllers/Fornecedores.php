<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fornecedores extends CI_Controller
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

    // Carregando o modelo Fornecedores_model
    $this->load->model('Fornecedores_model');
  }

  /**
   * Carrega a página inicial de Fornecedores.
   * Inclui scripts padrão e específicos da página.
   */
  public function index()
  {
    // Scripts padrão
    $scriptsPadraoHead = scriptsPadraoHead();
    $scriptsPadraoFooter = scriptsPadraoFooter();

    // Scripts específicos para Fornecedores
    $scriptsFornecedoresHead = scriptsFornecedoresHead();
    $scriptsFornecedoresFooter = scriptsFornecedoresFooter();

    // Adicionando scripts ao header e footer
    add_scripts('header', array_merge($scriptsPadraoHead, $scriptsFornecedoresHead));
    add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsFornecedoresFooter));

    // Obtendo todos os Fornecedores
    $data['fornecedores'] = $this->Fornecedores_model->recebeFornecedores();

    // Carregando as views com os dados
    $this->load->view('admin/includes/painel/cabecalho', $data);
    $this->load->view('admin/paginas/fornecedores/fornecedores');
    $this->load->view('admin/includes/painel/rodape');
  }

  /**
   * Carrega o formulário de cadastro/edição de Fornecedor.
   * Inclui scripts padrão e específicos da página.
   */
  public function formulario()
  {
    // Scripts padrão
    $scriptsPadraoHead = scriptsPadraoHead();
    $scriptsPadraoFooter = scriptsPadraoFooter();

    // Scripts específicos para Fornecedores
    $scriptsFornecedoresFooter = scriptsFornecedoresFooter();

    // Adicionando scripts ao header e footer
    add_scripts('header', array_merge($scriptsPadraoHead));
    add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsFornecedoresFooter));

    // Obtendo o ID do fornecedor da URL
    $id = $this->uri->segment(3);

    // Obtendo o fornecedor específico
    $data['fornecedor'] = $this->Fornecedores_model->recebeFornecedor($id);

    // Carregando as views com os dados
    $this->load->view('admin/includes/painel/cabecalho', $data);
    $this->load->view('admin/paginas/fornecedores/cadastra-fornecedor');
    $this->load->view('admin/includes/painel/rodape');
  }


  public function validaDadosFornecedor(array $dados): array
  {
    $this->load->helper('validacao_helper');

    $erros = [];

    // CNPJ
    if (!validarCnpj($dados['cnpj'])) {
      $erros[] = "O CNPJ especificado não é válido!";
    }

    //  CNPJ já está cadastrado
    if ($this->Fornecedores_model->verificaCnpjFornecedores($dados['cnpj'])) {
      $erros[] = "O CNPJ especificado já está cadastrado para outro Fornecedor!";
    }

    // e-mail
    if (!validarEmail($dados['email'])) {
      $erros[] = "O e-mail especificado não é válido!";
    }

    // telefone
    if (!validarTelefone($dados['telefone'])) {
      $erros[] = "O telefone especificado não é válido!";
    }

    return $erros;
  }


  /**
   * Processa o cadastro ou edição de um Fornecedor.
   * Verifica se o nome do Fornecedor já existe e insere ou edita conforme necessário.
   * Retorna uma resposta JSON para o JavaScript do lado do cliente.
   */
  public function cadastraFornecedor()
  {
    $this->load->helper('validacao_helper');

    // Obtendo os dados do formulário e atribuindo ao array $dados
    $dados = array(
      'id' => $this->input->post('id'),
      'razao_social' => $this->input->post('razao_social'),
      'nome_fantasia' => $this->input->post('nome_fantasia'),
      'cnpj' => $this->input->post('cnpj'),
      'contato' => $this->input->post('contato'),
      'cep' => $this->input->post('cep'),
      'cidade' => $this->input->post('cidade'),
      'bairro' => $this->input->post('bairro'),
      'estado' => $this->input->post('estado'),
      'rua' => $this->input->post('rua'),
      'numero' => $this->input->post('numero'),
      'complemento' => $this->input->post('complemento'),
      'telefone' => $this->input->post('telefone'),
      'email' => $this->input->post('email'),
      'id_empresa' => (int) $this->session->userdata('id_empresa')
    );

    $erros = $this->validaDadosFornecedor($dados);

    if (!empty($erros)) {
      $response = array(
          'title' => "Algo deu errado!",
          'type' => "error",
          'success' => false,
          'erros' => $erros
      );

      return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }


    // Verificando se o fornecedor já existe
    $id = (int) $dados['id'];
    $fornecedor = $this->Fornecedores_model->recebeNomeFornecedor($dados['razao_social'], $id);

    if ($fornecedor) {
      // Resposta caso o fornecedor já exista
      $response = array(
        'title' => "Algo deu errado!",
        'type' => "error",
        'success' => false,
        'message' => "Este Fornecedor já existe! Tente cadastrar um diferente."
      );

      return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    // Inserindo ou editando o fornecedor
    $retorno = $id ? $this->Fornecedores_model->editaFornecedor($id, $dados) : $this->Fornecedores_model->insereFornecedor($dados);

    // Retorna a resposta de sucesso ou erro
    $response = $retorno ? array(
      'success' => true,
      'title' => 'Sucesso!',
      'message' => $id ? 'Fornecedor editado com sucesso!' : 'Fornecedor cadastrado com sucesso!',
      'type' => 'success'
    ) : array(
      'success' => false,
      'title' => 'Algo deu errado!',
      'message' => $id ? "Erro ao editar o Fornecedor!" : "Erro ao cadastrar o Fornecedor!",
      'type' => 'error'
    );

    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  /**
   * Processa a exclusão de um Fornecedor.
   * Retorna uma resposta JSON para o JavaScript do lado do cliente.
   */
  public function deletaFornecedor()
  {
    // Obtendo o ID do fornecedor do formulário
    $id = (int) $this->input->post('id');

    // Deletando o fornecedor
    $retorno = $this->Fornecedores_model->deletaFornecedor($id);

    if ($retorno) {
      // Resposta de sucesso
      $response = array(
        'success' => true,
        'title' => "Sucesso!",
        'message' => "Fornecedor deletado com sucesso!",
        'type' => "success"
      );
    } else {
      // Resposta de erro
      $response = array(
        'success' => false,
        'title' => "Algo deu errado!",
        'message' => "Não foi possível deletar o Fornecedor!",
        'type' => "error"
      );
    }

    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  /**
   * Retorna todos os fornecedores em formato JSON.
   */
  public function recebeTodosFornecedores()
  {
    $todosFornecedores = $this->Fornecedores_model->recebeFornecedores();

    if ($todosFornecedores) {
      $response = array(
        'fornecedores' => $todosFornecedores,
        'success' => true
      );
    } else {
      $response = array(
        'success' => false
      );
    }

    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
}
