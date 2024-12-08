<?php
require_once './src/models/Model.php';

class PageInfo extends Model
{
    public function getPageById($id)
    {
        $query = $this->db->prepare("SELECT titulo, descripcion FROM info_pagina WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>
