@extends('base.app')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css">
    @endpush
    @push('scripts')
        <script
            src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
            crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>
        <script>
            $(document).ready( function () {
                var table = $('.table').DataTable({
                    select: {
                        style: 'multi'
                    }
                });
                $('#classroom-students-add-button').click(function() {
                    var selected = table.rows({selected: true}).data();
                    var studentIds = [];
                    for (var i = 0; i < selected.length; i++) {
                        studentIds.push(selected[i][0]);
                    }
                    $('<form action="{{ route('classrooms.users.store', $classroom->id) }}" method="POST">' +
                        '<input type="hidden" name="users" value="' + studentIds + '">' +
                        '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                        '</form>')
                        .appendTo('body')
                        .submit();

                });

            } );
        </script>
    @endpush
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card card-body mb-4 blur shadow-blur overflow-hidden">
                    <div class="row gx-4">
                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h2 class="mb-1">
                                    @lang('messages.classroom_users_create_title', [$classroom->name])
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="table-responsive p-3">
                    <table class="table table-hover text-white">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('messages.user_index_column_name')</th>
                                <th scope="col">@lang('messages.user_index_column_created_at')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->created_at->format('j. n. Y G:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mt-4 pt-3">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button type="button" id="classroom-students-add-button" onclick="this.disabled=true; this.value='@lang("messages.dataform_sending")';" class="btn btn-success">@lang("messages.save")</button>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-secondary" href="{{ route('classrooms.users.index', $classroom) }}">@lang("messages.cancel")</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
