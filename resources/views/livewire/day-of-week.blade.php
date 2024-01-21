<div class="flex-1 h-12 border -mt-px -ml-px flex items-center justify-center bg-indigo-100 text-gray-900"
     style="min-width: 10rem;">

    <p class="text-sm">
        @switch($day->format('l'))
            @case("Monday")
                Понедельник
                @break
            @case("Tuesday")
                Вторник
                @break
            @case("Wednesday")
                Среда
                @break
            @case("Thursday")
                Четверг
                @break
            @case("Friday")
                Пятница
                @break
            @case("Saturday")
                Суббота
                @break
            @case("Sunday")
                Воскресенье
                @break
        @endswitch
    </p>

</div>
