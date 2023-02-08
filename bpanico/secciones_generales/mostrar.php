<div class='card-deck'>
    <?php   
        include '../conexion/errores.php';
        include '../conexion/validarfoto2.php';
        include '../conexion/database.php';
        require_once '../conexion/config.php';

    
    
    
        spl_autoload_register( function($clase){ require_once "../conexion/$clase.php";});

        $curPageName = $_SERVER['REQUEST_URI'];
        $location = parse_url($curPageName);
        $id = str_replace("id=", "", $location["query"]);
        $id = (int)$id;

    
    
    
        $db = new database( DB_HOST, DB_USER, DB_PASS, DB_NAME );
        $db->preparar("SELECT COUNT(id_servicio) FROM servicio WHERE servicio.id_categoria= $id "); 
        $db->ejecutar();
        $db->prep()->bind_result($contador);
        $db->resultado();
        $db->liberar();
        $porPagina = 10;
        $paginas =  ceil($contador/$porPagina);
        $pagina = (isset ($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
        $iniciar = ($pagina-1) * $porPagina;

        $query = "SELECT servicio.id_servicio, servicio.nombre, servicio.id_categoria, servicio.direccion, servicio.maps, servicio.imagens, categoria.nombre as categoriaName FROM servicio INNER JOIN categoria ON servicio.id_categoria=categoria.id_categoria  WHERE servicio.id_categoria=$id LIMIT $iniciar, $porPagina";
        $db->preparar($query);
        $db->ejecutar();
        $db->prep()->bind_result( $dbid, $dbnombre, $dbcategoria, $dbdireccion, $dbmaps, $dbimagens, $dbcategorianame);

        $conteo=$iniciar;
    
        while( $db->resultado() ){
            $conteo++;
            $probando = $conteo;
            $probando= $probando / 3;
        
            echo " 
                <div class='card col-4 '>
                <img width='284' height='284' src='../index/$dbimagens' class='card-img-top' alt='Imagen de instituciones' >
                <div class='card-body'>
                <h5 class='card-title' style='text-align:center;'>$dbnombre</h5>
                <p class='card-text'>Busca todas las empresas de Software de tu zona.</p>
                </div>
                <div class='card-body' style='text-align:center;'>
                <a href='../informatica/software.php' class='card-link' >Ir a Software</a>
                </div>
                </div>
                ";
            if ($conteo%3==0){
                echo "<div class='w-100'></div> <br>";
            }
        }
                $db->liberar();
        ?>
        </div>