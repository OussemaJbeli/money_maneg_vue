#!/bin/bash

# Start the Laravel development server
echo "clearing cash..."
php artisan cache:clear &
php artisan config:clear &
php artisan route:clear &
php artisan view:clear &


# Keep the script running
wait
