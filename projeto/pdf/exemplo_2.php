<?php
// NESSA VERSAO CONSEGUI RENDERIZAR O HTML EM PDF 
// SALVAR O ARQUIVO PDF 
// DEIXAR NA VISUALIZAÇÃO PARA IMPRESSÃO
// Inclui a classe DOMPDF
include_once("dompdf/dompdf_config.inc.php");

/**
 * Gera um arquivo PDF lendo o conteúdo HTML proveniente de uma string
 * @param string $titulo Define o título do arquivo PDF
 * @param string $html A string de origem contendo a strutura HTML a ser convertida para PDF
 * @param string $tipo Define o tipo do documento PDF (P = Retrato ou L = Paisagem
 * @return bool Retorna se o arquivo foi gerado com sucesso ou não
 */
// ISSO FOI FEITO PARA EU VISUALIZAR O ARQUIVO NA PAGINA DE NAVEGAÇÃO
// MAS NAO ESTOU VISUALIZANDO O ARQUIVO CRIADO.
/* Cria a instância */
$dompdf = new DOMPDF();
// Html de teste
$html = '
    <!doctype html>
<html>
 
<head>
<meta charset="UTF-8">
<title>Atenção, apenas um teste</title>
<style>
* { font-family: sans-serif; }
</style>
</head>
 
<body>
 
<header>
    <h1>Atenção, SDASD</h1>
    <p>Estou dando um exemplo sobre como utilizar a dompdf. 
    Meu nome é <b>batman</b> E trabalho   
       
    </p>
    
     
</header>
 
</body>
 
</html>
';

/* Carrega seu HTML */
$dompdf->load_html($html); 

/* Renderiza */
$dompdf->render();
 
/* Exibe */
$dompdf->stream(
    "arquivo.pdf", /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);
// FIM DA GAMBIARRA.
// Tenta criar o arquivo PDF
toPDF("arquivo.pdf", $html);

function toPDF($titulo, $html, $tipo = "P") {
    $dompdf = new DOMPDF();

    // Define internamente o tipo do documento
    if ($tipo == "L") {
        $dompdf->set_paper("legal", "landscape");
    }

    // Carrega o $html de entrada para a classe
    $dompdf->load_html($html); 

    // "Renderiza" o conteúdo
    $dompdf->render();

    /* Exibe */
$dompdf->stream(
    "arquivo.pdf", /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);

    // Cria e obtém o PDF gerado
    $pdf = $dompdf->output();

    // Define o caminho onde será salvo
    $arquivo = "" . $titulo; 
    return ( file_put_contents($arquivo,$pdf) );
}
?>