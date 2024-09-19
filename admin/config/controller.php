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
        $kategori_id = sanitize($data['kategori_id']);

        // $query = "INSERT INTO film (kategori_id, title, slug, deskripsi, tanggal_rilis, studio) VALUES ('$kategori_id', '$title', '$slug', '$deskripsi', '$tanggal_rilis', '$studio')";
        // mysqli_query($database, $query);

        // return mysqli_affected_rows($database);

        $stmt = $database->prepare("INSERT INTO film (kategori_id, link, title, slug, deskripsi, tanggal_rilis, studio) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $kategori_id, $link, $title, $slug, $deskripsi, $tanggal_rilis, $studio);
        $stmt->execute();

        return $stmt->affected_rows;
    }

?>