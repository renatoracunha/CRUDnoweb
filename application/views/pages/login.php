<div class="main">
    <div class="container">
        <center>
            <div class="middle">
                <div id="login">

                    <form action="javascript:void(0);" method="get">

                        <fieldset class="clearfix">

                            <p><span class="fa fa-user"></span><input type="text" id="username" Placeholder="Usuário"></p>
                            <p><span class="fa fa-lock"></span><input type="password" id="password" Placeholder="Senha"></p>

                            <div>
                                <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="#">Esqueceu a senha?</a></span>
                                <span style="width:50%; text-align:right;  display: inline-block;"><button class="btn btn-dark" type="button" onclick='verify_login("<?= base_url() ?>")'>entrar</button></span>
                            </div>

                        </fieldset>
                        <div class="clearfix"></div>
                    </form>

                    <div class="clearfix"></div>

                </div> <!-- end login -->
                <div class="logo">LOGO

                    <div class="clearfix"></div>
                </div>

            </div>
        </center>
        <!-- scripts -->
        <script src="<?= base_url('assets/js/login.js') ?>"></script>