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
        $this->db->select('P.*');
        $this->db->from('ci_projetos P');
        $this->db->join('ci_empresas E', 'E.id = P.id_empresa', 'INNER');

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

    public function recebeProjetoPorCodigo($id_projeto)
    {
        $this->db->where('id', $id_projeto);
        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        }

        $query = $this->db->get('ci_projetos');

        return $query->row_array();
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

    public function recebeProjetoCliente($id_cliente, $status = null, $status_desenvolvido = null)
    {
        $this->db->select('P.*, C.*, P.status as STATUS_PROJETO, P.id as ID_PROJETO');
        $this->db->from('ci_projetos P');
        $this->db->join('ci_clientes C', 'P.id_cliente = C.id');
        $this->db->where('P.id_cliente', $id_cliente);
    
        if (!is_null($status)) {
            $this->db->where('P.status', $status);
        }
    
        if (!is_null($status_desenvolvido)) {
            $this->db->where('P.desenvolvido', $status_desenvolvido);
        }
    
        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('P.id_empresa', $this->session->userdata('id_empresa'));
        }
    
        $query = $this->db->get();
    
        return $query->result_array();
    }
    

    public function recebeDadosProjetoCliente($id_cliente)
    {
        $this->db->select('id, codigo_projeto, nome_produto');
        $this->db->where('id_cliente', $id_cliente);
        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        }

        $query = $this->db->get('ci_projetos');

        return $query->result_array();
    }

    public function recebeProjetoClienteCodigo($codigo_projeto)
    {
        $this->db->select('P.*, C.nome_fantasia as CLIENTE_NOME_FANTASIA, DP.*, P.criado_em');

        $this->db->join('ci_clientes C', 'P.id_cliente = C.id', 'left');
        $this->db->join('ci_desenvolvimento_projeto DP', 'DP.codigo_projeto = P.codigo_projeto', 'left');

        $this->db->where('P.codigo_projeto', $codigo_projeto);

        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('P.id_empresa', $this->session->userdata('id_empresa'));
        }

        $query = $this->db->get('ci_projetos P');

        return $query->result_array();
    }

    public function recebeMateriasPrimasPorCodigoProjeto($codigo_projeto, $versao_projeto)
    {
        $this->db->select('MP.*, MP.id as ID_MATERIA_PRIMA, MPP.fase as FASE_MATERIA_PRIMA, MP.nome AS NOME_MATERIA_PRIMA, MPP.total AS VALOR_MP_PROJETO, MPP.quantidade AS QUANTIDADE_MP_PROJETO, MPP.percentual AS PERCENTUAL_MP_PROJETO, MPP.total AS TOTAL_MP_PROJETO');
        $this->db->join('ci_materia_prima_projeto MPP', 'MP.id = MPP.id_materia_prima', 'left');
        $this->db->where('MPP.codigo_projeto', $codigo_projeto);
        $this->db->where('MPP.versao_projeto', $versao_projeto);

        $query = $this->db->get('ci_materias_primas MP');

        return $query->result_array();
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

    public function editaProjeto($id_projeto, $dados = null, $status_desenvolvido = null)
    {
        $dados['editado_em'] = date('Y-m-d H:i:s');
        
        if (!is_null($status_desenvolvido)) {
            $dados['desenvolvido'] = $status_desenvolvido;
        }
    
        $this->db->where('id', $id_projeto);
    
        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        }
    
        $this->db->update('ci_projetos', $dados);
    
        if ($this->db->affected_rows() > 0) {
            $this->Log_model->insereLog($id_projeto);
    
            $this->db->where('id', $id_projeto);
            $query = $this->db->get('ci_projetos');
            return $query->row_array();
        }
    
        return false;
    }
    

    public function inativaProjetoCliente($id_projeto)
    {
        $dados['status'] = 0;
        $this->db->where('id', $id_projeto);

        if ($this->session->userdata('id_empresa') > 1) {
            $this->db->where('id_empresa', $this->session->userdata('id_empresa'));
        }
        $this->db->update('ci_projetos', $dados);

        if ($this->db->affected_rows()) {
            $this->Log_model->insereLog($id_projeto);
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
