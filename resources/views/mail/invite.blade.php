<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Сообщение от TTS-QUIZ!</title>
</head>
<body>
<img src="https://wallpaperaccess.com/full/2384073.jpg" height="115" width="204">
<h1>Уважаемый(-ая) {{$detail["user"]["name"]}}</h1>
<p>Наша компания, в лице HR руководства, приглашает вас на сдачу теста {{$detail["info"]["title"]}} ({{$detail["info"]["type_id"] == 1 ? "Тест Соловьева" : "Тест Белбина"}})</p>
<p>Которая состоится в период
    {{\Carbon\Carbon::parse($detail["info"]["start"])->format("d.m.Y")}} - {{\Carbon\Carbon::parse($detail["info"]["end"])->format("d.m.Y")}}
</p>
<b>Ссылки для сдачи экзамена:

    @if($detail["info"]["type_id"] == 1)
        <a target="_blank" href="{{route("solovievQuiz",$detail["id"])}}">Ссылка для сдачи экзамена Соловьева</a>
    @elseif($detail["info"]["type_id"] == 2)
        <a target="_blank" href="{{route("belbinQuiz",$detail["id"])}}">Ссылка для сдачи экзамена Белбина</a>
    @else
        <a target="_blank" href="https://idl.kz/employee/my-invites">Страница профиля</a>
    @endif
</b>
<br>
<b>Сдача экзамена возможна в период:
    {{\Carbon\Carbon::parse($detail["info"]["start"])->format("d.m.Y")}} - {{\Carbon\Carbon::parse($detail["info"]["end"])->format("d.m.Y")}}
</b>
<p> Список предстоящих тестов вы можете также увидеть во вкладке 'Предстоящие тесты' на странице Профиля </p>
<p>Список доступных тестов для сдачи вы можете просмотреть во вкладке "Приглашения" </p>

<p>С уважение отдел HR компании TTS</p>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
