<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DesenvolverProjeto extends CI_Controller
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

        $this->load->model('DesenvolverProjeto_model');
    }

    public function insereDesenvolvimentoProjeto()
    {
        $this->load->model('MateriasPrimasProjeto_model');
        $this->load->model('Projetos_model');

        $codigo_projeto = $this->input->post('codigoProjeto');
        $id_empresa = $this->session->userdata('id_empresa');

        /* =============== Matérias Primas ============ */
        $materias_primas = $this->input->post('materiasPrimas');

        $materia_prima_inserida = true;

        foreach ($materias_primas as $materia_prima) {

            $materia_prima['quantidade'] = floatval(str_replace(',', '.', $materia_prima['quantidade']));
            $materia_prima['total'] = floatval(str_replace(['R$', ','], ['', '.'], $materia_prima['total']));

            $materia_prima['codigo_projeto'] = $codigo_projeto;
            $materia_prima['id_empresa'] = $id_empresa;

            if (!$this->MateriasPrimasProjeto_model->insereMateriaPrimaProjeto($materia_prima)) {
                $materia_prima_inserida = false;
                break;
            };
        }

        if (!$materia_prima_inserida) {
            $response = array(
                'success' => false,
                'title' => 'Algo deu errado!',
                'message' => 'Erro ao cadastrar uma ou mais Matérias Primas!',
                'type' => 'error'
            );
        }

        /* ============================================ */

        /* =============== Dados Projeto ================ */

        $dados = $this->input->post('inputsProjeto');
        $idProjeto = $this->input->post('idProjeto');

        $dados['codigo_projeto'] = $codigo_projeto;
        $dados['id_empresa '] = $id_empresa;
        
        $status_desenvolvido = 1;
        $retorno_projeto = $this->Projetos_model->editaProjeto($idProjeto, null, $status_desenvolvido);

        
        $retorno = $this->DesenvolverProjeto_model->insereDesenvolvimentoProjeto($codigo_projeto, $dados);

        if ($retorno || $retorno_projeto) {
            $response = array(
                'success' => true,
                'title' => 'Sucesso!',
                'message' => 'Desenvolvimento de projeto salvo com sucesso! Deseja ir para Preço de Venda?',
                'type' => 'success'
            );
        } else {
            $response = array(
                'success' => false,
                'title' => 'Algo deu errado!',
                'message' => 'Não foi possivel salvar o desenvolvimento do projeto!',
                'type' => 'error'
            );
        }

        /* ============================================ */


        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}
