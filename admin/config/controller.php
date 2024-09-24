<?php 

function query($query){
    global $database;

    $result = mysqli_query($database, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)){
        $rows[] =$row;
    }

    return $rows;
}


    function store_category($data){
            global $database;
            
            $title = sanitize($data['title']);
            $slug = sanitize($data['slug']);

            // $query = "INSERT INTO kategori (name, slug) VALUES ('$title', '$slug')";
            // mysqli_query($database, $query);

            // return mysqli_affected_rows($database);

            $stmt = $database->prepare("INSERT INTO kategori (name, slug) VALUES (?, ?)");
            $stmt->bind_param("ss", $title, $slug);
            $stmt->execute();

        return $stmt->affected_rows;
        }

    function delete_kategori($id){
        global $database;

        // $query = "DELETE FROM kategori WHERE id_kategori = $id";
        // mysqli_query($database, $query);

        // return mysqli_affected_rows($database);

        $stmt = $database->prepare("DELETE FROM kategori WHERE id_kategori = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->affected_rows;
        
    }

    function edit_kategori($id, $data) {
    global $database;

    $title = sanitize($data['title']);
    $slug = sanitize($data['slug']);

    // $query = "UPDATE kategori SET name = '$title', slug = '$slug' WHERE id_kategori = $id";
    // mysqli_query($database, $query);

    // return mysqli_affected_rows($database);

    $stmt = $database->prepare("UPDATE kategori SET name = ?, slug = ? WHERE id_kategori = ?");
    $stmt->bind_param("ssi", $title, $slug, $id);
    $stmt->execute();

    return $stmt->affected_rows;
    }

    function store_film($data){
        global $database;
        
        $link = sanitize($data['link']);
        $title = sanitize($data['title']);
        $slug = sanitize($data['slug']);
        $deskripsi = sanitize($data['deskripsi']);
        $tanggal_rilis = sanitize($data['tanggal_rilis']);
        $studio = sanitize($data['studio']);
        $status = sanitize($data['private']);
        $kategori_id = sanitize($data['kategori_id']);

        // $query = "INSERT INTO film (kategori_id, title, slug, deskripsi, tanggal_rilis, studio) VALUES ('$kategori_id', '$title', '$slug', '$deskripsi', '$tanggal_rilis', '$studio')";
        // mysqli_query($database, $query);

        // return mysqli_affected_rows($database);

        $stmt = $database->prepare("INSERT INTO film (kategori_id, link, title, slug, deskripsi, tanggal_rilis, studio, private) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $kategori_id, $link, $title, $slug, $deskripsi, $tanggal_rilis, $studio, $status);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    function delete_film($id){
        global $database;

        $stmt = $database->prepare("DELETE FROM film WHERE id_film = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    function edit_film($id, $data){
        global $database;

        $link = sanitize($data['link']);
        $title = sanitize($data['title']);
        $slug = sanitize($data['slug']);
        $deskripsi = sanitize($data['deskripsi']);
        $tanggal_rilis = sanitize($data['tanggal_rilis']);
        $studio = sanitize($data['studio']);
        $status = sanitize($data['private']);
        $kategori_id = sanitize($data['kategori_id']);

        $stmt = $database->prepare("UPDATE film SET link = ?, title = ?, slug = ?, deskripsi = ?, tanggal_rilis = ?, studio = ?, kategori_id = ?, private = ? WHERE id_film = ?");
        $stmt->bind_param("ssssssssi", $link, $title, $slug, $deskripsi, $tanggal_rilis, $studio, $kategori_id, $status, $id);
        $stmt->execute();

    return $stmt->affected_rows;
    }

    function store_user($data){
            global $database;
            
            $username = sanitize($data['username']);
            $email = sanitize($data['email']);
            $password = sanitize(password_hash($data['password'], PASSWORD_DEFAULT));
            $role = sanitize($data['role']);

            $stmt = $database->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $password, $role);
            $stmt->execute();

        return $stmt->affected_rows;
        }

        function delete_user($id){
        global $database;

        $stmt = $database->prepare("DELETE FROM users WHERE id_user = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->affected_rows;
        }

        function edit_user($id, $data){
        global $database;

        $username = sanitize($data['username']);
        $email = sanitize($data['email']);
        $password = sanitize(password_hash($data['password'], PASSWORD_DEFAULT));
        $role = sanitize($data['role']);

        $stmt = $database->prepare("UPDATE users SET username = ?, email = ?, password = ?, role = ? WHERE id_user = ?");
        $stmt->bind_param("ssssi", $username, $email, $password, $role, $id);
        $stmt->execute();

        return $stmt->affected_rows;
        }
        


?>