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
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-spa'></i>
                </div>
                <div class="menu-title">Manage Team</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.team') }}"><i class="bx bx-right-arrow-alt"></i>All Team Members</a>
                </li>
                <li> <a href="{{ route('add.team') }}"><i class="bx bx-right-arrow-alt"></i>Add Team Member</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Sections Setup</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart-alt'></i>
                </div>
                <div class="menu-title">Manage About Us</div>
            </a>
            <ul>
                <li> <a href="{{ route('about.us.update') }}"><i class="bx bx-right-arrow-alt"></i>Update About Us</a>
                </li>
                <li> <a href="ecommerce-products-details.html"><i class="bx bx-right-arrow-alt"></i>Product Details</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart-alt'></i>
                </div>
                <div class="menu-title">Testimonial</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.testimonial') }}"><i class="bx bx-right-arrow-alt"></i>All Testimonial</a>
                </li>
                <li> <a href="{{ route('add.testimonial') }}"><i class="bx bx-right-arrow-alt"></i>Add Testimonial</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Manage Rooms</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart-alt'></i>
                </div>
                <div class="menu-title">Manage Rooms</div>
            </a>
            <ul>
                <li> <a href="{{ route('room.type.list') }}"><i class="bx bx-right-arrow-alt"></i>Room Type List</a>
                </li>
                <li> <a href="ecommerce-products-details.html"><i class="bx bx-right-arrow-alt"></i>Product Details</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Booking Manage</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart-alt'></i>
                </div>
                <div class="menu-title">Manage Rooms</div>
            </a>
            <ul>
                <li> <a href="{{ route('booking.list') }}"><i class="bx bx-right-arrow-alt"></i>Booking List</a>
                </li>
                <li> <a href="{{ route('add.room.list') }}"><i class="bx bx-right-arrow-alt"></i>Add Booking</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-gift'></i>
                </div>
                <div class="menu-title">Manage Room List</div>
            </a>
            <ul>
                <li> <a href="{{ route('room.list.view') }}"><i class="bx bx-right-arrow-alt"></i>Manage Room List</a>
                </li>
                <li> <a href="component-accordions.html"><i class="bx bx-right-arrow-alt"></i>Accordions</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-gift'></i>
                </div>
                <div class="menu-title">Settings</div>
            </a>
            <ul>
                <li> <a href="{{ route('smtp.setting') }}"><i class="bx bx-right-arrow-alt"></i>SMTP Setting</a>
                </li>
                <li> <a href="component-accordions.html"><i class="bx bx-right-arrow-alt"></i>Accordions</a>
                </li>
            </ul>
        </li>
       
        <li class="menu-label">Others</li>
        <li>
            <a href="#" target="_blank">
                <div class="parent-icon"><i class='bx bx-headphone'></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>