@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">
        <div class="container mb-5">
            <div class="row">
                <div class="col-12 col-md-6 my-2 flex align-items-center">
                    <p class="text-lg font-bold lg:text-xl xl:text-2xl">
                        Видеоурок {{$lesson->order}} - {{$lesson->title}}
                    </p>
                </div>
                <div class="col-12 col-md-6 my-2 text-right">
                    <a href="{{route("course-show-employee",$lesson->course->alias)}}" class="btn btn-warning text-white px-4 py-2">
                       Назад в Курс {{$lesson->course->title}}
                    </a>
                </div>
            </div>
        </div>
            <div class="container">
                <div class="row mt-5">
                    <div class="col-12 my-3 d-flex justify-content-center align-items-center">
                        @if($lesson->type == 'youtube')
                            <div id="my-video-display" class="w-full rounded-lg"></div>
                        @else
                            <div id="bgndVideo" class="player" style="min-height: 500px; width: 100%">
                                <video width="100%" height="500px" controls>
                                    <source src="{{$lesson->getFile("video_url")}}" type="{{$lesson->video_type}}">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 my-3">
                        <div>
                            <div class="flex align-items-center justify-content-between">
                                <section>
                                    <p class="text-lg font-bold lg:text-xl xl:text-2xl">{{$lesson->title}}</p>
                                    <p class="text-md lg:text-lg">{{$lesson->subtitle}}</p>
                                </section>
                                <section>
                                    @if($lesson->isPassed())
                                        <a class="btn btn-success text-sm text-white mx-1">
                                            Вы сдали тест
                                        </a>
                                    @else
                                        @if($lesson->questions_count > 0)
                                            <a href="{{route("pass-quiz-by-lesson",$lesson->id)}}" class="btn btn-warning text-sm text-white mx-1">
                                                Сдать тест
                                            </a>
                                        @endif
                                    @endif
                                </section>
                            </div>

                            <div class="mt-4" style="max-width: 320px;border-bottom: 1px solid grey">
                                <p class="mt-2 mb-2 d-inline">
                                    {{$lesson->created_at->diffForHumans()}}
                                </p>
                            </div>
                            <div class="mt-4">
                                <p class="text-md">
                                    {!! $lesson->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 flex my-2 justify-content-between my-4">
                        @if($lesson->prev_lesson)
                            <a href="{{route("lesson-show-employee",$lesson->prev_lesson->alias)}}" class="btn btn-warning text-sm text-white mx-1">
                                <i class="fas fa-arrow-alt-circle-left"></i> Предыдущий урок
                            </a>
                        @endif
                        @if($lesson->next_lesson)
                                <a href="{{route("lesson-show-employee",$lesson->next_lesson->alias)}}" class="btn btn-warning text-sm text-white mx-1">
                                   Следуюший урок   <i class="fas fa-arrow-alt-circle-right"></i>
                                </a>
                        @endif
                    </div>

                    @if($other_lessons->isNotEmpty())
                        <div class="col-12 mt-5 mb-2 text-lg lg:text-xl xl:text-2xl font-weight-bold text-black">
                            Другие Уроки по данной категории
                        </div>
                        @foreach($other_lessons as $item)
                            <div class="col-12 col-md-6 col-lg-4 my-2">
                                <div class="card h-full rounded-lg">
                                    <div class="card-image min-h-[300px] background-no-repeat background-center background-cover" style="min-height:300px;background-image:url({{$item->getFile("image_url")}})"></div>
                                    <section class="py-2 px-3">
                                        <div class="header">
                                            <p class="text-md lg:text-lg xl:text-xl font-weight-bold text-black">
                                                {{$item->order}}.  {{\Illuminate\Support\Str::limit($item->title,30)}}
                                            </p>
                                        </div>
                                        <div class="header-subtitle my-3">
                                            <p class="text-md text-gray-500">
                                                {{\Illuminate\Support\Str::limit($item->subtitle,30)}}
                                            </p>
                                        </div>
                                        <div class="flex justify-content-center align-items-center text-center py-3">
                                            <a href="{{route("lesson-show-employee",$item->alias)}}" class="btn btn-warning text-white">
                                                <i class="fas fa-eye"></i> Смотреть
                                            </a>
                                        </div>
                                    </section>

                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- end row -->

            </div>
        <!-- End Page-content -->
        </div>
    </div>
    <!-- end main content-->

@endsection

@push("scripts")

    <script>
        $('#my-video-display').prettyEmbed({
            videoID: "{{\Alaouy\Youtube\Youtube::parseVidFromURL($lesson->video_url)}}",
            previewSize: 'hd',				// use either this option...
            customPreviewImage: '',			// ...or this option
            // Embed controls
            showInfo: false,
            showControls: true,
            loop: false,
            colorScheme: 'dark',
            showRelated: false,
            useFitVids: true
        });
    </script>

@endpush
