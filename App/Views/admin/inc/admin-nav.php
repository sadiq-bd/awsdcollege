<?php
  $navPages = [
    'dashboard' => [
      'icon' => 'fa fa-dashboard',
      'title' => 'Dashboard'
    ],
    'manage-students' => [
      'icon' => 'fa fa-users',
      'title' => 'Manage Students'
    ],
    'manage-teachers' => [
      'icon' => 'fa fa-users',
      'title' => 'Manage Teachers'
    ],
    'settings' => [
      'icon' => 'fa fa-cog',
      'title' => 'Settings'
    ],
    'operations' => [
      'icon' => 'fa fa-tasks',
      'title' => 'Operations'
    ],
    'report' => [
      'icon' => 'fa fa-area-chart',
      'title' => 'Report'
    ],
    'profile' => [
      'icon' => 'fa fa-user-o',
      'title' => 'Profile'
    ]
    
  ];

  $logoutUri = CONFIG['base_url'] . '/logout/' . '2y3hr98q239084q2m534fde8wuaf89';
?>

<style>
  .bd-placeholder-img {font-size: 1.125rem;text-anchor: middle;-webkit-user-select: none;-moz-user-select: none;user-select: none;}
  @media (min-width: 768px) {.bd-placeholder-img-lg {font-size: 3.5rem;} }
  .b-example-divider {height: 3rem;background-color: rgba(0, 0, 0, .1);border: solid rgba(0, 0, 0, .15);border-width: 1px 0;box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);}
  .b-example-vr {flex-shrink: 0;width: 1.5rem;height: 100vh;}
  .bi {vertical-align: -.125em;fill: currentColor;}
  .nav-scroller {position: relative;z-index: 2;height: 2.75rem;overflow-y: hidden;}
  .nav-scroller .nav {display: flex;flex-wrap: nowrap;padding-bottom: 1rem;margin-top: -1px;overflow-x: auto;text-align: center;white-space: nowrap;-webkit-overflow-scrolling: touch;}
  @media (max-width: 768px) {#signOutAnchor{display: none;}}
</style>

<script type="text/javascript">
let navCss = document.createElement('link');navCss.type = 'text/css';navCss.rel = 'stylesheet';navCss.href = '<?= CONFIG['base_url'] ?>/resources/styles/dashboard.css';document.head.appendChild(navCss);
</script>

<header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="javascript:void(0)"><img src="/resources/favicon.png" alt="" width="28"></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav" id="signOutAnchor">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="<?php echo $logoutUri; ?>">Logout</a>
    </div>
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function(e) {
    var cont = document.getElementById('allContainer');
    cont.innerHTML = `
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">
         <ul class="nav flex-column">
<?php
  $baseURL = CONFIG['base_url'];
  foreach($navPages as $key => $val) {
      $navTitle = $val['title'];
      $navLocation = $key;
      $navIcon = $val['icon'];
      $navActive = preg_match('/^'.trim($key,'/').'$/i', trim($_SERVER['REQUEST_URI'],'/')) ? ' active' : '';
    echo <<<NAVITEM
          <li class="nav-item">
            <a class="nav-link{$navActive}" href="{$baseURL}/admin/{$navLocation}">
              <i class="{$navIcon}"></i>&nbsp;&nbsp;
              {$navTitle}
            </a>
          </li>
    NAVITEM;
  }
?> 
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $logoutUri; ?>">
              <i class="fa fa-sign-out"></i>&nbsp;&nbsp;
              Logout
            </a>
          </li> 
         </ul>

        </div>
      </nav>
    ` + cont.innerHTML;
  });
</script>
