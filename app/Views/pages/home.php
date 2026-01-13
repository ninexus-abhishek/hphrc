<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Carousel -->
<div id="slider" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#slider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#slider" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="4000">
            <img src="<?= base_url('assets/images/slider/hpshrc-home-slider-3.jpg') ?>" class="d-block w-100" alt="slide-1">
            <div class="carousel-caption d-none d-md-block slider-caption">
                <h2 class="bounceInDown animated slow caption-title">Himachal Pradesh Human Rights Commission , Minister House No. 3, Grant Lodge, Shimla-171002, HP.</h2>
                <h4 class="bounceInUp animated slow caption-sub-title">HPSHRC</h4>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="4000">
            <img src="<?= base_url('assets/images/slider/hpshrc-home-slider-2.jpg') ?>" class="d-block w-100" alt="slide-2">
            <div class="carousel-caption d-none d-md-block slider-caption">
                <h2 class="bounceInDown animated slow caption-title">In Accordance with the provisions of the The Protection of Human Rights Act, 1993.</h2>
                <h4 class="bounceInUp animated slow caption-sub-title">HPSHRC</h4>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('assets/images/slider/hpshrc-home-slider-1.jpg') ?>" class="d-block w-100"  alt="slide-3">
            <div class="carousel-caption d-none d-md-block slider-caption">
                <h2 class="bounceInDown animated slow caption-title">To Ensure better protection of Human Rights in accordance with the provision of the human rights Act. 1993 and for matters concerning therewith or incidental thereto.</h2>
                <h4 class="bounceInUp animated slow caption-sub-title">HPSHRC</h4>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- Carousel -->

<div class="section-home about-us fadeIn animated">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="card hphrc-card mb-5 mb-md-0">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-center card-icon">
                            <img src="<?= base_url('assets/images/icons/our-mission-icon.png') ?>" alt="our-mission">
                        </div>
                        <h3 class="text-center text-uppercase">our mission</h3>
                        <div class="text-container text-justify">
                            <p>
                                To Ensure better protection of Human Rights in accordance with the provision of the human rights Act. 1993 and for matters concerning therewith or incidental thereto
                            </p>
                        </div>
                        <div class="text-center btn-container">
                            <a href="#" class="btn btn-card">Read more</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card hphrc-card mb-5 mb-md-0">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-center card-icon">
                            <img src="<?= base_url('assets/images/icons/our-functions-3-icon.png') ?>" alt="our-functions">
                        </div>
                        <h3 class="text-center text-uppercase">Our Functions</h3>
                        <div class="text-container text-justify">
                            <p>
                                All regulations and instruction received from the NHRC and state Government from the time to time.
                                Updated manuals received from the state Government from time to time
                            </p>
                        </div>
                        <div class="text-center btn-container">
                            <a href="#" class="btn btn-card">Read more</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card hphrc-card mb-5 mb-md-0">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-center card-icon">
                            <img src="<?= base_url('assets/images/icons/help-icon.png') ?>" alt="help-and-support">
                        </div>
                        <h3 class="text-center text-uppercase">Help & support</h3>
                        <div class="text-container text-justify">
                            <p>
                                The Commission in its discretion, accept telegraphic, telephonic and FAX complaints if conveyed through reliable and verifiable sources.
                                <br /> <br />
                            </p>
                        </div>
                        <div class="text-center btn-container">
                            <a href="#" class="btn btn-card">Read more</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="card hphrc-card mb-5 mb-md-0">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-center card-icon">
                            <img src="<?= base_url('assets/images/icons/programs-icon.png') ?>" alt="our-programs">
                        </div>
                        <h3 class="text-center text-uppercase">our programs</h3>
                        <div class="text-container text-justify">
                            <p>
                                Working for better Protection of human rights and for matters connected therewith or incidental thereto
                                <br /> <br /> <br />
                            </p>
                        </div>
                        <div class="text-center btn-container">
                            <a href="#" class="btn btn-card">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
    <div class="section-home home-reasons">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="reasons-col animate-onscroll fadeIn">
                        <img src="<?php echo FRONT_ASSETS_FOLDER; ?>images/reasons/we-fight-togother.jpg" alt="">
                        <div class="reasons-titles">
                            <h3 class="reasons-title">We fight together</h3>
                            <h5 class="reason-subtitle">We are humans</h5>
                        </div>
                        <div class="on-hover hidden-xs">
                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur praesentium, itaque facilis nesciunt ab omnis cumque similique ipsa veritatis perspiciatis, harum ad at nihil molestias, dignissimos sint consequuntur. Officia, fuga.</p>

                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur praesentium, itaque facilis nesciunt ab omnis cumque similique ipsa veritatis perspiciatis, harum ad at nihil molestias, dignissimos sint consequuntur. Officia, fuga.</p>

                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur praesentium, itaque facilis nesciunt ab omnis cumque similique ipsa veritatis perspiciatis, harum ad at nihil molestias, dignissimos sint consequuntur. Officia, fuga.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="reasons-col animate-onscroll fadeIn">
                        <img src="<?php echo FRONT_ASSETS_FOLDER; ?>images/reasons/we-care-about.jpg" alt="">
                        <div class="reasons-titles">
                            <h3 class="reasons-title">WE care about others</h3>
                            <h5 class="reason-subtitle">We are humans</h5>
                        </div>
                        <div class="on-hover hidden-xs">
                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur praesentium, itaque facilis nesciunt ab omnis cumque similique ipsa veritatis perspiciatis, harum ad at nihil molestias, dignissimos sint consequuntur. Officia, fuga.</p>

                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur praesentium, itaque facilis nesciunt ab omnis cumque similique ipsa veritatis perspiciatis, harum ad at nihil molestias, dignissimos sint consequuntur. Officia, fuga.</p>

                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur praesentium, itaque facilis nesciunt ab omnis cumque similique ipsa veritatis perspiciatis, harum ad at nihil molestias, dignissimos sint consequuntur. Officia, fuga.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 -->
<!-- /.home-reasons -->
<?= $this->endSection() ?>