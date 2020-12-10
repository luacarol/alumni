<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="plataforma Alumni do Instituto Federal de São Paulo">
  <meta name="author" content="IFSP-JCR">

  <title>Alumni IFSP</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="{{asset('css/agency.css')}}" rel="stylesheet">
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>

<body>

 <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Alumni IFSP</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
       <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ URL::previous() }}">Voltar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="masthead mb-5">
    <div class="container">
      <div class="intro-text"> 
          <div class="row">
               <div class="col-lg-7">
                    <div class="intro-lead-in">
                        <h2>Notícias e Eventos</h2>
                    </div>
                    <div class="intro-heading">
                        <h5>Fique atento a todas as notícias e eventos do IFSP</h5>
                    </div>
               </div>
               <div class="col-lg-5">
                    <div class="mt-0">
                        <img src="{{asset('img/ifsp-logo.png')}}" width="50%">
                    </div>
               </div>
          </div>
      </div>
    </div>
  </header>

<!-- ##### Blog Area Start ##### -->
    <div class="blog-area section-padding-0-80" >
        <div class="container">
            <div class="row mt-5 pt-4">
                <div class="col-12 col-lg-12" >
                    <div class="blog-posts-area">

                        <!-- Single Featured Post -->
                        <div class="single-blog-post featured-post single-post">
                            <div class="post-thumb">
                                <a href="#"><img src="img/bg-img/16.png" alt=""></a>
                            </div>
                              <div class="post-data">
                                <h3 class="post-catagory text-warning">{{$noticia->titulo}}</h3>
                                <h5 class="post-title text-warning mb-3">{{$noticia->lide}}</h5>
                                @if($noticia->imagem != '')
                                  <img class="img-fluid" src="{{ url("storage/uploadNoticias/{$noticia->imagem}") }}">
                                @endif
                                <div class="post-meta mt-5">
                                  @php
                                    echo($noticia->texto);
                                  @endphp
                                </div>
                              </div>
                            </div>
                        </div>

                        <!-- About Author -->
                        <div class="blog-post-author d-flex">
                            <div class="author-thumbnail">
                                <img src="img/bg-img/32.jpg" alt="">
                            </div>
                            <div class="author-info">
                                <a>Publicado por: {{$noticia->nome}} {{$noticia->sobrenome}}</a>
                                <p>{{date('d-m-Y',strtotime($noticia->data))}}</p>
                            </div>
                        </div>
  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Blog Area End ##### -->
    
  <!-- Footer -->
<footer class="page-footer font-small unique-color-dark">

  <div style="background-color: #f4bf0e;">
    <div class="container">

      <!-- Grid row-->
      <div class="row py-4 d-flex align-items-center">

        <!-- Grid column -->
        <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
          <h6 class="mb-0 text-white">Conecte-se ao Alumni por meio de suas redes sociais</h6>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-6 col-lg-7 text-center text-md-right">

          <!-- Facebook -->
          <a class="fb-ic">
            <i class="fab fa-facebook-f white-text mr-4 text-white"> </i>
          </a>
          <!-- Twitter -->
          <a class="tw-ic">
            <i class="fab fa-twitter white-text mr-4 text-white"> </i>
          </a>
          <!-- Google +-->
          <a class="gplus-ic">
            <i class="fab fa-google-plus-g white-text mr-4 text-white"> </i>
          </a>
          <!--Linkedin -->
          <a class="li-ic">
            <i class="fab fa-linkedin-in white-text mr-4 text-white"> </i>
          </a>
          <!--Instagram-->
          <a class="ins-ic">
            <i class="fab fa-instagram white-text text-white"> </i>
          </a>

        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row-->

    </div>
  </div>

  <!-- Footer Links -->
  <div style="background-color: #305474">

    <!-- Grid row -->
    <div class="row  text-md-left text-center pt-5 pb-5">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

        <!-- Content -->
        <h6 class="text-uppercase font-weight-bold text-white">Alumni IFSP</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>Logo</p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold text-white">Links Úteis</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a href="#alumni" class="text-white">O que é o Alumni?</a>
        </p>
        <p>
          <a href="#portfolio" class="text-white">Últimas notícias</a>
        </p>
        <p>
          <a href="#contact" class="text-white">Contato</a>
        </p>
        <p>
          <a href="#!" class="text-white">Login</a>
        </p>
        <p >
          <a href="#!" class="text-white">Cadastro</a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold text-white">Informações adicionais</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p class=" text-white">
          <i class="fas fa-home mr-3 text-white"></i> R. Antônio Fogaça de Almeida, 200 - Jardim America, Jacareí - SP, 12322-030 </p>
        <p class="text-white">
          <i class="fas fa-envelope mr-3 text-white"></i> info@ifsp.edu.br</p>
        <p class="text-white">
          <i class="fas fa-phone mr-3 text-white"></i> (12) 2128-5200</p>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 text-white" style="background-color: #254a6b">© 2018 Copyright:
    <a href="https://jcr.ifsp.edu.br/"> IFSP</a>
  </div>
  <!-- Copyright -->

</footer>
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Plugin JavaScript -->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Contact form JavaScript -->
  <script src="{{asset('js/jqBootstrapValidation.js')}}"></script>
  <script src="{{asset('js/contact_me.js')}}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{asset('js/agency.js')}}"></script>
  <!-- ##### Footer Area Start ##### -->
  <script src="{{asset('js/active.js')}}"></script>

</body>

</html>