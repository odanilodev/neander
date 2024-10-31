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

		$id_projeto = $this->uri->segment(4);

		$data['projeto'] = $this->Projetos_model->recebeProjetoPorCodigo($id_projeto);

		$data['empresas'] = $this->Empresas_model->recebeEmpresas();

		$data['tiposEmbalagem'] = $this->Projetos_model->recebeTiposEmbalagem();
		$data['tiposTampa'] = $this->Projetos_model->recebeTiposTampa();

		$this->load->view('admin/includes/painel/cabecalho', $data);
		$this->load->view('admin/paginas/projetos/solicitar-projetos');
		$this->load->view('admin/includes/painel/rodape');
	}

	public function cadastraProjeto()
	{
		$id_projeto = $this->input->post('idProjeto');
		$codigo_projeto = $this->input->post('codigoProjeto');

		$dadosInformacoes = $this->input->post('dadosInformacoes');
		$dadosBriefing = $this->input->post('dadosBriefing');
		$dadosCustos = $this->input->post('dadosCustos');

		$dadosInformacoes['nome_marca'] = isset($dadosInformacoes['nome_marca']) ? ucfirst($dadosInformacoes['nome_marca']) : '';

		if (!$id_projeto && empty($codigo_projeto)) {
			$codigo_projeto = $this->session->userdata('id_empresa') .
				$this->session->userdata('id_usuario') .
				random_int(100, 999) .
				date('His');
		}

		$dados = array_merge(
			array('codigo_projeto' => $codigo_projeto),
			is_array($dadosInformacoes) ? $dadosInformacoes : [],
			is_array($dadosBriefing) ? $dadosBriefing : [],
			is_array($dadosCustos) ? $dadosCustos : []
		);

		$id_cliente = $this->input->post('idCliente');
		$dados['id_empresa'] = $this->session->userdata('id_empresa');

		if (!$id_projeto) {
			$dados['versao_projeto'] = 1;
			$dados['id_cliente'] = $id_cliente;
		}

		$retorno = $id_projeto
			? $this->Projetos_model->editaProjeto($id_projeto, $dados) // Se existe, edita
			: $this->Projetos_model->insereProjeto($dados); // Se não existe, insere

		if ($retorno) {
			$response = array(
				'success' => true,
				'message' => $id_projeto ? 'Projeto editado com sucesso!' : 'Projeto cadastrado com sucesso!',
				'idClienteCadastrado' => $id_cliente
			);
		} else {
			$response = array(
				'success' => false,
				'message' => $id_projeto ? "Erro ao editar o projeto!" : "Erro ao cadastrar o projeto!"
			);
		}

		// Retorna a resposta em formato JSON
		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function inativaProjetoCliente()
	{
		// Obtendo o ID da matéria prima do formulário
		$id_projeto = (int) $this->input->post('idProjeto');

		// Deletando a matéria prima
		$retorno = $this->Projetos_model->inativaProjetoCliente($id_projeto);

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

	public function verificaAtividadeProjeto()
	{
		$codigo_projeto = $this->input->post('codigoProjeto');
	
		// Verifica se já existe um projeto ativo com o código fornecido
		$projeto = $this->Projetos_model->verificaProjetosAtivos($codigo_projeto, 1);
	
		if ($projeto) {
			// Retorna a resposta solicitando confirmação
			$response = array(
				'success' => false,
				'title' => "Atenção!",
				'message' => "Um projeto com o mesmo código já está ativo, deseja inativá-lo?",
				'type' => "warning",
				'confirm' => true
			);
		} else {
			// Retorna resposta de que não há projetos ativos e pode prosseguir
			$response = array(
				'success' => true,
				'title' => "Nenhum conflito encontrado",
				'message' => "Pode prosseguir com a ativação do projeto.",
				'type' => "success"
			);
		}
	
		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	
	public function ativarProjetoCliente()
	{
		// Obtém o ID do projeto do formulário
		$id = (int) $this->input->post('id');
	
		// Tenta ativar o projeto diretamente
		$retorno = $this->Projetos_model->ativarProjetoCliente($id);
	
		if ($retorno) {
			// Resposta de sucesso
			$response = array(
				'success' => true,
				'title' => "Sucesso!",
				'message' => "Projeto ativado com sucesso!",
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
		$versao_projeto = $this->input->post('versaoProjeto');

		$retornoProjetoCliente = $this->Projetos_model->recebeProjetoClienteCodigo($codigo_projeto, $versao_projeto);
		$retornoMateriasPrimas = $this->Projetos_model->recebeMateriasPrimasPorCodigoProjeto($codigo_projeto, $versao_projeto);

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

	public function reformularProjeto()
	{
		$projetoId = $this->input->post('id');
		$projeto = $this->Projetos_model->recebeProjeto($projetoId);
		$retorno = null;

		if ($projeto) {
			$novaVersao = $projeto['versao_projeto'] + 1;

			$projetoData = $projeto;
			$projetoData['versao_projeto'] = $novaVersao;
			$projetoData['desenvolvido'] = 0;

			unset($projetoData['id']);
			unset($projetoData['editado_em']);

			$novoProjeto = $this->Projetos_model->insereProjeto($projetoData);

			if ($novoProjeto) {
				$this->Projetos_model->inativaProjetoCliente($projetoId);
				$retorno = [
					'title' => "Nova versão criada!",
					'message' => "Uma nova versão do projeto foi criada com sucesso.",
					'type' => "success"
				];
			}
		}

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
