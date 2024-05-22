<?php 
/*Está classe tem  apenas um metodo chamado Query
Ela aceita uma query de sql, se quisermos selecionar um usuario especifico devemos  indicar o nome do usuario e senha preenchidos pelo formulario, 
assim sera armazenado em $params, passando as informações por parametros é possivel ser filtrado pelo sistema PDO NESTE CASO impede ataque.*/
class database {
    public function query($sql, $params = []) {
        try {
            //conexão e comunicação com a base de dados
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);  //A VARIAVEL pdo faz a conexão com a base de dados
            $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Se existir erro devolve as exeções
            $stmt = $pdo -> prepare($sql);//verificar se sql precisa ser filtrada para evitar sql injection (stmt= statement)
            $stmt->execute($params);

            $results = $stmt->fetchAll(PDO::FETCH_CLASS); //buscando todos os dados e dizendo como quero que os dados venham, no caso em formato de objeto
            //devolver resultados
            return[
                'status' =>'success',
                'data' => $results
            ];
            
            
        }catch (\PDOException $err) {
            //devolver o erro
            return [
                'status' => 'error',
                'data' => $err->getMessage()
            ];
        }
}}