@extends('layouts.frontend')
@section('content')

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{asset('public/images/carousel-1.jpg')}}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase">Best Gym Center</h5>
                            <h1 class="display-2 text-white text-uppercase mb-md-4">Build Your Body Strong With Gymster</h1>
                            <a href="{{route('join_us')}}" class="btn btn-primary py-md-3 px-md-5 me-3">Join Us</a>
                            <a href="" class="btn btn-light py-md-3 px-md-5">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{asset('public/images/carousel-2.jpg')}}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase">Best Gym Center</h5>
                            <h1 class="display-2 text-white text-uppercase mb-md-4">Grow Your Strength With Our Trainers</h1>
                            <a href="{{route('join_us')}}" class="btn btn-primary py-md-3 px-md-5 me-3">Join Us</a>
                            <a href="" class="btn btn-light py-md-3 px-md-5">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->
    <!-- About Start -->
    <div class="container-fluid p-5">
        <div class="row gx-5">
            <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 rounded" src="{{asset('public/images/about.jpg')}}" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="mb-4">
                    <h5 class="text-primary text-uppercase">About Us</h5>
                    <h1 class="display-3 text-uppercase mb-0">Welcome to Gymster</h1>
                </div>
                <h4 class="text-body mb-4">Diam dolor diam ipsum tempor sit. Clita erat ipsum et lorem stet no labore lorem sit clita duo justo magna dolore</h4>
                <p class="mb-4">Nonumy erat diam duo labore clita. Sit magna ipsum dolor sed ea duo at ut. Tempor sit lorem sit magna ipsum duo. Sit eos dolor ut sea rebum, diam sea rebum lorem kasd ut ipsum dolor est ipsum. Et stet amet justo amet clita erat, ipsum sed at ipsum eirmod labore lorem.</p>
                <div class="rounded bg-dark p-5">
                    <ul class="nav nav-pills justify-content-between mb-3">
                        <li class="nav-item w-50">
                            <a class="nav-link text-uppercase text-center w-100 active" data-bs-toggle="pill" href="#pills-1">About Us</a>
                        </li>
                        <li class="nav-item w-50">
                            <a class="nav-link text-uppercase text-center w-100" data-bs-toggle="pill" href="#pills-2">Why Choose Us</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-1">
                            <p class="text-secondary mb-0">Tempor erat elitr at rebum at at clita aliquyam consetetur. Diam dolor diam ipsum et, tempor voluptua sit consetetur sit. Aliquyam diam amet diam et eos sadipscing labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor consetetur takimata eirmod, dolores takimata consetetur invidunt magna dolores aliquyam dolores dolore. Amet erat amet et magna</p>
                        </div>
                        <div class="tab-pane fade" id="pills-2">
                            <p class="text-secondary mb-0">Tempor erat elitr at rebum at at clita aliquyam consetetur. Diam dolor diam ipsum et, tempor voluptua sit consetetur sit. Aliquyam diam amet diam et eos sadipscing labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor consetetur takimata eirmod, dolores takimata consetetur invidunt magna dolores aliquyam dolores dolore. Amet erat amet et magna</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Programe Start -->
    <div class="container-fluid programe position-relative px-5 mt-5" style="margin-bottom: 135px;">
        <div class="row g-5 gb-5">
            <div class="col-lg-4 col-md-6">
                <div class="bg-light rounded text-center p-5">
                    <i class="flaticon-six-pack display-1 text-primary"></i>
                    <h3 class="text-uppercase my-4">Body Building</h3>
                    <p>Sed amet tempor amet sit kasd sea lorem dolor ipsum elitr dolor amet kasd elitr duo vero amet amet stet</p>
                    <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="bg-light rounded text-center p-5">
                    <i class="flaticon-barbell display-1 text-primary"></i>
                    <h3 class="text-uppercase my-4">Weight Lefting</h3>
                    <p>Sed amet tempor amet sit kasd sea lorem dolor ipsum elitr dolor amet kasd elitr duo vero amet amet stet</p>
                    <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="bg-light rounded text-center p-5">
                    <i class="flaticon-bodybuilding display-1 text-primary"></i>
                    <h3 class="text-uppercase my-4">Muscle Building</h3>
                    <p>Sed amet tempor amet sit kasd sea lorem dolor ipsum elitr dolor amet kasd elitr duo vero amet amet stet</p>
                    <a class="text-uppercase" href="">Read More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-12 col-md-6 text-center">
                <h1 class="text-uppercase text-light mb-4">30% Discount For This Summer</h1>
                <a href="" class="btn btn-primary py-3 px-5">Become A Member</a>
            </div>
        </div>
    </div>
    <!-- Programe Start -->

    <!-- Team Start -->
    <div class="container-fluid p-5">
        <div class="mb-5 text-center">
            <h5 class="text-primary text-uppercase">The Team</h5>
            <h1 class="display-3 text-uppercase mb-0">Expert Trainers</h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <div class="team-item position-relative">
                    <div class="position-relative overflow-hidden rounded">
                        <img class="img-fluid w-100" src="{{asset('public/images/team-1.jpg')}}" alt="">
                        <div class="team-overlay">
                            <div class="d-flex align-items-center justify-content-start">
                                <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute start-0 bottom-0 w-100 rounded-bottom text-center p-4" style="background: rgba(34, 36, 41, .9);">
                        <h5 class="text-uppercase text-light">John Deo</h5>
                        <p class="text-uppercase text-secondary m-0">Trainer</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team-item position-relative">
                    <div class="position-relative overflow-hidden rounded">
                        <img class="img-fluid w-100" src="{{asset('public/images/team-2.jpg')}}" alt="">
                        <div class="team-overlay">
                            <div class="d-flex align-items-center justify-content-start">
                                <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute start-0 bottom-0 w-100 rounded-bottom text-center p-4" style="background: rgba(34, 36, 41, .9);">
                        <h5 class="text-uppercase text-light">James Taylor</h5>
                        <p class="text-uppercase text-secondary m-0">Trainer</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team-item position-relative">
                    <div class="position-relative overflow-hidden rounded">
                        <img class="img-fluid w-100" src="{{asset('public/images/team-3.jpg')}}" alt="">
                        <div class="team-overlay">
                            <div class="d-flex align-items-center justify-content-start">
                                <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-light btn-square rounded-circle mx-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute start-0 bottom-0 w-100 rounded-bottom text-center p-4" style="background: rgba(34, 36, 41, .9);">
                        <h5 class="text-uppercase text-light">Adam Phillips</h5>
                        <p class="text-uppercase text-secondary m-0">Trainer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-fluid p-0 my-5">
        <div class="row g-0">
            <div class="col-lg-6" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="{{asset('public/images/testimonial.jpg')}}" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-6 bg-dark p-5">
                <div class="mb-5">
                    <h5 class="text-primary text-uppercase">Testimonial</h5>
                    <h1 class="display-3 text-uppercase text-light mb-0">Our Client Say</h1>
                </div>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item">
                        <p class="fs-4 fw-normal text-light mb-4"><i class="fa fa-quote-left text-primary me-3"></i>Dolores sed duo clita tempor justo dolor et stet lorem kasd labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy et labore et tempor diam tempor erat dolor rebum sit ipsum.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid rounded-circle" src="{{asset('public/images/testimonial-1.jpg')}}" alt="">
                            <div class="ps-4">
                                <h5 class="text-uppercase text-light">Client Name</h5>
                                <span class="text-uppercase text-secondary">Profession</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <p class="fs-4 fw-normal text-light mb-4"><i class="fa fa-quote-left text-primary me-3"></i>Dolores sed duo clita tempor justo dolor et stet lorem kasd labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy et labore et tempor diam tempor erat dolor rebum sit ipsum.</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid rounded-circle" src="{{asset('public/images/testimonial-2.jpg')}}" alt="">
                            <div class="ps-4">
                                <h5 class="text-uppercase text-light">Client Name</h5>
                                <span class="text-uppercase text-secondary">Profession</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary px-5 mt-5">
        <div class="row gx-5">
            <div class="col-lg-8 col-md-6">
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-12 pt-5 mb-5">
                        <h4 class="text-uppercase text-light mb-4">Get In Touch</h4>
                        <div class="d-flex mb-2">
                            <i class="bi bi-geo-alt text-primary me-2"></i>
                            <p class="mb-0">123 Street, New York, USA</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-envelope-open text-primary me-2"></i>
                            <p class="mb-0">info@example.com</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-telephone text-primary me-2"></i>
                            <p class="mb-0">+012 345 67890</p>
                        </div>
                        <div class="d-flex mt-4">
                            <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-uppercase text-light mb-4">Quick Links</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Class Schedule</a>
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our Trainers</a>
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                            <a class="text-secondary" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-uppercase text-light mb-4">Popular Links</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Class Schedule</a>
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our Trainers</a>
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                            <a class="text-secondary" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary p-5">
                    <h4 class="text-uppercase text-white mb-4">Newsletter</h4>
                    <h6 class="text-uppercase text-white">Subscribe Our Newsletter</h6>
                    <p class="text-light">Amet justo diam dolor rebum lorem sit stet sea justo kasd</p>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control border-white p-3" placeholder="Your Email">
                            <button class="btn btn-dark">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4 py-lg-0 px-5" style="background: #111111;">
        <div class="row gx-5">
            <div class="col-lg-8">
                <div class="py-lg-4 text-center">
                    <p class="text-secondary mb-0">&copy; <a class="text-light fw-bold" href="#">Your Site Name</a>. All Rights Reserved.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="py-lg-4 text-center credit">
                    <p class="text-light mb-0">Designed by <a class="text-light fw-bold" href="https://htmlcodex.com">HTML Codex</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-dark py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

@endsection
