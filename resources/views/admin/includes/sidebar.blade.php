<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">

            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="{{ route_is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li>

                @can('view-consultations')
                    <li class="submenu">
                        <a href="#"><i class="fe fe-star-o"></i> <span> Consultations</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ route_is('consultations.*') ? 'active' : '' }}"
                                    href="{{ route('consultations.index') }}">Consultations</a></li>
                            @can('create-consultations')
                                <li><a class="{{ route_is('consultations.create') ? 'active' : '' }}"
                                        href="{{ route('consultations.create') }}">Create Consultations</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('view-feedbacks')
                    <li class="submenu">
                        <a href="#"><i class="material-icons">feedback</i> <span> Feedback</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
							@can('index-feedbacks')
                            <li><a class="{{ route_is('feedbacks.*') ? 'active' : '' }}"
                                    href="{{ route('feedbacks.index') }}">Feedbacks</a></li>
							@endcan
                            @can('create-feedbacks')
                                <li><a class="{{ route_is('feedbacks.create') ? 'active' : '' }}"
                                        href="{{ route('feedbacks.create') }}">Create Feedbacks</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

				@can('view-records')
				<li class="submenu">
					<a href="#"><i class="fe fe-activity"></i><span> Records</span> <span
							class="menu-arrow"></span></a>
					<ul style="display: none;">
						@can('index-records')
						<li><a class="{{ route_is('records.*') ? 'active' : '' }}"
								href="{{ route('records.index') }}">Records</a></li>
						@endcan
						@can('create-records')
							<li><a class="{{ route_is('records.create') ? 'active' : '' }}"
									href="{{ route('records.create') }}">Create Records</a></li>
						@endcan
					</ul>
				</li>
			@endcan

                @can('view-payments')
                    <li class="submenu">
                        <a href="#"><i class="fe fe-document"></i> <span> Payments</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">

                            @can('my-payments')
                                <li><a class="{{ route_is('payment-history.my-payments') ? 'active' : '' }}"
                                        href="{{ route('payment-history.my-payments') }}">My payments</a></li>
                            @endcan
                            @can('all-payments')
                                <li><a class="{{ route_is('payment-history.*') ? 'active' : '' }}"
                                        href="{{ route('payment-history.all-payments') }}">All payments</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('view-access-control')
                    <li class="submenu">
                        <a href="#"><i class="fe fe-lock"></i> <span> Access Control</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @can('view-permission')
                                <li><a class="{{ route_is('permissions.index') ? 'active' : '' }}"
                                        href="{{ route('permissions.index') }}">Permissions</a></li>
                            @endcan
                            @can('view-role')
                                <li><a class="{{ route_is('roles.*') ? 'active' : '' }}"
                                        href="{{ route('roles.index') }}">Roles</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('view-users')
                    <li class="{{ route_is('users.*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}"><i class="fe fe-users"></i> <span>Users</span></a>
                    </li>
                @endcan

                <li class="{{ route_is('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}"><i class="fe fe-user-plus"></i> <span>Profile</span></a>
                </li>
                <li class="{{ route_is('backup.index') ? 'active' : '' }}">
                    <a href="{{ route('backup.index') }}"><i class="material-icons">backup</i>
                        <span>Backups</span></a>
                </li>

                @can('view-settings')
                    <li class="{{ route_is('settings') ? 'active' : '' }}">
                        <a href="{{ route('settings') }}">
                            <i class="material-icons">settings</i>
                            <span> Settings</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
