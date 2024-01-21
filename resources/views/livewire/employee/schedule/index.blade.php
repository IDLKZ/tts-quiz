<div class="container">
    <div class="grid grid-cols-12 gap-3 my-3">
        <div class="col-span-12 md:col-span-6">
            <div class="form-group">
                <div>
                    <select wire:change="selectYear" wire:model="yearId" class="form-control">
                        @foreach($years as $year)
                            <option
                                @if($yearId == $year)
                                    selected
                                @endif
                                value="{{$year}}">
                                {{$year}} год
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-span-12 md:col-span-6">
            <div class="form-group">
                <div>
                    <select wire:change="selectMonth" wire:model="monthId" class="form-control">
                        @foreach($months as $monthKey => $monthValue)
                            <option
                                @if($monthId == $monthKey)
                                    selected
                                @endif
                                value="{{$monthKey}}">
                                {{$monthValue}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="grid-cols-12 gap-4 my-2">
        <div class="col-span-12">
            <livewire:employee.employee-schedule
                :initial-year="$yearId"
                :initial-month="$monthId"
                week-starts-at="1"
                :day-of-week-view="'livewire/day-of-week'"
                :event-click-enabled="true"
            />
        </div>

    </div>
</div>
