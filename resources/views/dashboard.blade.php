@extends('base.app')

@section('content')
    <div class="row mb-1">
        <div class="col-8">
            <div class="row">
                <div class="col-12 card">
                    <div class="row p-3">
                        <div class="col-8">
                            <h3>
                                @lang('messages.dashboard_welcome', [\Illuminate\Support\Facades\Auth::user()->name])
                            </h3>
                            <p class="lead">
                                Vaši učenci napredujejo.
                            </p>
                            <a href="{{ route('classrooms.edit', $classroom) }}" class="btn btn-primary">
                                @lang('messages.classroom_show_edit')
                            </a>
                        </div>
                        <div class="col-4 text-end">
                            <img style="width: 150px" src="{{ asset('img/dashboard_welcome_image.jpg') }}" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-3 p-0">
                    <div class="card me-3">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-6 col-7">
                                    <h6 class="my-auto">@lang('messages.dashboard_students_title')</h6>
                                </div>
                                <div class="col-lg-6 col-5 my-auto text-end">
                                        <a class="small text-muted" href="{{ route('classrooms.users.index', $classroom) }}">
                                            @lang('messages.dashboard_students_index_button')
                                        </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <tbody>
                                        @if(!$classroom->users()->exists())
                                            <tr>
                                                <td>
                                                    <div class="text-center">
                                                        @lang("messages.classroom_show_users_empty", [route('classrooms.users.create', $classroom)])
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                        @foreach($classroom->users as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src='https://avataaars.io/?avatarStyle=Circle&topType=ShortHairShortRound&accessoriesType=Blank&hairColor=BrownDark&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Light'
                                                                     class="avatar avatar-sm me-3"
                                                                />
                                                        </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                                <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                                            </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-3 p-0">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6 class="my-auto">@lang('messages.classroom_show_activity_title')</h6>
                        </div>
                        <div class="card-body p-2">
                            @if($gameUsers->isEmpty())
                                <div class="col text-center mb-2">
                                    @lang('messages.classroom_show_activity_empty')
                                </div>
                            @endif
                            @foreach($gameUsers as $gameUser)
                            <div class="timeline timeline-one-side">
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                    <i class="fa fa-user text-success text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">@lang('messages.classroom_show_activity_game_user_created', [$gameUser->user->name, $gameUser->game->homework->name])</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $gameUser->created_at->format('j. n. Y G:i') }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="ms-3 card row">
                <div class="col">
                    <div class="vanilla-calendar mx-auto px-0"></div>
                    @push('scripts')
                        <script>
                          const calendar = new VanillaCalendar(document.querySelector('.vanilla-calendar'), {
                            settings: {
                                selection: {
                                    day: false,
                                },
                            },
                            popups: @json($classroom->homeworks->mapWithKeys(fn ($item, $key) => [$item->available_at->format('Y-m-d') => ['modifier' => 'bg-red', 'html' => $item->available_at->format('G:i') . ' - ' . __('messages.classroom_index_calendar_homework_start') . $item->name]])->toArray())
                          });
                          calendar.init();
                        </script>
                    @endpush
                </div>
                <div class="col mb-2">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h5 class="my-auto">
                                @lang('messages.dashboard_homeworks_list_title')
                            </h5>
                        </div>
                        <div class="col-lg-6 col-5 my-auto text-end">
                            <a class="small text-muted" href="{{ route('classrooms.homeworks.index', $classroom) }}">
                                @lang('messages.dashboard_homeworks_index_button')
                            </a>
                        </div>
                    </div>
                </div>
                @if(!$classroom->homeworks()->exists())
                    <div class="col text-center mb-2">
                        @lang('messages.classroom_show_homeworks_empty', [route('classrooms.homeworks.create', $classroom)])
                    </div>
                @endif
                @foreach($homeworks as $homework)
                <div class="col">
                    <div class="card mb-3 p-2 shadow border border-primary">
                        <a href="{{ route('classrooms.homeworks.show', [$classroom, $homework]) }}">
                            <h6>{{ $homework->name }}</h6>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
