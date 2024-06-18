<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <section>
        <a href="" class="logo text-center">
            <span class="logo-lg">
                <img src="{{ asset('root/hyp/assets/images/logo-sm.png') }}" alt=""
                    height="25">
                <strong style="font-size: 22px; font-weight: bold; color: white; font-family: 'Segoe UI';">{{ env('APP_NAME')}}</strong>
                {{-- <span class="logo-lg-text-dark" style="font-family: 'Segoe UI'; color: white;">-TICK</span> --}}
            </span>
            <span class="logo-sm">
                <img src="{{ asset('root/hyp/assets/images/logo-sm.png') }}" alt="" height="25">
            </span>
        </a>
    </section>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title" style="margin: -30px 0px -30px 0px">
                <hr>
            </li>
            <li class="side-nav-item">

                @if(session('batch') === 'skaimount')
                <a href="{{ route('management.dashboard')}}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span>Go Home</span>
                </a>
                @endif
                <a href="{{ route('client.dashboard')}}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span>Go Home</span>
                </a>
            </li>

            <!-- Middle Nav -->
            <section>
                <li class="side-nav-title">hr console</li>
                <li class="side-nav-item">
                    <a href="#" class="side-nav-link">
                        <i class="uil-folder"></i>
                        <span>My Logs </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="#" class="side-nav-link">
                        <i class="uil-comments-alt"></i>
                        <span> Chat </span>
                    </a>
                </li>

                <li class="side-nav-item" id="Full-Accounts">
                    <a data-bs-toggle="collapse" href=".sidebarAccount" aria-expanded="false"
                        aria-controls="sidebarAccount" class="side-nav-link">
                        <i class="mdi mdi-account-key-outline"></i>
                        <span>My Account </span><span class="menu-arrow"></span>
                    </a>
                    <div class="collapse sidebarAccount">
                        <ul class="side-nav-second-level">
                            <li id="issue-concern"><a href="#">Issue Concern</a></li>
                            <li id="request-refund"><a href="#">Request Refund</a></li>
                            <li id="enable-2fa"><a href="#">Enable 2FA</a></li>
                            <li id="my-profile"><a href="#">My Profile</a></li>
                            <li id="cash-out"><a href="#">Cash Out</a></li>
                            <li id="bank-statement"><a href="#">Bank Statement</a></li>
                            <li id="live-event"><a href="#">Live Event</a></li>
                            <li id="cast-stream"><a href="#">Cast Stream</a></li>
                            <li id="alert-management"><a href="#">Alert Management</a></li>
                            <li id="chat-friend"><a href="#">Chat Friend</a></li>
                            <li id="read-policy"><a href="#">Read Policy</a></li>
                            <li id="contact-management"><a href="#">Contact Management</a></li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item" id="Full-Settings">
                    <a data-bs-toggle="collapse" href=".sidebarSystem" aria-expanded="false"
                        aria-controls="sidebarSystem" class="side-nav-link">
                        <i class="uil-cog"></i>
                        <span> System Settings </span><span class="menu-arrow"></span>
                    </a>
                    <div class="collapse sidebarSystem">
                        <ul class="side-nav-second-level">
                            <li id="view-roles"><a href="{{ route("settings.roles.show")}}">View Roles</a></li>
                            <li id="view-permissions"><a href="{{ route('settings.permissions.show')}}">View Permissions</a></li>
                            <li id="view-regions"><a href="{{ route('settings.regions.show')}}">View Regions</a></li>
                            <li id="view-districts"><a href="{{ route('settings.districts.show')}}">View Districts</a></li>
                            <li id="view-towns"><a href="{{ route('settings.towns.show')}}">View Towns</a></li>
                            <li id="view-identities"><a href="{{ route('settings.identitytypes.show')}}">View Identities</a></li>
                            <li id="view-notifications"><a href="{{ route('settings.notifications.show')}}">View Notifications</a></li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item" id="Full-Users">
                    <a data-bs-toggle="collapse" href=".sidebarUser" aria-expanded="false"
                        aria-controls="sidebarUser" class="side-nav-link">
                        <i class="uil-users-alt"></i>
                        <span> User Management </span><span class="menu-arrow"></span>
                    </a>
                    <div class="collapse sidebarUser">
                        <ul class="side-nav-second-level">
                            <li id="view-user"><a href="{{route("users.show")}}">View Users</a></li>
                            <li id="suspended-users"><a href="#">Suspended Users</a></li>
                            <li id="reset-password"><a href="#">Reset Password</a></li>
                            <li id="assign-user-role"><a href="#">Assign User Role</a></li>
                            <li id="assign-user-permission"><a href="#">Assign User Permission</a></li>
                            <li id="user-logs"><a href="#">User Logs</a></li>
                            <li id="user-event-history"><a href="#">User Event History</a></li>
                            <li id="user-apikeys"><a href="#">User Apikeys</a></li>
                            <li id="user-statistics"><a href="#">Users Statistics</a></li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item" id="Full-Events">
                    <a data-bs-toggle="collapse" href=".sidebarContract" aria-expanded="false"
                        aria-controls="sidebarContract" class="side-nav-link">
                        <i class="uil-link"></i>
                        <span> Event Manager</span><span class="menu-arrow"></span>
                    </a>
                    <div class="collapse sidebarContract">
                        <ul class="side-nav-second-level">
                            <li id="view-event"><a href="{{ route('events.show')}}">View Event</a></li>
                            @if(session('batch') === 'skaimount')
                                <li id="create-event"><a href="{{ route('events.setting-up')}}">Create Event</a></li>
                                <li id="view-event-type"><a href="{{ route('events.types.show')}}">View Event Type</a></li>
                                <li id="view-author"><a href="{{ route('events.authors.show')}}">View Author</a></li>
                            @endif

                            {{-- <li id="view-comments"><a href="{{ route('events.comments.show')}}">View Comments</a></li> --}}
                            {{-- <li id="view-likes"><a href="{{ route('events.likes.show')}}">View Likes</a></li> --}}
                            {{-- <li id="view-star"><a href="{{ route('events.stars.show')}}">View Star</a></li> --}}
                            {{-- <li id="view-ticket"><a href="{{ route('events.tickets.show')}}">View Ticket</a></li> --}}

                            <li id="event-statistics"><a href="#">Event Statistics</a></li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item" id="Full-Payments">
                    <a data-bs-toggle="collapse" href=".sidebarCrm" aria-expanded="false"
                        aria-controls="sidebarCrm" class="side-nav-link">
                        <i class="uil uil-tachometer-fast"></i>
                        <span class="badge bg-info text-white float-end">All</span>
                        <span> Payments </span>
                    </a>
                    <div class="collapse sidebarCrm">
                        <ul class="side-nav-second-level">
                            <li id="sold-tickets"><a href="#">Sold Tickets</a></li>
                            <li id="view-refund"><a href="#">View Refund</a></li>
                            <li id="view-payout"><a href="#">View Payout</a></li>
                            <li id="approve-payout"><a href="#">Approve Payout</a></li>
                            <li id="decline-payout"><a href="#">Decline Payout</a></li>
                            <li id="approve-refund"><a href="#">Approve Refund</a></li>
                            <li id="request-payout"><a href="#">Request Payout</a></li>
                            <li id="request-refund"><a href="#">Request Refund</a></li>
                            <li id="payment-statistics"><a href="#">Payment Statistics</a></li>
                            <li id="credit-user"><a href="#">Credit User</a></li>
                            <li id="initialize-payment"><a href="#">Initialize Payment</a></li>
                            <li id="authorize-payment"><a href="#">Authorize Payment</a></li>
                            <li id="my-approvals"><a href="#">My Approvals</a></li>
                            <li id="pending-user-approvals"><a href="#">Pending User Approvals</a></li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item" id="Full-Configuration">
                    <a data-bs-toggle="collapse" href=".sidebarLeave" aria-expanded="false" aria-controls="sidebarLeave" class="side-nav-link">
                        <i class="uil-sliders-v-alt"></i>
                        <span> General Confuguration </span><span class="menu-arrow"></span>
                    </a>
                    <div class="collapse sidebarLeave">
                        <ul class="side-nav-second-level">
                            <li id="sms-subscribers"><a href="#">SMS Subscribers</a></li>
                            <li id="sms"><a href="#">SMS</a></li>
                            <li id="email"><a href="#">Email</a></li>
                            <li id="users-concerns"><a href="#">Users Concerns</a></li>
                            <li id="advertisements"><a href="#">Advertisements</a></li>
                            <li id="api-routes"><a href="#">API Routes</a></li>
                            <li id="documentations"><a href="#">Documentations</a></li>
                            <li id="policy"><a href="#">Policy</a></li>
                            <li id="about-us"><a href="#">About Us</a></li>
                            <li id="messages"><a href="#">Messages</a></li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item">
                    <a href="#" class="side-nav-link">
                        <i class="uil-keyhole-square"></i>
                        <span> Logout</span>
                    </a>
                </li>


            </section>
            <!-- End of Middle Nav -->

            <!-- Help Box -->
            <div class="help-box text-white text-center">
                <a href="javascript: void(0);" class="float-end iclose-btn text-white">
                    <i class="mdi mdi-close"></i>
                </a>
                <img src="{{ asset('root/hyp/assets/images/svg/help-icon.svg') }}" height="90"
                    alt="Helper Icon Image" />
                <h5 class="mt-3">{{ env('APP_NAME')}} Upgrade Plan</h5>
                <p class="mb-3">Upgrade to plan to get access to unlimited reports</p>
                <a href="javascript: void(0);" class="btn btn-secondary btn-sm">Approve</a>
            </div>
            <!-- end Help Box -->

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
