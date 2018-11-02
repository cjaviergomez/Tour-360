<?php

class menuFijo{

	function obtenerMenu(){
		echo '<ul class="nav">
				<li><a href="inicio.php">Inicio</a></li>
                <li>    
					<button  style="border: #FFF 1px solid; background-color: #FFF">
                        <figure  class="post2 wow fadeIn" data-wow-delay="0.2s">
                            <img data-toggle="dropdown" class="img-circle" src ='.$_SESSION["foto"].' height="45px" width="45px" > 
                                <h5 data-toggle="dropdown">'.$_SESSION["nombre"].'</h5>
                        </figure>

                    </button>

                    <ul>
         				<li><a href="confi_usuario.php">Configuración</a></li>
                        <li><a href="index2.php">Cerrar sesión</a></li>
          			</ul>

        
                </li>  
              </ul>';
	}
	
}

?>