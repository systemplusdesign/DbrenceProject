<?php
  require_once ("functions.php");  require_once ("db_conn.php");
	$email = $_POST['m_name'];	$pass = $_POST['m_pass'];
  error_reporting(E_ALL & ~E_NOTICE);
  if (!$email & !$pass) { echo "Ingrese sus datos...";
  }elseif (!$email) { echo "Ingrese Usuario o Email..."; 
  }elseif (!$pass) { echo "Ingrese contraseña...";
  }else {	// Check email
    $safe_email = mysqli_real_escape_string($connection, $email);
		$query  = "SELECT * FROM admins WHERE email = '{$safe_email}' LIMIT 1";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		if($admin = mysqli_fetch_assoc($admin_set)) {
			$existing_hash = $admin["hashed_password"];
			$hash = crypt($pass, $admin["hashed_password"]);
			if ($hash === $existing_hash) {
				echo "Bienvenido".' '.$admin["username"];
				$_SESSION["admin_id"] = $admin["id"];
        $_SESSION["user_name"] = $admin["username"];
				$_SESSION["level"] = $admin["user_level"];
				if ($admin["key_pass"] == 1) {
					echo "<script>window.location.href='chgpass.php';</script>";
				}else{
					echo "<script>window.location.href='public/admin.php';</script>";
				}				
			} else { echo "Datos invalidos...";
			}
		} else { // Check username
			$query  = "SELECT * FROM admins WHERE username = '{$safe_email}' LIMIT 1";
			$admin_set = mysqli_query($connection, $query);
			confirm_query($admin_set);
			if($admin = mysqli_fetch_assoc($admin_set)) {
				$existing_hash = $admin["hashed_password"];
				$hash = crypt($pass, $admin["hashed_password"]);
				// if ((password_verify($pass, $existing_hash))) {
				if ($hash === $existing_hash) {
					echo "Bienvenido".' '.$admin["username"];
					$_SESSION["admin_id"] = $admin["id"];
          $_SESSION["user_name"] = $admin["username"];
					$_SESSION["level"] = $admin["user_level"];
					if ($admin["key_pass"] == 1) {
						echo "<script>window.location.href='chgpass.php';</script>";
					}else{
						echo "<script>window.location.href='public/admin.php';</script>";
					}				
				} else {
					echo "Datos invalidos...";
				}
			}else{
				echo "Datos invalidoss...";
			}
		}
  }