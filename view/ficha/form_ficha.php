<?php 
ob_start(); ?>
  <div class="{class}">      
    <label for="{field}">{label}</label>
    <input type="text" id="{field}" class="maskField form-control" aria-describedby="erro_{field}" name="{field}" value="{value}" {adicional}/>
    <div style="font-color:red;font-size:12px" class="form-text text-muted"><font color=red><div class="msg_error" id="erro_{field}">{msg}</div></font></div>
  </div>
<?php global $tmp_textfield;
$tmp_textfield = ob_get_contents(); 
ob_end_clean();

function textfield($label,$field,$class,$obrigatorio = false,$adicional="",$msg="",$value=""){
  global $tmp_textfield;
  global $ficha;
  if($field!="" && $field!=null)
  if(isset($ficha->{$field})) $value = $ficha->{$field};
  echo str_replace('{msg}',$msg,str_replace('{adicional}',$adicional,str_replace('{label}',$label.($obrigatorio ? '<font color=red> ⋆</font>' : ''),str_replace('{class}',$class,str_replace('{value}',$value,str_replace('{field}',$field,$tmp_textfield))))));
}
$pagina = "ficha";
?>

<?php include GPATH."view".S.'ficha'.S."ficha_header.php"; ?>    
<h3><font color=black>Editar a ficha de inscrição</font></h3>
<hr>
<div style="text-align:left">
<div class="container p-2">
<div class="row">
    <div class='col-md-12'>
      
                <a class="btn btn-success" id=salvar  onclick="$('#voltar').val(0); validar('form','ficha');"><font color=black>Salvar ficha</font></a>&nbsp;  
                <a class="btn btn-success" id=salvar  onclick="$('#voltar').val(1); validar('form','ficha');"><font color=black>Salvar ficha & Continuar >></font></a>&nbsp;  
                </br>
                </br>
                <div>
<font size=2>
- Os campos sinalizados são obrigatórios (<font color=red>⋆</font>).</br>
- Por exceção, somente um telefone ou celular é obrigatório.</br>
</font>
                </div>
</div></div></div>
<form id=form class="form-horizontal" action="?controller=fichacontroller&method=atualizar&id=<?php echo $ficha->id_ficha; ?>" method="post" >
<input type="hidden" id="bl_condicao_especial_valor" name="bl_condicao_especial2" value=<?=$ficha->bl_condicao_especial ? 1 : 0?> >
<input type=hidden id=voltar name=voltar value=0/>
<div class="form-group">
 <div class="container border p-2">
 <div class=row>
<div class=row>
<div class="col-md-12 col-sm-12">  
<div id=display_erro class="alert alert-danger display-error" style="display: none">
 <b>Não foi possível enviar o formulário pelos seguintes motivos:</br></b><ul><span id="erro" name="erro"></span></ul>
 </div>
