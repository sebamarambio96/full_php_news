<?php
require_once './src/models/Model.php';

class News extends Model
{
    // Obtener todas las noticias ordenadas por fecha de publicación
    public function getAll()
    {
        $query = $this->db->prepare("SELECT * FROM noticias ORDER BY fecha_publicacion DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = $this->db->prepare("SELECT * FROM noticias WHERE id = :id");
        $query->execute([':id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function create($titulo, $contenido, $imagen, $autor)
    {
        $query = $this->db->prepare("INSERT INTO noticias (titulo, contenido, imagen, autor) VALUES (:titulo, :contenido, :imagen, :autor)");
        $query->execute([
            ':titulo' => $titulo,
            ':contenido' => $contenido,
            ':imagen' => $imagen,
            ':autor' => $autor
        ]);
    }

    public function update($id, $titulo, $contenido, $imagen, $autor)
    {
        $query = $this->db->prepare("UPDATE noticias SET titulo = :titulo, contenido = :contenido, imagen = :imagen, autor = :autor WHERE id = :id");
        $query->execute([
            ':titulo' => $titulo,
            ':contenido' => $contenido,
            ':imagen' => $imagen,
            ':autor' => $autor,
            ':id' => $id
        ]);
    }

    public function deleteById($id)
    {
        $query = $this->db->prepare("DELETE FROM noticias WHERE id = :id");
        $query->execute([':id' => $id]);
    }
}
?>
