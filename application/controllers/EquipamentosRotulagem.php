<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EquipamentosRotulagem extends CI_Controller
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

        // Carregando o modelo EquipamentosRotulagem_model
        $this->load->model('EquipamentosRotulagem_model');
    }

    /**
     * Função para obter os equipamentos de rotulagem
     * Retorna os dados em formato JSON.
     */
    public function recebeDadosEquipamentoRotulagem()
    {
        $id_equipamento = $this->input->post('idEquipamento');

        $equipamento = $this->EquipamentosRotulagem_model->recebeDadosEquipamentoRotulagem($id_equipamento);

        if ($equipamento) {
            $response = array(
                'equipamento' => $equipamento,
                'success' => true
            );
        } else {
            $response = array(
                'title' => 'Erro!',
                'message' => 'Falha ao buscar dados do equipamento de rotulagem.',
                'type' => 'error',
                'success' => false
            );
        }

        // Retorna a resposta em formato JSON
        return $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}
