<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Mpdf\Mpdf;

class GerarPdf
{
  protected $CI;

  public function __construct()
  {
    $this->CI = &get_instance();
  }

  public function gerarPdfPrecoVenda($dados)
  {
    $this->CI->load->model('Clientes_model');
    $this->CI->load->model('PrecoVenda_model');
    $this->CI->load->model('CondicoesGeraisFornecimento_model');

    $data['cliente'] = $this->CI->Clientes_model->recebeCliente($dados[0]['idCliente']);

    $projetosCliente = [];

    foreach ($dados as $dado) {
      $projetosCliente = array_merge($projetosCliente, $this->CI->PrecoVenda_model->recebePrecoVendaProjetosCliente($dado['codigoProjeto'], $data['cliente']['id']));
    }

    $data['projetosClientes'] = $projetosCliente;

    $data['condicaoFornecimento'] = $this->CI->CondicoesGeraisFornecimento_model->recebeCondicoesFornecimentoProjeto($projetosCliente[0]['codigo_projeto']);

    $mpdf = new \Mpdf\Mpdf(['format' => 'A4', 'orientation' => 'P']);

    $footerHtml = '
          <div style="text-align: center; font-size: 10px;">
              Neander Cosméticos Indústria e Comércio LTDA<br>
              R. Pastor Sebastião André de Oliveira, D-71 - Distrito Industrial - Agudos - SP - CEP 17.123-221<br>
              Email: neander@neandercosmeticos.com.br / Telefone: (14) 3261-7018
          </div>
      ';

    $mpdf->SetHTMLFooter($footerHtml);


    $html = $this->CI->load->view('admin/paginas/preco-venda/preco-venda-pdf', $data, true);
    $mpdf->WriteHTML($html);

    return $mpdf->Output('', \Mpdf\Output\Destination::INLINE);
  }
}
