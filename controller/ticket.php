<?php
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");
    $ticket= new Ticket();

    switch($_GET["op"]){
        case "insert":
            $ticket->insert_ticket($_POST["usu_id"],$_POST["cat_id"],$_POST["tipo_id"],$_POST["puesto_id"],$_POST["tick_titulo"],$_POST["tick_descrip"]); 
        break;

            case "listar_x_usu":
                $datos=$ticket->listar_ticket_x_usu($_POST["usu_id"]);
                $data= Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = $row["tick_id"];
                    if($row["tipo_nom"]=="Incidencia"){
                        $sub_array[] ='<span class="label label-danger">Incidencia</span>';
                    }elseif($row["tipo_nom"]=="Consulta"){
                        $sub_array[]='<span class="label label-primary">Consulta</span>';
                    }elseif($row["tipo_nom"]=="Solicitud de servicio"){
                        $sub_array[]='<span class="label label-success">Solicitud de servicio</span>';
                    }
                    $sub_array[] = $row["cat_nom"];
                    $sub_array[] = $row["tick_titulo"];
                    if($row["tick_estado"]=="Abierto"){
                        $sub_array[] ='<span class="label label-success">Abierto</span>';
                    }else{
                        $sub_array[]='<span class="label label-danger">Cerrado</span>';
                    }
                        $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                        $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');" id="'.$row["tick_id"].'" class="tabledit-edit-button btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>';
                        $data[] = $sub_array;
                }

                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);

            break;

        case "listar":
            $datos=$ticket->listar_ticket();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tick_id"];
                if($row["tipo_nom"]=="Incidencia"){
                    $sub_array[] ='<span class="label label-danger">Incidencia</span>';
                }elseif($row["tipo_nom"]=="Consulta"){
                    $sub_array[]='<span class="label label-primary">Consulta</span>';
                }elseif($row["tipo_nom"]=="Solicitud de servicio"){
                    $sub_array[]='<span class="label label-success">Solicitud de servicio</span>';
                }
                $sub_array[] = $row["cat_nom"];
                $sub_array[] = $row["tick_titulo"];

                if($row["tick_estado"]=="Abierto"){
                    $sub_array[] ='<span class="label label-success">Abierto</span>';
                }else{
                    $sub_array[]='<span class="label label-danger">Cerrado</span>';
                }

                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');" id="'.$row["tick_id"].'" class="tabledit-edit-button btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

        break;

        case "listardetalle":
            $datos=$ticket->listar_ticketdetalle_x_ticket($_POST["tick_id"]);
            ?>
                <?php
                    foreach($datos as $row){
                        ?>
                            <article class="activity-line-item box-typical">
                                <div class="activity-line-date">
                                    <?php echo date("d/m/Y", strtotime($row["fech_crea"]));?>
                                </div>
                            <header class="activity-line-item-header">
                                <div class="activity-line-item-user">
                                    <div class="activity-line-item-user-photo">
                                        <a href="#">
                                            <img src="../../public/img/<?php echo $row['rol_id'];?>.png" alt="Foto de perfil del usuario">
                                        </a>
                                    </div>
                                    <div class="activity-line-item-user-name"> <?php echo $row['usu_nom'].' '.$row['usu_ape'];?></div>
                                    <div class="activity-line-item-user-status">
                                        <?php 
                                            if($row['rol_id']==1){
                                                echo 'Usuario';
                                            }else{
                                                 echo 'Soporte';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </header>
                            <div class="activity-line-action-list">
                                <section class="activity-line-action">
                                    <div class="time"><?php echo date("H:i:s", strtotime($row["fech_crea"]));?></div>
                                    <div class="cont">
                                        <div class="cont-in">
                                            <p><?php echo $row['tickd_descrip'];?></p>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </article>

                        <?php
                    }
                ?>
            <?php

        break;

        case "mostrar";
            $datos=$ticket->listar_ticket_x_id($_POST["tick_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["tick_id"]=$row["tick_id"];
                    $output["usu_id"]=$row["usu_id"];
                    $output["tipo_id"]=$row["tipo_id"];
                    $output["cat_id"]=$row["cat_id"];
                    $output["tick_titulo"]=$row["tick_titulo"];
                    $output["tick_descrip"]=$row["tick_descrip"];
                    
                    if($row["tick_estado"]=="Abierto"){
                        $output["tick_estado"] ='<span class="label label-pill label-success">Abierto</span>';
                    }else{
                        $output["tick_estado"] ='<span class="label label-pill label-danger">Cerrado</span>';
                    }
                    $output["tick_estado_texto"] = $row["tick_estado"];
                    $output["fech_crea"]= date("d/m/Y", strtotime($row["fech_crea"]));
                    $output["usu_nom"]=$row["usu_nom"];
                    $output["usu_ape"]=$row["usu_ape"];
                    if($row["tipo_nom"]=="Incidencia"){
                        $output["tipo_nom"] ='<span class="label label-pill label-danger">Incidencia</span>';
                    }elseif($row["tipo_nom"]=="Consulta"){
                        $output["tipo_nom"] ='<span class="label label-pill label-primary">Consulta</span>';
                    }elseif($row["tipo_nom"]=="Solicitud de servicio"){
                        $output["tipo_nom"] ='<span class="label label-pill label-success">Solicitud de Servicio</span>';
                    };
                    $output["cat_nom"]=$row["cat_nom"];
                    
                }
                echo json_encode($output);
            }
         break;

         case "insertdetalle":
            $ticket->insert_ticketdetalle($_POST["tick_id"],$_POST["usu_id"],$_POST["tickd_descrip"]); 
        break;

        case "update":
            $ticket->update_ticket($_POST["tick_id"],); 
            $ticket->insert_ticketdetalle_cerrar($_POST["tick_id"],$_POST["usu_id"]);
        break;
    }
?>