</div>
</div>
</div>
  <div class="row">
  <form method="post" action="" enctype="multipart/form-data" id="myform">
  <div class="col-md-2 col-sm-12">    
        <div>
        <b>Sua foto<font color=red> ⋆</font>:</b><br/>
        <img style="display:<?php echo isset($ficha->txt_photo) ? "block" : "none" ?>" src="<?php echo isset($ficha->txt_photo) ? "/photo.php?uq=".uniqid()."&id=".$ficha->id_ficha : "" ?>" id="img" width="162" height="180">
        </div>
        <div >
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="file_picture" id="file_picture" aria-describedby="inputGroupFileAddon01">
                    <input type="hidden" value="" name="id" id="id"/>
                    <input type="hidden" value="<?php echo isset($ficha->txt_photo) ? $ficha->id_ficha : "" ?>" name="id_saved" id="id_saved"/>

                    <span id="status_photo"><b><font color="red"><?php echo isset($ficha->txt_photo) && $ficha->txt_photo!="" ? "<b><font color=green>Foto salva!</font></b>" : "" ?></font></b></span>
                    <a id="excluir_photo" onclick="excluir_photo();" style="display:none;cursor:pointer">Excluir foto temporária</a>



                    <label class="custom-file-label"  for="txt_picture">Selecione</label>
                </div>
              <!--input type="button" class="button_photo" value="Upload" id="but_upload"-->
              <div id="erro_txt_picture" class="form-text text-muted"></div>
        </div>
        
   </div>
   </form>

   <div class="col-md-10 col-sm-12">
    <div class="row">
      <div class='col-md-12'><b><font color=darkblue>Informe seus dados gerais:</font></b></div>
      <?php textfield('Nome completo',  '',         'col-lg-6 col-md-6 col-sm-12',  false, 'disabled',"<b><font color=green size=1px>O nome completo pode ser alterado na página do perfil.</font></b>",UsuariosController::get_usuario()['txt_nome'] ); ?>
      <?php textfield('E-mail',         '',        'col-lg-6 col-md-6 col-sm-12', false, 'disabled',"<b><font color=green size=1px>O e-mail pode ser alterado na página do perfil.</font></b>",UsuariosController::get_usuario()['txt_email']); ?>
      <div class="col-lg-3 col-md-3 col-sm-12">      
      <label for="txt_nascimento">Data de Nascimento<font color=red> ⋆</font></label>
      <input type="date" id="txt_nascimento" class="maskField form-control" aria-describedby="erro_txt_nascimento" name="txt_nascimento" value="<?php echo $ficha->txt_nascimento; ?>" />
      <div  class="form-text text-muted"><font color=red><div class="msg_error" id="erro_txt_nascimento"></div></font></div>
      </div>
     
     
      <?php textfield('Nome da mãe',    'txt_nome_mae',     'col-lg-5 col-md-5 col-sm-12',true); ?>
      <?php textfield('Nome do pai',    'txt_nome_pai',     'col-lg-4 col-md-4 col-sm-12',true); ?>
      <?php textfield('Telefone',       'txt_telefone',     'col-lg-6 col-md-6 col-sm-12',true,"mask='(999) 9999–9999'"); ?>
      <?php textfield('Celular',        'txt_celular',      'col-lg-6 col-md-6 col-sm-12',true,"mask='(999) 99999–9999'"); ?>
      
      <div class="col-md-3 col-sm-12">      
        <label for="txt_civil">Estado Civil<font color=red> ⋆</font></label>
        <div class="container p-2" id="txt_civil">
        <select id="txt_civil" class="form-control" aria-describedby="erro_txt_civil" name="txt_civil" >
                        <option value="0"></option>
                        <option <?=$ficha->txt_civil == 1 ? "selected" : ""?> value="1">Casado</option>
                        <option <?=$ficha->txt_civil == 2 ? "selected" : ""?> value="2">Divorciado</option>
                        <option <?=$ficha->txt_civil == 3 ? "selected" : ""?> value="3">Separado</option>
                        <option <?=$ficha->txt_civil == 4 ? "selected" : ""?> value="4">Solteiro</option>
                        <option <?=$ficha->txt_civil == 5 ? "selected" : ""?> value="5">União estável</option>
                        <option <?=$ficha->txt_civil == 6 ? "selected" : ""?> value="6">Viúvo</option>
                            </select>   
        </div>     
        <div style="font-color:red;font-size:12px" class="form-text text-muted"><font color=red><div class="msg_error" id="erro_txt_civil"></div></font></div>
      </div>
      
      <div class="col-md-3 col-sm-12">      
        <label for="txt_sexo">Sexo<font color=red> ⋆</font></label>
        <div class="container p-2" id="txt_sexo">
        <select id="txt_sexo" class="form-control" aria-describedby="erro_txt_sexo" name="txt_sexo" >
                        <option value="0"></option>
                        <option <?=$ficha->txt_sexo == 1 ? "selected" : ""?> value="1">Masculino</option>
                        <option <?=$ficha->txt_sexo == 2 ? "selected" : ""?> value="2">Feminino</option>
                        <option <?=$ficha->txt_sexo == 3 ? "selected" : ""?> value="3">Ignorado</option>
                            </select>   
        </div>     
        <div style="font-color:red;font-size:12px" class="form-text text-muted"><font color=red><div class="msg_error" id="erro_txt_civil"></div></font></div>
      </div>


      <div class="col-lg-6 col-md-6 col-sm-12">      
        <label for="txt_escolaridade">Escolaridade<font color=red> ⋆</font></label>
        <div class="container p-2" id="txt_escolaridade">
        <select id="txt_civil" class="form-control" aria-describedby="erro_txt_escolaridade" name="txt_escolaridade" >
                        <option value="0"></option>
                        <option <?=$ficha->txt_escolaridade == 1 ? "selected" : ""?> value="1">Doutorado</option>
                        <option <?=$ficha->txt_escolaridade == 2 ? "selected" : ""?> value="2">Mestrado</option>
                        <option <?=$ficha->txt_escolaridade == 3 ? "selected" : ""?> value="3">Superior completo</option>
                        <option <?=$ficha->txt_escolaridade == 4 ? "selected" : ""?> value="4">Superior incompleto</option>
                        <option <?=$ficha->txt_escolaridade == 5 ? "selected" : ""?> value="5">Ensino médio completo</option>
                        <option <?=$ficha->txt_escolaridade == 6 ? "selected" : ""?> value="6">Ensino médio incompleto</option>
                        <option <?=$ficha->txt_escolaridade == 7 ? "selected" : ""?> value="7">Ensino fundamental completo</option>
                        <option <?=$ficha->txt_escolaridade == 8 ? "selected" : ""?> value="8">Ensino fundamental incompleto</option>
                        <option <?=$ficha->txt_escolaridade == 9 ? "selected" : ""?> value="9">Não sei informar</option>
                            </select> 
        </div>     
        <div style="font-color:red;font-size:12px" class="form-text text-muted"><font color=red><div class="msg_error" id="erro_txt_escolaridade"></div></font></div>
      </div>
    
    </div>
   </div>
  </div>
  
