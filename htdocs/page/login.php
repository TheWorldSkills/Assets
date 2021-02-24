<?php 
    if($member)
    {
        alert("비회원만 접근 할수있습니다." . '/');
    }
 ?>
    <!-- contents -->
    <section id="contents">
        <div class="container">
            <div class="row">
                <div class="main-content">
                    <h1 class="antitle">로그인</h1>

                    <!-- content inner -->
                    <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
                        <form class="login-page" method="post" action="/action/login">
                            <div class="login-header margin-bottom-30">
                                <h2>Login to your account</h2>
                            </div>
                            <div class="input-group margin-bottom-20">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input placeholder="아이디" class="form-control" type="text" name="userid">
                            </div>
                            <div class="input-group margin-bottom-20">
                                <span class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input placeholder="비밀번호" class="form-control" type="password" name="pw">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary pull-right" type="submit">로그인</button>
                                </div>
                            </div>
                            <hr>
                            <h4>Forget your Password ?</h4>
                            <p>
                                <a href="#">Click here</a>to reset your password.
                            </p>
                        </form>
                    </div>
                    <!-- content inner -->

                </div>
            </div>
        </div>
    </section>
