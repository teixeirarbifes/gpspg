<?php
$request = new Request();
$txt_controller = $request->__get('controller');
$txt_method = $request->__get('method');

$campos = [['Tipo documento','txt_classe'],['Nome do arquivo','txt_filename']];
$id = 'id_doc';
$exclusao = 1;
$novo = 0;
$visualizar = 3;
$visualizar_url = "/?action=download&d=";
#$visualizar_controller = "documentoscontroller";
#$visualizar_method = "download";
$visualizar_txt = "Baixar PDF";
$visualizar_extra = "f=".$ficha->id_ficha;

$botao_extra_1 = 0;
$botao_extra_1_controller = "processoscontroller";
$botao_extra_1_method = "visualizar_candidato";
$botao_extra_1_txt = "Mais informações</br>do processo seletivo";

$funcao_excluir = "excluir_grade_pessoal";
?>
<script>
let modal_id = 0;
delete excluir_grade_pessoal;
delete callback_grade_pessoal;


//function confirma(evento){
//        close_modal();
//}
</script>   

<?php $pagina = "pessoal"; include GPATH."view".S.'ficha'.S."ficha_header.php"; ?>    
<h3><font color=black>Anexar os documentos pessoais e formulários</font></h3>

<hr>

<form id="excluir" action="" method="post">
        <input type="hidden" name="excluir" value="1"/>
</form>

<form method="post" action="?controller=DocumentosController&method=upload&tipo=1&id_ficha=<?=$ficha->id_ficha?>" enctype="multipart/form-data" id="form">

<div class="container p-2">
  <div class="row">        
  <a class="btn btn-secondary" id=salvar onclick="go_link('/?controller=FichaController&method=editar&id_ficha=<?php echo $ficha->id_ficha; ?>');"><font color=black>Voltar para ficha</font></a>&nbsp;
  <a class="btn btn-success" id=salvar onclick="go_link('/?controller=DocumentosController&method=listar_curriculo&id_ficha=<?php echo $ficha->id_ficha; ?>');"><font color=black>Continuar >></font></a>&nbsp;
</div>
</br>
<div class="row">
  <b>Utilize esse formulário para enviar os documentos.<b>
  </div>
  <div class="row">
        <div class="form-group">    
                <div classa="col-md-12 col-sm-12">  
                    <div id="display_erro" class="alert alert-danger display-error" style="display: none">
                        <b>Não foi possível carregar!</br></b><ul><span id="erro" name="erro"></span></ul>
                    </div>
                </div>
        </div>
    </div>

        <div >
            <input type="hidden" id="id_ficha" value="<?=$ficha->id_ficha?>"/>
            <div class="form-group">
                <?php $comment = ""; ?>
                <select onchange="if($('#id_classe').val()==0){ $('#descricao').html(''); }else{ $('#descricao').html('<b>Descrição:</b> '+desc[$('#id_classe').val()]); }" style="width:500px" class="form-control" id="id_classe" name="id_classe">
                <option value=""> *** Selecione um tipo da lista *** </option>                    
                <?php 
                foreach($classes as $classe){ 
                    if($comment!="") $comment .= ",";
                    
                    $comment .= $classe->id_classe.':"'.str_replace(PHP_EOL,'',nl2br(htmlentities($classe->txt_descricao))).'"';
                    ?>    
                <option value="<?php echo $classe->id_classe; ?>"> <?php echo $classe->txt_classe; ?></option>    
                <?php } ?>
                </select>               
                <script>
                    var desc = {<?=$comment?>};
                </script>
                <div style="font-color:red;font-size:12px" class="form-text text-muted"><font color="red"><div class="msg_error" id="erro_id_classe"></div></font></div>
                <div style="font-color:black;font-size:16px;font-weight: normal;font-family: 'Times New Roman', Times, serif"><font color="black"><div>
                <span id="descricao"></span>
                </div></font></div>
            </div>                                           
            <div>   
            <input type="file"  id="txt_filename" name="txt_filename" accept=".pdf">
            <!--label class="custom-file-label"  for="txt_filename">Selecione o arquivo em PDF</label-->
            </div>
            <!--input type="button" class="button_photo" value="Upload" id="but_upload"-->            
            <div style="font-color:red;font-size:12px" class="form-text text-muted"><font color="red"><div class="msg_error" id="erro_txt_filename"></div></font></div>
            </br>
            <div class="form-group">
            <a class="btn btn-primary" id="bt_excluir" onclick="validar_upload('form','upload',false);"><font color="black">Carregar documento</font></a>
            </div>  
        </div>
    </div>
</div>
<div class="container p-2">  
<div class="row">
<div class="col-md-12 col-sm-12 border"> 
     <h3>Documentos carregados</h3>
        <div class="row">
            <div class='col-md-12'>
                <?php 
                if($data_table){
                ?>
                <?php
                include GPATH."utils".S."table.php"; 
                //echo $paginacao;
                }else{
                ?>
                <div style="text-align:center">
                <font color="red">Não há nenhum documento de curriculo pessoal ou formulário para esta inscrição.</font>
                </div>
            <?php } ?>
        </div>
    </div>
   </div>
</div>
</div>

</form>