</div>
</BR>
<div class="container border p-2">
  <div class="row">
      <div class='col-md-12'><b><font color=darkblue>Informe a sua naturalidade:</font></b></div>
      <div class="col-md-3 col-sm-5">      
        <label for="txt_natural_pais">País<font color=red> ⋆</font></label>
        <div class="container p-2" id="txt_natural_pais">
        <select onchange="if(this.value==76){$('#txt_natural_estado_select').show();$('#txt_natural_estado_exterior').hide();$('#txt_natural_cidade_select').show();$('#txt_natural_cidade_exterior').hide(); }else{$('#txt_natural_estado_select').hide();$('#txt_natural_estado_exterior').show();$('#txt_natural_cidade_select').hide();$('#txt_natural_cidade_exterior').show(); } " class="form-control" aria-describedby="erro_txt_natural_pais" name="txt_natural_pais" >
            <option value=""></option>
            <?=get_ajax_paises($ficha->txt_natural_pais > 0 ? $ficha->txt_natural_pais : 76)?>
            </select>               
        </div>     
        <div style="font-color:red;font-size:12px" class="form-text text-muted"><font color=red><div class="msg_error" id="erro_txt_natural_pais"></div></font></div>
      </div>
      <div class="col-md-3 col-sm-5">      
        <label for="txt_natural_estado">Estado<font color=red> ⋆</font></label>
        <div class="container p-2"  id="txt_natural_estado">
        <select id="txt_natural_estado_select" <?=(($ficha->txt_natural_pais > 0 && $ficha->txt_natural_pais!=76)) ? "style='display:none'" : "" ?> onchange="montaCidade(this.value,'txt_natural_cidade_select');" class="form-control" aria-describedby="erro_txt_natural_estado" name="txt_natural_estado" >
            <option value=''></option>
            <?=get_ajax_ufs($ficha->txt_natural_estado)?>
            </select>   
            <input <?=((!($ficha->txt_natural_pais > 0) || $ficha->txt_natural_pais==76)) ? "style='display:none'" : "" ?> type="text" id="txt_natural_estado_exterior" class="maskField form-control" aria-describedby="erro_txt_natural_estado" name="txt_natural_estado_exterior" value="<?=$ficha->txt_natural_estado_exterior?>"/>
        </div>     
        <div style="font-color:red;font-size:12px" class="form-text text-muted"><font color=red><div class="msg_error" id="erro_txt_natural_estado"></div></font></div>
      </div>
      <div class="col-md-3 col-sm-5">      
        <label for="txt_natural_cidade">Cidade<font color=red> ⋆</font></label>
        <div class="container p-2" id="txt_natural_cidade" >
        <select id="txt_natural_cidade_select" <?=(($ficha->txt_natural_pais > 0 && $ficha->txt_natural_pais!=76)) ? "style='display:none'" : "" ?> class="form-control" aria-describedby="erro_txt_natural_cidade" name="txt_natural_cidade" >
            <option value=''></option>
            <?=get_ajax_cities($ficha->txt_natural_estado,$ficha->txt_natural_cidade)?>
            </select>   
            <input <?=((!($ficha->txt_natural_pais > 0) || $ficha->txt_natural_pais==76)) ? "style='display:none'" : "" ?> type="text" id="txt_natural_cidade_exterior" class="maskField form-control" aria-describedby="erro_txt_natural_cidade" name="txt_natural_cidade_exterior" value="<?=$ficha->txt_natural_cidade_exterior?>"/>
        </div>     
        <div style="font-color:red;font-size:12px" class="form-text text-muted"><font color=red><div class="msg_error" id="erro_txt_natural_cidade"></div></font></div>
        
      </div>
  </div>
