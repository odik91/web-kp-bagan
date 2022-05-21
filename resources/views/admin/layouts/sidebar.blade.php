<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
      <div class="nav">
        <div class="sb-sidenav-menu-heading">Main Menu</div>
        <a class="nav-link" href="{{ route('home') }}">
          <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
          Beranda
        </a>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuLayouts" aria-expanded="false"
          aria-controls="menuLayouts">
          <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
          Item Menu
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="menuLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="{{ route('menu.index') }}">Daftar Menu</a>
            <a class="nav-link" href="{{ route('menu.create') }}">Tambah Menu</a>
            <a class="nav-link" href="{{ route('menu.trash') }}">Tong Sampah Menu</a>
          </nav>
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#submenuLayouts"
          aria-expanded="false" aria-controls="submenuLayouts">
          <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
          Item Submenu
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="submenuLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="{{ route('submenu.index') }}">Daftar Submenu</a>
            <a class="nav-link" href="{{ route('submenu.create') }}">Tambah Submenu</a>
            <a class="nav-link" href="{{ route('submenu.trash') }}">Tong Sampah Submenu</a>
          </nav>
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryLayouts"
          aria-expanded="false" aria-controls="categoryLayouts">
          <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
          Item Kategori
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="categoryLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="{{ route('category.index') }}">Daftar Kategori</a>
            <a class="nav-link" href="{{ route('category.create') }}">Tambah Kategori</a>
            <a class="nav-link" href="{{ route('category.trash') }}">Tong Sampah Kategori</a>
          </nav>
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#subcategoryLayout"
          aria-expanded="false" aria-controls="subcategoryLayout">
          <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
          Item Subkategori
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="subcategoryLayout" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="{{ route('subcategory.index') }}">Daftar Subkategori</a>
            <a class="nav-link" href="{{ route('subcategory.create') }}">Tambah Subkategori</a>
            <a class="nav-link" href="{{ route('subcategory.trash') }}">Tong Sampah Subkategori</a>
          </nav>
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postsLayouts" aria-expanded="false"
          aria-controls="postsLayouts">
          <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
          Item Posting
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="postsLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="{{ route('post.index') }}">Daftar Posting</a>
            <a class="nav-link" href="{{ route('post.create') }}">Tambah Posting</a>
            <a class="nav-link" href="{{ route('post.trash') }}">Tong Sampah Posting</a>
          </nav>
        </div>
      </div>
    </div>
    <div class="sb-sidenav-footer">
      <div class="small">Masuk sebagai:</div>
      {{ ucwords(auth()->user()->name) }}
    </div>
  </nav>
</div>