<?/*
<header>    
	<nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Northfield</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Contratos<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li <?if($pagina=="categorias"){echo 'class="active"';}?>><a href="?a=categorias">Contratos</a></li>
                <li <?if($pagina=="subcategorias"){echo 'class="active"';}?>><a href="?a=subcategorias">Texto Contrato</a></li>
                <li <?if($pagina=="contratoTipo"){echo 'class="active"';}?>><a href="?a=contratoTipo">Tipo Contrato</a></li>
              </ul>
            </li>

            <li <?if($pagina=="usuarios"){echo 'class="active"';}?>><a href="?a=usuarios">Alumno</a></li>
            
            <li <?if($pagina=="sede"){echo 'class="active"';}?>><a href="?a=sede">Sede</a></li>

            <li <?if($pagina=="compania"){echo 'class="active"';}?>><a href="?a=compania">Mi Cuenta</a></li>
              
            <li <?if($pagina=="usuarios"){echo 'class="active"';}?>><a href="backend.php?close=logout">Cerrar sesión</a></li>
            
            
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
</header>

*/?>
<!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <h6 style="height: 4.375rem; display: flex; align-items: center; color: #4e73df !important;">
                  R E D  I T I N E R E - Expedientes
          </h6>
          <!-- Sidebar Toggle (Topbar) 
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          Topbar Search
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> -->
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS)
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              Dropdown - Messages 
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li> -->

            <!-- Nav Item - Messages -->
            
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link" href="?a=colegio" role="button" style="color: #4e73df !important;">
                  Colegios
                </a>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link" href="?a=tipo" role="button" style="color: #4e73df !important;">
                  Tipos
                </a>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link" href="?a=nivel" role="button" style="color: #4e73df !important;">
                  Niveles
                </a>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link" href="?a=persona" role="button" style="color: #4e73df !important;">
                  Personas
                </a>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link" href="?a=carpeta" role="button" style="color: #4e73df !important;">
                  Carpetas
                </a>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link" href="?a=persona-tipo" role="button" style="color: #4e73df !important;">
                  Persona Tipo
                </a>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link" href="?a=persona-exp" role="button" style="color: #4e73df !important;">
                  Persona Exp
                </a>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link" href="?a=etiqueta" role="button" style="color: #4e73df !important;">
                  Etiqueta
                </a>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link" href="?a=permiso" role="button" style="color: #4e73df !important;">
                  Permiso
                </a>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link" href="?a=expediente" role="button" style="color: #4e73df !important;">
                  Expediente
                </a>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link" href="?a=adjunto" role="button" style="color: #4e73df !important;">
                  Adjunto
                </a>
              </li>
            
            <!-- <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #4e73df !important;">
                Entidades
              </a>
              <!- Dropdown - Messages ->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  A B M S
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="?a=sede">                  
                  <div class="font-weight-bold">
                    <div class="text-truncate">Sedes</div>                    
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="?a=alumno">                  
                  <div class="font-weight-bold">
                    <div class="text-truncate">Alumno/a</div>                    
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="?a=contrato">                  
                  <div class="font-weight-bold">
                    <div class="text-truncate">Contrato</div>                   
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="?a=contratoTipo">                  
                  <div class="font-weight-bold">
                    <div class="text-truncate">Tipo de Contrato</div>                    
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="?a=contratoTexto">                  
                  <div class="font-weight-bold">
                    <div class="text-truncate">Texto Contrato</div>                    
                  </div>
                </a>                
              </div>
            </li>. -->

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <? if($_SESSION['type']!="front"){?>
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrador</span>
                <?}else{?>
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">Vista Front</span>
                <?}?>
                <i class="fas fa-user" style="font-size: 30px;"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="backend.php?destroy=ok">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesión
                </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->