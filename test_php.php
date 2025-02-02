<?php

require_once __DIR__ . '/App/Entity/Ads.php';
require_once __DIR__ . '/App/Repository/AdsRepository.php';


use App\Entity\Ads;
use App\Repository\AdsRepository;

// Create a new Ads object
$ad = new Ads(1, "Test Ad", "This is a test ad description.", 99.99, "test.jpg");

echo "<h2>Ads Entity Test</h2>";
echo "<pre>";
print_r($ad);
echo "</pre>";

// Database Connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=okayz_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Test Repository
    $adsRepo = new AdsRepository($pdo);
    $foundAd = $adsRepo->findOneById(1); // Fetch ad with ID 1

    echo "<h2>Repository Test</h2>";
    echo "<pre>";
    print_r($foundAd);
    echo "</pre>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
