<?php

class Lightning extends Connection{
    

    public function deletelist(){
        $conn = $this->getConn();
        $query = "DELETE FROM lamps"; 
        $conn->query($query);
        
    }
    public function getmodelId($name) {
        $query = "SELECT model_id FROM lamp_models WHERE model_part_number='$name'";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row["model_id"];
            }
        } else {
            return 0;
        }
    }

      public function getzonaId($zona){
        $query = "SELECT zone_id FROM zones WHERE zone_name='$zona'";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row["zone_id"];
            }
        } else {
            return 0;
        }
    }      

      public function importarLambs($fichero){
        $gestor = fopen($fichero, "r");
        if ($gestor !== false) {
            while (($element = fgetcsv($gestor)) !== false) {
              
                $query = "INSERT INTO lamps (lamp_id, lamp_name, lamp_model, lamp_zone, lamp_on) VALUES (?, ?, ?, ?, ?)";
                $statement = $this->conn->prepare($query);
               
                
                $id = $element[0];
                $lamp_name = $element[1];
                $lamp_model=$this->getmodelId($element[2]);
                $lamp_zone = $this->getzonaId($element[3]);
                $lamp_on = $element[4];
                
            if($lamp_on == "on"){
                $lamp_on=1;
            }else{
                $lamp_on=0;
            }
                $statement->bind_param("isiis", $id, $lamp_name, $lamp_model, $lamp_zone, $lamp_on);
                $statement->execute();
            }
            fclose($gestor);
        }
    }
   public  function getAllLamps() {
        $query  = "SELECT * FROM lamps INNER JOIN lamp_models on lamps.lamp_model = model_id INNER JOIN zones on lamps.lamp_zone = zone_id";
        $resultado = $this->conn->query($query);
        if(!$resultado){
            die("Error en la consulta: " . $this->conn->error);
        }
        $producto =  array();
        while($file  = $resultado->fetch_object()) {
            $producto[]=$file;
        }
         return $producto;
    }
    public function drawLampsList(){
        $productos = $this->getAllLamps();

        foreach ($productos as $producto) {
            if($producto->lamp_on){
                echo"<div class='element on'>
                <h4><a href='changestatus.php?id=1&status=off'><img src='img/bulb-icon-on.png'></a> $producto->lamp_name</h4>
                <h1>$producto->model_wattage</h1>
                <h4>$producto->zone_name</h4>
            </div>";
            }else{
                echo"<div class='element off'>
                <h4><a href='changestatus.php?id=0&status=on'><img src='img/bulb-icon-off.png'></a> $producto->lamp_name</h4>
                <h1>$producto->model_wattage</h1>
                <h4>$producto->zone_name</h4>
            </div>";
            }
            
        }
        echo "</table>";
    }

   public function sumazona(){
    
    
        $productos = $this->getAllLamps();
        
                $suma=0;
                
        foreach($productos as $producto){
            if($producto->lamp_on == "on"){
                if($producto->zone_name=="Norte"){
                    $suma= $producto->model_wattage=600+ $producto->model_wattage=400+  $producto->model_wattage=500;
                }
                elseif($producto->zone_name=="Este"){
                    $suma= $producto->model_wattage=600+ $producto->model_wattage=400+  $producto->model_wattage=500;
                }
                if($producto->zone_name=="Oeste"){
                    $suma= $producto->model_wattage=600+ $producto->model_wattage=400+  $producto->model_wattage=500;
                }else{
                    $suma= $producto->model_wattage=600+ $producto->model_wattage=400+  $producto->model_wattage=500;
                }
               
            }
            return $suma;
            echo "<table>
            <tr>
                <th>Norte</th>
                <th>Sur</th>
                <th>Este</th>
                <th>Oeste</th>
                </tr>
                </table>";
            
        }

}
        public function changestatus($id, $status){
            $query = "UPDATE lamps SET lamp_on ='$status' WHERE lamp_id=$id";
                $resultado = $this->conn->query($query);
                
                if (!$resultado) {
                    
                  
                    die("Error en la consulta: " . $this->conn->error);
                } 
            }
        public function encotrarID($id) {
            $query = "SELECT * FROM lamps WHERE lamp_id = $id";
            $resultado = $this->conn->query($query);
            if ($resultado && $resultado->num_rows > 0) {
                $row = $resultado->fetch_object();
                return $row;
            } else {
                return null; 
        }
    }
}
