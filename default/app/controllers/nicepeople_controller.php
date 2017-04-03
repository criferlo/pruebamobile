<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nicepeople
 *
 * @author practicante
 */
Load::models("usuario","ciudad");
class NicepeopleController extends AppController {
    //put your code here
    function registrarUsuario(){
        View::template(null);
        $post1 = $_POST["var_usuario"];
        $post1 = json_decode($post1, true);

        $usu = new Usuario();
        $usu->nombre = $post1[0]["nombre"];
        $usu->apellido = $post1[0]["apellido"];
        $usu->edad = $post1[0]["edad"];
        $usu->email = $post1[0]["email"];
        $usu->pass = $post1[0]["pass"];
        $usu->save();

        $arr  = array();

        $arr[] = $usu;

        $this->data = json_encode($arr);

    }


   function iniciarSesion(){
       View::template(null);
        $post1 = $_POST["var_usuario"];
        $post1 = json_decode($post1, true);

        $usu = new Usuario();
        $email = $post1[0]["email"];
        $pass = $post1[0]["pass"];
        if($usu->count("email='$email' and pass='$pass'")>0){
            $usu = $usu->find_first("email='$email' and pass='$pass'");
        }else{
            $usu = new Usuario();
        }

        $arr  = array();

        $arr[] = $usu;

        $this->data = json_encode($arr);
   }


    function registrarCiudad(){
        View::template(null);
        $post1 = $_POST["var_ciudad"];
        $post1 = json_decode($post1, true);

        $usu = new Ciudad();
        $usu->nombre = $post1[0]["nombre"];
        $usu->codpais = $post1[0]["codpais"];
        $usu->predeterminada = $post1[0]["predeterminada"];
        $usu->save();

        $arr  = array();

        $arr[] = $usu;

        $this->data = json_encode($arr);

    }

    function consultarCiudades(){
        View::template(null);

        $ciu = new Ciudad();
        $arr  = array();
        $arr = $ciu->find();

        $this->data = json_encode($arr);
    }


    function consultarUsuarios(){
        View::template(null);

        $ciu = new Usuario();
        $arr  = array();
        $arr = $ciu->find("order: nombre ASC");

        $this->data = json_encode($arr);
    }

    function eliminarCiudad(){

        View::template(null);
        $post1 = $_POST["var_ciudad"];
        $post1 = json_decode($post1, true);

        $usu = new Ciudad();
        $nombre = $post1[0]["nombre"];
        $usu->delete("nombre='$nombre'");

        $usu->find_first("nombre='$nombre'");

        $arr  = array();

        $arr[] = $usu;

        $this->data = json_encode($arr);
    }

}
