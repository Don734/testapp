@extends('layouts.app')

@section('content')
    @include('modules.header')
    <main class="main">
        @include('modules.sidebar')
        <section class="content">
            <div class="container">
                <h2 class="page__title"><span class="icon material-icons">border_all</span>Панель</h2>
                <div class="row">
                    <div class="col">
                        <div class="left-block">
                            <h4 class="col__title">Приход</h4>
                            <span class="numbers">{{ $coming }}</span>
                        </div>
                        <span class="material-icons icon bg-green">trending_up</span>
                        <div class="old-week">
                            <p class="old-week-name">На прошлой неделе: <span class="value">6</span></p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="left-block">
                            <h4 class="col__title">Расход</h4>
                            <span class="numbers">{{ $expens }}</span>
                        </div>
                        <span class="material-icons icon bg-red">trending_down</span>
                        <div class="old-week">
                            <p class="old-week-name">На прошлой неделе: <span class="value">6</span></p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="left-block">
                            <h4 class="col__title">Остаток</h4>
                            <span class="numbers">{{ $balance }}</span>
                        </div>
                        <span class="material-icons icon bg-yellow">trending_flat</span>
                        <div class="old-week">
                            <p class="old-week-name">На прошлой неделе: <span class="value">6</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection