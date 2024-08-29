<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Projetos_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Log_model');
    }

    public function recebeProjetos()
    {
        $this->db->select('ci_projetos.*');
        $this->db->from('ci_projetos');
        $this->db->join('ci_empresas', 'ci_empresas.id = ci_projetos.id_empresa', 'INNER');

        $query = $this->db->get();

        return $query->result_array();
    }
    public function recebeTiposEmbalagem()
    {
        $this->db->select('TE.*');
        $this->db->from('ci_tipos_embalagem TE');

        $query = $this->db->get();

        return $query->result_array();
    }
    public function recebeTiposTampa()
    {
        $this->db->select('TT.*');
        $this->db->from('ci_tipos_tampa TT');
        $query = $this->db->get();

        return $query->result_array();
    }


    public function recebeProjeto($id)
    {
        $this->db->where('id', $id);
        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        }

        $query = $this->db->get('ci_projetos');

        return $query->row_array();
    }

    public function recebeProjetoCliente($id_cliente)
    {
        $this->db->where('id_cliente', $id_cliente);
        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        }

        $query = $this->db->get('ci_projetos');

        return $query->result_array();
    }

    public function recebeProjetoClienteCodigo($codigo_projeto)
    {
        $this->db->select('P.*, C.nome_fantasia as CLIENTE_NOME_FANTASIA');
        $this->db->join('ci_clientes C', 'P.id_cliente = C.id');
        $this->db->where('P.codigo_projeto', $codigo_projeto);
        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('P.id_empresa', $this->session->userdata('id_empresa'));
        }

        $query = $this->db->get('ci_projetos P');

        return $query->row_array();
    }

    public function insereProjeto($dados)
    {
        $dados['criado_em'] = date('Y-m-d H:i:s');

        $this->db->insert('ci_projetos', $dados);

        $inserted_id = $this->db->insert_id();

        if ($inserted_id) {
            $this->db->where('id', $inserted_id);
            $query = $this->db->get('ci_projetos');
            return $query->row_array(); 
        }

        return false;
    }

    public function editaProjeto($id, $dados)
    {
        $dados['editado_em'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);

        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        }

        $this->db->update('ci_projetos', $dados);

        if ($this->db->affected_rows() > 0) {
            $this->Log_model->insereLog($id);

            // Retrieve and return the updated row
            $this->db->where('id', $id);
            $query = $this->db->get('ci_projetos');
            return $query->row_array(); // Return the updated row as an associative array
        }

        return false;
    }

    public function inativaProjetoCliente($id)
    {
        $dados['status'] = 0;
        $this->db->where('id', $id);

        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        }
        $this->db->update('ci_projetos', $dados);

        if ($this->db->affected_rows()) {
            $this->Log_model->insereLog($id);
        }

        return $this->db->affected_rows() > 0;
    }

    public function ativarProjetoCliente($id)
    {
        $dados['status'] = 1;
        $this->db->where('id', $id);

        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        }
        $this->db->update('ci_projetos', $dados);

        if ($this->db->affected_rows()) {
            $this->Log_model->insereLog($id);
        }

        return $this->db->affected_rows() > 0;
    }
}
