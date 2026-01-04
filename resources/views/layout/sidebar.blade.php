<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- ============================================================== -->
                <!-- Karyawan -->
                <!-- ============================================================== -->
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('dashboard')}}" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @if(Auth::check())
                @if(Auth::user()->role==='karyawan')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('kategori')}}" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="hide-menu">Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('barang')}}" aria-expanded="false">
                        <i class="mdi mdi-cube"></i>
                        <span class="hide-menu">Barang</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('customer')}}" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="hide-menu">Customer</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('supplier')}}" aria-expanded="false">
                        <i class="fas fa-truck"></i>
                        <span class="hide-menu">Supplier</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('barang_keluar')}}" aria-expanded="false">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="hide-menu">Barang Keluar</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('barang_masuk')}}" aria-expanded="false">
                        <i class="fas fa-sign-in-alt"></i>
                        <span class="hide-menu">Barang Masuk</span>
                    </a>
                </li>
                <!-- ============================================================== -->
                <!-- Pemilik -->
                <!-- ============================================================== -->
                @endif
                @if(Auth::user()->role==='pemilik')
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('laporan_stok_barang')}}" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="hide-menu">Laporan Stok Barang</span>
                    </a>
                </li>
                @endif
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>