<?php

# Controlador de operaciones para usuarios.


class UserController extends Controller {


    public function home() {

        Auth::check();  # Autorización (Solo identificados)

        # Carga la bvista home y le pasa el usuario identificado
        $this->loadView('user/home', [
            'user'=> Login::user()
        ]);
    }
}