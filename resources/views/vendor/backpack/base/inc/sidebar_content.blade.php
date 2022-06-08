<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="nav-icon la la-dashboard"></i> {{ trans('backpack::base.dashboard') }}</a></li>
@if(App\Helpers::allowedAdminUsers([App\Constants\AdminUserType::SUPER_ADMIN]))
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-users'></i> Users</a></li>
@endif
<li class='nav-item nav-dropdown'>
    <a class='nav-link nav-dropdown-toggle' href="#"><i class="nav-icon la la-pencil"></i> Submissions </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('contact-us') }}'><i class='nav-icon la la-inbox'></i> Contact us</a></li>
        @if(App\Helpers::allowedAdminUsers([App\Constants\AdminUserType::SUPER_ADMIN, App\Constants\AdminUserType::ELITE_ONLY]))
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('elite-services') }}'><i class='nav-icon la la-star-o'></i> Elite Services</a></li>
        @endif
        @if(App\Helpers::allowedAdminUsers([App\Constants\AdminUserType::SUPER_ADMIN, App\Constants\AdminUserType::GA]))
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('general-services') }}'><i class='nav-icon la la-plane'></i> General Aviation </a></li>
        @endif
    </ul>
</li>
@if(App\Helpers::allowedAdminUsers([App\Constants\AdminUserType::SUPER_ADMIN]))
<li class='nav-item nav-dropdown'>
    <a class='nav-link nav-dropdown-toggle' href="#"><i class="nav-icon la la-th-list"></i> Metadata </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('airport') }}'><i class='nav-icon la la-plane'></i> Airports</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('country') }}'><i class='nav-icon la la-globe'></i> Countries</a></li>
    </ul>
</li>
@endif
