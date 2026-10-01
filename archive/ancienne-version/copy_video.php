<?php
// Get the actual watermarked file from Downloads
$downloadsDir = 'C:\\Users\\adams\\Downloads';
$files = scandir($downloadsDir);
$watermarkedFile = null;

foreach ($files as $file) {
    if (strpos($file, 'watermarked') !== false && strpos($file, '.mp4') !== false) {
        $watermarkedFile = $downloadsDir . '\\' . $file;
        break;
    }
}

if (!$watermarkedFile) {
    echo "✗ Aucun fichier watermarked.mp4 trouvé\n";
    exit(1);
}

$destDir = 'C:\\Users\\adams\\Desktop\\projet\\public\\videos';
$destFile = $destDir . '\\' . basename($watermarkedFile);

// Create directory if needed
if (!is_dir($destDir)) {
    mkdir($destDir, 0755, true);
}

// Copy the file
if (copy($watermarkedFile, $destFile)) {
    echo "✓ Vidéo copiée avec succès !\n";
    echo "Source: $watermarkedFile\n";
    echo "Destination: $destFile\n";
} else {
    echo "✗ Erreur lors de la copie\n";
}
?>
