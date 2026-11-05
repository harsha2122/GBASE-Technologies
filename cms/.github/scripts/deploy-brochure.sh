#!/usr/bin/env bash
set -euo pipefail
umask 077

app=/var/www/backup-edudag-1/current/cms
revision=bd93cf579c2b32776c6b47e0a5d016840008b14c
baseline=37b136a71dda1f8fceae2ef53b32623bd79a47f6
repository=https://github.com/harsha2122/GBASE-Technologies.git

for command in git php python3 sudo tar composer; do
    command -v "$command" >/dev/null || { echo "Missing command: $command" >&2; exit 1; }
done
test -f "$app/artisan"
test -d "$app/vendor/composer"
cd "$app"

deploy_dir=$(mktemp -d)
trap 'rm -rf -- "$deploy_dir"' EXIT
git clone --depth 3 --branch feat/filament-brochure-upload "$repository" "$deploy_dir/repo"
git -C "$deploy_dir/repo" fetch --depth 2 origin "$revision"
git -C "$deploy_dir/repo" checkout --detach "$revision"
test "$(git -C "$deploy_dir/repo" rev-parse HEAD)" = "$revision"

files=(
    app/Filament/Pages/ManageSettings.php
    app/Http/Controllers/BrochureController.php
    app/Http/Controllers/HomeController.php
    app/Models/Setting.php
    config/livewire.php
    database/migrations/2026_11_05_122726_add_brochure_path_to_settings_table.php
    resources/views/home.blade.php
    routes/web.php
)

# Refuse to overwrite server edits or an independently published Livewire config.
for file in "${files[@]}"; do
    if [ ! -e "$app/$file" ]; then
        if git -C "$deploy_dir/repo" cat-file -e "$baseline:cms/$file" 2>/dev/null; then
            echo "STOP: expected server file is missing: $file. No application files changed." >&2
            exit 1
        fi
        continue
    fi
    if cmp -s "$app/$file" "$deploy_dir/repo/cms/$file"; then
        continue
    fi
    if git -C "$deploy_dir/repo" show "$baseline:cms/$file" > "$deploy_dir/expected" 2>/dev/null && cmp -s "$app/$file" "$deploy_dir/expected"; then
        continue
    fi
    echo "STOP: $file differs from the known deployment. Merge this server change before deploying; no application files changed." >&2
    exit 1
done

runtime_owner=$(stat -c '%U' storage/framework/views)
vendor_owner=$(stat -c '%U' vendor/composer)
source_owner=$(stat -c '%U:%G' app)
database_file=$(sudo -u "$runtime_owner" php -r '
require "vendor/autoload.php";
$app = require "bootstrap/app.php";
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$connection = Illuminate\Support\Facades\DB::connection();
if ($connection->getDriverName() !== "sqlite") {
    fwrite(STDERR, "STOP: this deployment helper requires a SQLite backup; use your configured database backup procedure instead.\n");
    exit(1);
}
echo $connection->getDatabaseName();
')
test -f "$database_file"

backup_dir=$(mktemp -d "$HOME/gbase-brochure-backup-$(date +%Y%m%d-%H%M%S)-XXXXXX")
sudo tar -czf "$backup_dir/source.tgz" -C "$app" app config resources/views routes database/migrations
sudo python3 - "$database_file" "$backup_dir/database.sqlite" <<'PY'
from pathlib import Path
import os
import sqlite3
import sys
os.umask(0o077)
source_path = Path(sys.argv[1]).resolve()
with sqlite3.connect(source_path.as_uri() + '?mode=ro', uri=True) as source:
    with sqlite3.connect(sys.argv[2]) as destination:
        source.backup(destination)
os.chmod(sys.argv[2], 0o600)
PY
echo "Source and consistent SQLite backup saved in: $backup_dir"

archive_paths=()
for file in "${files[@]}"; do archive_paths+=("cms/$file"); done
git -C "$deploy_dir/repo" archive --format=tar --output="$deploy_dir/update.tar" "$revision" -- "${archive_paths[@]}"
sudo tar --extract --file="$deploy_dir/update.tar" --directory="$app" --strip-components=1 --no-same-owner --same-permissions --no-overwrite-dir
for file in "${files[@]}"; do sudo chown "$source_owner" "$app/$file"; done

sudo -u "$vendor_owner" composer --no-plugins dump-autoload --no-dev --optimize --no-scripts
sudo -u "$runtime_owner" php artisan config:clear
sudo -u "$runtime_owner" php artisan migrate --force --no-interaction --path=database/migrations/2026_11_05_122726_add_brochure_path_to_settings_table.php
sudo -u "$runtime_owner" php artisan route:clear
sudo -u "$runtime_owner" php artisan view:clear
sudo -u "$runtime_owner" php artisan route:list --path=brochure --except-vendor

echo 'Deployed. Open /admin/manage-settings using your existing admin account.'
echo 'For 30 MB uploads, PHP-FPM needs upload_max_filesize=30M and post_max_size=35M; Nginx needs client_max_body_size 35M.'
