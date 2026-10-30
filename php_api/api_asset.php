<?php

include 'condb.php';

$action = $_POST['action'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action) {
    // เพิ่ม / แก้ไข / ลบ
    switch($action) {

        case 'add':
            $asset_code = $_POST['asset_code'] ?? '';
            $asset_name = $_POST['asset_name'] ?? '';
            $purchase_date = $_POST['purchase_date'] ?? null;
            $price = $_POST['price'] ?? 0;
            $created_at = date('Y-m-d H:i:s'); // ให้ฐานข้อมูลหรือ PHP จัดการเวลาบันทึก

            // อัพโหลดไฟล์รูป
            $filename = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $targetDir = "uploads/";
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $filename = time() . '_' . basename($_FILES['image']['name']);
                $targetFile = $targetDir . $filename;
                move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
            }

            // แก้ชื่อตารางจาก products เป็น assets และเพิ่ม price
            $sql = "INSERT INTO assets (asset_code, asset_name, purchase_date, price, image, created_at)
                    VALUES (:asset_code, :asset_name, :purchase_date, :price, :image, :created_at)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':asset_code', $asset_code);
            $stmt->bindParam(':asset_name', $asset_name);
            $stmt->bindParam(':purchase_date', $purchase_date);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image', $filename);
            $stmt->bindParam(':created_at', $created_at);

            if ($stmt->execute()) {
                echo json_encode(["message" => "เพิ่มข้อมูลสำเร็จ"]);
            } else {
                echo json_encode(["error" => "เพิ่มข้อมูลล้มเหลว"]);
            }
            break;

        case 'update':
            $asset_id = $_POST['asset_id'] ?? null;
            $asset_code = $_POST['asset_code'] ?? '';
            $asset_name = $_POST['asset_name'] ?? '';
            $purchase_date = $_POST['purchase_date'] ?? null;
            $price = $_POST['price'] ?? 0;

            // ตรวจสอบการอัพโหลดรูปใหม่
            $imageClause = "";
            $hasNewImage = false;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $targetDir = "uploads/";
                $filename = time() . '_' . basename($_FILES['image']['name']);
                $targetFile = $targetDir . $filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imageClause = ", image = :image";
                    $hasNewImage = true;
                }
            }

            // จัดโครงสร้าง SQL ให้ถูกต้อง (มีคอมมา , คั่นระหว่างฟิลด์ชัดเจน)
            $sql = "UPDATE assets SET 
                        asset_code = :asset_code,
                        asset_name = :asset_name,
                        purchase_date = :purchase_date,
                        price = :price
                        {$imageClause}
                    WHERE asset_id = :asset_id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':asset_code', $asset_code);
            $stmt->bindParam(':asset_name', $asset_name);
            $stmt->bindParam(':purchase_date', $purchase_date);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':asset_id', $asset_id);
            
            if ($hasNewImage) {
                $stmt->bindParam(':image', $filename);
            }

            if ($stmt->execute()) {
                echo json_encode(["message" => "แก้ไขข้อมูลสำเร็จ"]);
            } else {
                echo json_encode(["error" => "แก้ไขข้อมูลล้มเหลว"]);
            }
            break;

        case 'delete':
            $asset_id = $_POST['asset_id'] ?? null;
            $stmt = $conn->prepare("DELETE FROM assets WHERE asset_id = :asset_id");
            $stmt->bindParam(':asset_id', $asset_id);
            if ($stmt->execute()) {
                echo json_encode(["message" => "ลบข้อมูลสำเร็จ"]);
            } else {
                echo json_encode(["error" => "ลบข้อมูลล้มเหลว"]);
            }
            break;

        default:
            echo json_encode(["error" => "Action ไม่ถูกต้อง"]);
            break;
    }

} else {
    // GET: ดึงข้อมูล
    $stmt = $conn->prepare("SELECT * FROM assets ORDER BY asset_id DESC");
    if ($stmt->execute()) {
        $assets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(["success" => true, "data" => $assets]);
    } else {
        echo json_encode(["success" => false, "data" => []]);
    }
}
?>