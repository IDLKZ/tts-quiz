@extends("auth.layout")
@section("content")
    <div class="account-pages min-vh-100 flex justify-content-center align-items-center bg-gray-300 py-3 px-2">
        <div class="container">
            <!-- end row -->
            <div class="grid grid-cols-12 shadow-lg rounded-xl">
                <div class="col-span-12 lg:col-span-6 flex h-full min-h-[600px] position-relative align-items-center justify-content-center">
                    <div class="absolute brightness-[30%] z-10 w-full h-full bg-cover lg:rounded-bl-xl lg:rounded-tl-xl bg-center bg-no-repeat bg-[url('/images/bg-4.PNG')]"></div>
                    <img class="absolute max-w-[150px] z-20 left-[15px] top-[15px]" src="{{asset("images/logo.png")}}"/>
                    <p class="text-lg md:text-xl lg:text-2xl z-30 text-white uppercase px-4 text-center font-weight-bold">
                        Добро пожаловать,
                        <br/>
                        на платформу <br/><span class="text-yellow-500">Темир Транс Сервис!</span>
                    </p>
                    <div class="text-sm lg:text-md text-left z-30 text-white uppercase px-4 font-weight-bold absolute bottom-[10px] w-full px-2">
                        <p class="my-2">
                            <i class="fas fa-map-marker-alt mr-2"></i>Республика Казахстан, г.Астана, ул.Кунаева 10, 26 этаж.
                        </p>
                        <p class="my-2">
                            <i class="fas fa-phone mr-2"></i>+7 7172 610 626 <br/>
                            <i class="fas fa-phone mr-2"></i>+7 771 055 31 94 <br/>
                        </p>
                        <p class="my-2">
                            <i class="fas fa-envelope mr-2"></i>tts@ttservice.kz
                        </p>

                    </div>
                </div>
                <div class="col-span-12 lg:col-span-6 flex align-items-center h-full justify-content-center bg-white lg:rounded-br-xl lg:rounded-tr-xl">
                    <div class="card w-full max-w-[500px]">
                        <div class="card-body p-4">
                            <div class="p-2 text-center">
                                <p class="text-lg md:text-xl lg:text-2xl text-yellow-500 flex justify-content-center align-items-center">
                                   <img src="{{asset('images/navbar-logo.png')}}" class="max-w-[20px] mr-2"/> Портал Темир Транс Сервис
                                </p>
                                <br/>
                                <h5 class="mb-5 text-center">Вход в личный кабинет</h5>
                                @if ($errors->any())
                                    <div class="alert alert-danger my-2">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form id="js-form" class="form-horizontal" action="{{route('auth')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-custom mb-4">
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
                                            </div>

                                            <div class="form-group form-group-custom mb-4">
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Пароль" required>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="remember_me" class="custom-control-input" id="customControlInline">
                                                        <label class="custom-control-label" for="customControlInline">Запомнить меня</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-md-right mt-3 mt-md-0">
                                                        <a href="{{route("forget")}}" class="text-muted"><i class="mdi mdi-lock"></i> Забыли пароль?</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success bg-green-300 btn-block waves-effect waves-light" type="submit">Вход</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end Account pages -->
@endsection
