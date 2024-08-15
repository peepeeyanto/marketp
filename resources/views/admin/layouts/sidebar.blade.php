<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">marketp</a>
      </div>

      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('admin.dashboard') }}">ADM</a>
      </div>

      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>

        <li class="dropdown active">
          <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>

        <li class="menu-header">Starter</li>

        <li class="dropdown {{ setActive([
            'admin.slider.*',
            'admin.category.*',
            'admin.subcategory.*',
        ]) }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage website</span></a>
          <ul class="dropdown-menu">
            <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link" href="{{ route('admin.slider.index') }}">Slider</a></li>
          </ul>
          <ul class="dropdown-menu">
            <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link" href="{{ route('admin.category.index') }}">Category</a></li>
          </ul>
          <ul class="dropdown-menu">
            <li class="{{ setActive(['admin.subcategory.*']) }}"><a class="nav-link" href="{{ route('admin.subcategory.index') }}">Subcategory</a></li>
          </ul>
        </li>

        <li class="dropdown {{ setActive([
            'admin.vendor-profile.*',
            'admin.products.*',
            'admin.vendor-product.*',
            'admin.shipping-rule.*'
            ])
            }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Commerce</span></a>
            <ul class="dropdown-menu">
              <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link" href="{{ route('admin.vendor-profile.index') }}">Profil Penjual Admin</a></li>
              <li class="{{ setActive(['admin.products.*']) }}"><a class="nav-link" href="{{ route('admin.products.index') }}">Produk</a></li>
              <li class="{{ setActive(['admin.vendor-product.*']) }}"><a class="nav-link" href="{{ route('admin.vendor-product.index') }}" }}">Produk Penjual</a></li>
              <li class="{{ setActive(['admin.shipping-rule.*']) }}"><a class="nav-link" href="{{ route('admin.shipping-rule.index') }}">Shipping</a></li>
            </ul>
        </li>



        {{-- <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
              <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
              <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
            </ul>
        </li> --}}
        {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li> --}}
      </ul>

      {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
          <i class="fas fa-rocket"></i> Documentation
        </a>
      </div> --}}
    </aside>
</div>
