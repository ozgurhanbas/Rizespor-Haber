<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // HTML'de güvenli çıktı için escape et
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

    $newsEntry = "<div class='news-card'><h3 class='card-title'>$title</h3><p class='card-description'>$content</p></div>\n";

    $file = 'haberler.html';
    $currentContent = file_get_contents($file);
    $updatedContent = preg_replace('/(<div class="news-grid">)/', "$1\n$newsEntry", $currentContent);
    
    if (file_put_contents($file, $updatedContent) !== false) {
        echo "Haber başarıyla eklendi!";
    } else {
        echo "Haber eklenirken hata oluştu!";
    }
} else {
    echo "Geçersiz istek.";
}
?>
