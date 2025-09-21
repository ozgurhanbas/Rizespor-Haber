<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newsId = $_POST['news_id'];
    
    $file = 'haberler.html';
    $currentContent = file_get_contents($file);
    
    // Haber kartını sil (basit regex ile)
    // Bu regex, belirli bir haber kartını bulup siler
    $pattern = '/<div class="news-card"[^>]*data-id="' . preg_quote($newsId, '/') . '"[^>]*>.*?<\/div>\s*(?=<div class="news-card"|$)/s';
    $updatedContent = preg_replace($pattern, '', $currentContent);
    
    if (file_put_contents($file, $updatedContent) !== false) {
        echo "Haber başarıyla silindi!";
    } else {
        echo "Haber silinirken hata oluştu!";
    }
} else {
    echo "Geçersiz istek.";
}
?>
