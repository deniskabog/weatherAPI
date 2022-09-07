
@extends('header')

@section('title')Погода@endsection


@section('header_content')

    @if(isset($cityName))
        <h1>Погода в {{$cityName}}</h1>
    @else
        <h1>Погода</h1>
    @endif

    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="post" action="/weather/check">
        @csrf
        <input type="text" name="city" id="city" placeholder="Введите город" class="form-control" required><br>
        <div class="radioButton">
            <div class="list-group mx-0 w-auto">
                <label class="list-group-item d-flex gap-2">
                    <input class="form-check-input flex-shrink-0" type="radio" name="listWeather" id="weather1" value="1" checked="">
                    <span>Погода сейчас</span>
                </label>
                <label class="list-group-item d-flex gap-2">
                    <input class="form-check-input flex-shrink-0" type="radio" name="listWeather" id="weather2" value="8">
                    <span>Погода на день</span>
                </label>
                <label class="list-group-item d-flex gap-2">
                    <input class="form-check-input flex-shrink-0" type="radio" name="listWeather" id="weather3" value="24">
                    <span>Погода на 3 дня</span>
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-light me-2">Узнать погоду</button>
    </form>

    @if(isset($cityWrongName))
        <p>Нет города с названием {{$cityWrongName}}</p>
    @endif

    <div class="weatherForADay">

    @if(isset($weather))
    @foreach($weather as $weatherNow)
    <div class="forecast_current current primpogoda">
        <div class="current__wrapper">
            <Img src="http://openweathermap.org/img/wn/{{$weatherNow['weather'][0]['icon']}}@2x.png" width="200" height="200">
            <div class="current__main">
                <div class="current__temperature">{{(int) $weatherNow['main']['temp']}}°</div>
                <div class="current__description">{{$weatherNow['weather'][0]['description']}}</div>
                <div class="current__feels-temperature">
                    При ветре ощущается как {{(int) $weatherNow['main']['feels_like']}}°
                </div>
                <div class="current__other">
                    <div class="current__other-item">
                        <div class="current__other-value">
                            {{(int) $weatherNow['wind']['speed']}} м/с
                        </div>
                        <div class="current__other-label">Ветер</div>
                    </div>
                    <div class="current__other-item">
                        <div class="current__other-value">{{$weatherNow['main']['humidity']}}%</div>
                        <div class="current__other-label">Влажность</div>
                    </div>
                    <div class="current__other-item">
                        <div class="current__other-value">{{$weatherNow['main']['pressure']}} мм.рт.ст.</div>
                        <div class="current__other-label">Давление</div>
                    </div>
                </div>    На момент {{ mb_substr($weatherNow['dt_txt'],5,11)}}

            </div>
        </div>
    </div>

    @endforeach
    @endif
    </div>
@endsection
