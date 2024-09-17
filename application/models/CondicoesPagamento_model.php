<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CondicoesPagamento_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Log_model');
    }


    public function recebeCondicoes()
    {

        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        }

        $consulta = $this->db->get('ci_condicao_pagamento');

        return $consulta->result_array();
    }
}
