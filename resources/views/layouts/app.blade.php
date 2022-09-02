<?= '<'.'?'.'xml version="1.0" encoding="UTF-8"?>'."\n"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($maps as $map)
        <url>

            <loc>{{ $map['url'] }}</loc>

            <lastmod>{{ $map['lastmod'] }}</lastmod>

            <changefreq>{{ $map['changefreq'] }}</changefreq>

            <priority>{{ $map['priority'] }}</priority>

        </url>
    @endforeach
</urlset>