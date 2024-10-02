<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DesenvolverProjeto_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Log_model');
    }

    public function insereDesenvolvimentoProjeto($codigo_projeto, array $dados): bool
    {
        $dados['criado_em'] = date('Y-m-d H:i:s');
        $dados['codigo_projeto'] = $codigo_projeto;
        $dados['status_desenvolvido'] = 1; 
        

        $this->db->insert('ci_desenvolvimento_projeto', $dados);

        if ($this->db->affected_rows() > 0) {
            $this->Log_model->insereLog($this->db->insert_id()); 
            return true; 
        }

        return false; 
    }
}
