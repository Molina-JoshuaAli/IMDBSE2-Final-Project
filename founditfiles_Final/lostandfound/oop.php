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
    
    public function getFoundItemById($found_id) {
        $sql = "SELECT f.found_id, i.item_name, i.description, f.room_no, f.found_at, 
                       f.item_id, f.finder_id, i.item_id as original_item_id
                FROM Found f 
                JOIN Item i ON f.item_id = i.item_id
                WHERE f.found_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$found_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateFoundItem($found_id, $item_name, $description, $room_no) {
        // Start transaction
        $this->conn->beginTransaction();
        
        try {
            // First, get the item_id from the found record
            $sql = "SELECT item_id FROM Found WHERE found_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$found_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $item_id = $result['item_id'];
            
            // Update the Item table
            $sql = "UPDATE Item SET item_name = ?, description = ? WHERE item_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$item_name, $description, $item_id]);
            
            // Update the Found table
            $sql = "UPDATE Found SET room_no = ? WHERE found_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$room_no, $found_id]);
            
            // Commit transaction
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            // Rollback on error
            $this->conn->rollBack();
            return false;
        }
    }

    public function deleteFoundItem($found_id) {
        // Start transaction
        $this->conn->beginTransaction();
        
        try {
            // First, get the item_id from the found record
            $sql = "SELECT item_id FROM Found WHERE found_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$found_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $item_id = $result['item_id'];
            
            // First, delete any claims associated with this found item
            $sql = "DELETE FROM Claimed_items WHERE found_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$found_id]);
            
            // Delete from Found table
            $sql = "DELETE FROM Found WHERE found_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$found_id]);
            
            // Delete from Item table (only if not used elsewhere)
            $sql = "SELECT COUNT(*) as count FROM Found WHERE item_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$item_id]);
            $item_usage = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($item_usage['count'] == 0) {
                $sql = "DELETE FROM Item WHERE item_id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$item_id]);
            }
            
            // Commit transaction
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            // Rollback on error
            $this->conn->rollBack();
            return false;
        }
    }
    
}
?>