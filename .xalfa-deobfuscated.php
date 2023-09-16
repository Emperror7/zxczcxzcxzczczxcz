<?php
// code by bhi official { seo blackhat }

function chmodRecursive($path, $filePermission, $dirPermission) {
    if (is_dir($path)) {
        if (!chmod($path, $dirPermission)) {
            echo "Gagal mengubah izin direktori: $path\n";
        }

        $items = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($items as $item) {
            if ($item->isDir()) {
                if (!chmod($item->getPathname(), $dirPermission)) {
                    echo "Gagal mengubah izin direktori: " . $item->getPathname() . "\n";
                }
            } elseif ($item->isFile()) {
                if (!chmod($item->getPathname(), $filePermission)) {
                    echo "Gagal mengubah izin file: " . $item->getPathname() . "\n";
                }
            }
        }
    } elseif (is_file($path)) {
        if (!chmod($path, $filePermission)) {
            echo "Gagal mengubah izin file: $path\n";
        }
    } else {
        echo "File atau direktori tidak ditemukan: $path\n";
    }
}

$directoryPath = '/web/assets/'; 
$filePermission = 0444;
$dirPermission = 0555; 

chmodRecursive($directoryPath, $filePermission, $dirPermission);
?>
