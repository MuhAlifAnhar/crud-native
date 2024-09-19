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
        
        $title = $data['title'];
        $slug = $data['slug'];

        $query = "INSERT INTO kategori (name, slug) VALUES ('$title', '$slug')";
        mysqli_query($database, $query);

        return mysqli_affected_rows($database);
    }

    function delete_kategori($id){
        global $database;

        $query = "DELETE FROM kategori WHERE id_kategori = $id";
        mysqli_query($database, $query);

        return mysqli_affected_rows($database);
    }

    function edit_kategori($id, $data) {
    global $database;

    $title = $data['title'];
    $slug = $data['slug'];

    $query = "UPDATE kategori SET name = '$title', slug = '$slug' WHERE id_kategori = $id";
    mysqli_query($database, $query);

    return mysqli_affected_rows($database);
    } 

?>