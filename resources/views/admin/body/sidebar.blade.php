<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">CheapHotel</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
       
        @if (Auth::user()->can('booking.menu') || Auth::user()->can('booking.report.menu') || Auth::user()->can('room.list.menu') || Auth::user()->can('room.type.menu'))
        <li class="menu-label">Bookings</li>
        @endif
        @if (Auth::user()->can('booking.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx bx-calendar-star'></i>
                </div>
                <div class="menu-title">Booking</div>
            </a>
            <ul>
                @if (Auth::user()->can('booking.list'))
                <li> <a href="{{ route('booking.list') }}"><i class="bx bx-right-arrow-alt"></i>Booking List</a>
                </li>
                @endif
                @if (Auth::user()->can('booking.add'))
                <li> <a href="{{ route('add.room.list') }}"><i class="bx bx-right-arrow-alt"></i>Add Booking</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if (Auth::user()->can('booking.report.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-search-alt-2'></i>
                </div>
                <div class="menu-title">Booking Report</div>
            </a>
            <ul>
                <li> <a href="{{ route('booking.report') }}"><i class="bx bx-right-arrow-alt"></i>Booking Report</a>
                </li>
            </ul>
        </li>
        @endif
        @if (Auth::user()->can('room.list.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-list-ul'></i>
                </div>
                <div class="menu-title">Room List</div>
            </a>
            <ul>
                @if (Auth::user()->can('room.list.view'))
                <li> <a href="{{ route('room.list.view') }}"><i class="bx bx-right-arrow-alt"></i>Room List</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if (Auth::user()->can('room.type.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-layer'></i>
                </div>
                <div class="menu-title">Room Types</div>
            </a>
            <ul>
                @if (Auth::user()->can('room.type.list'))
                <li> <a href="{{ route('room.type.list') }}"><i class="bx bx-layer"></i>Room Types</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
 
        @if (Auth::user()->can('aboutus.menu') || Auth::user()->can('team.menu') || Auth::user()->can('testimonial.menu'))
        <li class="menu-label">Sections Setup</li>
        @endif
        @if (Auth::user()->can('aboutus.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx bx-command'></i>
                </div>
                <div class="menu-title">About Us</div>
            </a>
            <ul>
                @if (Auth::user()->can('aboutus.update'))    
                <li> <a href="{{ route('about.us.update') }}"><i class="bx bx-right-arrow-alt"></i>About Us</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if(Auth::user()->can('team.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-spa'></i>
                </div>
                <div class="menu-title">Team</div>
            </a>
            <ul>
                @if(Auth::user()->can('team.all'))
                <li> <a href="{{ route('all.team') }}"><i class="bx bx-right-arrow-alt"></i>All Team Members</a>
                </li>
                @endif
                @if(Auth::user()->can('team.add'))
                <li> <a href="{{ route('add.team') }}"><i class="bx bx-right-arrow-alt"></i>Add Team Member</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if (Auth::user()->can('testimonial.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-world'></i>
                </div>
                <div class="menu-title">Testimonials</div>
            </a>
            <ul>
                @if (Auth::user()->can('testimonial.all'))    
                <li> <a href="{{ route('all.testimonial') }}"><i class="bx bx-right-arrow-alt"></i>All Testimonials</a>
                </li>
                @endif
                @if (Auth::user()->can('testimonial.add'))
                <li> <a href="{{ route('add.testimonial') }}"><i class="bx bx-right-arrow-alt"></i>Add Testimonial</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        <li class="menu-label">Restaurant</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-envelope-open'></i>
                </div>
                <div class="menu-title">Restaurant Menu</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.menu.category') }}"><i class="bx bx-right-arrow-alt"></i>Menu Categories</a>
                </li>
            </ul>
        </li>

        @if (Auth::user()->can('messages.menu') || Auth::user()->can('blog.menu'))
        <li class="menu-label">Messages & Blog</li>
        @endif
        @if (Auth::user()->can('messages.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-envelope-open'></i>
                </div>
                <div class="menu-title">Messages</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.contact.message') }}"><i class="bx bx-right-arrow-alt"></i>Messages</a>
                </li>
            </ul>
        </li>
        @endif
        @if (Auth::user()->can('blog.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-news'></i>
                </div>
                <div class="menu-title">Blog</div>
            </a>
            <ul>
                @if (Auth::user()->can('blog.category.list'))
                <li> <a href="{{ route('blog.category') }}"><i class="bx bx-right-arrow-alt"></i>Categories</a>
                </li>
                @endif
                @if (Auth::user()->can('blog.post.list'))
                <li> <a href="{{ route('all.blog.post') }}"><i class="bx bx-right-arrow-alt"></i>Posts</a>
                </li>
                @endif
                @if (Auth::user()->can('blog.comment.list'))
                <li> <a href="{{ route('all.comment') }}"><i class="bx bx-right-arrow-alt"></i>Comments</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('employee.menu') || Auth::user()->can('role.permission.menu'))
        <li class="menu-label">Manage Employees</li>
        @endif
        @if (Auth::user()->can('employee.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-user-pin'></i>
                </div>
                <div class="menu-title">Manage Employees</div>
            </a>
            <ul>
                @if (Auth::user()->can('employee.list'))
                <li> <a href="{{ route('all.admin') }}"><i class="bx bx-right-arrow-alt"></i>All Employees</a>
                </li>
                @endif
                @if (Auth::user()->can('employee.add'))
                <li> <a href="{{ route('add.admin') }}"><i class="bx bx-right-arrow-alt"></i>Add Employee</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if (Auth::user()->can('role.permission.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-shield-x'></i>
                </div>
                <div class="menu-title">Role & Permisson</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.permission') }}"><i class="bx bx-right-arrow-alt"></i>All Permission</a>
                </li>
                <li> <a href="{{ route('all.roles') }}"><i class="bx bx-right-arrow-alt"></i>All Roles</a>
                </li>
                <li> <a href="{{ route('all.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>All Roles in Permission</a>
                </li>
            </ul>
        </li>
        @endif
        @if (Auth::user()->can('setting.smtp') || Auth::user()->can('setting.site') || Auth::user()->can('setting.gallery.list'))
        <li class="menu-label">Settings</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-cog'></i>
                </div>
                <div class="menu-title">Settings</div>
            </a>
            <ul>
                @if (Auth::user()->can('setting.smtp'))
                <li> <a href="{{ route('smtp.setting') }}"><i class="bx bx-right-arrow-alt"></i>SMTP Setting</a>
                </li>
                @endif
                @if (Auth::user()->can('setting.site'))
                <li> <a href="{{ route('site.setting') }}"><i class="bx bx-right-arrow-alt"></i>Site Setting</a>
                </li>
                @endif
                @if (Auth::user()->can('setting.gallery.list'))
                <li> <a href="{{ route('all.gallery.setting') }}"><i class="bx bx-right-arrow-alt"></i>Gallery Setting</a>
                </li>
                @endif
            </ul>
        </li>   
        @endif
    </ul>
    <!--end navigation-->
</div>