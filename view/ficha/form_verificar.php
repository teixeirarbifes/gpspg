
  <?php 
if($data_table['rascunho']==1)
$pagina = "verificar";
else
$pagina = "conferir";

?>
<?php include GPATH."view".S.'ficha'.S."ficha_header.php"; ?>    
<?php if($data_table['rascunho']==1){ ?>
<h3><font color=black>Verificar inscrição e enviar para avaliação</font></h3>
<?php }else{ ?>
<h3><font color=black>Dados do último envio para análise</font></h3>
<?php } ?>
<hr>
<?php if($data_table['rascunho']==1){ ?>
<div>
    <B>Você está no área de verificação final da sua inscrição antes do envio.</B></br>
    <b><font color=red>Inscrições que não forem enviadas não serão consideradas no processo seletivo.</font></b>  <b><font color=red>Somente a última inscrição enviada será considerada.</font></b>
    </br></br>Ao final da sua conferëncia, no final dessa página, aceite os termos, digite sua senha e clique em ENVIAR PARA ANÁLISE.</br>
    </br>   
    <div class="row">
    <div class="col-sm-12 col-md-4"> 
    <a class="btn btn-success" id=salvar  onclick="$('html, body').animate({ scrollTop: $('#enviar_analise').offset().top }, 'slow');"><font color=black>Ir para formulário de envio</font></a>&nbsp;  
</div>
</div>
<?php }else{ ?>
  <div>
    Os dados abaixo referem-se a um último envio de inscrição para análise.</b></br></br>
    <b><font color=red>Somente a última inscrição enviada será considerada.</font></b>
  </br></br>Caso identifique alguma inconsistência, ainda dentro do prazo de inscrição, uma retificação poderá ser realizada, bastando editar a sua inscrição e realizar novo envio.</br>
    </br>   
</div>
<?php } ?>
<hr>
<div style="text-align:left">
<?php include "ficha_verificar.php"; ?>

</div>

</br></br>

<div class="container border p-2">
      <div class="row">
    <div class="col-md-12 col-sm-12">  
    <h4><font color=blue>Documentos pessoais e formulários apresentados (clique para download).</font></h4>
    </div>
    </div>
<?php 
if($documentos_pessoais)
foreach($documentos_pessoais as $doc){ ?>
 
  <hr>
  <div class="row">
  <div class="col-md-1 col-sm-12">
  <a class="btn btn-light stretched-link" style="cursor:pointer" onclick="go_link('/?action=download&d=<?=$doc->id_doc?>&f=<?=$ficha->id_ficha?>');"><font color=black>Baixar</font></a>
 </div>
  <div class="col-md-3 col-sm-12"> 
    <span style="width:100%"><?=$doc->txt_classe?></span>
  </div>
  <div class="col-md-8 col-sm-12">
    <?=$doc->txt_filename?>
 </div>
 
</div>
 
<?php } ?>
</font>

</div></div></div>

</br></br>
<div class="container p-2">  
<div class="row">
<div class="col-md-8 col-sm-12 border"> 
     <h3>Matriz de Pontuação</h3>
        <div class="row">
            <div class='col-md-12'>
                <?php include GPATH."view".S.'documentos'.S."matriz_curriculo.php"; ?>            
        </div>
    </div>
   </div>
</div>
</div>



<div class="container border p-2">
      <div class="row">
    <div class="col-md-12 col-sm-12">  
    <h4><font color=blue>Documentos de currículo apresentados (clique para download).</font></h4>
    </div>
    </div>
<?php 
if($documentos_curriculo)
foreach($documentos_curriculo as $doc){ ?>
 
  <hr>
  <div class="row">
  <div class="col-md-1 col-sm-12">
    <a class="btn btn-light stretched-link" style="cursor:pointer" onclick="go_link('/?action=download&d=<?=$doc->id_doc?>&f=<?=$ficha->id_ficha?>');"><font color=black>Baixar</font></a>
 </div>
  <div class="col-md-3 col-sm-12"> 
    <span style="width:100%"><?=$doc->txt_classe?></span>
  </div>
  <div class="col-md-8 col-sm-12">
    <?=$doc->txt_filename?>

 </div>
 
</div>
 
<?php } ?>
</font>

</div></div></div>


</br></br>
<?php if($data_table['rascunho']==1){ ?>
<form id=form class="form-horizontal" action="?controller=inscricaocontroller&method=entregar&id_processo=<?php echo $inscricao->id_processo; ?>" method="post" >

<div class='container border bg-white'>
</br>
<div class=row>
    <div class=row>
      <div class="col-md-12 col-sm-12">  
        <div id=display_erro class="alert alert-danger display-error" style="display: none">
          <b>Não foi possível enviar o formulário pelos seguintes motivos:</br></b><ul><span id="erro" name="erro"></span></ul>
        </div>
      </div>
    </div>
  </div>
<h3><font color=red>Enviar para análise</font></h3>

<b><font color=darkblue size=2px>Atenção! Esteja de acordo com a declaração e digite sua senha para enviar sua inscrição para análise.</font></b>
<div class="container" id="concordo">
</br>
  <label for="concordo"><font color=black>Eu, <?php echo $usuario['txt_nome']; ?>, CPF nº <?php echo $usuario['txt_cpf']; ?>, declaro, sob as penas da Lei, que são verdadeiras e completas as informações prestadas neste sistema eletrônico para essa inscrição. Entendo que somente será considerado o último protocolo de envio de inscrição conforme edital. Entendo que os dados da inscrição devem estar em consonância com as normas do edital do processo seletivo.</font>
  </br>  </br>  </br>  
  <input type="checkbox" name="concordo"> Estou de acordo com a declaração. 
</label>
</div>
</br><div>
<b><font color=darkblue size=2px>Digite a sua senha para autenticação</font></b>
</div>
<div class="row">
    <div class="col-sm-12 col-md-4">      
      <input type="password" id="txt_senha" class="form-control" aria-describedby="erro_txt_senha" name="txt_senha"/>
      <div id="erro_txt_senha" class="form-text text-muted"></div>
  </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-4" id="enviar_analise"> 
    <a class="btn btn-success" id=salvar  onclick="validar('form','entregar',null,false);"><font color=black>Enviar inscrição para análise</font></a>&nbsp;  
</div>
</form>
<?php }else{ ?>  
<?php } ?>
</br>
</br>
</div>
</div>
</br></br></br></br></br></br></br>
</div>
</div>

<script src="../ajax/ajax_submit.js"></script>
<script>
    conf_form('form');
</script>
