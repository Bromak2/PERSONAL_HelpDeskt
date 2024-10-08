<?php
    class Ticket extends Conectar{

        public function insert_ticket($usu_id,$cat_id,$tipo_id,$puesto_id,$tick_titulo,$tick_descrip){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_ticket (tick_id,usu_id,tipo_id,cat_id,puesto_id,tick_titulo,tick_descrip,tick_estado,fech_crea,est) VALUES (NULL,?,?,?,?,?,?,'Abierto',now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1,$usu_id);
            $sql->bindvalue(2,$tipo_id);
            $sql->bindvalue(3,$cat_id);
            $sql->bindvalue(4,$puesto_id);
            $sql->bindvalue(5,$tick_titulo);
            $sql->bindvalue(6,$tick_descrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
            
        }

        public function listar_ticket_x_usu($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                tm_ticket.tick_id,
                tm_ticket.usu_id,
                tm_ticket.tipo_id,
                tm_ticket.cat_id,
                tm_ticket.puesto_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_descrip,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_tipo.tipo_nom,
                tm_categoria.cat_nom
                FROM
                tm_ticket
                INNER join tm_tipo on tm_ticket.tipo_id = tm_tipo.tipo_id
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                WHERE
                tm_ticket.est=1
                AND tm_usuario.usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function listar_ticket(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                tm_ticket.tick_id,
                tm_ticket.usu_id,
                tm_ticket.tipo_id,
                tm_ticket.cat_id,
                tm_ticket.puesto_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_descrip,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_tipo.tipo_nom,
                tm_categoria.cat_nom
                FROM
                tm_ticket
                INNER join tm_tipo on tm_ticket.tipo_id = tm_tipo.tipo_id
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                WHERE
                tm_ticket.est=1
                ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function listar_ticketdetalle_x_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
            td_ticketdetalle.tickd_id,
            td_ticketdetalle.tickd_descrip,
            td_ticketdetalle.fech_crea,
            tm_usuario.usu_nom,
            tm_usuario.usu_ape,
            tm_usuario.rol_id
            FROM 
            `td_ticketdetalle` 
            INNER JOIN tm_usuario ON td_ticketdetalle.usu_id=tm_usuario.usu_id
            WHERE 
            tick_id=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }


        public function listar_ticket_x_id($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                tm_ticket.tick_id,
                tm_ticket.usu_id,
                tm_ticket.tipo_id,
                tm_ticket.cat_id,
                tm_ticket.puesto_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_descrip,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_tipo.tipo_nom,
                tm_categoria.cat_nom
                FROM 
                tm_ticket
                INNER join tm_tipo on tm_ticket.tipo_id = tm_tipo.tipo_id
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                WHERE
                tm_ticket.est = 1
                AND tm_ticket.tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle($tick_id, $usu_id, $tickd_descrip){
            $conectar= parent::conexion();
            parent::set_names();
                $sql="INSERT INTO td_ticketdetalle (tickd_id,tick_id,usu_id,tickd_descrip,fech_crea,estado) VALUES (NULL,?,?,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1,$tick_id);
            $sql->bindvalue(2,$usu_id);
            $sql->bindvalue(3,$tickd_descrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
            
        }
        public function insert_ticketdetalle_cerrar($tick_id, $usu_id){
            $conectar= parent::conexion();
            parent::set_names();
                $sql="INSERT INTO td_ticketdetalle (tickd_id,tick_id,usu_id,tickd_descrip,fech_crea,estado) VALUES (NULL,?,?,'Ticket Cerrado...',now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1,$tick_id);
            $sql->bindvalue(2,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
            
        }

        public function update_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE 
                        tm_ticket
                        SET
	                    tick_estado = 'Cerrado'
                        WHERE
	                    tick_id =?";
            $sql=$conectar->prepare($sql);
            $sql->bindvalue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }
    }
?>