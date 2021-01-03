@extends("auth.layout")
@section("content")
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h3 class="font-size-20 text-white">Корпоративный портал</h3>
                        <h5 class="font-size-16 text-white-50 mb-4">Вход в личный кабинет</h5>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-xl-5 col-sm-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-2">
                                <h5 class="mb-5 text-center">Вход в личный кабинет</h5>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
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
                                                <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Вход</button>
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
