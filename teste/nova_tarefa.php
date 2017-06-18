<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>nova_tarefa</title>
</head>

<body>
<div>
<form id="nova_tarefa" name="nova_tarefa" method="post" action="inserir_nova_tarefa.php">
  <p>
    <label for="responsavel"></label>
    <?php require ("lista_select.php") ?>
  </p>
  <p>
      <label for="data_limite"></label>
    Data Limite
  <input type="datetime-local" name="data_limite">
  </p>
  <p>
    <label for="resumo">Resumo da Tarefa</label>
    <textarea name="resumo" id="resumo" cols="45" rows="5"></textarea>
  </p>
  <p>
    <label for="prioridade">Prioridade</label>
    <input type="text" name="prioridade" id="prioridade" />
  </p><p>
    <input type="submit" name="enviar">
  <p>&nbsp;</p>
  
  <p>&nbsp;</p>
</form>
</div>
</body>
</html>