</div>
<br/>
<div class="container border p-2">
  <div class="row">
    <div class='col-md-12'><b><font color=darkblue>Informe os seus documentos:</font></b></div>
    <?php textfield('CPF',  '',         'col-lg-2 col-md-3 col-sm-12',  false, 'disabled',"<b><font color=green size=1px>O CPF foi informado no cadastro.</font></b>",UsuariosController::get_usuario()['txt_cpf'] ); ?>
  </div>
  <hr/>
  <div class="row">
    <div class='col-md-12'><b>Registro Geral (RG)</b></div>
    <?php textfield('RG',             'txt_rg',           'col-md-4 col-sm-12',true); ?>
    <?php textfield('Orgão Expedidor','txt_rg_orgao',     'col-md-2 col-sm-12',true); ?>
    <?php textfield('UF',             'txt_rg_uf',        'col-md-2 col-sm-12',true); ?>
    <div class="col-md-2 col-sm-12">      
    <label for="txt_rg_expedicao">Data de Expedição<font color=red> ⋆</font></label>
    <input type="date" id="txt_rg_expedicao" class="maskField form-control" aria-describedby="erro_txt_rg_expedicao" name="txt_rg_expedicao" value="<?php echo $ficha->txt_rg_expedicao; ?>" {adicional}/>
    <div  class="form-text text-muted"><font color=red><div class="msg_error" id="erro_txt_rg_expedicao"></div></font></div>
    </div>
  </div>
  <hr/>
  <div class="row">
    <div class='col-md-12'><b>Título de Eleitor</b></div>
  
    <?php textfield('Título de Eleitor','txt_eleitor',    'col-md-4 col-sm-12',true); ?>
    <?php textfield('Zona',           'txt_eleitor_zona', 'col-md-1 col-sm-12',true); ?>
    <?php textfield('Seção',          'txt_eleitor_secao','col-md-1 col-sm-12',true); ?>
    <?php textfield('Estado',         'txt_eleitor_estado','col-md-2 col-sm-12',true); ?>
    <div class="col-md-2 col-sm-12">      
    <label for="txt_eleitor_emissao">Data de Emissão<font color=red> ⋆</font></label>
    <input type="date" id=txt_eleitor_emissao" class="maskField form-control" aria-describedby="erro_txt_eleitor_emissao" name="txt_eleitor_emissao" value="<?php echo $ficha->txt_eleitor_emissao; ?>" {adicional}/>
    <div  class="form-text text-muted"><font color=red><div class="msg_error" id="erro_txt_eleitor_emissao"></div></font></div>
    </div>
    </div>
