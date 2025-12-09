<?php
header('Content-Type: application/json');
require "connection.php";

$input = json_decode(file_get_contents("php://input"), true);

if (!$input) {
    echo json_encode(["success" => false, "message" => "Invalid JSON"]);
    exit;
}

$code = $input["code"] ?? "";
$title = $input["title"] ?? "";
$price = $input["price"] ?? "";
$description = $input["description"] ?? "";
$img = $input["img"] ?? "";

if ($code === "" || $title === "") {
    echo json_encode(["success" => false, "message" => "code & title wajib"]);
    exit;
}

try {
    if (isset($input["id"])) {
        // UPDATE
        $stmt = $pdo->prepare(
            "UPDATE models SET code=?, title=?, price=?, description=?, img=? WHERE id=?"
        );
        $stmt->execute([$code, $title, $price, $description, $img, $input["id"]]);

        echo json_encode(["success" => true, "message" => "Updated"]);
    } else {
        // INSERT
        $stmt = $pdo->prepare(
            "INSERT INTO models (code, title, price, description, img)
             VALUES (?,?,?,?,?)"
        );
        $stmt->execute([$code, $title, $price, $description, $img]);

        echo json_encode(["success" => true, "message" => "Inserted"]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
