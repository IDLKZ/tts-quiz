<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Завершена сдача экзамена!</title>
</head>
<body>
<img src="https://wallpaperaccess.com/full/2384073.jpg" height="115" width="204">
<h1>Уважаемый администратор</h1>
<p>Напоминаем, что {{\Illuminate\Support\Facades\Auth::user()->name}} сдал экзамен, для просмотра результата экзамена пройдите по следующей ссылке:</p>
@if($result->invite->type_id == 1)
    <a href="{{route("admin-soloview-show",["userId"=>\Illuminate\Support\Facades\Auth::id(),"id"=>$result->id])}}">{{route("admin-soloview-show",["userId"=>\Illuminate\Support\Facades\Auth::id(),"id"=>$result->id])}}</a>
    @elseif($result->invite->type_id == 2)
    <a href="{{route("admin-belbin-show",["userId"=>\Illuminate\Support\Facades\Auth::id(),"id"=>$result->id])}}">{{route("admin-belbin-show",["userId"=>\Illuminate\Support\Facades\Auth::id(),"id"=>$result->id])}}</a>
@endif

<br>
<p>Профиль сотрудника</p>
<a href="{{route("user.show",\Illuminate\Support\Facades\Auth::id())}}">{{route("user.show",\Illuminate\Support\Facades\Auth::id())}}</a>

<p>С уважением компании TTS</p>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