</div>
</br>
<div class="container border p-2">
<div class="row">
    <div class='col-md-12'><b><font color=darkblue>Informe o seu endereço residencial:</font></b></div>
    <?php textfield('CEP',            'txt_cep',          'col-md-2 col-sm-12',true); ?>
    </div>
    <div class="row">
      <?php 
      if($cep == false || $cep['logradouro']!="")
      textfield('Logadouro',      'txt_logadouro',    'col-md-8 col-sm-12', false,' disabled '); 
      else
      textfield('Logadouro',      'txt_logadouro',    'col-md-8 col-sm-12', false);
      ?>
    <?php textfield('Número',         'txt_numero',       'col-md-1 col-sm-12',true); ?>
    </div>
    <div class="row">
    <?php if($cep == false || $cep['bairro']!="")
          textfield('Bairro',         'txt_bairro',       'col-md-3 col-sm-12', false,' disabled ');
          else
          textfield('Bairro',         'txt_bairro',       'col-md-3 col-sm-12', false);
          ?>
    <?php textfield('Complemento',    'txt_complemento',  'col-md-6 col-sm-12'); ?>
</div>
    <div class="row">   
    <?php textfield('Estado',         'txt_estado',       'col-md-3 col-sm-12', false,' disabled '); ?>
    <?php textfield('Cidade',         'txt_cidade',       'col-md-6 col-sm-12', false,' disabled '); ?>
    </div>
  </div>
    </br></br></br>
                <input type="hidden" name="id_ficha" id="id_ficha" value="<?php echo $ficha->id_ficha;?>" />
                <input type="hidden" name="salvar" id="salvar" value="1" />
                <input type="hidden" id="id_modalidade" name="id_modalidade" value="<?php echo isset($ficha->id_modalidade) ? $ficha->id_modalidade>0 ? $ficha->id_modalidade : "" : ""; ?>">
</div>    
</div>

<div class="container border p-2">
    <div class="row">
        <div class="col-lg-12" id="id_modalidade_box">
            <b>Escolha a modalidade para a inscrição<font color=red> ⋆</font>:</b></br>
            <div  class="form-text text-muted"><font color=red><div class="msg_error" id="erro_id_modalidade"></div></font></div>
        </div>
    </div>    
    <?php foreach($modalidade as $m){ ?>
    <input onclick="$('#id_modalidade').val(<?=$m->id_modalidade?>);" type="radio" name="id_modalidade_select" id="id_modalidade<?=$m->id_modalidade?>" <?php echo $ficha->id_modalidade == $m->id_modalidade ? "checked" : "";?>
    <font size=4><b><font color=darkblue><?=$m->sigla?></font></b> - <b><?=$m->modalidade?></b> [<font color=black><?=$m->num_vagas?> vagas</font>]</font>      </br></br>
    <?php } ?>
</div>

<div class="container border p-2" id="bl_condicao_especial">
</br>
  <input onchange="if($('#bl_condicao_especial_check').prop('checked')){ $('#bl_condicao_especial_valor').val(1); }else{$('#bl_condicao_especial_valor').val(0);}" type="checkbox" id="bl_condicao_especial_check" <?=$ficha->bl_condicao_especial ? "checked" : ""?> > Solicito condições especiais para a realização da prova.
    </br>  </br>
  Verifique, no edital, a apresentação de documento necessária para o atendimento da sua solicitação.
</div>

</form>
</div>
<div class="container p-2">
<div class="row">
    <div class='col-md-12'>
    <a class="btn btn-success" id=salvar  onclick="$('#voltar').val(0); validar('form','ficha');"><font color=black>Salvar ficha</font></a>&nbsp;  
    <!--a class="btn btn-success" id=salvar  onclick="$('#voltar').val(1); validar('form','ficha');"><font color=black>Salvar e Continuar</font></a-->&nbsp;       
              </div></div></div>

<script src="../ajax/ajax_submit.js"></script>

<script>
  
