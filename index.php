<?php 
if(file_exists("clientes.txt")){
    $jsonClientes = file_get_contents("clientes.txt");
    $aClientes = json_decode($jsonClientes, true);
} else{
    $aClientes = array();
}

$pos = isset($_GET["pos"])? $_GET["pos"] : "";


if($_POST){
    $dni = $_POST["txtDni"];
    $nombre = $_POST["txtNombre"];
    $telefono = $_POST["txtTelefono"];
    $correo = $_POST["txtCorreo"];

if(isset($_POST["btnInsertar"])){
    //Creamos el array
    $aClientes[] = array("dni" => $dni,
                        "nombre" => $nombre,
                        "telefono" => $telefono,
                        "correo" => $correo);

    

    //Convertimos a Json
    $jsonClientes = json_encode($aClientes);
    //Guardamos el Json en el archivo
    file_put_contents("clientes.txt", $jsonClientes);

    } 

    if(isset($_GET["do"]) && $_GET["do"] == "insert"){
        $aClientes[$pos] = array("dni" => $dni,
        "nombre" => $nombre,
        "telefono" => $telefono,
        "correo" => $correo);

    }

}

if(isset($_GET["do"]) && $_GET["do"] == "delete"){
    unset($aClientes[$pos]);
    //Guardar en el archivo, el nuevo array de clientes modificado

    $jsonClientes = json_encode($aClientes);
    file_put_contents("clientes.txt", $jsonClientes);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="css/awesomefonts/css/all.min.css" rel="stylesheet">
    <link href="css/awesomefonts/css/fontawesome.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABM Clientes</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class = "col-12 text-center py-3">
                <h1>Registro de clientes</h1>
            </div>
        </div>
        <div class = "row">
            <div class="col-6">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <label for="">DNI:</label>
                        <input type="text" id="txtDni" name="txtDni" class="form-control" required value="<?php echo isset($aClientes[$pos]["dni"])? $aClientes[$pos]["dni"] : ""; ?>"><br>
                    </div>
                    <div class="col-12">
                        <label for="">Nombre y apellido:</label>    
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control" required value="<?php echo isset($aClientes[$pos]["nombre"])? $aClientes[$pos]["nombre"] : ""; ?>"><br>
                    </div>
                    <div class="col-12">
                        <label for="">Teléfono:</label>
                        <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" required value="<?php echo isset($aClientes[$pos]["telefono"])? $aClientes[$pos]["telefono"] : ""; ?>"><br>
                    </div>
                    <div class="col-12">
                        <label for="">Correo:</label>
                        <input type="text" id="txtCorreo" name="txtCorreo" class="form-control" required value="<?php echo isset($aClientes[$pos]["correo"])? $aClientes[$pos]["correo"] : ""; ?>"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" id="btnInsertar" name="btnInsertar" class="btn btn-primary">Insertar</button>
                        <button type="submit" id="btnLimpiar" name="btnLimpiar" class="btn btn-secondary">Limpiar</button>
                        <button type="submit" id="btnBorrar" name="btnBorrar" class="btn btn-danger">Borrar</button>
                        <button type="submit" id="btnActualizar" name="btnActualizar" class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </form>
            </div>
            <div class="col-6">
                <table class = "table table-hover">
                    <tr>
                        <th>DNI: </th>
                        <th>Nombre: </th>
                        <th>Correo: </th>
                        <th>Acciones: </th>
                    </tr>
                    <tr>
                        <?php 
                        $pos = 0;
                        foreach ($aClientes as $cliente){ ?>
                   
                        <td> <?php echo $cliente["dni"] ?></td>
                   
                        <td><?php echo $cliente["nombre"] ?></td>
                    
                        <td><?php echo $cliente["correo"] ?></td>

                        <td><a href="?pos=<?php echo $pos; ?>"><i class="fas fa-edit"></i></a>
                        <a href="?pos=<?php echo $pos;?>&do=delete"><i class="fas fa-trash-alt"></i></a></td>
                        
                    </tr>
<?php   
$pos++;
  } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>