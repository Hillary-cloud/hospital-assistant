<!-- Header -->
<div class="header">

    <!-- Logo -->
    <div class="header-left">
        <a href="{{ route('dashboard') }}" class="logo mt-3">
            {{-- <img src="@if (!empty(AppSettings::get('logo'))) {{asset('storage/'.AppSettings::get('logo'))}} @else{{asset('assets/img/logo.png')}} @endif" alt="Logo"> --}}
            <h4 class="text-dark">Hospital<span class="text-primary">Assistant</span></h4>
        </a>
        <a href="{{ route('dashboard') }}" class="logo logo-small mt-2">
            {{-- <img src="{{asset('assets/img/logo-small.png')}}" alt="Logo" width="30" height="30"> --}}
            <h1 class="font-bold">HA</h1>
        </a>
    </div>
    <!-- /Logo -->

    <a href="javascript:void(0);" id="toggle_btn">
        <i class="fe fe-text-align-left"></i>
    </a>

    <!-- Mobile Menu Toggle -->
    <a class="mobile_btn" id="mobile_btn">
        <i class="fa fa-bars"></i>
    </a>
    <!-- /Mobile Menu Toggle -->

    <!-- Header Right Menu -->
    <ul class="nav user-menu">
        <li class="nav-item dropdown">
            <a href="#" data-target="#add_sales" title="make a sale" data-toggle="modal"
                class="dropdown-toggle nav-link">
                <i class="fas fa-clipboard"></i>
            </a>
        </li>
        <!-- Notifications -->
        <li class="nav-item dropdown noti-dropdown">

            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <i class="fe fe-bell"></i> <span
                    class="badge badge-pill">{{ auth()->user()->unReadNotifications->count() }}</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="{{ route('mark-as-read') }}" class="clear-noti">Mark All As Read </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        @foreach (auth()->user()->unReadNotifications as $notification)
                            <li class="notification-message">
                                <a href="{{ route('read') }}">
                                    <div class="media">
                                        <span class="avatar avatar-sm">
                                            {{-- <img class="avatar-img rounded-circle" alt="Product image" src="{{asset('storage/purchases/'.$notification['image'])}}"> --}}
                                        </span>
                                        <div class="media-body">

                                            @if ($notification->type == 'App\Notifications\ApprovalNotification')
                                                <h6 class="text-success">Appointment Approved</h6>
                                                <p class="noti-details">
                                                    {{-- <span class="noti-title">{{$notification->data['symptoms']}} is only {{$notification->data['status']}} left.</span> --}}
                                                    <span>Your appointment has been approved. </span>
                                                </p>

                                                <p class="noti-time"><span
                                                        class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                                </p>
                                            @elseif($notification->type == 'App\Notifications\DeclineNotification')
                                                <h6 class="text-danger">Appointment Declined</h6>
                                                <p class="noti-details">
                                                    {{-- <span class="noti-title">{{$notification->data['symptoms']}} is only {{$notification->data['status']}} left.</span> --}}
                                                    <span>Your appointment has been declined, please try rescheduling
                                                        your appointment or contact us through our phone number to
                                                        reschedule. </span>
                                                </p>

                                                <p class="noti-time"><span
                                                        class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                                </p>
                                            @elseif($notification->type == 'App\Notifications\CreateConsultationNotification')
                                                @if (auth()->user()->hasRole('admin'))
                                                    <h6 class="text-warning">Appointment Scheduled</h6>
                                                    <p class="noti-details">
                                                        {{-- <span class="noti-title">{{$notification->data['symptoms']}} is only {{$notification->data['status']}} left.</span> --}}
                                                        <span>Appointment has been scheduled </span>
                                                    </p>

                                                    <p class="noti-time"><span
                                                            class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </p>
                                                @endif
                                            @else
                                            @endif

                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="#">View all Notifications</a>
                </div>
            </div>
        </li>
        <!-- /Notifications -->

        <!-- User Menu -->
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img"><img class="rounded-circle"
                        src="{{ !empty(auth()->user()->avatar) ? asset('storage/users/' . auth()->user()->avatar) : asset('assets/img/avatar.png') }}"
                        width="31" alt="avatar"></span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="{{ !empty(auth()->user()->avatar) ? asset('storage/users/' . auth()->user()->avatar) : asset('assets/img/avatar.png') }}"
                            alt="User Image" class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>{{ auth()->user()->name }}</h6>
                    </div>
                </div>

                <a class="dropdown-item" href="{{ route('profile') }}">My Profile</a>
                @can('view-settings')
                    <a class="dropdown-item" href="{{ route('settings') }}">Settings</a>
                @endcan

                <a href="javascript:void(0)" class="dropdown-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn">Logout</button>
                    </form>
                </a>
            </div>
        </li>
        <!-- /User Menu -->

    </ul>
    <!-- /Header Right Menu -->

</div>
<!-- /Header -->
