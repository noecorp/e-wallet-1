<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <li class="nav-item  ">
                <a href="{{ url('admin/') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Home</span>
                </a>
            </li>

			<li class="nav-item start ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">Users</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start ">
                        <a href="{{ url('admin/users') }}" class="nav-link ">
                            <i class="icon-user"></i>
                            <span class="title">All Users</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="{{ url('admin/users/new') }}" class="nav-link ">
                            <i class="icon-user-following"></i>
                            <span class="title">New User</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item start ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-list"></i>
                    <span class="title">Reports</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start ">
                        <a href="{{ url('admin/reports/deposits') }}" class="nav-link ">
                            <i class="icon-cloud-upload"></i>
                            <span class="title">Deposits Report</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="{{ url('admin/reports/withdrawals') }}" class="nav-link ">
                            <i class="icon-cloud-download"></i>
                            <span class="title">Withdrawals Report</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="{{ url('admin/reports/transactions') }}" class="nav-link ">
                            <i class="icon-directions"></i>
                            <span class="title">Transactions Report</span>
                        </a>
                    </li>
                </ul>
            </li>

		</ul>
	</div><!-- end of page-sidebar -->
</div><!-- end of pagee-sidebar-wrapper -->