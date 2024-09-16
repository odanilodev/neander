<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Projetos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		//INICIO controle sessão
		$this->load->library('Controle_sessao');
		$res = $this->controle_sessao->controle();
		if ($res == 'erro') {
			if ($this->input->is_ajax_request()) {
				$this->output->set_status_header(403);
				exit();
			} else {
				redirect('login/erro', 'refresh');
			}
		}
		// FIM controle sessão
		$this->load->model('Projetos_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index()
	{
		// scripts padrão
		$scriptsPadraoHead = scriptsPadraoHead();
		$scriptsPadraoFooter = scriptsPadraoFooter();


		add_scripts('header', array_merge($scriptsPadraoHead));
		add_scripts('footer', array_merge($scriptsPadraoFooter));

		$data['projetos'] = $this->Projetos_model->recebeProjetos();

		$this->load->view('admin/includes/painel/cabecalho', $data);
		$this->load->view('admin/paginas/projetos/projetos');
		$this->load->view('admin/includes/painel/rodape');
	}

	public function formulario()
	{
		// scripts padrão
		$scriptsPadraoHead = scriptsPadraoHead();
		$scriptsPadraoFooter = scriptsPadraoFooter();

		// scripts para projetos
		$scriptsProjetoFooter = scriptsProjetoFooter();
		$scriptsProjetoHead = scriptsProjetoHead();

		add_scripts('header', array_merge($scriptsProjetoHead, $scriptsPadraoHead));
		add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsProjetoFooter));

		$this->load->model('Empresas_model');

		$data['empresas'] = $this->Empresas_model->recebeEmpresas();
		$data['tiposEmbalagem'] = $this->Projetos_model->recebeTiposEmbalagem();

		$data['tiposTampa'] = $this->Projetos_model->recebeTiposTampa();

		$this->load->view('admin/includes/painel/cabecalho', $data);
		$this->load->view('admin/paginas/projetos/solicitar-projetos');
		$this->load->view('admin/includes/painel/rodape');
	}

	public function cadastraProjeto()
	{
		$id = $this->input->post('id');

		$dadosInformacoes = $this->input->post('dadosInformacoes');
		$dadosBriefing = $this->input->post('dadosBriefing');
		$dadosCustos = $this->input->post('dadosCustos');

		$dadosInformacoes['nome_marca'] = ucfirst($dadosInformacoes['nome_marca']);

		// Gera o código do projeto com a data e hora atual no formato DDMMAAHHIISS
		$codigoProjeto = date('dmYHis');

		// Coloca os arrays em uma única variável e adiciona o código do projeto
		$dados = array_merge(
			array('codigo_projeto' => $codigoProjeto),
			$dadosInformacoes,
			$dadosBriefing,
			$dadosCustos
		);

		$dados['id_empresa'] = $this->session->userdata('id_empresa');
		$dados['id_cliente'] = $this->input->post('idCliente');

		$retorno = $id ? $this->Projetos_model->editaProjeto($id, $dados) : $this->Projetos_model->insereProjeto($dados); // se tiver ID edita se não INSERE

		if ($retorno) { // inseriu ou editou

			$response = array(
				'success' => true,
				'message' => $id ? 'Projeto editado com sucesso!' : 'Projeto cadastrado com sucesso!',
				'idClienteCadastrado' => $this->input->post('idCliente')
			);
		} else { // erro ao inserir ou editar

			$response = array(
				'success' => false,
				'message' => $id ? "Erro ao editar o projeto!" : "Erro ao cadastrar o projeto!"
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function inativaProjetoCliente()
	{
		// Obtendo o ID da matéria prima do formulário
		$id = (int) $this->input->post('id');

		// Deletando a matéria prima
		$retorno = $this->Projetos_model->inativaProjetoCliente($id);

		if ($retorno) {
			// Resposta de sucesso
			$response = array(
				'success' => true,
				'title' => "Sucesso!",
				'message' => "Projeto Inativado com sucesso!",
				'type' => "success"
			);
		} else {
			// Resposta de erro
			$response = array(
				'success' => false,
				'title' => "Algo deu errado!",
				'message' => "Não foi possível inativar o Projeto!",
				'type' => "error"
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function ativarProjetoCliente()
	{
		// Obtendo o ID da matéria prima do formulário
		$id = (int) $this->input->post('id');

		// Deletando a matéria prima
		$retorno = $this->Projetos_model->ativarProjetoCliente($id);

		if ($retorno) {
			// Resposta de sucesso
			$response = array(
				'success' => true,
				'title' => "Sucesso!",
				'message' => "Projeto Ativado com sucesso!",
				'type' => "success"
			);
		} else {
			// Resposta de erro
			$response = array(
				'success' => false,
				'title' => "Algo deu errado!",
				'message' => "Não foi possível reativar o Projeto!",
				'type' => "error"
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function recebeProjetoClienteCodigo()
	{
		$codigo_projeto = $this->input->post('codigoProjeto');

		$retornoProjetoCliente = $this->Projetos_model->recebeProjetoClienteCodigo($codigo_projeto);
		$retornoMateriasPrimas = $this->Projetos_model->recebeMateriasPrimasPorCodigoProjeto($codigo_projeto);

		$retorno = array_merge($retornoProjetoCliente, $retornoMateriasPrimas);

		if (!empty($retorno)) {

			$response = array(
				'success' => true,
				'data' => $retorno,
				'type' => "success"
			);
		} else {
			$response = array(
				'success' => false,
				'title' => "Algo deu errado!",
				'message' => "Não foi possível encontrar o projeto, tente novamente mais tarde!",
				'type' => "error"
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}