function excluir_photo(){
  if($('#id').val()>0){    
    if($('#id_saved').val()>0){
      $("#img").attr("src",'photo.php?id='+$('#id_saved').val());
      $("#status_photo").html("<b><font color=green>Foto no servidor!</font></b>");
      $('#erro_txt_picture').html('');
      $('#excluir_photo').hide();
      $('#img').show();
      $('#id').val("");
    }else{
      $("#img").attr("src",""); 
      $("#status_photo").html("<b><font color=red>Sem foto</font></b>");
      $('#erro_txt_picture').html('Foto temporária excluída.');
      $('#excluir_photo').hide();
      $('#img').hide();
      $('#id').val("");   
    }
  }else{
      $("#img").attr("src","");
      $("#status_photo").html("<b><font color=red>A excluir!</font></b>");
      $('#erro_txt_picture').html('Para salvar o formulário, escolha outra imagem.');
      $('#excluir_photo').hide();
      $('#img').hide();
      $('#id_saved').val("");  
      $('#id').val("-1");
  }
}

$(document).ready(function(){
  $.jMaskGlobals = {
    maskElements: 'input,td,span,div',
    dataMaskAttr: '*[data-mask]',
    dataMask: true,
    clearIfNotMatch : true,
    watchInterval: 300,
    watchInputs: true,
    watchDataMask: false,
    byPassKeys: [9, 16, 17, 18, 36, 37, 38, 39, 40, 91],
    translation: {
      '0': {pattern: /\d/},
      '9': {pattern: /\d/, optional: true},
      '#': {pattern: /\d/, recursive: true},
      'A': {pattern: /[a-zA-Z0-9]/},
      'S': {pattern: /[a-zA-Z]/}
    }
  };

  $('#txt_telefone').mask('(00) 0000-0000');
  $('#txt_celular').mask('(00) 00000-0000');
  $('#txt_cpf').mask('000.000.000-00');
  $('#txt_rg').mask('0#');
  $('#txt_eleitor').mask('0#');
  $('#txt_cep').mask('00.000-000');
});


$(document).ready(function(){
$("#file_picture").change(function(){
    var fd = new FormData();
    var files = $('#file_picture')[0].files;
    var max =  2097152;
    if (files[0].size > max) {
      files.value = null; // Clear the field.
      $('#erro_txt_picture').html('<b><font color=red size=1>Carregue uma figura JPG ou PNG de máximo de 2Mbytes.</font></b>');
      return;
   }
    // Check file selected or not
    $("#status_photo").html("<b><font color=black>Carregando foto...</font></b>");
    if(files.length > 0 ){
       fd.append('file',files[0]);
       fd.append('id',$('#id').val());
       $.ajax({
          url: 'upload.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            if(response == 'wrong_ext'){
              $("#status_photo").html("<b><font color=orange>Foto não carregada...</font></b>");
              if($("#id_saved").val()>0){
                $('#erro_txt_picture').html('<b><font color=red size=1>A foto deve ser JPEG ou PNG.</br>Mantida a foto atual.</font></b>');
              }else{
                $('#erro_txt_picture').html('<b><font color=red size=1>A foto deve ser JPEG ou PNG.</font></b>');
              }
             }else if(response == 'wrong_size'){
              $("#status_photo").html("<b><font color=orange>Foto não carregada...</font></b>");
              if($("#id_saved").val()>0){
                $('#erro_txt_picture').html('<b><font color=red size=1>A foto deve ter no máximo 1Mbyte.</font></b>');
              }else{
                $('#erro_txt_picture').html('<b><font color=red size=1>A foto deve ter no máximo 1Mbyte.</br>Mantida a foto atual.</font></b>');
              }
            }else{
                $('#erro_txt_picture').html('');
                $("#img").attr("src",'photo.php?temp=1&id='+response); 
                $("#id").val(response);
                $("#status_photo").html("<b><font color=orange>Foto carregada!</font></b>");
                $(".preview img").show(); // Display image element
                $('#excluir_photo').show();
                $('#img').show();
            }
            $("#file_picture").val('');
          },
       });
    }else{
       alert("Please select a file.");
    }
});
});
</script>

<script>
$('#txt_cep').change(function(){ getbyCEP($('#txt_cep').val()); })
setup_check_change();
</script>
<input type=hidden id=formulario value="form"/>