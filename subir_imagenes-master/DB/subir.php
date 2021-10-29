<?php
include('conexion.php');

if(isset($_POST['Guardar'])){

    $imagen = $_FILES['imagen']['name'];
    $nombre = $_POST['nombre'];
    $apellido=$_POST['apellido'];
    $numero=$_POST['numero'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];

    if(isset($imagen) && $imagen != ""){
        $tipo = $_FILES['imagen']['type'];
        $temp  = $_FILES['imagen']['tmp_name'];

       if( !((strpos($tipo,'gif') || strpos($tipo,'jpeg') || strpos($tipo,'png')))){
          $_SESSION['mensaje'] = 'solo se permite archivos jpeg, gif, png';
          $_SESSION['tipo'] = 'danger';
          header('location:../index.php');
       }else{
         $query = "INSERT INTO publicaciones(imagen,nombre, apellido, numero,correo,direccion,fecha,descripcion) values('$imagen','$nombre','$apellido','$numero','$correo','$direccion','$fecha', '$descripcion')";
         $resultado = mysqli_query($conn,$query);



         if($resultado){
              move_uploaded_file($temp,'img/'.$imagen);   
             $_SESSION['mensaje'] = 'se ha subido correctamente';
             $_SESSION['tipo'] = 'success';
             header('location:../index.php');
         }else{
             $_SESSION['mensaje'] = 'ocurrio un error en el servidor';
             $_SESSION['tipo'] = 'danger';
         }
       }
    }
}


?>