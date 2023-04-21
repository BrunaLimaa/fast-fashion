<?php  $this->layout("_theme1",["categories" => $categories]); ?>


<div class="form-style--3">
      <div class="form-style-3">
        
    <h2>Fale Conosco</h2>
        
  <form action="<?= url("contato"); ?>" method="post" class="form-container" id="contact">
    <fieldset><legend>Formulário</legend>
        <div>
          Nome <input type="text" name="name"  class="input-field"  placeholder="Seu nome..."/>
        </div>
        <div>
          Email <input type="text" name="email"  class="input-field"  placeholder="Seu email..."/>
        </div>
        <div>
          <textarea name="message" rows="3" class="textarea-field" placeholder="Sua mensagem..."></textarea>
        </div>
        <label><span> </span><input type="submit" value="Submit" id="Send" /></label>
        <label><span> </span><input type="reset" value="limpar" id="Send" /></label>

    </form>
    
  </div>

  
        <div class="col-12" id="message1" style="display: none;">
                                <!-- Aqui aparece a mensagem, caso ocorra erro! -->
</div>


<script type="text/javascript" async>
                            const form = document.querySelector("#contact");
                            const message = document.querySelector("#message1");
                            form.addEventListener("submit", async (e) => {
                                e.preventDefault();
                                const dataContact = new FormData(form);
                                const data = await fetch("<?= url("app/contato"); ?>",{
                                    method: "POST",
                                    body: dataContact,
                                });
                                const contact = await data.json();
                                console.log(contact);
                                if(contact) {
              
                                    message.setAttribute("style","display");
                                    message.textContent = contact.message1;
                                    message.classList.remove("alert-primary", "alert-danger");
        
                                    setTimeout(() => {
                                        message.setAttribute("style","display: none")
                                    },3000);
                                }
                            });
</script>

<style type="text/css">
.form-style-3{
  margin: 35%;
  margin-top: 8%;
  margin-bottom: 10%;
	max-width: 1800;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
.form-style-3 label{
	display:block;
	margin-bottom: 10px;
}
.form-style-3 label > span{
	float: left;
	width: 100px;
	color: #F072A9;
	font-weight: bold;
	font-size: 13px;
	text-shadow: 1px 1px 1px #fff;
}
.form-style-3 fieldset{
	border-radius: 10px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	margin: 0px 0px 10px 0px;
	border: 1px solid #FFD2D2;
	padding: 20px;
	background: #FFF4F4;
	box-shadow: inset 0px 0px 15px #FFE5E5;
	-moz-box-shadow: inset 0px 0px 15px #FFE5E5;
	-webkit-box-shadow: inset 0px 0px 15px #FFE5E5;
}
.form-style-3 fieldset legend{
	color: #FFA0C9;
	border-top: 1px solid #FFD2D2;
	border-left: 1px solid #FFD2D2;
	border-right: 1px solid #FFD2D2;
	border-radius: 5px 5px 0px 0px;
	-webkit-border-radius: 5px 5px 0px 0px;
	-moz-border-radius: 5px 5px 0px 0px;
	background: #FFF4F4;
	padding: 0px 8px 3px 8px;
	box-shadow: -0px -1px 2px #F1F1F1;
	-moz-box-shadow:-0px -1px 2px #F1F1F1;
	-webkit-box-shadow:-0px -1px 2px #F1F1F1;
	font-weight: normal;
	font-size: 12px;
}
.form-style-3 textarea{
	width:250px;
	height:100px;
}
.form-style-3 input[type=text],
.form-style-3 input[type=date],
.form-style-3 input[type=datetime],
.form-style-3 input[type=number],
.form-style-3 input[type=search],
.form-style-3 input[type=time],
.form-style-3 input[type=url],
.form-style-3 input[type=email],
.form-style-3 select, 
.form-style-3 textarea{
	border-radius: 3px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border: 1px solid #FFC2DC;
	outline: none;
	color: #F072A9;
	padding: 5px 8px 5px 8px;
	box-shadow: inset 1px 1px 4px #FFD5E7;
	-moz-box-shadow: inset 1px 1px 4px #FFD5E7;
	-webkit-box-shadow: inset 1px 1px 4px #FFD5E7;
	background: #FFEFF6;
	width:50%;
}
.form-style-3  input[type=submit],
.form-style-3  input[type=reset],
.form-style-3  input[type=button]{
	background: #EB3B88;
	border: 1px solid #C94A81;
	padding: 5px 15px 5px 15px;
	color: #FFCBE2;
	box-shadow: inset -1px -1px 3px #FF62A7;
	-moz-box-shadow: inset -1px -1px 3px #FF62A7;
	-webkit-box-shadow: inset -1px -1px 3px #FF62A7;
	border-radius: 3px;
	border-radius: 3px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;	
	font-weight: bold;
}
.required{
	color:red;
	font-weight:normal;
}
</style>