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
                <h2 class="page__title"><span class="icon material-icons">assignment</span>Отчёты</h2>
                <div class="table__col" id="table_id-wrap">
                    <table class="display" id="table_reports">
                        <thead>
                            <tr>
                                <th>Описание</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr>
                                    <td>{{ $report->desc }}</td>
                                    <td>
                                        @can('manage-tables')
                                            <button class='actions-control'><span class='material-icons'>more_horiz</span></button>
                                            <div class="action-menu">
                                                <form action="{{ route('destroyReport', ['report' => $report->id]) }}" method="post">
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
    </main>
@endsection

@push('scripts')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script src="{{ url('js/data.js') }}"></script>
    <script src="{{ url('js/mytables.js') }}"></script>
@endpush