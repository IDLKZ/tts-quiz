@extends('layout-employee')
@section('content')

    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div>

        <div class="page-content">

            <div class="container">
                <div class="row my-3">
                    <div class="col-12">
                        <p class="text-lg md:text-xl lg:text-2xl xl:text-3xl font-weight-bold text-black pl-8">
                            Портал «ТемирТрансСервис»
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-12 my-3 gap-5">
                    @if($news)
                        <div class="col-span-12 lg:col-span-8">
                            <section class="relative  h-[300px] md:h-[400px] lg:h-[600px] lg:mx-5">
                                <div class="absolute rounded-xl z-10 h-[300px] md:h-[400px] lg:h-[600px] brightness-50 w-full bg-cover bg-center bg-no-repeat" style="background-image:url({{$news->img}})"></div>
                                <div class="absolute z-20 bottom-0 w-full p-4">
                                    <p class="text-white font-weight-bold text-md lg:text-lg xl:text-2xl">
                                        {{$news->title}}
                                    </p>
                                    <div class="lg:flex justify-content-between align-items-center">
                                        <p class="text-white text-xs lg:text-md my-3 lg:w-3/4">
                                            {{strlen($news->subtitle) > 30 ? trim($news->subtitle,30) . "..." : $news->subtitle}}
                                        </p>
                                        <a href="{{route("news-show",$news->id)}}" class="btn btn-warning text-white">
                                            Читать
                                        </a>
                                    </div>

                                </div>
                            </section>
                            @endif
                            @if($questionnaires->isNotEmpty())
                                <section class="my-4 p-3">
                                    <div class="w-full">
                                        <p class="text-lg md:text-xl font-weight-bold text-black text-uppercase inline-block mb-4">
                                            Опросники
                                        </p>
                                        @foreach($questionnaires as $questionnaire)
                                            <div class="max-w-sm w-full lg:max-w-full lg:flex my-3 rounded-2xl">
                                                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover bg-center bg-white rounded-t py-2 lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('/images/question.webp')">
                                                </div>
                                                <div class="border border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal w-full">
                                                    <a href="{{route("employee-questionnaire-show",$questionnaire->id)}}" class="block mb-8">
                                                        <p class="text-sm text-gray-600 flex items-center">
                                                            {{$questionnaire->start_at->format("d/m/Y H:i")}}
                                                            @if($questionnaire->end_at)
                                                                - {{$questionnaire->end_at->format("d/m/Y H:i")}}
                                                            @endif
                                                        </p>
                                                        <div class="text-gray-900 font-bold text-xl mb-2">{{$questionnaire->title}}</div>
                                                        <p class="text-xs text-gray-700 text-base">
                                                            {!! $questionnaire->description !!}
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </section>
                            @endif
                            @if($events->isNotEmpty())
                                <section class="my-4 p-3">
                                    <div class="w-full">
                                        <p class="text-lg md:text-xl font-weight-bold text-black text-uppercase inline-block mb-4">
                                            Мероприятия
                                        </p>
                                        @foreach($events as $event)
                                            <div class="max-w-sm w-full lg:max-w-full lg:flex my-3 rounded-2xl">
                                                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover bg-center bg-white rounded-t py-2 lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url({{$event->getFile("image_url")}})">
                                                </div>
                                                <div class="border border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal w-full">
                                                    <a href="{{route("event-show",$event->id)}}" class="block mb-8">
                                                        <p class="text-sm text-gray-600 flex items-center">
                                                            {{$event->start_date->format("d/m/Y H:i")}}
                                                            @if($event->end_date)
                                                               - {{$event->end_date->format("d/m/Y H:i")}}
                                                            @endif
                                                        </p>
                                                        <p class="text-sm text-gray-600 flex items-center mb-3">
                                                            <i class="fas fa-location"></i>
                                                            {{$event->address}}
                                                        </p>
                                                        <div class="text-gray-900 font-bold text-xl mb-2">{{$event->title}}</div>
                                                        <p class="text-xs text-gray-700 text-base">
                                                            {!! $event->description !!}
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </section>
                            @endif

                        </div>
                        <div class="col-span-12 lg:col-span-4">
                            @if($tasks->isNotEmpty())
                            <div class="flex align-items-center justify-content-center mb-3">
                                <div class="w-full max-w-[400px] shadow-lg bg-white min-h-[350px] rounded-2xl relative p-4">
                                    <div class="header-card-title flex justify-content-between">
                                        <p class="text-md lg:text-lg text-rose-500 font-weight-bold">Важные задания</p>
                                        <a href="{{route("employee-tasks")}}">
                                            <i class="fas fa-eye text-rose-500"></i>
                                        </a>
                                    </div>
                                    @foreach($tasks as $task)
                                        <div class="card-row-body my-3">
                                            <div class="flex align-items-center">
                                                <div class="min-w-8 w-1/12">
                                                    <img class="w-6 h-6 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 mr" src="{{$task->user->img}}">
                                                </div>
                                                <a href="{{route("employee-task-detail",$task->id)}}" class="min-w-8 justify-content-between flex w-10/12">
                                                    <div class="word-break pl-2 w-2/3">
                                                        <p class="text-md">
                                                            {{$task->user->name}}
                                                        </p>
                                                        <small class="text-xs my-2">
                                                            {{$task->task}}
                                                        </small>
                                                    </div>
                                                    <small class="text-xs ml-2 text-left w-1/3">
                                                        {{$task->created_at->diffForHumans()}}
                                                    </small>
                                                </a>

                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="absolute bottom-0 left-0 w-full min-h-[30px] mt-3 bg-rose-500 rounded-br-2xl rounded-bl-2xl text-left">
                                    </div>
                                </div>
                            </div>
                            @endif
                                @if($users->isNotEmpty())
                                    <div class="flex align-items-center justify-content-center mb-3">
                                        <div class="w-full max-w-[400px] shadow-lg bg-white min-h-[300px] rounded-2xl relative p-4">
                                            <div class="header-card-title flex justify-content-between">
                                                <span class="text-md lg:text-lg text-yellow-500 font-weight-bold">
                                                   Дни рождения <i class="fas fa-gift"></i>
                                                </span>
                                            </div>
                                            @foreach($users as $user)
                                                <div class="card-row-body my-3">
                                                    <div class="flex align-items-center">
                                                        <div class="min-w-8 w-1/12">
                                                            <img class="w-6 h-6 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 mr" src="{{$user->img}}">
                                                        </div>
                                                        <div class="min-w-8 justify-content-between flex w-10/12">
                                                            <div class="word-break pl-2 w-2/3">
                                                                <p class="text-md">
                                                                    {{$user->name}}
                                                                </p>
                                                                <small class="text-xs my-2">
                                                                    Поздравляем!
                                                                </small>
                                                            </div>
                                                            <small class="text-xs ml-2 text-left min-w-[40px] w-1/3">
                                                                {{$user->birth_date->format('d M')}}
                                                            </small>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="absolute bottom-0 left-0 w-full min-h-[30px] mt-3 bg-yellow-500 rounded-br-2xl rounded-bl-2xl">
                                                <div class="flex align-items-center justify-content-center p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="256" height="24" viewBox="0 0 256 24" fill="none">
                                                        <g opacity="0.5">
                                                            <mask id="mask0_1_2136" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="20" height="20">
                                                                <rect width="15.7275" height="15.7275" transform="matrix(-0.965926 0.258819 0.258819 0.965926 15.1914 0)" fill="#D9D9D9"/>
                                                            </mask>
                                                            <g mask="url(#mask0_1_2136)">
                                                                <path d="M16.391 14.604L14.5253 7.64121L15.7913 7.302L14.7736 3.5041L11.4821 4.38606C11.5094 4.27698 11.5169 4.16757 11.5044 4.05783C11.492 3.94809 11.4702 3.8352 11.4391 3.71915C11.2978 3.19167 10.993 2.79277 10.5248 2.52247C10.0567 2.25217 9.55884 2.18769 9.03135 2.32903C8.78871 2.39404 8.5739 2.49966 8.38693 2.64586C8.19997 2.79207 8.03801 2.96833 7.90107 3.17463C7.67649 3.05389 7.4474 2.97959 7.21379 2.95172C6.98019 2.92386 6.74206 2.94244 6.49942 3.00746C5.97193 3.1488 5.57304 3.45355 5.30273 3.92173C5.03243 4.38991 4.96795 4.88774 5.10929 5.41523C5.14038 5.53127 5.17991 5.63658 5.22786 5.73115C5.27582 5.82572 5.33503 5.9201 5.40549 6.01429L2.11398 6.89625L3.13162 10.6941L4.39759 10.3549L6.26327 17.3177L16.391 14.604ZM6.83863 4.27342C7.01798 4.22537 7.18456 4.24575 7.33839 4.33456C7.49222 4.42337 7.59317 4.55745 7.64122 4.7368C7.68928 4.91614 7.6689 5.08273 7.58008 5.23656C7.49127 5.39039 7.35719 5.49133 7.17785 5.53939C6.9985 5.58744 6.83191 5.56707 6.67808 5.47825C6.52425 5.38944 6.42331 5.25536 6.37526 5.07601C6.3272 4.89667 6.34758 4.73008 6.43639 4.57625C6.52521 4.42242 6.65929 4.32148 6.83863 4.27342ZM10.1732 4.05837C10.2212 4.23771 10.2008 4.4043 10.112 4.55813C10.0232 4.71196 9.88912 4.8129 9.70978 4.86096C9.53043 4.90901 9.36385 4.88864 9.21002 4.79982C9.05619 4.71101 8.95524 4.57693 8.90719 4.39758C8.85913 4.21824 8.87951 4.05165 8.96833 3.89782C9.05714 3.74399 9.19122 3.64305 9.37056 3.59499C9.54991 3.54694 9.7165 3.56732 9.87033 3.65613C10.0242 3.74494 10.1251 3.87902 10.1732 4.05837ZM13.8469 5.10928L14.1861 6.37525L9.75522 7.5625L9.41601 6.29653L13.8469 5.10928ZM11.6209 14.5253L10.0944 8.82847L13.2594 7.98043L14.7858 13.6773L11.6209 14.5253ZM10.3549 14.8645L7.19002 15.7126L5.66356 10.0157L8.82847 9.16768L10.3549 14.8645ZM4.05838 9.08897L3.71916 7.823L8.15004 6.63575L8.48926 7.90171L4.05838 9.08897Z" fill="white"/>
                                                            </g>
                                                            <mask id="mask1_1_2136" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="69" y="1" width="20" height="20">
                                                                <rect x="73.0708" y="1" width="15.7275" height="15.7275" transform="rotate(15 73.0708 1)" fill="#D9D9D9"/>
                                                            </mask>
                                                            <g mask="url(#mask1_1_2136)">
                                                                <path d="M71.8712 15.604L73.7369 8.64121L72.4709 8.302L73.4886 4.5041L76.7801 5.38606C76.7528 5.27698 76.7453 5.16757 76.7578 5.05783C76.7702 4.94809 76.792 4.8352 76.8231 4.71915C76.9644 4.19167 77.2692 3.79277 77.7374 3.52247C78.2055 3.25217 78.7034 3.18769 79.2309 3.32903C79.4735 3.39404 79.6883 3.49966 79.8753 3.64586C80.0622 3.79207 80.2242 3.96833 80.3611 4.17463C80.5857 4.05389 80.8148 3.97959 81.0484 3.95172C81.282 3.92386 81.5201 3.94244 81.7628 4.00746C82.2903 4.1488 82.6892 4.45355 82.9595 4.92173C83.2298 5.38991 83.2943 5.88774 83.1529 6.41523C83.1218 6.53127 83.0823 6.63658 83.0343 6.73115C82.9864 6.82572 82.9272 6.9201 82.8567 7.01429L86.1482 7.89625L85.1306 11.6941L83.8646 11.3549L81.9989 18.3177L71.8712 15.604ZM81.4236 5.27342C81.2442 5.22537 81.0776 5.24575 80.9238 5.33456C80.77 5.42337 80.669 5.55745 80.621 5.7368C80.5729 5.91614 80.5933 6.08273 80.6821 6.23656C80.7709 6.39039 80.905 6.49133 81.0844 6.53939C81.2637 6.58744 81.4303 6.56707 81.5841 6.47825C81.738 6.38944 81.8389 6.25536 81.887 6.07601C81.935 5.89667 81.9146 5.73008 81.8258 5.57625C81.737 5.42242 81.6029 5.32148 81.4236 5.27342ZM78.0891 5.05837C78.041 5.23771 78.0614 5.4043 78.1502 5.55813C78.239 5.71196 78.3731 5.8129 78.5524 5.86096C78.7318 5.90901 78.8984 5.88864 79.0522 5.79982C79.206 5.71101 79.307 5.57693 79.355 5.39758C79.4031 5.21824 79.3827 5.05165 79.2939 4.89782C79.2051 4.74399 79.071 4.64305 78.8916 4.59499C78.7123 4.54694 78.5457 4.56732 78.3919 4.65613C78.2381 4.74494 78.1371 4.87902 78.0891 5.05837ZM74.4153 6.10928L74.0761 7.37525L78.507 8.5625L78.8462 7.29653L74.4153 6.10928ZM76.6413 15.5253L78.1678 9.82847L75.0029 8.98043L73.4764 14.6773L76.6413 15.5253ZM77.9073 15.8645L81.0722 16.7126L82.5986 11.0157L79.4337 10.1677L77.9073 15.8645ZM84.2038 10.089L84.543 8.823L80.1122 7.63575L79.7729 8.90171L84.2038 10.089Z" fill="white"/>
                                                            </g>
                                                            <mask id="mask2_1_2136" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="236" y="0" width="20" height="20">
                                                                <rect x="240.071" width="15.7275" height="15.7275" transform="rotate(15 240.071 0)" fill="#D9D9D9"/>
                                                            </mask>
                                                            <g mask="url(#mask2_1_2136)">
                                                                <path d="M238.871 14.604L240.737 7.64121L239.471 7.302L240.489 3.5041L243.78 4.38606C243.753 4.27698 243.745 4.16757 243.758 4.05783C243.77 3.94809 243.792 3.8352 243.823 3.71915C243.964 3.19167 244.269 2.79277 244.737 2.52247C245.206 2.25217 245.703 2.18769 246.231 2.32903C246.474 2.39404 246.688 2.49966 246.875 2.64586C247.062 2.79207 247.224 2.96833 247.361 3.17463C247.586 3.05389 247.815 2.97959 248.048 2.95172C248.282 2.92386 248.52 2.94244 248.763 3.00746C249.29 3.1488 249.689 3.45355 249.959 3.92173C250.23 4.38991 250.294 4.88774 250.153 5.41523C250.122 5.53127 250.082 5.63658 250.034 5.73115C249.986 5.82572 249.927 5.9201 249.857 6.01429L253.148 6.89625L252.131 10.6941L250.865 10.3549L248.999 17.3177L238.871 14.604ZM248.424 4.27342C248.244 4.22537 248.078 4.24575 247.924 4.33456C247.77 4.42337 247.669 4.55745 247.621 4.7368C247.573 4.91614 247.593 5.08273 247.682 5.23656C247.771 5.39039 247.905 5.49133 248.084 5.53939C248.264 5.58744 248.43 5.56707 248.584 5.47825C248.738 5.38944 248.839 5.25536 248.887 5.07601C248.935 4.89667 248.915 4.73008 248.826 4.57625C248.737 4.42242 248.603 4.32148 248.424 4.27342ZM245.089 4.05837C245.041 4.23771 245.061 4.4043 245.15 4.55813C245.239 4.71196 245.373 4.8129 245.552 4.86096C245.732 4.90901 245.898 4.88864 246.052 4.79982C246.206 4.71101 246.307 4.57693 246.355 4.39758C246.403 4.21824 246.383 4.05165 246.294 3.89782C246.205 3.74399 246.071 3.64305 245.892 3.59499C245.712 3.54694 245.546 3.56732 245.392 3.65613C245.238 3.74494 245.137 3.87902 245.089 4.05837ZM241.415 5.10928L241.076 6.37525L245.507 7.5625L245.846 6.29653L241.415 5.10928ZM243.641 14.5253L245.168 8.82847L242.003 7.98043L240.476 13.6773L243.641 14.5253ZM244.907 14.8645L248.072 15.7126L249.599 10.0157L246.434 9.16768L244.907 14.8645ZM251.204 9.08897L251.543 7.823L247.112 6.63575L246.773 7.90171L251.204 9.08897Z" fill="white"/>
                                                            </g>
                                                            <mask id="mask3_1_2136" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="149" y="0" width="20" height="21">
                                                                <rect width="15.7275" height="15.7275" transform="matrix(-0.965926 0.258819 0.258819 0.965926 164.192 0.773438)" fill="#D9D9D9"/>
                                                            </mask>
                                                            <g mask="url(#mask3_1_2136)">
                                                                <path d="M165.391 15.3775L163.526 8.41465L164.792 8.07544L163.774 4.27754L160.483 5.1595C160.51 5.05041 160.517 4.94101 160.505 4.83127C160.492 4.72153 160.471 4.60864 160.44 4.49259C160.298 3.96511 159.994 3.56621 159.525 3.29591C159.057 3.02561 158.559 2.96112 158.032 3.10246C157.789 3.16748 157.574 3.27309 157.387 3.4193C157.2 3.56551 157.039 3.74176 156.902 3.94807C156.677 3.82733 156.448 3.75302 156.214 3.72516C155.981 3.6973 155.743 3.71588 155.5 3.78089C154.972 3.92223 154.574 4.22699 154.303 4.69517C154.033 5.16335 153.968 5.66118 154.11 6.18866C154.141 6.30471 154.18 6.41002 154.228 6.50459C154.276 6.59916 154.336 6.69354 154.406 6.78773L151.114 7.66968L152.132 11.4676L153.398 11.1284L155.264 18.0912L165.391 15.3775ZM155.839 5.04686C156.018 4.9988 156.185 5.01918 156.339 5.108C156.493 5.19681 156.594 5.33089 156.642 5.51024C156.69 5.68958 156.669 5.85617 156.581 6.01C156.492 6.16383 156.358 6.26477 156.178 6.31283C155.999 6.36088 155.832 6.3405 155.679 6.25169C155.525 6.16288 155.424 6.0288 155.376 5.84945C155.328 5.67011 155.348 5.50352 155.437 5.34969C155.526 5.19586 155.66 5.09492 155.839 5.04686ZM159.174 4.83181C159.222 5.01115 159.201 5.17774 159.113 5.33157C159.024 5.4854 158.89 5.58634 158.71 5.6344C158.531 5.68245 158.364 5.66207 158.211 5.57326C158.057 5.48445 157.956 5.35037 157.908 5.17102C157.86 4.99168 157.88 4.82509 157.969 4.67126C158.058 4.51743 158.192 4.41649 158.371 4.36843C158.55 4.32038 158.717 4.34075 158.871 4.42957C159.025 4.51838 159.126 4.65246 159.174 4.83181ZM162.847 5.88272L163.187 7.14869L158.756 8.33594L158.416 7.06997L162.847 5.88272ZM160.621 15.2988L159.095 9.6019L162.26 8.75387L163.786 14.4507L160.621 15.2988ZM159.355 15.638L156.191 16.486L154.664 10.7892L157.829 9.94112L159.355 15.638ZM153.059 9.8624L152.72 8.59644L157.151 7.40919L157.49 8.67515L153.059 9.8624Z" fill="white"/>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($forums->isNotEmpty())
                                    <div class="flex align-items-center justify-content-center mb-3">
                                        <div class="w-full max-w-[400px] shadow-lg bg-white min-h-[300px] rounded-2xl relative p-4">
                                            <div class="header-card-title flex justify-content-between">
                                                <p class="text-md lg:text-lg text-yellow-500 font-weight-bold">Форумы</p>
                                                <a href="{{route("forum-list")}}">
                                                    <i class="fas fa-eye text-yellow-500"></i>
                                                </a>
                                            </div>
                                            @foreach($forums as $forum)
                                                <div class="card-row-body my-3">
                                                    <div class="flex align-items-center">
                                                        <div class="min-w-8 w-1/12">
                                                            <img class="w-6 h-6 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 mr" src="{{$forum->user->img}}">
                                                        </div>
                                                        <div class="min-w-8 justify-content-between flex w-10/12">
                                                            <div class="word-break pl-2  w-3/4">
                                                                <a href="{{route("forumDetail",$forum->id)}}" class="text-md">
                                                                    {{\Illuminate\Support\Str::limit($forum->title,30)}}
                                                                </a><br/>
                                                                <small class="text-xs my-2">
                                                                    {!! \Illuminate\Support\Str::limit(strip_tags($forum->description),30) !!}
                                                                </small>
                                                            </div>
                                                            <small class="text-xs ml-2 text-left min-w-[40px]  w-1/4">
                                                                {{$forum->created_at->diffForHumans()}}
                                                            </small>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="absolute bottom-0 left-0 w-full min-h-[30px] mt-3 bg-yellow-500 rounded-br-2xl rounded-bl-2xl">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                </div>
            </div>
        </div>
    </div>

@endsection
