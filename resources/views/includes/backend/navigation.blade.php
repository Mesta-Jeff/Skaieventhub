<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <section>
        <a href="" class="logo text-center">
            <span class="logo-lg">
                <img src="{{ asset('root/hyp/assets/images/logo-sm.png') }}" alt=""
                    height="25">
                <strong
                    style="font-size: 22px; font-weight: bold; color: white; font-family: 'Segoe UI';">e</strong><span
                    class="logo-lg-text-dark" style="font-family: 'Segoe UI'; color: white;">Work</span>
            </span>
            <span class="logo-sm">
                <img src="{{ asset('root/hyp/assets/images/logo-sm.png') }}" alt=""
                    height="25">
            </span>
        </a>

        <!-- Brand Logo Dark -->
        <a href="" class="logo logo-dark">
            <span class="logo-lg">
                <img src="{{ asset('root/hyp/assets/images/logo-sm.png') }}" alt=""
                    height="25">
                <strong
                    style="font-size: 22px; font-weight: bold; color: #4C52A3; font-family: 'Segoe UI';">e</strong><span
                    class="logo-lg-text-dark" style="font-family: 'Segoe UI'; color: #4C52A3;">Work</span>
            </span>
            <span class="logo-sm">
                <img src="{{ asset('root/hyp/assets/images/logo-sm.png') }}" alt="small logo">
            </span>
        </a>
    </section>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right"
        title="Show Full Sidebar">
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
                <a href="#" class="side-nav-link">
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
                            <li id="my-days"><a href="#">My Days</a></li>
                            <li id="my-attendance"><a href="#">My Attendance</a></li>
                            <li id="my-payslip"><a href="#">My Payslip</a></li>
                            <li id="print-payslip"><a href="#">Print Payslip</a></li>
                            <li id="my-profile"><a href="#">My Profile</a></li>
                            <li id="approve-withdrawal"><a href="#">Approve Withdrawal</a></li>
                            <li id="request-new-contract"><a href="#">Request New Contract</a></li>
                            <li id="contract-statistics"><a href="#">Contract Statistics</a></li>
                            <li id="request-leave"><a href="#">Request Leave</a></li>
                            <li id="request-days"><a href="#">Request Days</a></li>
                            <li id="contract-statistics-2"><a href="#">Contract Statistics</a></li>
                            <li id="request-promotion"><a href="#">Request Promotion</a></li>
                            <li id="request-bank-statement"><a href="#">Request Bank Statement</a>
                            </li>
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
                            <li id="view-roles"><a href="#">View Roles</a></li>
                            <li id="view-permissions"><a href="#">View Permissions</a></li>
                            <li id="set-contract"><a href="#">Set Contract</a></li>
                            <li id="set-payslip"><a href="#">Set Payslip</a></li>
                            <li id="set-leave"><a href="#">Set Leave</a></li>
                            <li id="set-leave-claims"><a href="#">Set Leave Claims</a></li>
                            <li id="set-wage"><a href="#">Set Wage</a></li>
                            <li id="view-groups"><a href="#">View Groups</a></li>
                            <li id="configure-system"><a href="#">Configure System</a></li>

                        </ul>
                    </div>
                </li>

                <li class="side-nav-item" id="Full-Workers">
                    <a data-bs-toggle="collapse" href=".sidebarUser" aria-expanded="false"
                        aria-controls="sidebarUser" class="side-nav-link">
                        <i class="uil-users-alt"></i>
                        <span> Workers Management </span><span class="menu-arrow"></span>
                    </a>
                    <div class="collapse sidebarUser">
                        <ul class="side-nav-second-level">
                            <li id="view-casual-workers"><a href="#">View Casual Workers</a></li>
                            <li id="view-contract-workers"><a href="#">View Contract Workers</a></li>
                            <li id="view-permanent-workers"><a href="#">View Permanent Workers</a></li>
                            <li id="assign-worker-permission"><a href="#">Assign Worker Permission</a></li>
                            <li id="effect-promotion"><a href="#">Effect Promotion</a></li>

                        </ul>
                    </div>
                </li>

                <li class="side-nav-item" id="Full-Contracts">
                    <a data-bs-toggle="collapse" href=".sidebarContract" aria-expanded="false"
                        aria-controls="sidebarContract" class="side-nav-link">
                        <i class="uil-link"></i>
                        <span> Contract Manager</span><span class="menu-arrow"></span>
                    </a>
                    <div class="collapse sidebarContract">
                        <ul class="side-nav-second-level">
                            <li id="sign-contract"><a href="#">Sign Contract</a></li>
                            <li id="terminate-contract"><a href="#">Terminate Contract</a></li>
                            <li id="pending-contract-request"><a href="#">Pending Contract Request</a></li>
                            <li id="contract-review"><a href="#">Contract Review</a></li>
                            <li id="batch-assignment"><a href="#">Batch Assignment</a></li>
                            <li id="issue-contract-statement"><a href="#">Issue Contract Statement</a></li>
                            <li id="extend-contract-individual"><a href="#">Extend Contract Individual</a></li>
                            <li id="extend-group-contract"><a href="#">Extend Group Contract</a></li>

                        </ul>
                    </div>
                </li>

                <li class="side-nav-item" id="Full-Requests">
                    <a data-bs-toggle="collapse" href=".sidebarCrm" aria-expanded="false"
                        aria-controls="sidebarCrm" class="side-nav-link">
                        <i class="uil uil-tachometer-fast"></i>
                        <span class="badge bg-info text-white float-end">All</span>
                        <span> Requests </span>
                    </a>
                    <div class="collapse sidebarCrm">
                        <ul class="side-nav-second-level">
                            <li id="attendance-list"><a href="#">Attendance list</a></li>
                            <li id="workers-records"><a href="#">Workers Records</a></li>
                            <li id="requested-loans"><a href="#">Requested Loans</a></li>
                            <li id="account-minute"><a href="#">Account Minute</a></li>
                            <li id="promotion-claims"><a href="#">Promotion Claims</a></li>
                            <li id="leave-claims"><a href="#">Leave Claims</a></li>
                            <li id="excuse-duties"><a href="#">Excuse Duties</a></li>
                            <li id="requested-days"><a href="#">Requested Days</a></li>

                        </ul>
                    </div>
                </li>

                <li class="side-nav-item" id="Full-Leaves">
                    <a data-bs-toggle="collapse" href=".sidebarLeave" aria-expanded="false" aria-controls="sidebarLeave" class="side-nav-link">
                        <i class="uil-sliders-v-alt"></i>
                        <span> Leave Management </span><span class="menu-arrow"></span>
                    </a>
                    <div class="collapse sidebarLeave">
                        <ul class="side-nav-second-level">
                            <li id="leave-requests"><a href="#">Leave Requests</a></li>
                            <li id="requests-days"><a href="#">Requests Days</a></li>
                            <li id="pending-leaves"><a href="#">Pending Leaves</a></li>
                            <li id="due-leaves"><a href="#">Due Leaves</a></li>
                            <li id="enforce-leave"><a href="#">Enforce Leave</a></li>
                            <li id="reschedule-leave"><a href="#">Re-Schedule Leave</a></li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item" id="Full-Attendances">
                    <a data-bs-toggle="collapse" href=".sidebarAttendace" aria-expanded="false" aria-controls="sidebarAttendace" class="side-nav-link">
                        <i class="mdi mdi-barcode-scan"></i>
                        <span> Attendance Manager </span><span class="menu-arrow"></span>
                    </a>
                    <div class="collapse sidebarAttendace">
                        <ul class="side-nav-second-level">
                            <li id="upload-attendance"><a href="#">Upload Attendance</a></li>
                            <li id="remark-attendance"><a href="#">Remark Attendance</a></li>
                            <li id="review-attendance"><a href="#">Review Attendance</a></li>
                            <li id="check-days-worker"><a href="#">Check Days Worker</a></li>
                            <li id="check-group-days"><a href="#">Check Group Days</a></li>
                            <li id="days-claims"><a href="#">Days Claims</a></li>
                            <li id="generate-timetable"><a href="#">Generate Timetable</a></li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item" id="Full-Loans">
                    <a data-bs-toggle="collapse" href=".sidebarLoan" aria-expanded="false" aria-controls="sidebarLoan" class="side-nav-link">
                        <i class="mdi mdi-apple-keyboard-command"></i>
                        <span class="badge bg-info text-white float-end">Manager</span>
                        <span> Loan </span>
                    </a>
                    <div class="collapse sidebarLoan">
                        <ul class="side-nav-second-level">
                            <li id="process-loan"><a href="#">Process Loan</a></li>
                            <li id="approve-loan"><a href="#">Approve Loan</a></li>
                            <li id="loan-statements"><a href="#">Loan Statements</a></li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item" id="Full-Payslips">
                    <a data-bs-toggle="collapse" href=".sidebarPayslip" aria-expanded="false" aria-controls="sidebarPayslip" class="side-nav-link">
                        <i class="mdi mdi-cash-multiple"></i>
                        <span> Payslip </span><span class="menu-arrow"></span>
                    </a>
                    <div class="collapse sidebarPayslip">
                        <ul class="side-nav-second-level">
                            <li id="approve-payslip"><a href="#">Approve Payslip</a></li>
                            <li id="financial-ticket"><a href="#">Financial Ticket</a></li>
                            <li id="generate-pincode"><a href="#">Generate Pincode</a></li>
                            <li id="prepare-payslip"><a href="#">Prepare Payslip</a></li>
                            <li id="release-salary"><a href="#">Release Salary</a></li>
                            <li id="release-pincode"><a href="#">Release Pincode</a></li>
                            <li id="verify-payslip"><a href="#">Verify Payslip</a></li>
                            <li id="view-slip-ticket"><a href="#">View Slip Ticket</a></li>
                            <li id="withheld-payslip"><a href="#">Withheld Payslip</a></li>
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
                <h5 class="mt-3">eWork Upgrade Plan</h5>
                <p class="mb-3">Upgrade to plan to get access to unlimited reports</p>
                <a href="javascript: void(0);" class="btn btn-secondary btn-sm">Approve</a>
            </div>
            <!-- end Help Box -->

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
