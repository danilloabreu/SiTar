<?php require("../../model/usuario.php");?>﻿

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="../../view/css/form_nova_tarefa_1.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../../controller/js/form_nova_tarefa.js"></script>
    
</head>

<form action="#" method="post">
    <fieldset>
        <fieldset class="grupo">
            <div class="campo">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" style="width: 10em" value="" />
            </div>
            <div class="campo">
                <label for="snome">Sobrenome</label>
                <input type="text" id="snome" name="snome" style="width: 10em" value="" />
            </div>
        </fieldset>
        <div class="campo">
            <label>Sexo</label>
            <label>
                <input type="radio" name="sexo" value="masculino"> Masculino
            </label>
            <label>
                <input type="radio" name="sexo" value="feminino"> Feminino
            </label>
        </div>
        <div class="campo">
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" style="width: 20em" value="" />
        </div>
        <div class="campo">
            <label for="telefone">Telefone</label>
            <input type="text" id="telefone" name="telefone" style="width: 10em"  value="" />
        </div>
 
        <fieldset class="grupo">
            <div class="campo">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" style="width: 10em" value="" />
            </div>
            <div class="campo">
                <label for="estado">Estado</label>
                <select name="estado" id="estado">
                    <option value="">--</option>
                    <option value="PR">PR</option>
                </select>
            </div>
        </fieldset>
 
        <div class="campo">
            <label for="mensagem">Mensagem</label>
            <textarea rows="6" style="width: 20em" id="mensagem" name="mensagem"></textarea>
        </div>
 
        <div class="campo">
            <label>Newsletter</label>
            <label>
                <input type="checkbox" name="newsletter" value="1"> Gostaria de receber a Newsletter da empresa
            </label>
        </div>
 
        <button type="submit" name="submit">Enviar</button>
 
    </fieldset>
</form>