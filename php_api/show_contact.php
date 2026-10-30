<?php
include 'condb.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!is_array($data)) {
            $data = $_POST;
        }

        $subject = trim($data['subject'] ?? '');
        $detail = trim($data['detail'] ?? '');
        $fullname = trim($data['fullname'] ?? '');
        $email = trim($data['email'] ?? '');

        if ($subject === '' || $detail === '' || $fullname === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'กรุณากรอกข้อมูลให้ครบและตรวจสอบอีเมล'], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $stmt = $conn->prepare(
            "INSERT INTO contacts (subject, detail, fullname, email, created_at)
             VALUES (:subject, :detail, :fullname, :email, NOW())"
        );
        $stmt->execute([
            ':subject' => $subject,
            ':detail' => $detail,
            ':fullname' => $fullname,
            ':email' => $email
        ]);

        http_response_code(201);
        echo json_encode([
            'status' => 'success',
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'contact_id' => $conn->lastInsertId()
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(405);
        echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        exit;
    }

    $stmt = $conn->query("SELECT * FROM contacts ORDER BY contact_id DESC");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'ไม่สามารถดำเนินการกับข้อมูลติดต่อได้'], JSON_UNESCAPED_UNICODE);
}
?>
