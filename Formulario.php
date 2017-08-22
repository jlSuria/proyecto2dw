<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario</title>
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="css/menu.css">
        <link rel="stylesheet" href="css/banner.css">
    </head>
     <br>
    <div class="topnav" id="myTopnav">
        <a href="index.php">Menu</a>
        <a href="Formulario.php">Formulario</a>
        <a href="#contact">Contacto</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
    </div> 
    
    <header>
        <div class="contenedor">
        <h1 class="">Formulario</h1>
        <nav class="menu">
        </nav>
    </header>
    
    <body>
    
    <p>Ingresar Nuevo Registro</p>
    <form method="get" action="Altas.php">
    <input type="image" value="Enviar este formulario" src="images/Agregar.png" />
    
    <?php
    include ("Conexion.php");

    if (!$enlace = mysqli_connect($host,$user,$pw)) {
     echo 'No pudo conectarse a mysql';
     exit;
    }

    if (!mysqli_select_db($enlace,$db)) {
        echo 'No pudo seleccionar la base de datos';
        exit;
    }

    $sql       = 'SELECT ID,Nombre, Carnet, Email FROM p2_integrantes';
    $resultado = mysqli_query($enlace,$sql);

    if (!$resultado) {
        echo "Error de BD, no se pudo consultar la base de datos\n";
        //echo "Error MySQL: " . mysql_error();
        exit;
    }
    
    echo '<br><br><br>';
    echo '<h1>Integrantes Actuales</h1>';
    echo '<br><br><br>';
    
    echo '<table align="center" border=1><tr>';
    echo '<td>Nombre</td>';
    echo '<td>Carnet</td>';
    echo '<td>Email</td>';     
    echo '<td>Eliminar</td>';      
    echo '<td>Modificar</td>';      
    echo '</tr>';
    
    
   
while($fila = mysqli_fetch_assoc($resultado))
{
    echo '<tr> <td>';
    echo $fila['Nombre'] .'</td>';
    echo '<td>' . $fila['Carnet'] . '</td>';
    echo '<td>' . $fila['Email'];    
    echo '</td>';
    echo '<td><form action="Bajas.php?id=' . $fila['ID'] .  '" method="post" name="FrmEliminar"><center><input type="image" id="Eliminar" name="Eliminar" text="Eliminar" value="Eliminar" src="images/Eliminar.png" onclick="javascript:document.form.submit();" /></center></form></td>';
    echo '<td><form action="Cambios.php?id=' . $fila['ID'] .  '" method="post" name="FrmCambiar"><center><input type="image" id="Cambiar" name="Cambiar" text="Cambiar" value="Cambiar" src="images/Editar.png" onclick="javascript:document.form.submit();" /></center></form></td>';
    
    echo '</tr>';
}       

echo '</table>';
mysqli_free_result($resultado);

?>
    </body>
</html>
