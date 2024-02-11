@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12 col-md-6 my-2">
                        <p class="text-lg font-bold lg:text-xl xl:text-2xl">
                            Список Опросов
                        </p>
                        <p class="text-md font-bold lg:text-lg">
                            Здесь вы можете увидеть список опросов.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Page-Title -->

            <!-- end row -->

            <!-- end page title end breadcrumb -->
            @if($questionnaires->isNotEmpty())
            <div class="container">
                <div class="row mt-5">

                  <div class="col-12 my-2">
                      @foreach($questionnaires as $questionnaire)
                          <a href="{{route("employee-questionnaire-show",$questionnaire->id)}}" class="w-full lg:max-w-full lg:flex my-3 rounded-2xl">
                              <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover bg-center bg-white rounded-t py-2 lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/images/question.webp')">
                              </div>
                              <div class="border border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal w-full">
                                  <div class="mb-8">
                                      <p class="text-sm text-gray-600 flex items-center">
                                          {{$questionnaire->start_at->format("d/m/Y H:i")}}
                                          @if($questionnaire->end_date)
                                              - {{$questionnaire->end_at->format("d/m/Y H:i")}}
                                          @endif
                                      </p>
                                      <div class="text-gray-900 font-bold text-xl mb-2">{{$questionnaire->title}}</div>
                                      <p class="text-xs text-gray-700 text-base">
                                          {!! $questionnaire->description !!}
                                      </p>
                                  </div>
                              </div>
                          </a>
                      @endforeach
                  </div>
                    <div class="col-12 my-2 flex justify-content-center align-items-center">
                        {{$questionnaires->links()}}
                    </div>
                </div>
                <!-- end row -->

            </div>
            @endif
            <!-- end page-content-wrapper -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

@endsection

