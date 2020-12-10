<!DOCTYPE html>
<html lang="en">

<head>
  <link href="{{ asset('img/favicon.ico') }}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">


  <link href="{{ asset('index/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('index/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('index/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('index/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('index/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('index/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('index/css/style.css') }}" rel="stylesheet">

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container-fluid d-flex">

      <div class="logo mr-auto">
        <a href="#"><img src="{{ asset('img/brand/blue2.png') }}" alt="" class="img-fluid"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#header">Home</a></li>
          <li><a href="#about">Sobre o Alumni</a></li>
          <li><a href="#services">Últimas Notícias</a></li>
          <li><a href="#contact">Contato</a></li>
          <li><a href="{{route('login')}}">Entrar</a></li>
          <li class="get-started"><a href="{{route('cadastro')}}">Cadastre-se</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1">
          <h1>Seja bem-vindo ao portal Alumni do IFSP</h1>
          <h2>Encontre ex-alunos e estabeleça contatos pessoais e profissionais</h2>
          <a href="{{route('cadastro')}}" class="btn-get-started scrollto">Comece Agora Mesmo</a>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
          <img src="{{ asset('index/img/graduation_cap.svg') }}" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
            <img src="{{ asset('index/img/resources.svg') }}" class="img-fluid" alt="" data-aos="zoom-in">
          </div>
          <div class="col-lg-6 pt-5 pt-lg-0">
            <h3 data-aos="fade-up">Conheça os recursos que oferecemos</h3>
            <p data-aos="fade-up" data-aos-delay="100">
              O Alumni é uma plataforma criada para reunir antigos alunos do Instituto Federal. Aqui você poderá reecontrar colegas e aproveitar diversas ferramentas.
            </p>
            <div class="row">
              <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-graduation-cap"></i>
                <h4> Participe da comunidade acadêmica</h4>
                <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
              </div>
              <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <i class="fas fa-bell"></i>
                <h4> Receba notificações sobre eventos</h4>
                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= notices Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Notícias</h2>
          <p>Confira as últimas notícias postadas na plataforma</p>
        </div>

        <div class="row justify-content-center">
          @foreach($noticias as $noticia)
            <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box">
                <h4 class="title"><a href="">{{$noticia->titulo}}</a></h4>
                <p class="description">{{$noticia->lide}}</p>
              </div>
            </div>
          @endforeach
        </div>

      </div>

    </section><!-- End Services Section -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Contato</h2>
          <p>Envie uma mensagem para uma CEX</p>
        </div>

        <div class="row justify-content-center">
          @if(session()->get('success'))
                <div class="alert alert-dismissible alert-success col-lg-7">
                  {{ session()->get('success') }}  
                </div>
            @endif
            @if(session()->get('erro'))
                <div class="alert alert-dismissible alert-danger col-lg-7">
                  {{ session()->get('erro') }}  
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-dismissible alert-danger col-lg-7">
                  <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                </div>
            @endif
          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <form action="{{route('mensagem.enviar')}}" method="POST" role="form" class="php-email-form">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="name">Seu Nome</label>
                  <input type="text" name="name" class="form-control" id="name" required="" maxlength="255" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="tel">Seu Telefone</label>
                  <input type="text" name="tel" class="form-control" id="tel" required="" maxlength="20" />
                </div>
                <div class="form-group col-md-6">
                  <label for="email">Seu Email</label>
                  <input type="email" name="email" class="form-control" id="email" required="" maxlength="150" />
                </div>
              </div>
              <div class="form-group">
                <label for="campus">Campus de Destino</label>
                <select class="form-control" name="campus" id="campus">
                  @foreach($campus as $camp)
                    <option value="{{$camp->id}}">{{$camp->sigla}}</option>
                  @endforeach
                  </select>
              </div>
              <div class="form-group">
                <label for="subject">Assunto</label>
                <input type="text" class="form-control" name="subject" id="subject" required="" maxlength="15" />
              </div>
              <div class="form-group">
                <label for="message">Mensagem</label>
                <textarea class="form-control" name="message" rows="10" required=""></textarea>
              </div>
              <div class="text-center"><button type="submit">Enviar Mensagem</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Us Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-contact" data-aos="fade-up" data-aos-delay="100">
            <h3>Ninestars</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-4 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="200">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="300">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span>IFSP</span></strong>. Todos os direitos reservados
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('index/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('index/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('index/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('index/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('index/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('index/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('index/aos/aos.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('index/js/main.js') }}"></script>

</body>

</html>
