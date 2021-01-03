@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/fc-3.3.1/datatables.min.css"/>
@endpush

@section('content')
    @include('modules.header')
    <main class="main">
        @include('modules.sidebar')
        <section class="content">
            <div class="container_table">
                <h2 class="page__title"><span class="icon material-icons">table_chart</span>Таблицы</h2>
                <div class="table__col" id="table_id-wrap">
                    @can('manage-tables')
                        <button class="add" id="addTable">Добавить</button>
                    @endcan
                    <table class="display" id="table_id">
                        <thead>
                            <tr>
                                <th rowspan="2"></th>
                                <th rowspan="2">Проект</th>
                                <th rowspan="2">Описание</th>
                                <th rowspan="2">Наименование</th>
                                <th rowspan="2">Счёт №</th>
                                <th rowspan="2">Код продукта</th>
                                <th rowspan="2">Ед. изм.</th>
                                <th rowspan="1" colspan="2">Приход</th>
                                <th rowspan="1" colspan="2">Расход</th>
                                <th rowspan="1" colspan="2">Остаток</th>
                                <th rowspan="2"></th>
                            </tr>
                            <tr>
                                <th>Текущ.</th>
                                <th>Пред.</th>
                                <th>Текущ.</th>
                                <th>Пред.</th>
                                <th>Текущ.</th>
                                <th>Пред.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tables as $table)
                                <tr>
                                    <td><button class='details-control' data-id={{ $table->id }}><span class='material-icons'>expand_more</span></button></td>
                                    <td>{{ $table->project }}</td>
                                    <td>{{ $table->description }}</td>
                                    <td>{{ $table->name }}</td>
                                    <td>{{ $table->score }}</td>
                                    <td>{{ $table->codeprod }}</td>
                                    <td>{{ $table->unit }}</td>
                                    <td>{{ $table->comingcur }}</td>
                                    <td>{{ $table->comingprev }}</td>
                                    <td>{{ $table->expenscur }}</td>
                                    <td>{{ $table->expensprev }}</td>
                                    <td>{{ $table->balancecur }}</td>
                                    <td>{{ $table->balanceprev }}</td>
                                    <td>
                                        @can('manage-tables')
                                            <button class='actions-control'><span class='material-icons'>more_horiz</span></button>
                                            <div class="action-menu">
                                                <a class="action-btn" href=""><span class="material-icons">reply</span></a>
                                                <button class="action-btn editTable" data-id="{{ $table->id }}"><span class="material-icons">edit</span></button>
                                                <button class="action-btn editExpens" data-id="{{ $table->id }}"><span class="material-icons">trending_down</span></button>
                                                <form action="{{ route('destroyTable', ['table' => $table->id]) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="action-btn"><span class="material-icons">remove</span></button>
                                                </form>
                                            </div>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        @can('manage-tables')
            <div class="modalForm" id="modalTable">
                <button class="modalForm__close" id="modalClose"><span class="material-icons">close</span></button>
                <form class="modalForm-control" action="{{ route('createTable') }}" method="POST">
                    @csrf
                    <div class="modalForm__col">
                        <label for="project">Название проекта:</label>
                        <input class="modalForm__control" id="project" type="text" name="project">
                    </div>
                    <div class="modalForm__col">
                        <label for="description">Описание:</label>
                        <input class="modalForm__control" id="description" type="text" name="description">
                    </div>
                    <div class="modalForm__col">
                        <label for="name">Наименование:</label>
                        <input class="modalForm__control" id="name" type="text" name="name">
                    </div>
                    <div class="modalForm__col">
                        <label for="score">Счёт №:</label>
                        <input class="modalForm__control" id="score" type="text" name="score">
                    </div>
                    <div class="modalForm__col">
                        <label for="codeproduct">Код продукта:</label>
                        <input class="modalForm__control" id="codeproduct" type="text" name="codeproduct">
                    </div>
                    <div class="modalForm__col">
                        <label for="unit">Ед. изм.:</label>
                        <select class="modalForm__control" id="unit" name="unit">
                            <option value="шт.">шт.</option>
                            <option value="к-т.">к-т.</option>
                        </select>
                    </div>
                    <div class="modalForm__col">
                        <label for="comingcur">Количество:</label>
                        <input class="modalForm__control" id="comingcur" type="text" name="comingcur">
                        <input class="modalForm__control" id="comingprev" type="hidden" name="comingprev">
                    </div>
                    <div class="modalForm__col">
                        <input class="modalForm__submit" id="addNewTable" type="submit" value="Добавить">
                    </div>
                </form>
            </div>
            <div class="modalForm" id="modalExpens">
                <button class="modalForm__close" id="modalClose"><span class="material-icons">close</span></button>
                @foreach ($tables as $table)
                    <form class="modalFormExpens-control" action="{{ route('updateExpens', ['table' => $table->id]) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="modalForm__col">
                            <label for="expens">Расход:</label>
                            <input class="modalForm__control" id="expenscur" type="text" name="expenscur">
                            <input class="modalForm__control" id="expensprev" type="hidden" name="expensprev">
                            <input class="modalForm__control" id="balanceprev" type="hidden" name="balanceprev">
                            
                        </div>
                        <div class="modalForm__col">
                            <input class="modalForm__submit" type="submit" value="Сохранить">
                        </div>
                    </form>
                    @if ($loop->iteration == 1)
                        @break
                    @endif
                @endforeach
            </div>
        @endcan
    </main>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/fc-3.3.1/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script src="{{ url('js/data.js') }}"></script>
    <script src="{{ url('js/mytables.js') }}"></script>
    <script src="{{ url('js/whtables.js') }}"></script>
    <script src="{{ url('js/modalOpen.js') }}"></script>
@endpush