<?php 
    
    $member_r = fetch("select * from member where userid = ? " , array($varray[0]));

    @$active = isset($varray[1]) ? fetch("select * from menu where idx = ? " , array($varray[1])) : fetch("select * from menu where member = ? " , array($member_r->idx));
    @$active_chk = isset($varray[1]) ? $active->idx : $active->idx;
    @$blogRoot = isset($varray[2]) ? $varray[2] : 'myblogBoard';

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Todo Blog</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="/assets/css/main.css" rel="stylesheet">
</head>

<body>
	<header id="header">  

        <!-- topicon -->    
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12 overflow">
                   <div class="social-icons pull-right">
                        <ul class="nav nav-pills">
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                            <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div> 
                </div>
             </div>
        </div>
        
        <!-- navigation -->
        <div class="container">
            <div class="row">
                <div class="pull-left">
                    <a class="navbar-brand" href="/">
                    	<h1><img src="/assets/images/logo.png" alt="logo"></h1>
                    </a>
                </div>
           </div> 
        </div>
      
    </header>
    
    <!-- visual -->
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
             <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">
                                <a href="/<?php echo $member_r->id ?>"><?php echo $member_r->id ?>의 블로그</a>
                            </h1>
                            <p><small>Todo Blog of <?php echo $varray[0] ?> </small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </section>
    
    <!-- contents -->
    <section id="contents">
        <div class="container">
            <div class="row">
                <div class="main-content">

                    <!-- content inner -->
                    <section id="projects">
                        <div class="container">
                            <div class="row">
                                <?php 
                                    include_once('./page/menu.php');
                                 ?>
                                <?php 
                                if($active){
                                    if(file_exists("./page/{$blogRoot}.php")){
                                        include_once("./page/{$blogRoot}.php");
                                    }    
                                }else{
                                    echo "블로그에 등록된 메뉴가 없습니다.";
                                 }       
                                 ?>
                                
                                
                            </div>
                        </div>
                    </section>
                    <!-- content inner -->

                </div>
            </div>
        </div>
    </section>
    
    <!-- footer -->
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12  text-center bottom-separator">
                    <img src="/assets/images/home/under.png" class="img-responsive inline" alt="">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="testimonial bottom">
                        <h2>Testimonial</h2>
                        <div class="media">
                            <div class="media-body">
                                <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</blockquote>
                                <h3><a href="#">- Jhon Kalis</a></h3>
                            </div>
                         </div>
                        <div class="media">
                            <div class="media-body">
                                <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</blockquote>
                                <h3><a href="">- Abraham Josef</a></h3>
                            </div>
                        </div>   
                    </div> 
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="contact-info bottom">
                        <h2>Contacts</h2>
                        <address>
                        E-mail: <a href="mailto:someone@example.com">email@email.com</a> <br> 
                        Phone: +1 (123) 456 7890 <br> 
                        Fax: +1 (123) 456 7891 <br> 
                        </address>

                        <h2>Address</h2>
                        <address>
                        Unit C2, St.Vincent's Trading Est., <br> 
                        Feeder Road, <br> 
                        Bristol, BS2 0UY <br> 
                        United Kingdom <br> 
                        </address>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="contact-form bottom">
                        <h2>Send a message</h2>
                        <form id="main-contact-form" name="contact-form" method="post" action="sendemail.php">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" required="required" placeholder="Email Id">
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your text here"></textarea>
                            </div>                        
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="copyright-text text-center">
                        <p>&copy; Todo Blog 2019. All Rights Reserved.</p>
                        <p>Designed by <a target="_blank" href="http://www.dojo.com">DOJO</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="/assets/js/jquery.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/js/app.js"></script>
</body>
</html>
