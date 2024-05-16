<?php



class Tema extends Model {


    public function getTemas():array {   

        $consulta = "SELECT * FROM temas WHERE tema =$this->id ";

        return (DB_CLASS)::selectAll($consulta, 'Tema');
    }
}

