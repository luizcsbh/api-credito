# Create a file named `setup.sh`
#!/bin/bash
mkdir -p /app/storage/framework/{cache,sessions,views}
chmod -R 775 /app/storage