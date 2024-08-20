#!/bin/bash

# Execute the command in the background
nohup php artisan queue:listen --timeout=3600 > /dev/null 2>&1 &

# Print the process ID of the background job
echo "Queue listener started with PID $!"
