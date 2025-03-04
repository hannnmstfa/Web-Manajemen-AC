<div class="sidebar" style="background-color: rgb(60, 182, 239); min-height: 100vh; border-right: 1px solid #ddd; padding: 10px;">
    <!-- Header -->
    <h3 class="text-center py-2" style="background-color: rgba(255, 255, 255, 0.8); font-weight: bold; border-bottom: 2px solid #ddd;">Program AC</h3>
    
    <!-- Navigation Menu -->
    <ul class="nav flex-column">
        <li class="nav-item border-bottom py-2">
            <a class="nav-link" href="{{ route('/') }}" style="color: #000000; font-weight: bold;">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>

     
        <!-- Data Master -->
        <li class="nav-item border-bottom py-2">
            <a class="nav-link dropdown-toggle" href="#" onclick="toggleDropdown('DataMasterMenu')" style="color: #000000; font-weight: bold;">
                <i class="fas fa-database"></i> Data Master
            </a>
            <div class="collapse" id="DataMasterMenu">
                <ul class="list-unstyled pl-3">
                    <li><a class="nav-link" href="{{route('ruangan.index')}}" style="color: #000000;"><i class="fas fa-building"></i> Data Ruang</a></li>
                    <li><a class="nav-link" href="{{route('vendor.index')}}" style="color: #000000;"><i class="fas fa-handshake"></i> Data Vendor</a></li>
                    <li><a class="nav-link" href="{{route('ac.index')}}" style="color: #000000;">            Data AC Normal</a></li>
                </ul>
            </div>
        </li>
 

       
        
        <!-- Perbaikan AC -->
        <li class="nav-item border-bottom py-2">
            <a class="nav-link dropdown-toggle" href="#" onclick="toggleDropdown('PerbaikanACMenu')" style="color: #000000; font-weight: bold;">
                <i class="fas fa-wrench"></i> Perbaikan  AC
            </a>
            <div class="collapse" id="PerbaikanACMenu">
                <ul class="list-unstyled pl-3">
                    <li><a class="nav-link" href="{{route('pengajuan.index')}}" style="color: #000000;"><i class="fas fa-clipboard-list"></i> Proses Pengajuan</a></li>
                    <li><a class="nav-link" href="{{route('proses.index')}}" style="color: #000000;"><i class="fas fa-cogs"></i> Proses Perbaikan</a></li>
                    <li><a class="nav-link" href="{{route('selesai.index')}}" style="color: #000000;"><i class="fas fa-check-double"></i> Selesai Perbaikan</a></li>
                </ul>
            </div>
        </li>

            <!-- Cleaning AC -->
            <li class="nav-item border-bottom py-2">
            <a class="nav-link" href="{{ route('cleaning.index') }}" style="color: #000000; font-weight: bold;">
            <i class="fa-solid fa-gear"></i> Maintance AC
            </a>
        </li>
        
        <!-- Report -->
        <li class="nav-item border-bottom py-2">
            <a class="nav-link dropdown-toggle" href="#" onclick="toggleDropdown('ReportMenu')" style="color: #000000; font-weight: bold;">
                <i class="fas fa-chart-line"></i> Report
            </a>
            <div class="collapse" id="ReportMenu">
                <ul class="list-unstyled pl-3">
                    <li><a class="nav-link" href="{{route('report.harian')}}" style="color: #000000;"><i class="fas fa-calendar-day"></i> Report Harian</a></li>
                    <li><a class="nav-link" href="{{route('report.bulanan')}}" style="color: #000000;"><i class="fas fa-clipboard-check"></i> Report Bulanan</a></li>
                </ul>
            </div>
        </li>
         
        
        <!-- Pengguna Sistem -->
        <li class="nav-item border-bottom py-2">
            <a class="nav-link" href="{{ route('users.index') }}" style="color: #000000; font-weight: bold;">
                <i class="fas fa-users"></i> Pengguna Sistem
            </a>
        </li>

        <!-- Tentang Program -->
        <li class="nav-item py-2">
            <a class="nav-link" href="#" style="color: #000000; font-weight: bold;">
                <i class="fas fa-info-circle"></i> Tentang Program
            </a>
        </li>
    </ul>
</div>

<script>
   // Toggle dropdown visibility for a given menu
function toggleDropdown(menuId) {
    const menu = document.getElementById(menuId);
    menu.classList.toggle('show');
}

$(document).ready(function () {
    // Handle the click event for nav links with collapse behavior
    $('.nav-link[data-bs-toggle="collapse"]').click(function (e) {
        e.preventDefault();
        var parent = $(this).closest('.nav-item');
        
        // Toggle the clicked dropdown
        parent.toggleClass('show');
        parent.find('.collapse').toggleClass('show');

        // Close other dropdowns
        $('.nav-item').not(parent).removeClass('show').find('.collapse').removeClass('show');
    });

    // Prevent hover effect from disappearing when the dropdown is clicked
    $('.nav-item').on('mouseenter', function () {
        $(this).addClass('item-active');
    }).on('mouseleave', function () {
        if (!$(this).hasClass('show')) {
            $(this).removeClass('item-active');
        }
    });

    // Prevent closing the dropdown when clicking on a link inside the dropdown
    $('.nav-item .collapse .nav-link').click(function (e) {
        e.stopPropagation();  // Prevent click event from propagating to parent and closing dropdown
    });

    // Close dropdown when clicking outside
    $(document).click(function (e) {
        if (!$(e.target).closest('.nav-item').length) {
            // If click is outside, close any open dropdowns
            $('.nav-item').removeClass('show').find('.collapse').removeClass('show');
        }
    }); 
});
</script>
