$root = "d:\project\peyug_project\rise_academy"
Get-ChildItem -Path $root -Recurse -Include *.php,*.html,*.js,*.css -File | ForEach-Object {
    $content = Get-Content $_.FullName -Raw
    $content = $content -replace , 'Internmo'
    $content = $content -replace '<img[^>]*src=["\'\']([^"\'\']*rise_logo\.png)[^>]*>', '<a href="http://internmo.com/" class="font-bold text-lg text-white">Internmo</a>'
    Set-Content -Path $_.FullName -Value $content -Encoding UTF8
}
