<?php
    class Usuario extends Conectar{

        public function login(){
            $conectar=parent::conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $correo = $_POST["usu_correo"];
                $pass = $_POST["usu_pass"];
                $rol = $_POST["rol_id"];
                if(empty($correo) and empty($pass)){
                    header("location:".conectar::ruta()."index.php?m=2");
                    exit();
                }else{
                    $sql = "SELECT * FROM tm_usuario WHERE usu_correo=? and usu_pass=? and rol_id=? and est=1";
                      $stmt=$conectar->prepare($sql);
                      $stmt->bindvalue(1, $correo);
                      $stmt->bindvalue(2, $pass);
                      $stmt->bindvalue(3, $rol);
                      $stmt->execute();
                      $resultado = $stmt->fetch();
                      if(is_array($resultado) and count($resultado)>0){
                        $_SESSION["usu_id"]=$resultado["usu_id"];
                        $_SESSION["usu_nom"]=$resultado["usu_nom"];
                        $_SESSION["usu_ape"]=$resultado["usu_ape"];
                        $_SESSION["rol_id"]=$resultado["rol_id"];
                        header("location:".conectar::ruta()."view/Home/");
                        exit();
                      }else{
                        header("location:".conectar::ruta()."index.php?m=1");
                        exit();
                      }
                }
            }
        }
        public function insert_usuario($usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_usuario (usu_id,usu_nom,usu_ape,usu_correo,usu_pass,rol_id,fecha_cre,fech_modi,fech_elim,est) VALUES (NULL,?,?,?,?,?,now(), NULL, NULL, '1');";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1,$usu_nom);
            $sql->bindvalue(2,$usu_ape);
            $sql->bindvalue(3,$usu_correo);
            $sql->bindvalue(4,$usu_pass);
            $sql->bindvalue(5,$rol_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function update_usuario($usu_id,$usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario SET
                usu_nom = ?,
                usu_ape = ?,
                usu_correo = ?,
                usu_pass = ?,
                rol_id = ?
                WHERE
                usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1,$usu_nom);
            $sql->bindvalue(2,$usu_ape);
            $sql->bindvalue(3,$usu_correo);
            $sql->bindvalue(4,$usu_pass);
            $sql->bindvalue(5,$rol_id);
            $sql->bindvalue(6,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function delete_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario 
                SET
                    est='0',
                    fech_elim = now()
                WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_usuario(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE est='1'";
            $sql=$conectar->prepare($sql);

            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_usuario_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
}
?>