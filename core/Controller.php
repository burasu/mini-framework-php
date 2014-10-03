<?php

/**
 * Controlador base de cual extenderá el reto de controladores.
 * Cuando se inicia, se le debe pasar el action, el cual es el nombre
 * del método a ejecutar.
 */
class Controller {

    static $require_auth = [];

    /**
     * El constructor recibe el action, que contiene el nombre del método que va a ejecutar.
     * Si el método no existe, mostramos un error 404. Si existe, enviamos al usuario
     * la vista y finaliza la ejecución del programa.
     *
     * @param String $action Nombre del método a ejecutar.
     */
    public function __construct($action = null)
    {

        // Comprueba si action es distinto de null, y en dicho caso, si equivale
        // a un método que exista en el controlador.
        if ($action !== null && method_exists($this, $action))
        {
            // Comprobamos si el método require estar autenticado,
            // y lo redirigimos al login si no lo está.
            if (in_array($action, static::$require_auth))
            {

                // Si no está autenticado lo redirigimos al home.
                if ( ! Auth::check())
                {
                    die(header('Location:./'));
                }
            }

            // Ejecutamos el método guardado en $action.
            $view = $this->$action();

            // Si el contenido devuelto por el método es una instancia de la clase View,
            // ejecutamos el método que imprime la vista.
            if ($view instanceof View)
            {
                $view->draw();
            }
            // Si no, muestra el contenido devuelto.
            else
            {
                echo $view;
            }

            die;
        }
    }

} 