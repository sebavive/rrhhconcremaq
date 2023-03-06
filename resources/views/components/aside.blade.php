<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand mt-3">
      <a href="index.html" class="app-brand-link">
          <img src="{{ asset('images/logo_md.png') }}" alt="Concremax" class="img-fluid">
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item">
        <a href="{{route('home')}}" class="menu-link">
          <i class="menu-icon fa fa-home"></i>
          <div data-i18n="inicio">Inicio</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('employee.index')}}" class="menu-link">
          <i class="menu-icon fa fa-helmet-safety"></i>
          <div data-i18n="obreros">Obreros</div>
        </a>
      </li>

      <li class="menu-item">
        <a href="{{route('proyect.index')}}" class="menu-link">
          <i class="menu-icon fa fa-warehouse"></i>
          <div data-i18n="Proyectos">Proyectos</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('salary-advances.index')}}" class="menu-link">
            <i class="menu-icon fa-solid fa-coins"></i>
            <div data-i18n="Proyectos">Adelantos</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Liquidaciones</span>
      </li>
      <li class="menu-item">
        <a href="pages-account-settings-account.html" class="menu-link">
            <div data-i18n="listado">Planilla</div>
        </a>
      </li>
      {{-- CONFIGURACIONES --}}
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Configuraciones</span>
      </li>
      <li class="menu-item">
        <a href="{{route('attendance.index')}}" class="menu-link">
            <i class="menu-icon fa fa-clock"></i>
            <div data-i18n="asistencias">Asistencias</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('user.index')}}" class="menu-link">
            <i class="menu-icon fa fa-users"></i>
            <div data-i18n="usuarios">Usuarios</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="pages-account-settings-notifications.html" class="menu-link">
            <i class="menu-icon fa fa-lock"></i>
            <div data-i18n="permisos">Permisos</div>
        </a>
      </li>
    </ul>
  </aside>
