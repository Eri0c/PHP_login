<?php

//Verifica se existe erro na sessão
$erro = $_SESSION['error'] ?? null;
unset($_SESSION['error']);


?>

<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="col-4">
         
         <div class="card bg-light p-5 shadow-mt-5">
            <h3 class="text-center">Criar conta</h3>
            <hr>
            <!-- Formulário de registro -->
            <form action="?rota=registrar_submit" method="post">
               <!-- Campos do formulário -->
               <div class="mb-3">
                  <label for="registro-usuario" class="form-label">Usuário</label>
                  <input type="text" name="registro_usuario" class="form-control" required>
               </div>
               <div class="mb-3">
                  <label for="registro-email" class="form-label">Email</label>
                  <input type="email" name="registro_email" class="form-control" required>
               </div>
               <div class="mb-3">
                  <label for="registro-senha" class="form-label">Senha</label>
                  <input type="password" name="registro_senha" class="form-control" required>
               </div>
               <!-- Botão de envio do formulário -->
               <div>
                  <input type="submit" value="Registrar" class="btn btn-secondary w-100">
               </div>
               <!-- Link para a página de login -->
               <div class="mt-3 text-center ">
                  <p><a href="index.php?rota=login">Fazer login</a></p>
               </div>
            </form>
            
            <!-- Exibição da mensagem de erro, se houver -->
            <?php if(!empty($erro)): ?>
                  <div class="alert alert-danger mt-3 p-2 text-center">
                     <?= $erro ?>
                  </div>
            <?php endif; ?>
         </div>
      </div>
   </div>
</div>
