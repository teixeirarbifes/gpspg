<?php
$titulo = "Ativação de nova conta";
?>

<div style="font-size:14px; border: 20px solid #969696;text-align:center;max-width:700px;padding:2ex">
<a href="https://gpspg.gemad.net"><img src="cid:logo"/><?php //img src="/images/logosmall.png.jpg" ?></a>
</br>
<h2>Sistema de Gestão de Processos Seletivos - Pós-Graduação</h2>
<hr>
<div style="text-align:left;font-family: Arial, Helvetica, sans-serif;">
<p>
<span style="font-size:14px">
Obrigado por se cadastrar no GPS-PG, um sistema eficiente para facilitar o processo seletivo de programa de pós-graduação, em todas etapas.
Para continuar com seu cadastro, é importante que você forneça o código abaixo para gerar a sua nova senha e ativar a sua conta. Somente após gerar sua senha e ativar sua conta, poderás ter acesso ao sistema e se inscrever no processo seletivo.
<span>
</p>
<p>
<b>O código de acesso é:</b>
</br></br>
<span style="font-size:25px;color:blue"><strong><?php echo $data['key']?></strong></span>
</p>
<p>Se preferir, clique ou copie o link para seu navegador:
</br></br>
<a href="https://gpspg.gemad.net/?ativacao=1&email=<?php echo $to_email?>&key=<?php echo $data['key']?>">https://gpspg.gemad.net/?ativacao=1&email=<?php echo $to_email?>&key=<?php echo $data['key']?></a>
</p>
<p>Caso não tenha realizado cadastro no site GPS-PG, <a href="https://gpspg.gemad.net/?wrong=1&email=<?php echo $to_email?>">Clique aqui</a>.</br>Qualquer coisa, pode entrar em contato pelo e-mail suporte.ppgep@gemad.net.</p>
</br>
<p>
Cordialmente,
</br></br>
GPS-PG - Ifes - Campus Cariacica
<a href="https://gpspg.gemad.net">https://gpspg.gemad.net</a>
</p>
</div>
</div>