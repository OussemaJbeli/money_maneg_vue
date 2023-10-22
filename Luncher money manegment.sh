#!/bin/bash

# Start the Laravel development server
echo "Starting Laravel development server..."
php artisan serve &

# Start the npm development build
echo "Starting npm development build..."
npm run dev &

# Wait for a moment to ensure the servers are up and running
sleep 12

# Open the Laravel app in the default web browser (Windows)
echo "Opening the Laravel app in your default web browser..."
start http://127.0.0.1:8000

# Keep the script running
wait
