<style>
    /* Styles for screens with a maximum width of 768px */
@media (max-width: 768px) {
    /* Your CSS rules here */
    .hide_for_mobile{
        display: none !important;
    }
}

</style>
<ul class="nav navbar-nav navbar-left">
    <!-- Show Side Menu -->
    <li class="navbar-main hide_for_mobile">
        <a href="javascript:void(0);" class="toggleSidebar" title="Show sidebar">
            <span class="toggleMenuIcon">
                <span class="icon ico-menu"></span>
            </span>
        </a>
    </li>
    <!--/ Show Side Menu -->
    <li class="nav-button hide_for_mobile">
        {{-- <a target="_blank" href="{{ route('showOrganiserHome',[$organiser->id]) }}">
            <span>
                <i class="ico-eye2"></i>&nbsp;@lang("Organiser.organiser_page")
            </span>
        </a> --}}
        <a target="_blank" href="{{ route('events.index') }}">
            <span>
                <i class="ico-eye2"></i>&nbsp;@lang("Organiser.organiser_page")
            </span>
        </a>
    </li>
</ul>