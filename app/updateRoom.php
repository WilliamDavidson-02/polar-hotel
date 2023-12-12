<?php

declare(strict_types=1);

require_once __DIR__ . "/autoload.php";

if (isset($_POST["name"], $_POST["price"], $_POST["description"], $_POST["id"])) {
    $name = htmlspecialchars(trim(ucfirst($_POST["name"])));
    $price = intval($_POST["price"]);
    $description = htmlspecialchars(trim($_POST["description"]));
    $id = intval($_POST["id"]);

    if (!is_numeric($id)) return;

    $updateRoom = $db->prepare("UPDATE rooms SET name = :name, price = :price, description = :description WHERE id = :id");

    $updateRoom->bindParam(":name", $name, PDO::PARAM_STR);
    $updateRoom->bindParam(":price", $price, PDO::PARAM_INT);
    $updateRoom->bindParam(":description", $description, PDO::PARAM_STR);
    $updateRoom->bindParam(":id", $id, PDO::PARAM_INT);

    $updateRoom->execute();
}

redirect("/admin.php");