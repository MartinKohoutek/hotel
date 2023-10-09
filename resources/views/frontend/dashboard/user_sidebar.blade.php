<div class="service-side-bar">
    @php
        $user = \App\Models\User::findOrFail(Auth::user()->id)
    @endphp
    <div class="services-bar-widget">
        <h3 class="title">User Dashboard</h3>
        <div class="side-bar-categories">
            <img src="{{ (!empty($user->photo)) ? url('/upload/user_images/'.$user->photo) : url('/upload/no_image.jpg') }}" class="rounded mx-auto d-block" alt="Image" style="width:100px; height:100px;">
            <div class="text-center mb-4 mt-4">
                <span class="mb-1" style="font-size: 20px">{{ $user->name }}</span><br>
                <span style="font-size: 16px;">{{ $user->email }}</span>
            </div>
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}">User Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('user.profile') }}">User Profile </a>
                </li>
                <li>
                    <a href="#">Change Password</a>
                </li>
                <li>
                    <a href="#">Booking Details </a>
                </li>
                <li>
                    <a href="#">Logout </a>
                </li>
            </ul>
        </div>
    </div>
</div>