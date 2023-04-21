<?php 
$this->layout("_theme1",["categories" => $categories]); 
?>

<div class="container-profile">
    <form enctype="multipart/form-data" method="post" id="formProfile" class="profile-form">
        <h1>PERFIL</h1>

        <div class="profilepic">
            <?php
            if(!empty($user->getPhoto())):
                ?>
                <img class="picture" src="<?= url($user->getPhoto()); ?>" class="img-thumbnail" id="photoShow" alt="...">
                <?php
            else:
            ?>
                <img src="<?= url("themes/web/images/user-photo-null.jpg"); ?>" class="img-thumbnail" id="photoShow" alt="...">
            <?php
            endif;
            ?>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nome </label>
            <input type="text" name="name" class="form-control" id="name" value="<?= $user->getName();?>" placeholder="Seu Nome...">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email </label>
            <input type="email" name="email" class="form-control" id="email" value="<?= $user->getEmail();?>" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Sua Foto </label>
            <input class="form-control" type="file" name="photo" id="photo">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="send">Alterar</button>
        </div>
        <div role="alert" id="message" style="display: none" class="message-p">
          <!---  Mensagem de Retorno! -->
        </div>
    </form>
</div>
<script type="text/javascript" async>
    const form = document.querySelector("#formProfile");
    const message = document.querySelector("#message");
    const photoShow = document.querySelector("#photoShow");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("app/perfil"); ?>",{
            method: "POST",
            body: dataUser,
        });
        const user = await data.json();
        console.log(user);
        if(user) {
            if(user.type === "alert-success" && user.photo != null) {
                photoShow.setAttribute("src",user.photo);
            }
            message.setAttribute("style","display");
            message.textContent = user.message;
            message.classList.remove("alert-primary", "alert-danger");
            message.classList.add(`${user.type}`);
            setTimeout(() => {
                message.setAttribute("style","display: none")
            },3000);
        }
    });
</script>