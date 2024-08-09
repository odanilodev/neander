<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MateriasPrimas extends CI_Controller
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

    // Carregando o modelo MateriasPrimas_model
    $this->load->model('MateriasPrimas_model');
  }

  /**
   * Carrega a página inicial de Matéria Prima.
   * Inclui scripts padrão e específicos da página.
   */
  public function index()
  {
    // Scripts padrão
    $scriptsPadraoHead = scriptsPadraoHead();
    $scriptsPadraoFooter = scriptsPadraoFooter();

    // Scripts específicos para Matéria Prima
    $scriptsMateriaPrimaFooter = scriptsMateriaPrimaFooter();

    // Adicionando scripts ao header e footer
    add_scripts('header', array_merge($scriptsPadraoHead));
    add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsMateriaPrimaFooter));

    // Obtendo todas as Matérias Primas
    $data['materiasPrimas'] = $this->MateriasPrimas_model->recebeMateriasPrimas();

    // Carregando as views com os dados
    $this->load->view('admin/includes/painel/cabecalho', $data);
    $this->load->view('admin/paginas/materias-primas/materias-primas');
    $this->load->view('admin/includes/painel/rodape');
  }

  /**
   * Carrega o formulário de cadastro/edição de Matéria Prima.
   * Inclui scripts padrão e específicos da página.
   */
  public function formulario()
  {
    $this->load->model('Fornecedores_model');

    // Scripts padrão
    $scriptsPadraoHead = scriptsPadraoHead();
    $scriptsPadraoFooter = scriptsPadraoFooter();

    // Scripts específicos para Matéria Prima
    $scriptsMateriaPrimaHead = scriptsMateriaPrimaHead();
    $scriptsMateriaPrimaFooter = scriptsMateriaPrimaFooter();

    // Adicionando scripts ao header e footer
    add_scripts('header', array_merge($scriptsPadraoHead, $scriptsMateriaPrimaHead));
    add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsMateriaPrimaFooter));

    // Obtendo o ID da matéria prima da URL
    $id = $this->uri->segment(3);

    // Obtendo a matéria prima específica
    $data['materiaPrima'] = $this->MateriasPrimas_model->recebeMateriaPrima($id);
    $data['fornecedores'] = $this->Fornecedores_model->recebeFornecedores();

    // Carregando as views com os dados
    $this->load->view('admin/includes/painel/cabecalho', $data);
    $this->load->view('admin/paginas/materias-primas/cadastra-materia-prima');
    $this->load->view('admin/includes/painel/rodape');
  }

  /**
   * Processa o cadastro ou edição de uma Matéria Prima.
   * Verifica se o nome da Matéria Prima já existe e insere ou edita conforme necessário.
   * Retorna uma resposta JSON para o JavaScript do lado do cliente.
   */
  public function cadastraMateriaPrima()
  {
    $id = (int) $this->input->post('id');

    // Obtendo os dados do formulário e atribuindo ao array $dados
    $dados = array(
      'nome' => $this->input->post('nome'),
      'id_fornecedor' => $this->input->post('idFornecedor'),
      'composicao_ptbr' => $this->input->post('composicao_ptbr'),
      'valor' => $this->input->post('valor'),
      'inci' => $this->input->post('inci'),
      'cas_number' => $this->input->post('cas_number'),
      'descricao' => $this->input->post('descricao'),
      'id_empresa' => (int) $this->session->userdata('id_empresa')
    );

    // Verificando se a matéria prima já existe
    $materiaPrima = $this->MateriasPrimas_model->recebeNomeMateriaPrima($dados['nome'], $id);

    if ($materiaPrima) {
      // Resposta caso a matéria prima já exista
      $response = array(
        'title' => "Algo deu errado!",
        'type' => "error",
        'success' => false,
        'message' => "Esta Matéria Prima já existe! Tente cadastrar uma diferente."
      );

      return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    // Inserindo ou editando a matéria prima
    $retorno = $id ? $this->MateriasPrimas_model->editaMateriaPrima($id, $dados) : $this->MateriasPrimas_model->insereMateriaPrima($dados);

    if ($retorno) {
      // Resposta de sucesso
      $response = array(
        'success' => true,
        'title' => 'Sucesso!',
        'message' => $id ? 'Matéria Prima editada com sucesso!' : 'Matéria Prima cadastrada com sucesso!',
        'type' => 'success'
      );
    } else {
      // Resposta de erro
      $response = array(
        'success' => false,
        'title' => 'Algo deu errado!',
        'message' => $id ? "Erro ao editar a Matéria Prima!" : "Erro ao cadastrar a Matéria Prima!",
        'type' => 'error'
      );
    }

    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  /**
   * Processa a exclusão de uma Matéria Prima.
   * Retorna uma resposta JSON para o JavaScript do lado do cliente.
   */
  public function deletaMateriaPrima()
  {
    // Obtendo o ID da matéria prima do formulário
    $id = (int) $this->input->post('id');

    // Deletando a matéria prima
    $retorno = $this->MateriasPrimas_model->deletaMateriaPrima($id);

    if ($retorno) {
      // Resposta de sucesso
      $response = array(
        'success' => true,
        'title' => "Sucesso!",
        'message' => "Matéria Prima deletada com sucesso!",
        'type' => "success"
      );
    } else {
      // Resposta de erro
      $response = array(
        'success' => false,
        'title' => "Algo deu errado!",
        'message' => "Não foi possível deletar a Matéria Prima!",
        'type' => "error"
      );
    }

    return $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  /**
   * Retorna todas as matérias primas em formato JSON.
   */
  public function recebeTodasMateriasPrimas()
  {
    $this->load->model('MateriasPrimas_model');
    $todasMaterias = $this->MateriasPrimas_model->recebeMateriasPrimas();

    if ($todasMaterias) {
      $response = array(
        'materias' => $todasMaterias,
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
