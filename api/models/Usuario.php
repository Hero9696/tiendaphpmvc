<?php
 require_once __DIR__ .'/../config/configdatabase.php';

class Usuario {
   

    public function registrar($nombre, $usuario, $clave, $rol) {
        global $conn;
    
        // Validar fortaleza de la contraseña
        /*if (
            strlen($clave) < 8 ||
            !preg_match('/[a-z]/', $clave) ||
            !preg_match('/[A-Z]/', $clave) ||
            !preg_match('/[0-9]/', $clave) ||
            !preg_match('/[\W]/', $clave) // Caracter especial
        ) {
            echo "<script>alert('La contraseña debe tener al menos 8 caracteres, incluir una mayúscula, una minúscula, un número y un símbolo.'); window.location.href = '/registrer';</script>";
            exit;
        }*/
    
        // Encriptar y guardar
        $claveHash = password_hash($clave, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre,usuario, clave,rol) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $usuario, $claveHash, $rol);
    
        if ($stmt->execute()) {
            echo "<script>alert('Usuario registrado exitosamente.'); window.location.href = '/';</script>";
        } else {
            echo "<script>alert('Error al registrar el usuario. Puede que ya exista.'); window.location.href = '/registrer';</script>";
        }
    }

    public function buscarPorUsuario($usuario) {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $usuarioEncontrado = $resultado->fetch_assoc();

        $stmt->close();
        return $usuarioEncontrado;
    }

    public function verificar($usuario, $clave) {
        global $conn;

        $stmt = $conn->prepare("SELECT clave FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $datos = $resultado->fetch_assoc();

        $stmt->close();

        if ($datos && password_verify($clave, $datos['clave'])) {
            return true;
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href = '/';</script>";
            return false;
        }
    }

}
