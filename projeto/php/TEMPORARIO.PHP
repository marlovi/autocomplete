// NUMERO TICKET
/////////////////////

SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro` WHERE p.`id_pesagem` = ".$id_pesagem." AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor` AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`

// PROCURA POR TIPO DE ENTRADA
/////////////////////////////////
// 0 entrada
// 1 saida
// 2 avulsa
// 3 manual

SELECT DATE_FORMAT(p.`data`, '%d-%m-%Y %h:%i:%s') AS data , p.`status` , p.`cliente_id_cliente` , p.`fornecedor_id_fornecedor` , p.`produto_id_produto` , p.`motorista` , p.`observacao`, p.`id_pesagem`, p.`peso_1`, p.`peso_2`, p.`peso_descontos`, p.`peso_liquido`, c.`nome`AS `cliente` , c.`cpf`AS `cpf_cliente` , c.`cnpj`AS `cnpj_cliente`, f.`nome` AS `fornecedor` , f.`cpf` AS `cpf_fornecedor` , f.`cnpj` AS `cnpj_fornecedor`, v.`placa`, pro.`nome` AS `produto` , pro.`id_produto` AS `cod_prod`  FROM `pesagem` as `p`, `cliente` as `c`, `fornecedor` as `f`, `veiculo` as `v`, `produto` as `pro` WHERE p.`status` = "0" AND p.`cliente_id_cliente` = c.`id_cliente` AND f.`id_fornecedor` = p.`fornecedor_id_fornecedor` AND v.`id_veiculo` = p.`veiculo_id_veiculo` AND pro.`id_produto` = p.`produto_id_produto`

// PROCURAR VEICULO POR PLACA
////////////////////////////////
// PROCURAR ID DO VEICULO BUSCANDO POR PLACA NO BANCO VEICULO
SELECT `id_veiculo`, `placa`, `descricao`, `tipo`,  `fornecedor_id_fornecedor`, `cliente_id_cliente`, `empresa_id_empresa` FROM `veiculo` WHERE `placa` LIKE '".$placa."%' LIMIT 30

// PROCURA PESAGEM BUSCANDO POR  ID VEICULO 
////////////////////////////
SELECT v.`placa`, p.`status` ,  p.`id_pesagem` ,  p.`veiculo_id_veiculo`  FROM `pesagem` as `p`, `veiculo` as `v` WHERE p.`veiculo_id_veiculo` = ".$id_placa." AND v.`id_veiculo` = p.`veiculo_id_veiculo`

 
// PROCURA PESAGEM POR ID PRODUTO
////////////////////////////////
SELECT p.`status` ,  p.`id_pesagem` , p.`produto_id_produto`   FROM `pesagem` as `p`, `produto` as `pro` WHERE p.`produto_id_produto` = "1" AND pro.`id_produto` = p.`produto_id_produto`

// PROCURA PRODUTO POR NOME NO BANCO PRODUTO
///////////////////////
SELECT `nome`,`id_produto`  FROM `produto` WHERE `nome` LIKE '".$nome."%' LIMIT 30

// PROCURA PESAGEM POR ID CLIENTE
/////////////////////////////
SELECT p.`status` ,  p.`id_pesagem` , p.`cliente_id_cliente`   FROM `pesagem` as `p`, `cliente` as `c` WHERE p.`cliente_id_cliente` = ".$id_placa." AND c.`id_cliente` = p.`cliente_id_cliente`
// PROCURA CLIENTE POR NOME 
///////////////////////////////
SELECT `nome`,`id_cliente`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `cliente` WHERE `nome` LIKE '".$nome."%' LIMIT 30

// PROCURA PESAGEM POR ID FORNECEDOR
///////////////////////////////////
SELECT p.`status` ,  p.`id_pesagem` , p.`fornecedor_id_fornecedor`   FROM `pesagem` as `p`, `fornecedor` as `c` WHERE p.`fornecedor_id_fornecedor` = ".$id_placa." AND c.`id_fornecedor` = p.`fornecedor_id_fornecedor`
// PROCURA PESAGEM POR NOME FORNECEDOR
////////////////////////////////////
SELECT `nome`,`id_fornecedor`, `cpf`, `cnpj`, `endereco`,`cidade`, `estado`, `telefone`, `email` FROM `fornecedor` WHERE `nome` LIKE '".$nome."%' LIMIT 30