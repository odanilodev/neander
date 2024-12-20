<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
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
		$this->load->model('Usuarios_model');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index()
	{
		// scripts padrão
		$scriptsPadraoHead = scriptsPadraoHead();
		$scriptsPadraoFooter = scriptsPadraoFooter();

		// scripts para usuarios
		$scriptsUsuarioHead = scriptsUsuarioHead();
		$scriptsUsuarioFooter = scriptsUsuarioFooter();

		add_scripts('header', array_merge($scriptsPadraoHead, $scriptsUsuarioHead));
		add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsUsuarioFooter));

		$data['usuarios'] = $this->Usuarios_model->recebeUsuarios();

		$this->load->view('admin/includes/painel/cabecalho', $data);
		$this->load->view('admin/paginas/usuarios/usuarios');
		$this->load->view('admin/includes/painel/rodape');
	}

	public function formulario()
	{
		// scripts padrão
		$scriptsPadraoHead = scriptsPadraoHead();
		$scriptsPadraoFooter = scriptsPadraoFooter();

		// scripts para usuarios
		$scriptsUsuarioHead = scriptsUsuarioHead();
		$scriptsUsuarioFooter = scriptsUsuarioFooter();

		add_scripts('header', array_merge($scriptsPadraoHead, $scriptsUsuarioHead));
		add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsUsuarioFooter));

		$this->load->model('Empresas_model');

		$id = $this->uri->segment(3);

		$data['usuario'] = $this->Usuarios_model->recebeUsuario($id);

		$data['empresas'] = $this->Empresas_model->recebeEmpresas();

		$this->load->view('admin/includes/painel/cabecalho', $data);
		$this->load->view('admin/paginas/usuarios/cadastra-usuario');
		$this->load->view('admin/includes/painel/rodape');
	}

	public function cadastraUsuario()
	{
		$this->load->library('upload_imagem');

		$id = $this->input->post('id');

		$nome = $this->input->post('nome');
		$dados['nome'] = mb_convert_case($nome, MB_CASE_TITLE, 'UTF-8');
		$dados['telefone'] = $this->input->post('telefone');
		$dados['email'] = $this->input->post('email');
		$dados['id_empresa'] = $this->session->userdata('id_empresa') > 1 ? $this->session->userdata('id_empresa') : $this->input->post('id_empresa'); // Se for usuário master pela valor do input

		$usuario = $this->Usuarios_model->recebeUsuarioEmail($dados['email']); // Verifica se já existe o email

		// Verifica se o email já existe e se não é o email do usuário que está sendo editado
		if ($usuario && $usuario['id'] != $id) {

			$response = array(
				'success' => false,
				'message' => "Este email está vinculado a outra conta! Tente um email diferente."
			);

			return $this->output->set_content_type('application/json')->set_output(json_encode($response));
		}

		// Verifica se veio a senha
		if ($this->input->post('senha')) {
			$dados['senha'] = password_hash($this->input->post('senha'), PASSWORD_DEFAULT);
		}

		$imagemAntiga = $this->Usuarios_model->imagemAntiga($id);

		$arrayUpload = [
			'foto_perfil'       => ['usuarios', $imagemAntiga['foto_perfil'] ?? null]
		];

		$retornoDados = $this->upload_imagem->uploadImagem($arrayUpload);
		$dados = array_merge($dados, $retornoDados);

		if ($id && $this->input->post('novaSenha')) {
			$dados['senha'] = password_hash($this->input->post('novaSenha'), PASSWORD_DEFAULT);
		}

		$retorno = $id ? $this->Usuarios_model->editaUsuario($id, $dados) : $this->Usuarios_model->insereUsuario($dados); // se tiver ID edita se não INSERE

		if ($retorno) { // inseriu ou editou

			$response = array(
				'success' => true,
				'message' => $id ? 'Usuário editado com sucesso!' : 'Usuário cadastrado com sucesso!'
			);
		} else { // erro ao inserir ou editar

			$response = array(
				'success' => false,
				'message' => $id ? "Erro ao editar o usuario!" : "Erro ao cadastrar o usuario!"
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}


	public function verificaSenhaAntiga()
	{
		$id = $this->input->post('id');
		$senhaAntiga = $this->input->post('senhaAntiga');

		$usuario = $this->Usuarios_model->recebeUsuario($id);

		if ($usuario) {

			$senha_hash = $usuario['senha']; // O hash da senha armazenado no banco de dados.

			if (password_verify($senhaAntiga, $senha_hash)) {
				$response = array(
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

	public function deletaUsuario()
	{
		$id = $this->input->post('id');

		$this->Usuarios_model->deletaUsuario($id);

		redirect('usuarios');
	}

	public function permissaoUsuarios()
	{
		$this->load->model('Menu_model');
		$id = $this->uri->segment(3);

		// scripts padrão
		$scriptsPadraoHead = scriptsPadraoHead();
		$scriptsPadraoFooter = scriptsPadraoFooter();

		// scripts para usuarios
		$scriptsUsuarioHead = scriptsUsuarioHead();
		$scriptsUsuarioFooter = scriptsUsuarioFooter();

		add_scripts('header', array_merge($scriptsPadraoHead, $scriptsUsuarioHead));
		add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsUsuarioFooter));

		$data['menus'] = $this->Menu_model->recebeMenus();
		$usuario = $this->Usuarios_model->recebeUsuario($id);
		$data['id_menu'] = [];

		if ($usuario) {
			$id_menu = json_decode($usuario['permissao'], true);
			$data['id_menu'] = $id_menu ?? [];
		}

		$this->load->view('admin/includes/painel/cabecalho', $data);
		$this->load->view('admin/paginas/usuarios/permissao-menus');
		$this->load->view('admin/includes/painel/rodape');
	}

	public function atualizaPermissoes()
	{
		$id_usuario = $this->input->post('id_usuario');
		$permissoes = $this->input->post('permissoes');

		$dados['permissao'] = json_encode($permissoes);

		$retorno = $this->Usuarios_model->editaUsuario($id_usuario, $dados);

		if ($retorno) { // editou

			if ($id_usuario == $this->session->userdata('id_usuario')) {
				$this->session->set_userdata('permissao', json_decode($dados['permissao'], true));
			}

			$response = array(
				'success' => true,
				'message' => "Permissão editada com sucesso!"
			);
		} else { // erro ao editar

			$response = array(
				'success' => false,
				'message' => "Erro ao editar a permissão do usuario!"
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function deletaFotoPerfil()
	{
		$id = $this->input->post('id');
		$arquivo = urldecode($this->input->post('arquivo'));
		$dados['foto_perfil'] = null;

		$retorno = $this->Usuarios_model->deletaFotoPerfil($id, $dados);

		if ($retorno) {
			$caminho = './uploads/' . $this->session->userdata('id_empresa') . '/usuarios/' . $arquivo;

			if (file_exists($caminho)) {
				unlink($caminho);
			}

			$response = array(
				'success' => true,
				'message' => 'Foto de perfil deletada com sucesso!',
				'type' => 'success',
				'title' => 'Sucesso!'
			);
		} else {
			$response = array(
				'success' => false,
				'message' => 'Erro ao deletar foto de perfil!',
				'type' => 'error',
				'title' => 'Algo deu errado!'
			);
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}
