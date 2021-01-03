@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
@endpush

@section('content')
    @include('modules.header')
    <main class="main">
        @include('modules.sidebar')
        <section class="content">
            <div class="container_table">
                <h2 class="page__title"><span class="icon material-icons">person</span>Пользователи</h2>
                <div class="table__col" id="table_id-wrap">
                    @can('manage-users')<button class="add" id="addGroup">Добавить группу</button>@endcan
                    <table class="display" id="table_groups">
                        <thead>
                            <tr>
                                <th>Название группы</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    <td>{{$group->name}}</td>
                                    <td>
                                        @can('manage-users', Model::class)
                                            <button class='actions-control'><span class='material-icons'>more_horiz</span></button>
                                            <div class="action-menu">
                                                <button class="action-btn editGroup" data-id="{{ $group->id }}"><span class="material-icons">edit</span></button>
                                                <form action="{{ route('destroyGroup', ['group' => $group->id]) }}" method="post">
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

        @can('manage-users')
            <div class="modalForm" id="modalAddGroup">
                <button class="modalForm__close" id="modalClose"><span class="material-icons">close</span></button>
                <form class="modalForm-control" action="{{ route('createGroup') }}" method="POST">
                    @csrf
                    <div class="modalForm__col">
                        <label for="project">Название группы:</label>
                        <input class="modalForm__control" id="groupname" type="text" name="groupname">
                    </div>
                    <div class="modalForm__col">
                        <div class="container">
                            <div class="item">
                                <div class="accordion__title">Привилегии <span class="material-icons icon">keyboard_arrow_down</span></div>
                                <div class="accordion__item">
                                    @foreach ($permission as $item)
                                        <label><input class="chkbox" type="checkbox" name="permission[]" value="{{ $item->id }}" > {{$item->name}}</label><br>
                                        {{-- <label>{{ Form::checkbox('permission[]', $item->id, false, array('class' => 'chkbox')) }} {{$item->name}} </label><br> --}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modalForm__col">
                        <input class="modalForm__submit" id="addNewGroup" type="submit" value="Добавить">
                    </div>
                </form>
            </div>
        @endcan
    </main>
@endsection

@push('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="{{ url('js/data.js') }}"></script>
    <script src="{{ url('js/mytables.js') }}"></script>
    <script src="{{ url('js/modalOpen.js') }}"></script>
@endpush