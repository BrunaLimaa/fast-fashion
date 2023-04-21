<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= CONF_SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?= url("assets/adm/css/styles-adm.css"); ?>">
    <script type="text/javascript" src="<?= url("assets/web/scripts/scripts.js"); ?>" async></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Josefin+Sans&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav>

    <div class="header">
    <div class="container">
    <div class="barra-nav">
        <div class="logo">
            <img src="https://i.ibb.co/H2BKBz1/logo-Shein.png" width="175px">
        </div>
        <nav>
            <ul id="menuItems">
                <li><a href="<?= url("adm/"); ?>">Home</a></li>
                <li><a href="<?= url("adm/mensagens"); ?>">Mensagens</a></li>
                <li><a href="<?= url("adm/sobre"); ?>">Sobre</a></li>

                <li><a href="<?= url("adm/FAQ"); ?>">FAQ</a>
                <ul>
                    <li>
                    <a  class="dropdown-item" href="<?= url("adm/criarFaq");?>">Criar</a>
                    </li>
                    </ul></li>
                <li><a href="#">Produtos</a>
                    <ul class="dropdown">
                        <?php
                        foreach ($categories as $category){
                            
                            ?>
                            <li>
                            <a class="dropdown-item" href="<?= url("adm/produtos/{$category->id}"); ?>"><?= $category->category;?></a>
                            </li>
                            <?php
                        }
                        ?>
                </ul>
            </li>

                <li><a href="#">Conta</a>
                <ul class="dropdown">
                    <li>
                    <a  class="dropdown-item" href="<?= url("adm/perfil");?>">Perfil</a>
                    </li>
                    <li>
                    <a  class="dropdown-item" href="<?= url("adm/addProduto");?>">Registrar</a>
                    </li>
                    <li>
                    <a  class="dropdown-item" href="<?= url("adm/updateProduto");?>">Atualizar</a>
                    </li>
                    <li>
                    <a  class="dropdown-item" href="<?= url("adm/logout");?>">Sair</a>
                    </li>
                </ul>
            </li>
            </ul>
        </nav>
        <img src="https://i.ibb.co/WxWv7my/cart.png" width="30px" height="30px">
        <img src="https://i.ibb.co/BjG3xWP/menu.png" class="menu-icon" onclick="menutoggle()">
    </div>
    </div>
</div>


    <?php
//        }
    ?>
</nav>
<main>
    <?= $this->section("content"); ?>
</main>
<footer>
    <div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col-1">
                <h3>Baixe o nosso App</h3>
                <p>Disponível para Android</p>
                <div class="app-logo">
                    <img src="https://i.ibb.co/yP5QBL9/play-store.png">
                </div>
            </div>
            <div class="footer-col-2">
                <img src="https://i.ibb.co/H2BKBz1/logo-Shein.png">
            </div>
            <div class="footer-col-3">
                <h3>Links</h3>
                <ul>
                    <li>Cupons</li>
                    <li>Blog Post</li>
                    <li>Política de Devolução</li>
                    <li>Seja Afiliado</li>
                </ul>
            </div>
            <div class="footer-col-4">
                <h3>Nos Siga</h3>
                <ul>
                    <li>Facebook</li>
                    <li>Instagram</li>
                    <li>Twitter</li>
                    <li>Youtube</li>
                    <li><a href="http://www.localhost/fast-fashion/contato">Contato</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <p class="copyright"> <?= CONF_SITE_NAME; ?> - 2023 </p>
    </div>
</div>

</footer>



</body>
</html>