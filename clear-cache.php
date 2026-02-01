<?php
// Script untuk clear cache Laravel
echo "Clearing Laravel cache...\n";

// Clear application cache
exec('php artisan cache:clear', $output1);
echo "✓ Application cache cleared\n";

// Clear config cache
exec('php artisan config:clear', $output2);
echo "✓ Config cache cleared\n";

// Clear route cache
exec('php artisan route:clear', $output3);
echo "✓ Route cache cleared\n";

// Clear view cache
exec('php artisan view:clear', $output4);
echo "✓ View cache cleared\n";

// Clear compiled services
exec('php artisan clear-compiled', $output5);
echo "✓ Compiled services cleared\n";

// Optimize for production
exec('php artisan optimize', $output6);
echo "✓ Application optimized\n";

echo "\nAll caches cleared successfully!\n";
echo "Please refresh your browser and try again.\n";
?>