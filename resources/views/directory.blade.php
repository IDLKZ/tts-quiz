@extends('layout')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Справочник</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Главная</a></li>
                                <li class="breadcrumb-item active">Справочник</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-10">
                                            <div class="text-center mt-4">
                                                <h4>Frequently Asked Questions</h4>
                                                <p class="text-muted">If several languages coalesce, the grammar of the resulting language</p>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-lg-4">
                                                    <div class="card border shadow-none">
                                                        <div class="card-body">
                                                            <div class="media">
                                                                <div class="icons-md mr-3">
                                                                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-quaternary" d="M12,14.19531a1.00211,1.00211,0,0,1-.5-.13379l-9-5.19726a1.00032,1.00032,0,0,1,0-1.73242l9-5.19336a1.00435,1.00435,0,0,1,1,0l9,5.19336a1.00032,1.00032,0,0,1,0,1.73242l-9,5.19726A1.00211,1.00211,0,0,1,12,14.19531Z"></path><path class="uim-tertiary" d="M21.5,11.13184,19.53589,9.99847,12.5,14.06152a1.0012,1.0012,0,0,1-1,0L4.46411,9.99847,2.5,11.13184a1.00032,1.00032,0,0,0,0,1.73242l9,5.19726a1.0012,1.0012,0,0,0,1,0l9-5.19726a1.00032,1.00032,0,0,0,0-1.73242Z"></path><path class="uim-primary" d="M21.5,15.13184l-1.96411-1.13337L12.5,18.06152a1.0012,1.0012,0,0,1-1,0L4.46411,13.99847,2.5,15.13184a1.00032,1.00032,0,0,0,0,1.73242l9,5.19726a1.0012,1.0012,0,0,0,1,0l9-5.19726a1.00032,1.00032,0,0,0,0-1.73242Z"></path></svg></span>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5 class="mb-1">General Questions</h5>
                                                                    <p class="text-muted">If several languages coalesce</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card-footer text-center">
                                                            <a href="pages-faqs.html#">View more</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="card border shadow-none">
                                                        <div class="card-body">
                                                            <div class="media">
                                                                <div class="icons-md mr-3">
                                                                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-tertiary" d="M16,11H8a.99974.99974,0,0,1-1-1V7A5,5,0,0,1,17,7v3A.99974.99974,0,0,1,16,11ZM9,9h6V7A3,3,0,0,0,9,7Z"></path><rect width="16" height="13" x="4" y="9" class="uim-primary" rx="3"></rect></svg></span>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5 class="mb-1">Privacy Policy</h5>
                                                                    <p class="text-muted">Neque porro quisquam est</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card-footer text-center">
                                                            <a href="pages-faqs.html#">View more</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="card border shadow-none">
                                                        <div class="card-body">
                                                            <div class="media">
                                                                <div class="icons-md mr-3">
                                                                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-primary" d="M11.4978,22a.99676.99676,0,0,1-.707-.293l-2.5-2.5a.99964.99964,0,0,1,0-1.41406l2.5-2.5A.99989.99989,0,0,1,12.20483,16.707l-1.793,1.793,1.793,1.793A1,1,0,0,1,11.4978,22Z"></path><path class="uim-tertiary" d="M21,4.5H19a1,1,0,0,0,0,2h1v11H11.41187l-1,1,1,1H21a.99974.99974,0,0,0,1-1V5.5A.99974.99974,0,0,0,21,4.5Z"></path><path class="uim-primary" d="M12.5,2a.99676.99676,0,0,1,.707.293l2.5,2.5a.99962.99962,0,0,1,0,1.41406l-2.5,2.5A.99989.99989,0,0,1,11.793,7.293l1.793-1.793L11.793,3.707A1,1,0,0,1,12.5,2Z"></path><path class="uim-tertiary" d="M5,17.5H4V6.5h8.58594l1-1-1-1H3a.99974.99974,0,0,0-1,1v13a.99974.99974,0,0,0,1,1H5a1,1,0,0,0,0-2Z"></path></svg></span>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h5 class="mb-1">Help &amp; Support</h5>
                                                                    <p class="text-muted">Sed ut perspiciatis unde</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card-footer text-center">
                                                            <a href="pages-faqs.html#">View more</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-lg-7">
                                            <div>
                                                <h5 class="mb-3">General Questions</h5>
                                                <div class="accordion custom-accordion" id="accordionExample">
                                                    <div class="card shadow-none mb-2">
                                                        <a data-toggle="collapse" href="pages-faqs.html#collapseOne" class="faq" aria-expanded="true" aria-controls="collapseOne">
                                                            <div class="card-header" id="headingOne">
                                                                <h6 class="mb-0 faq-question">
                                                                    <i class="mdi mdi-help text-primary h5 mr-3"></i>What is Lorem Ipsum?
                                                                    <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                                                                </h6>
                                                            </div>
                                                        </a>

                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <p class="text-muted mb-0 faq-ans">To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what languages are members of the same family.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- collapse one end -->

                                                    <div class="card shadow-none mb-2">
                                                        <a class="collapsed faq" data-toggle="collapse" href="pages-faqs.html#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                            <div class="card-header" id="headingTwo">
                                                                <h6 class="mb-0 faq-question">
                                                                    <i class="mdi mdi-help text-primary h5 mr-3"></i>Where does it come from?
                                                                    <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                                                                </h6>
                                                            </div>
                                                        </a>

                                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <p class="text-muted mb-0 faq-ans">To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words. If several languages coalesce of the resulting language.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- collapse two end -->

                                                    <div class="card shadow-none mb-2">
                                                        <a class="collapsed faq" data-toggle="collapse" href="pages-faqs.html#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                            <div class="card-header" id="headingThree">
                                                                <h6 class="mb-0 faq-question">
                                                                    <i class="mdi mdi-help text-primary h5 mr-3"></i>Why do we use it?
                                                                    <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                                                                </h6>
                                                            </div>
                                                        </a>

                                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <p class="text-muted mb-0 faq-ans">If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages new common will be more simple.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- collapse two end -->
                                                </div>
                                            </div>

                                            <div class="mt-5">
                                                <h5 class="mb-3">Privacy Policy</h5>
                                                <div class="accordion custom-accordion" id="accordionExample2">
                                                    <div class="card shadow-none mb-2">
                                                        <a data-toggle="collapse" href="pages-faqs.html#collapseOne2" class="faq" aria-expanded="true" aria-controls="collapseOne2">
                                                            <div class="card-header" id="headingOne2">
                                                                <h6 class="mb-0 faq-question">
                                                                    <i class="mdi mdi-help text-primary h5 mr-3"></i>Where can I get some?
                                                                    <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                                                                </h6>
                                                            </div>
                                                        </a>

                                                        <div id="collapseOne2" class="collapse show" aria-labelledby="headingOne2" data-parent="#accordionExample2">
                                                            <div class="card-body">
                                                                <p class="text-muted mb-0 faq-ans">Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ in their grammar, their pronunciation and their most common words.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- collapse one end -->

                                                    <div class="card shadow-none mb-2">
                                                        <a class="collapsed faq" data-toggle="collapse" href="pages-faqs.html#collapseTwo2" aria-expanded="true" aria-controls="collapseTwo2">
                                                            <div class="card-header" id="headingTwo2">
                                                                <h6 class="mb-0 faq-question">
                                                                    <i class="mdi mdi-help text-primary h5 mr-3"></i>What is Lorem Ipsum?
                                                                    <i class="mdi mdi-chevron-up float-right accor-plus-icon"></i>
                                                                </h6>
                                                            </div>
                                                        </a>

                                                        <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo2" data-parent="#accordionExample2">
                                                            <div class="card-body">
                                                                <p class="text-muted mb-0 faq-ans">Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- collapse two end -->

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 ml-auto">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="icons-md mb-4">
                                                    <span class="uim-svg" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><path class="uim-primary" d="M17,13H7a1,1,0,0,1,0-2H17a1,1,0,0,1,0,2Z"></path><path class="uim-tertiary" d="M12,2A10.00082,10.00082,0,0,0,4.25684,18.3291L2.293,20.293A.99991.99991,0,0,0,3,22h9A10,10,0,0,0,12,2ZM9,7h6a1,1,0,0,1,0,2H9A1,1,0,0,1,9,7Zm6,10H9a1,1,0,0,1,0-2h6a1,1,0,0,1,0,2Zm2-4H7a1,1,0,0,1,0-2H17a1,1,0,0,1,0,2Z"></path><path class="uim-primary" d="M15 17H9a1 1 0 0 1 0-2h6a1 1 0 0 1 0 2zM15 9H9A1 1 0 0 1 9 7h6a1 1 0 0 1 0 2z"></path></svg></span>
                                                </div>
                                                <h5>Can't find what you are looking for?</h5>
                                                <div class="text-muted">
                                                    <p class="mb-4">To achieve this, it would be necessary to have uniform grammar, pronunciation and common words</p>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-primary mt-1 mr-2 waves-effect waves-light"><i class="mdi mdi-email-outline mr-1"></i> Email Us</button>
                                                    <button type="button" class="btn btn-info mt-1 waves-effect waves-light"><i class="mdi mdi-twitter mr-1"></i> Send us a tweet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>
                <!-- end container-fluid -->
            </div>
        </div>
    </div>

@endsection

