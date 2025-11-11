<?php
require_once 'db.php';

class LostAndFound {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function addFinder($firstname, $lastname, $department, $student_id) {
        $sql = "INSERT INTO Finder (firstname, lastname, department, student_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$firstname, $lastname, $department, $student_id]);
        return $this->conn->lastInsertId();
    }

    public function addClaimer($firstname, $lastname, $student_id) {
        $sql = "INSERT INTO Claimer (firstname, lastname, student_id) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$firstname, $lastname, $student_id]);
        return $this->conn->lastInsertId();
    }

    public function addItem($name, $desc) {
        $sql = "INSERT INTO Item (item_name, description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name, $desc]);
        return $this->conn->lastInsertId();
    }

    public function addFound($item_id, $room_no, $finder_id) {
        $sql = "INSERT INTO Found (item_id, room_no, finder_id) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$item_id, $room_no, $finder_id]);
        return true;
    }

    public function addClaim($claimer_id, $item_id, $found_id) {
        $sql = "INSERT INTO Claimed_items (claimer_id, item_id, found_id) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$claimer_id, $item_id, $found_id]);
        return true;
    }

    public function getAllFoundItems() {
        $sql = "SELECT f.found_id, i.item_name, i.description, f.room_no, f.found_at 
                FROM Found f 
                JOIN Item i ON f.item_id = i.item_id
                ORDER BY f.found_at DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
