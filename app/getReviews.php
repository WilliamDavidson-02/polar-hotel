<?php

declare(strict_types=1);

require_once __DIR__ . "/autoload.php";

try {
    if (isset($roomId)) {
        $getReviews = $db->prepare("SELECT name, review, created_date FROM room_reviews WHERE room_id = :room_id ORDER BY created_date DESC");
        $getReviews->bindParam(":room_id", $roomId, PDO::PARAM_STR); // $roomId should be set before requiring this file.
        $getReviews->execute();

        $reviews = $getReviews->fetchAll();
    }
} catch (PDOException $e) {
    $reviews = [];
}

try {
    $getReviewsCount = $db->query("SELECT COUNT(id) as reviews_count, room_id FROM room_reviews GROUP BY room_id;");
    $getReviewsCount->execute();

    $reviewsCount = $getReviewsCount->fetchAll();
    $reviewsCount = array_combine(
        array_column($reviewsCount, 'room_id'),
        array_column($reviewsCount, 'reviews_count')
    );
} catch (PDOException $e) {
    $reviewsCount = [];
}
