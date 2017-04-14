<?php 

    class User {
        public function login($username, $password) {
            global $pdo;

            $query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");
            $query->bindValue(1, $username);
            $query->bindValue(2, $password);
            $query->execute();
            
            return !empty($query->fetch()) ? true : false;
        }
        
        public function signup() {
            global $pdo;

            $query = $pdo->prepare("INSERT INTO users(user_name, user_password) VALUES(?, ?)");
            $query->bindValue(1, $username);
            $query->bindValue(2, $password);

            return $query->execute() ? true : false;
        }
    }

?>