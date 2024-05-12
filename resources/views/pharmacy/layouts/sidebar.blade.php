<!-- Sidebar Start -->
<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo ">
      <a href="" class="text-nowrap logo-img">
        <img src="{{ asset('images/favicon.png') }}" width="50" class="d-block mx-auto pt-2" alt="" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('pharmacy.dashboard') }}" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">{{ translate('messages.dashboard') }}</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">{{ translate('messages.prescriptions') }}</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="" aria-expanded="false">
            <span>
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">{{ translate('messages.prescription_list') }}</span>
          </a>
        </li>
        <!-- Quotation -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">{{ translate('messages.quotations') }}</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="" aria-expanded="false">
            <span>
              <i class="fas fa-cogs"></i>
            </span>
            <span class="hide-menu">{{ translate('messages.quotation_list') }}</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->