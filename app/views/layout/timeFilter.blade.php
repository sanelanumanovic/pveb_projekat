<div class="col-6 col-md-3">
    {{ Form::radio('timeType', '1', true) }}
    {{Form::label('Interval')}}
</div>

<div class="col-6 col-md-9">
    <div class="timeType-1">
        {{ Form::input('date', 'fromDate', date('Y-m-d', strtotime('-1 day'))) }}
        {{Form::label('-')}}
        {{ Form::input('date', 'toDate', date('Y-m-d', strtotime('+0 day'))) }}
    </div>
</div>

<div class="col-6 col-md-3">
    {{Form::radio('timeType', '2')}}
    {{Form::label('Period')}}
</div>

<div class="col-12 col-md-9">
    <div class="timeType-2">
        {{Form::radio('timeSubType', '1', true)}}
        {{Form::label('1 mesec')}}
        <br>
        {{Form::radio('timeSubType', '2')}}
        {{Form::label('3 meseca')}}
        <br>
        {{Form::radio('timeSubType', '3')}}
        {{Form::label('6 meseci')}}
        <br>
        {{Form::radio('timeSubType', '4')}}
        {{Form::label('1 godina')}}
    </div>
</div>

<div class="col-6 col-md-3">
    {{Form::radio('timeType', '3')}}
    {{Form::label('Godina')}}
</div>

<div class="col-6 col-md-9">
    <div class="timeType-3">
        {{ Form::selectYear('year', 2018, 1990) }}
    </div>
</div>

<div class="col-6 col-md-3">
    {{Form::radio('timeType', '4')}}
    {{Form::label('Sve transakcije')}}
</div>

<div class="col-12 col-md-9">
    <div class="timeType-4"></div>
</div>
