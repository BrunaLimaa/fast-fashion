<?php $this->layout("_theme2", ["categories" => $categories]); ?>

<link rel="stylesheet" href="<?= url("assets/web/css/styles-register.css"); ?>">
<script src='assets/web/scripts/scripts.js' async></script>


<div class="account-page">
<div class="container">
    <div class="row">
        <div class="col-3">
            <img src="themes/web/images/image1.png" width="90%">
        </div>
        <div class="col-2">
            <div class="form-container">
        <h2>Registre-se Primeiro!</h2>

                <div class="form-btn">
                    <span onclick="login()">Login</span>
                    <span onclick="register()">Register</span>
                    <hr id="indicator">
                </div>

                <form id="register-form">
                    <input type="text" name="name" placeholder="Seu nome completo">
                    <input type="email" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" class="btn">Registrar</button>

                    <div class="col-12" id="message">
                                <!-- Aqui aparece a mensagem, caso ocorra erro! -->
                    </div>
                </form>

                <script type="text/javascript" async>
                            const form = document.querySelector("#register-form");
                            const message = document.querySelector("#message");
                            form.addEventListener("submit", async (e) => {
                                e.preventDefault();
                                const dataUser = new FormData(form);
                                const data = await fetch("<?= url("entrar"); ?>",{
                                    method: "POST",
                                    body: dataUser,
                                });
                                const user = await data.json();
                                console.log(user);
                                if(user) {
                                    message.innerHTML = user.message;
                                    message.classList.add("message");
                                    message.classList.remove("success", "warning", "error");
                                    message.classList.add(`${user.type}`);
                                }
                            });
                        </script>

                <form id="login-form">
                    <input type="text" name="email" placeholder="E-mail">
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" class="btn">Entrar</button>

                    <div class="col-12" id="message1">
                                <!-- Aqui aparece a mensagem, caso ocorra erro! -->
                    </div>

                </form>
                <script type="text/javascript" async>
                            const form1 = document.querySelector("#login-form");
                            const message1 = document.querySelector("#message1");
                            form1.addEventListener("submit", async (e) => {
                                e.preventDefault();
                                const dataUser1 = new FormData(form1);
                                const data1 = await fetch("<?= url("login"); ?>",{
                                    method: "POST",
                                    body: dataUser1,
                                });
                                const user = await data1.json();
                                console.log(user);
                                if(user) {
                                    if(user.type == "success"){
                                        message1.innerHTML = ` Olá, ${user.name}!`;
                                    window.location.href = "http://www.localhost/fast-fashion/app";
                                    } else {
                                        message1.innerHTML = user.message;
                                    }
                                    message1.classList.add("message");
                                    message1.classList.remove("success", "warning", "error");
                                    message1.classList.add(`${user.type}`);
                                }
                            });
                    </script>

            </div>
        </div>
    </div>
</div>

</div>
