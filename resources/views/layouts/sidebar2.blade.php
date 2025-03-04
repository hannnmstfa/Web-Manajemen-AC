<aside id="sidebar" class="sidebar navs-rounded-all">
    <div class="container-fluid sidebar-header d-flex justify-content-center py-1 sticky-top"
        style="background-color: #086197">
        <a class="d-flex justify-content-between flex-column align-items-center text-decoration-none"
            href="{{ route('dashboard') }}">
            <img src="{{asset('/storage/image/assets/favicon.png')}}" alt="logo" class="w-25">
            <h5>PT. Sinar Indah Kertas</h5>
        </a>
    </div>
    <div class="sidebar-body data-scrollbar pt-3">
        <div class="scroll-content">
            <div class="sidebar-list">
                <ul class="navbar-nav px-2">
                    <!-- Link Dashboard -->
                    <li
                        class="nav-item {{ request()->routeIs('/') || request()->routeIs('dashboard') ? 'item-active fw-bold' : '' }}">
                        <a class="nav-link " href="{{ route('/') }}">
                            <i class="icon fa-solid fa-house me-2"></i> <span>Dashboard</span>
                        </a>
                    </li>

                    <hr>

                    {{-- Data Master --}}
                    <li
                        class="nav-item dropdown {{request()->routeIs('ruangan.*') || request()->routeIs('vendor.*') || request()->routeIs('ac.*') ? 'item-active' : ''}}">
                        <a href="#master" data-bs-toggle="collapse"
                            class="nav-link {{request()->routeIs('ruangan.*') || request()->routeIs('vendor.*') || request()->routeIs('ac.*') ? 'fw-bold' : 'collapsed'}}">
                            <i class="fas fa-database me-2"></i> Master Data
                        </a>
                        <ul class="collapse navbar-nav gap-1 ps-3 py-2 border-top {{request()->routeIs('ruangan.*') || request()->routeIs('vendor.*') || request()->routeIs('ac.*') ? 'show' : ''}}"
                            id="master">
                            <li>
                                <a href="{{route('ruangan.index')}}"
                                    class="nav-link px-1 {{request()->routeIs('ruangan.*') ? 'link-active' : ''}}">
                                    Data Ruangan <i class="fas fa-building ms-1"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('vendor.index')}}"
                                    class="nav-link px-1 {{request()->routeIs('vendor.*') ? 'link-active' : ''}}">
                                    Data Vendor <i class="fas fa-handshake ms-1"></i>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link px-1 {{request()->routeIs('ac.*') ? 'link-active' : ''}}"
                                    href="{{route('ac.index')}}">
                                    Data AC <i class="fas fa-thermometer-three-quarters ms-1"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <hr>


                    <!-- Dropdown Perbaikan -->
                    <li
                        class="nav-item dropdown {{request()->routeIs('pengajuan.*') || request()->routeIs('proses.*') || request()->routeIs('selesai.*') ? 'item-active' : ''}}">
                        <a href="#perbaikan" data-bs-toggle="collapse"
                            class="nav-link {{request()->routeIs('pengajuan.*') || request()->routeIs('proses.*') || request()->routeIs('selesai.*') ? 'fw-bold' : 'collapsed'}}">
                            <i class="fas fa-wrench me-2"></i> <span>Perbaikan AC</span>
                        </a>
                        <ul class="collapse navbar-nav gap-1 ps-3 py-2 border-top {{request()->routeIs('pengajuan.*') || request()->routeIs('proses.*') || request()->routeIs('selesai.*') ? 'show' : ''}}"
                            id="perbaikan">
                            <li><a class="nav-link px-1 {{request()->routeIs('pengajuan.*') ? 'link-active' : ''}}"
                                    href="{{route('pengajuan.index')}}">
                                    Pengajuan Perbaikan <i class="fas fa-clipboard-list ms-1"></i>
                                </a>
                            </li>
                            <li><a class="nav-link px-1 {{request()->routeIs('proses.*') ? 'link-active' : ''}}"
                                    href="{{route('proses.index')}}">
                                    Proses Perbaikan <i class="fas fa-cogs ms-1"></i>
                                </a>
                            </li>
                            <li><a class="nav-link px-1 {{request()->routeIs('selesai.*') ? 'link-active' : ''}}"
                                    href="{{route('selesai.index')}}">
                                    Selesai Perbaikan <i class="fas fa-check-double ms-1"></i>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <hr>
                    <!-- Maintance -->
                    <li class="nav-item {{request()->routeIs('cleaning.*') ? 'fw-bold item-active' : ''}}">
                        <a class="nav-link" href="{{ route('cleaning.index') }}">
                            <i class="fa-solid fa-gear me-2"></i> <span>Maintenance</span>
                        </a>
                    </li>

                    <hr>
                    <!-- Dropdown Report -->
                    @if (Auth::user()->role !== 'Operator')
                        <li
                            class="nav-item dropdown {{request()->routeIs('report.*') || request()->routeIs('filter.*') ? 'item-active' : ''}}">
                            <a href="#report" data-bs-toggle="collapse"
                                class="nav-link {{request()->routeIs('report.*') || request()->routeIs('filter.*') ? 'fw-bold' : 'collapsed'}}">
                                <i class="fas fa-chart-line me-2"></i> <span>Report</span>
                            </a>
                            <ul class="collapse navbar-nav gap-1 ps-3 py-2 border-top {{request()->routeIs('report.*') || request()->routeIs('filter.*') ? 'show' : ''}}"
                                id="report">
                                <li><a class="nav-link px-1 {{request()->routeIs('report.harian') || request()->routeIs('filter.hari') ? 'link-active' : ''}}"
                                        href="{{route('report.harian')}}">
                                        Report Harian <i class="fa-solid fa-calendar-days ms-1"></i>
                                    </a>
                                </li>
                                <li><a class="nav-link px-1 {{request()->routeIs('report.bulanan') || request()->routeIs('filter.bulan') || request()->routeIs('report.cetak') || request()->routeIs('filter.cetak') ? 'link-active' : ''}}"
                                        href="{{route('report.bulanan')}}">
                                        Report Bulanan <i class="fa-solid fa-calendar-check ms-1"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <hr>
                        @if(Auth::user()->role !== 'Admin')
                            <!-- Pengguna -->
                            <li class="nav-item {{request()->routeIs('users.*') ? 'item-active' : ''}}">
                                <a class="nav-link {{request()->routeIs('users.*') ? 'fw-bold' : ''}}"
                                    href="{{ route('users.index') }}">
                                    <i class="fas fa-users me-2"></i><span>Pengguna System</span>
                                </a>
                            </li>
                            <hr>
                        @endif
                    @endif
                    <!-- Tentang -->
                    <li class="nav-item {{request()->routeIs('about') ? 'item-active' : ''}}">
                        <a class="nav-link {{request()->routeIs('about') ? 'fw-bold' : ''}}" href="{{route('about')}}">
                            <i class="fas fa-info-circle me-2"></i><span>Tentang Program</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdowns = document.querySelectorAll(".nav-item.dropdown");

        dropdowns.forEach(dropdown => {
            dropdown.addEventListener("show.bs.collapse", function () {
                this.classList.add("item-active");
            });

            dropdown.addEventListener("hide.bs.collapse", function () {
                this.classList.remove("item-active");
            });
        });
    });
</script>