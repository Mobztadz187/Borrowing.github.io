<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo getDashboardPath(); ?>">My Website</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <input type="text" name="valueToSearch" placeholder="Value to Search">
            <div class="togglebtn">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul id="navbar" class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo getDashboardPath(); ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo getStockPath(); ?>">Stocks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo getItem_ListPath(); ?>">Item Lists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo getProfilePath(); ?>">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo getLogOutPath(); ?>">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
