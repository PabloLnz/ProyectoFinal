<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class PaisesModel extends BaseDbModel
{
    /**
     * @return array
     * devuelce los paises
     */
    public function getPaises(): array
    {
        $stmt = $this->pdo->query("SELECT id_pais, nombre FROM paises ORDER BY nombre");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param string $codigo
     * @param string $nombre
     * @return int
     * busca un pais ponr nombre y lo cerea si no exise
     */
    public function obtenerCrearPaises(string $codigo, string $nombre): int
    {
    
        $stmt = $this->pdo->prepare("SELECT id_pais FROM paises WHERE nombre = :nombre LIMIT 1");
        $stmt->execute([':nombre' => $nombre]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row && isset($row['id_pais'])) {
            return (int)$row['id_pais'];
        }
        $stmt = $this->pdo->prepare("INSERT INTO paises (nombre) VALUES (:nombre)");
        $stmt->execute([':nombre' => $nombre]);
        return (int)$this->pdo->lastInsertId();
    }


}