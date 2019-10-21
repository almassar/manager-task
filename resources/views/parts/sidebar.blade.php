<div class="title-reminder {{ Auth::user()->unreadNotifications->isNotEmpty() ? 'reminder-animation': '' }}">
    @if(Auth::user()->unreadNotifications->isEmpty())
        <i class="fas fa-tasks"></i>
        Задачи
    @else
        <i class="far fa-bell"></i>
        Уведомления
    @endif
</div>

<div class="notifications">
    @foreach(Auth::user()->unreadNotifications as $notification)
        <notification id="{{ $notification->id }}" link="{{ url($notification->data['link']) }}">
             <span slot="title">
                 {{ $notification->data['title'] }}
             </span>

            {{ $notification->data['message'] }}
        </notification>
    @endforeach
</div>

@if(Auth::user()->unreadNotifications->isEmpty())
    @if(app('reminders')->count() > 0)
        <div class="reminders">
            <ul>
                @foreach(app('reminders') as $reminder)
                    <li>
                        <span>
                            {{ date('d.m', strtotime($reminder->date_execute)) }}
                        </span>
                        <a href="{{ url('task-form/'.$reminder->id) }}">
                            {{ $reminder->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <div class="reminders">
            <ul>
                <li>
                    задач нет
                </li>
            </ul>
        </div>
    @endif
@endif

