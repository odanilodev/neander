<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clientes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // INICIO controle sessão
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
        // FIM controle sessão

        // Carregando o modelo Clientes_model
        $this->load->model('Clientes_model');
    }

    public function index($page = 1)
    {
        // scripts padrão
        $scriptsPadraoHead = scriptsPadraoHead();
        $scriptsPadraoFooter = scriptsPadraoFooter();

        // Scripts para clientes
        $scriptsClienteHead = scriptsClientesHead();
        $scriptsClienteFooter = scriptsClientesFooter();

        add_scripts('header', array_merge($scriptsPadraoHead, $scriptsClienteHead));
        add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsClienteFooter));

        $this->load->helper('cookie');

        if ($this->input->post()) {
            $this->input->set_cookie('filtro_clientes', json_encode($this->input->post()), 3600);
        }

        if (is_numeric($page)) {
            $cookie_filtro_clientes = count($this->input->post()) > 0 ? json_encode($this->input->post()) : $this->input->cookie('filtro_clientes');
        } else {
            $page = 1;
            delete_cookie('filtro_clientes');
            $cookie_filtro_clientes = json_encode([]);
        }

        $data['cookie_filtro_clientes'] = json_decode($cookie_filtro_clientes, true);

        // >>>> PAGINAÇÃO <<<<<
        $limit = 12; // Número de clientes por página
        $this->load->library('pagination');
        $config['base_url'] = base_url('clientes/index');
        $config['total_rows'] = $this->Clientes_model->recebeClientes($cookie_filtro_clientes, $limit, $page, true); // true para contar
        $config['per_page'] = $limit;
        $config['use_page_numbers'] = TRUE; // Usar números de página em vez de offset
        $this->pagination->initialize($config);
        // >>>> FIM PAGINAÇÃO <<<<<

        //clientes
        $data['clientes'] = $this->Clientes_model->recebeClientes($cookie_filtro_clientes, $limit, $page);

        // cidades
        $data['cidades'] = $this->Clientes_model->recebeCidadesCliente();

        $this->load->view('admin/includes/painel/cabecalho', $data);
        $this->load->view('admin/paginas/clientes/clientes');
        $this->load->view('admin/includes/painel/rodape');
    }

    /**
     * Carrega o formulário de cadastro/edição de Cliente.
     * Inclui scripts padrão e específicos da página.
     */
    public function formulario()
    {
        // Scripts padrão
        $scriptsPadraoHead = scriptsPadraoHead();
        $scriptsPadraoFooter = scriptsPadraoFooter();

        // Scripts para Clientes
        $scriptsClientesFooter = scriptsClientesFooter();

        // Adicionando scripts ao header e footer
        add_scripts('header', array_merge($scriptsPadraoHead));
        add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsClientesFooter));

        // Obtendo o ID do cliente da URL
        $id = $this->uri->segment(3);

        // Obtendo o cliente específico
        $data['cliente'] = $this->Clientes_model->recebeCliente($id);

        // Carregando as views com os dados
        $this->load->view('admin/includes/painel/cabecalho', $data);
        $this->load->view('admin/paginas/clientes/cadastra-cliente');
        $this->load->view('admin/includes/painel/rodape');
    }

    /**
     * Processa o cadastro ou edição de um Cliente.
     * Verifica se o nome do Cliente já existe e insere ou edita conforme necessário.
     * Retorna uma resposta JSON para o JavaScript do lado do cliente.
     */
    public function cadastraCliente()
    {
        $id = (int) $this->input->post('id');

        // Obtendo os dados do formulário e atribuindo ao array $dados
        $dados = array(
            'razao_social' => mb_strtoupper($this->input->post('razao_social')),
            'nome_fantasia' => mb_strtoupper($this->input->post('nome_fantasia')),
            'cnpj' => $this->input->post('cnpj'),
            'contato' => ucwords($this->input->post('contato')),
            'cidade' => mb_strtoupper($this->input->post('cidade')),
            'estado' => mb_strtoupper($this->input->post('estado')),
            'telefone' => $this->input->post('telefone'),
            'email' => $this->input->post('email'),
            'id_empresa' => (int) $this->session->userdata('id_empresa')
        );

        // Verificando se o cliente já existe
        $cliente = $this->Clientes_model->recebeNomeCliente($dados['razao_social'], $id);

        if ($cliente) {
            // Resposta caso o cliente já exista
            $response = array(
                'title' => "Algo deu errado!",
                'type' => "error",
                'success' => false,
                'message' => "Este Cliente já existe! Tente cadastrar um diferente."
            );

            return $this->output->set_content_type('application/json')->set_output(json_encode($response));
        }

        // Inserindo ou editando o cliente
        $retorno = $id ? $this->Clientes_model->editaCliente($id, $dados) : $this->Clientes_model->insereCliente($dados);

        if ($retorno) {
            // Resposta de sucesso
            $response = array(
                'success' => true,
                'title' => 'Sucesso!',
                'message' => $id ? 'Cliente editado com sucesso!' : 'Cliente cadastrado com sucesso!',
                'type' => 'success'
            );
        } else {
            // Resposta de erro
            $response = array(
                'success' => false,
                'title' => 'Algo deu errado!',
                'message' => $id ? "Erro ao editar o Cliente!" : "Erro ao cadastrar o Cliente!",
                'type' => 'error'
            );
        }

        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function detalhes()
    {
        $this->load->model('Projetos_model');
        $this->load->model('EquipamentosManipulacao_model');
        $this->load->model('EquipamentosEnvase_model');
        $this->load->model('EquipamentosRotulagem_model');
        $this->load->model('MateriasPrimas_model');

        // scripts padrão
        $scriptsPadraoHead = scriptsPadraoHead();
        $scriptsPadraoFooter = scriptsPadraoFooter();

        // scripts para clientes
        $scriptsClienteHead = scriptsClientesHead();
        $scriptsProjetoHead = scriptsProjetoHead();
        $scriptsClienteFooter = scriptsClientesFooter();
        $scriptsProjetoFooter = scriptsProjetoFooter();

        add_scripts('header', array_merge($scriptsPadraoHead, $scriptsClienteHead, $scriptsProjetoHead));
        add_scripts('footer', array_merge($scriptsPadraoFooter, $scriptsClienteFooter, $scriptsProjetoFooter));

        $id = $this->uri->segment(3);

        $data['cliente'] = $this->Clientes_model->recebeCliente($id);
        $data['projetos'] = $this->Projetos_model->recebeProjetoCliente($id);

        $data['materiasPrimas'] = $this->MateriasPrimas_model->recebeMateriasPrimas();

        $data['equipamentosRotulagem'] = $this->EquipamentosRotulagem_model->recebeEquipamentosRotulagem();
        $data['equipamentosManipulacao'] = $this->EquipamentosManipulacao_model->recebeEquipamentosManipulacao();
        $data['equipamentosEnvase'] = $this->EquipamentosEnvase_model->recebeEquipamentosEnvase();

        $data['custoHoraManipulacao'] = $this->EquipamentosManipulacao_model->recebeCustoHoraManipulacao();   

        // verifica se existe cliente
        if (empty($data['cliente'])) {

            redirect('clientes/index/all');
        }

        $this->load->view('admin/includes/painel/cabecalho', $data);
        $this->load->view('admin/paginas/clientes/detalhes-cliente');
        $this->load->view('admin/includes/painel/rodape');
    }

    /**
     * Processa a exclusão de um Cliente.
     * Retorna uma resposta JSON para o JavaScript do lado do cliente.
     */
    public function deletaCliente()
    {
        // Obtendo o ID do cliente do formulário
        $id = (int) $this->input->post('id');

        // Deletando o cliente
        $retorno = $this->Clientes_model->deletaCliente($id);

        if ($retorno) {
            // Resposta de sucesso
            $response = array(
                'success' => true,
                'title' => "Sucesso!",
                'message' => "Cliente deletado com sucesso!",
                'type' => "success"
            );
        } else {
            // Resposta de erro
            $response = array(
                'success' => false,
                'title' => "Algo deu errado!",
                'message' => "Não foi possível deletar o Cliente!",
                'type' => "error"
            );
        }

        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function recebeTodosClientes()
    {
        $this->load->model('Clientes_model');
        $todosClientes = $this->Clientes_model->recebeClientes();

        if ($todosClientes) {
            $response = array(
                'clientes' => $todosClientes,
                'success' => true
            );
        } else {
            $response = array(
                'success' => false
            );
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function alteraStatusCliente()
    {
        $id = $this->input->post('id');
        $dados['status'] = $this->input->post('status');

        $retorno = $this->Clientes_model->editaCliente($id, $dados);

        if ($retorno) { // alterou status

            $response = array(
                'success' => true,
            );
        } else { // erro ao deletar

            $response = array(
                'success' => false,
            );
        }

        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function recebeEquipamentosManipulacaoPorNivel()
    {
        $nivel = $this->input->post('nivel');

        if ($nivel) {
            $this->load->model('EquipamentosManipulacao_model');
            $this->load->model('EquipamentosEnvase_model');

            $manipulacao = $this->EquipamentosManipulacao_model->recebeEquipamentosManipulacaoPorNivel($nivel);
            $envase = $this->EquipamentosEnvase_model->recebeEquipamentosEnvasePorNivel($nivel);

            $resposta = array(
                'manipulacao' => $manipulacao,
                'envase' => $envase
            );

            $this->output->set_content_type('application/json')->set_output(json_encode($resposta));
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode(array('equipamentos' => array())));
        }
    }
}
