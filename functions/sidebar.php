<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <img src="./img/faster.svg" alt="logo">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->

            <!-- Nav Item - Dashboards Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dashboardCollapse"
        aria-expanded="true" aria-controls="dashboardCollapse">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboards</span>
    </a>
    <div id="dashboardCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Dashboards:</h6>
            <a class="collapse-item" href="http://localhost:8001/api/v1/namespaces/kubernetes-dashboard/services/https:kubernetes-dashboard:/proxy/" target="_blank">Kubernetes</a>
            <a class="collapse-item" href="http://127.0.0.1:41087/d/FasterKube/faster-kube?orgId=1&from=now-5m&to=now" target="_blank">Grafana</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Components Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#componentsCollapse"
        aria-expanded="true" aria-controls="componentsCollapse">
        <i class="fas fa-fw fa-cog"></i>
        <span>Gérer</span>
    </a>
    <div id="componentsCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="deployer_dep.php">Déploiments</a>
            <a class="collapse-item" href="deployer_ser.php">Services</a>
            <a class="collapse-item" href="deployer_pod.php">Pods</a>
        </div>
    </div>
</li>

            <!-- Nav Item - Utilities Collapse Menu -->
            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            
            <!-- Nav Item - Charts -->
            

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="deployer.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Déployer</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>