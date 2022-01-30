<li class="nav-item dropdown header-nav-dropdown {{ $messagesFromComposer->count() > 0 ? 'has-notified' : '' }}">
    <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fas fa-envelope-open-text"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
        <div class="dropdown-arrow"></div>
        <h6 class="dropdown-header stop-propagation">
            <span>{{ __('Messages') }}</span>
            @if($messagesFromComposer->count() > 0)
                <a href="{{ route('admin.messages.mark-all-as-read') }}"> {{ __('Mark all as read') }} </a>
            @endif
        </h6>
        <div class="dropdown-scroll perfect-scrollbar">
            @forelse($messagesFromComposer as $messageFromComposer)
                <a href="{{ route('admin.messages.show', $messageFromComposer) }}" class="dropdown-item unread">
                    <div class="user-avatar">
                        <img src="{{ asset('assets/images/avatars/placeholder.jpg') }}" alt="">
                    </div>
                    <div class="dropdown-item-body">
                        <p class="subject"> {{ $messageFromComposer->phone }} </p>
                        <p class="text text-truncate"> {{ $messageFromComposer->name }} </p>
                        <span class="date"> {{ optional($messageFromComposer->created_at)->diffForHumans() }} </span>
                    </div>
                </a>
            @empty
                <div class="dropdown-item">
                    <i>{{ __('No unread message.') }}</i>
                </div>
            @endforelse
        </div>
        <a href="{{ route('admin.messages') }}" class="dropdown-footer">
            {{ __('All messages') }}<i class="fas fa-fw fa-long-arrow-alt-right"></i>
        </a>
    </div>
</li>
