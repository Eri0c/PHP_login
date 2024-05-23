<?php

//Verifica se existe erro na sessão
$erro = $_SESSION['error'] ?? null;
unset($_SESSION['error']);

//Verifica se existe sucesso na sessão
$sucesso = $_SESSION['success'] ?? null;
unset($_SESSION['success']);
?>

<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="col-4">
         
         <div class="card bg-light p-5 shadow-mt-5">
            <h3>Login</h3>
            <hr>
            <form action="?rota=login_submit" method="post">
               <div class="mb-3">
                  <label for="text-usuario" class="form-label">Usuário</label>
                  <input type="text" name="text_usuario" class="form-control" required>
               </div>

               <div class="mb-3">
                  <label for="text-senha" class="form-label">Senha</label>
                  <input type="password" name="text_senha" class="form-control" required>
               </div>
               <div>
                  <input type="submit" value="Entrar" class="btn btn-secondary w-100">
               </div>
               <div class="mt-3 text-center ">
                  <!--redirecionando para a pagina de registro -->
                  <p><a href="index.php?rota=registrar">Crie sua conta</a></p>

               </div>
            </form>

            <!--Verifica se existe erro e imprime mensagem do erro -->
            <?php if(!empty($sucesso)): ?>
               <div class="alert alert-success mt-3 p-2 text-center">
                  <?= $sucesso ?>
               </div>
            <?php endif; ?>

            <!--Verifica se existe erro e imprime mensagem do erro -->
            <?php if(!empty($erro)): ?>
                  <div class="alert alert-danger mt-3 p-2 text-center">
                     <?= $erro ?>
                  </div>
            <?php endif;?>
         </div>
      </div>
   </div>
</div>