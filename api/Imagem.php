<?php

if(isset($_FILES['imagemInsumoUpload'])){
    if (!empty($_FILES['imagemInsumoUpload'])){

        $ext = strtolower(substr($_FILES['imagemInsumoUpload']['name'], -4)); // pegar extensão
        
        $extValidas = array(".jpg",".jpeg",".png"); // extensões validas
        
        $verifica = 0;
        for ($i=0; $i < count($extValidas); $i++) { 
            if ($ext == $extValidas[$i]) $verifica++;
        }

        if ($verifica > 0) {
            $novoNome = md5(time()).$ext; // definir novo nome
            $dir = "../client/dist/img/insumos/"; // definir diretório para upload da imagem

            // upload imagem
            if (move_uploaded_file($_FILES['imagemInsumoUpload']['tmp_name'], $dir.$novoNome)) {
                echo 'true-|-'.$novoNome;
            }else{
                echo 'false-|-Imagem_não_enviada!';
            }
        }else{
            echo 'false-|-Extensão_Invalida!';
        }

    }else{
        echo 'false-|-Erro_inesperado!';
    }
}

if (isset($_POST['apagarImagem'])) {
    $dir = "../client/dist/img/insumos/";
    unlink($dir.$_POST['apagarImagem']);
}
?>