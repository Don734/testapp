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
                    @can('manage-users')
                        <button class="add" id="addUser">Добавить пользователя</button>
                    @endcan
                    <table class="display" id="table_users">
                        <thead>
                            <tr>
                                <th>Почта</th>
                                <th>Имя Фамилия</th>
                                <th>Телефон</th>
                                <th>Группа</th>
                                <th>Дата создания</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->fullname}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->group}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        @can('manage-users')
                                            <button class='actions-control'><span class='material-icons'>more_horiz</span></button>
                                            <div class="action-menu">
                                                <button class="action-btn editUser" data-id="{{ $user->id }}"><span class="material-icons">edit</span></button>
                                                <form action="{{ route('destroyUser', ['user' => $user->id]) }}" method="post">
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
            <div class="modalForm" id="modalAddUser">
                <button class="modalForm__close" id="modalClose"><span class="material-icons">close</span></button>
                <form class="modalForm-control" action="{{ route('createUser') }}" method="POST">
                    @csrf
                    <div class="modalForm__col">
                        <label for="fullname">Имя:</label>
                        <input class="modalForm__control" id="fullname" type="text" name="fullname">
                    </div>
                    <div class="modalForm__col">
                        <label for="email">Почта:</label>
                        <input class="modalForm__control" id="email" type="text" name="email" required>
                    </div>
                    <div class="modalForm__col">
                        <label for="password">Пароль:</label>
                        <input class="modalForm__control" id="password" type="password" name="password" required>
                    </div>
                    <div class="modalForm__col">
                        <label for="phone">Телефон:</label>
                        <input class="modalForm__control" id="phone" type="text" name="phone">
                    </div>
                    <div class="modalForm__col">
                        <label for="group">Группа:</label>
                        <select class="modalForm__control" id="group" name="group" required>
                            @foreach ($groups as $group)
                                <option value="{{ $group->name }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modalForm__col">
                        <input class="modalForm__submit" id="addNewUser" type="submit" value="Добавить">
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