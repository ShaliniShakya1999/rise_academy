$root = 'd:\project\peyug_project\rise_academy'
Get-ChildItem -Path $root -Recurse -Include *.php,*.html,*.js,*.css -File | ForEach-Object {
    $content = Get-Content $_.FullName -Raw
    # Replace brand name
    $content = $content -replace 'Internmo'
    # Replace logo img tags with brand link
    $pattern = '<img[^>]*rise_logo\.png[^>]*>'
    $replacement = '<a href="http://internmo.com/" class="font-bold text-lg text-white">Internmo</a>'
    $content = [regex]::Replace($content, $pattern, $replacement)
    Set-Content -Path $_.FullName -Value $content -Encoding UTF8
}
