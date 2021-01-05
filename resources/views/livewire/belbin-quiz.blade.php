            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <form wire:submit.prevent = "submit">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">{{  $belbin_quiz->title}}</h4>
                                    <p class="card-title-desc">
                                        {{  $belbin_quiz->description}}
                                    </p>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <hr>

                                    <!-- Nav tabs -->

                                    <ul class="nav nav-pills my-3" id="myTab" role="tablist">
                                        @foreach($belbin_questions as $id => $belbin)
                                        <li class="nav-item mr-1 nav-data {{$id == $activeTab ? "show active" : "hide"}} @if(isset($test[$id]) && isset($limitation[$id])) @if(count($test[$id]) == 8 && $limitation[$id] == 10) btn-success @else btn-warning @endif @else btn-warning @endif $id" wire:click="changeActive({{$id}})">
                                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#blog{{$id}}" role="tab" aria-controls="home" aria-selected="true">
                                                Блог - {{$id}}
                                            </a>
                                        </li>
                                        @endforeach

                                    </ul>
                                    <hr>
                                    <form action method="post">
                                        @csrf
                                        <input  hidden id = "answers" name="oven_answer" value="">
                                        <input  hidden  name="invite" value="{{$invite->id}}">
                                        <div class="tab-content" id="myTabContent">
                                            @foreach($belbin_questions as $id => $belbin)
                                            <div class="tab-pane fade {{$id == $activeTab ? "show active" : "hide"}}" id="blog{{$id}}" role="tabpanel" aria-labelledby="home-tab">
                                                <p class="card-text"></p>
                                                @foreach($belbin as $item)
                                                <div class="belbin-blog">
                                                    {{$item->question}}
                                                    <ul class="nav nav-pills my-3 justify-content-center" id="myTab" role="tablist">
                                                        @for($i = 0; $i <= 10; $i++)
                                                            <li class="nav-item mr-1 question-nav
                                                                @if(isset($test[$item->blog_id]))
                                                                @if(isset($test[$item->blog_id][$item->id]))
                                                                @if($test[$item->blog_id][$item->id] == $i)
                                                                bg-success
                                                                @endif
                                                                @endif
                                                                @endif
                                                                    "
                                                                 wire:click="collectItem({{$item->blog_id}},{{$i}},{{$item->id}})">
                                                                <a class="nav-link" id="home-tab" data-toggle="tab">
                                                                        {{$i}}
                                                                </a>
                                                            </li>
                                                        @endfor

                                                    </ul>
                                                </div>
                                                @endforeach
                                            </div>
                                            @endforeach
                                            <hr>
                                        </div>
                                        @if($rating == 70 && $arr == 56)
                                        <div class="text-center mt-5">
                                            <button class="btn btn-info" id="check">Отправить</button>
                                        </div>
                                        @endif
                                    </form>




                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <button class="btn  rounded-pill btn-lg @if(isset($limitation[$activeTab])) @if($limitation[$activeTab] == 10) btn-success @else btn-warning @endif @else btn-warning @endif " style="position: fixed;z-index: 5; right: 10px;bottom: 180px; height: 75px; width: 75px;font-size: 18px">
                        {{isset($limitation[$activeTab]) ? $limitation[$activeTab] :0 }}/10
                    </button>

                    <button class="btn  rounded-pill btn-lg  @if($rating == 70) btn-success @else btn-warning @endif" style="position: fixed;z-index: 5; right: 10px;bottom: 100px; height: 75px; width: 75px;font-size: 18px">
                        {{$rating}}/70
                    </button>

                    <!-- end row -->


                </div>
                <!-- end container-fluid -->
            </div>


<!-- end page-content-wrapper -->
