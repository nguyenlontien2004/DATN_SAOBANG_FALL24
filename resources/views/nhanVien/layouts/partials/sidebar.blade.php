<div class="sidebar" data-background-color="dark">
    <!-- Sidebar Logo -->
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="light"
            style="display: flex; align-items: center; justify-content: space-between; padding: 10px;">
            <a href="index.html" class="logo" style="display: flex; align-items: center;">
                <img src="https://files.oaiusercontent.com/file-fzKrGiSjtFvjVxuESDMgtKKD?se=2024-10-30T04%3A57%3A16Z&sp=r&sv=2024-08-04&sr=b&rscc=max-age%3D604800%2C%20immutable%2C%20private&rscd=attachment%3B%20filename%3D54b5a2cd-b6e4-4fc4-9f8b-ef36090d88d8.webp&sig=IVUSPVuT5il78/tPX228UeRwLXuStxnPHMfeQOItmlo%3D"
                    alt="Sao Băng Logo" style="max-height: 50px;">
            </a>

            <!-- Toggle Buttons -->
            <div class="nav-toggle" style="display: flex; align-items: center;">
                <button class="btn btn-toggle toggle-sidebar" style="margin-right: 5px;">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>

            <!-- Topbar Toggler -->
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#food">
                        <i class="fas fa-utensils"></i>
                        <p>Quản lý đồ ăn</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="food">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('do-an.index') }}">
                                    <span class="sub-item">Danh sách đồ ăn</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-ticket-alt"></i>
                        <p>Quản lý vé</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
