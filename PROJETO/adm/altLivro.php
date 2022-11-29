<?php
session_start();
include_once("../servidor.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <section class="col-md-2">

            </section>

            <?php
                include_once('../servidor.php')

               if(!empty($_GET['id']))
               {
                   $id = $_GET['id'];
                   $sqlSelect = "SELECT * FROM tb_livro WHERE id=$id";
                   $result = $conexao->query($sqlSelect);
                   if($result->num_rows > 0)
                   {
                       while($user_data = mysqli_fetch_assoc($result))
                       {
                           $titulo = $user_data['titulo'];
                           $desc = $user_data['desc'];
                           $dir = $user_data['dir'];
                           $valor = $user_data['valor'];
                       }
                   }
                   else
                   {
                       header('Location: lista_livro.php');
                   }
               }
               else
               {
                   header('Location: lista_livro.php');
               }

            ?>

            <section class="col-md-8">
                <h3 class="mt-5">Altera Livro</h2>

                    <form action="procAltLivro.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="cod_liv" value="<?php echo $campo["cod_liv"] ?>">    
                                     
                    <div class="form-group">
                            <label for="t">Titulo : </label>
                            <input type="text" class="form-control" id="t" name="titulo" 
                            value="<?php echo $campo["titulo_liv"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="desc">Descrição : </label>
                            <textarea name="desc" class="form-control" id="desc"><?php echo $campo["desc_liv"] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="ed">Editora: </label>

                            <?php
                            $editora = " select * from tb_editora ";
                            $resultado = mysqli_query($banco , $editora);
                            ?>

                            <select class="form-control" name="ed" id="ed">

                                <option>Selecione ...</option>
                                <?php
                                 while($tbEditora = mysqli_fetch_array($resultado)){
                                 echo "<option value='".$tbEditora["cod_ed"] ."'>".$tbEditora["nome_ed"]."</option>";
                                 }
                                ?>

                            </select>

                        </div>

                        <div class="form-group " style="width:30%;">
                            <label for="valor">Valor: </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="text" class="form-control" id="valor" name="valor"
                                value="<?php echo $campo["valor_liv"] ?>"
                                >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Alterar</button>
                    </form>
            </section>

            <section class="col-md-2"></section>
        </div>
    </div>

</body>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
</html>