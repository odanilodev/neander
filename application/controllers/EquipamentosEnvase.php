<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EquipamentosEnvase extends CI_Controller
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

        // Carregando o modelo EquipamentosEnvase_model
        $this->load->model('EquipamentosEnvase_model');
    }

    /**
     * Função para obter os equipamentos de envase
     * Retorna os dados em formato JSON.
     */
    public function recebeDadosEquipamentoEnvase()
    {
        $id_equipamento = $this->input->post('idEquipamento');

        $equipamento = $this->EquipamentosEnvase_model->recebeDadosEquipamentoEnvase($id_equipamento);

        if ($equipamento) {
            $response = array(
                'equipamento' => $equipamento,
                'success' => true
            );
        } else {
            $response = array(
                'title' => 'Erro!',
                'message' => 'Falha ao buscar dados do equipamento.',
                'type' => 'error',
                'success' => false
            );
        }

        // Retorna a resposta em formato JSON
        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}
