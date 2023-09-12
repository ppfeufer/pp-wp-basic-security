# WordPress Basic Security<a name="wordpress-basic-security"></a>

[![Translation status](https://weblate.ppfeufer.de/widget/wordpress-plugins/pp-wp-basic-security/svg-badge.svg)](https://weblate.ppfeufer.de/engage/wordpress-plugins/)

**Provides some basic security by removing WordPress's tendency to talk to much**

______________________________________________________________________

<!-- mdformat-toc start --slug=github --maxlevel=6 --minlevel=1 -->

- [WordPress Basic Security](#wordpress-basic-security)
  - [What will be removed?](#what-will-be-removed)
  - [What will be changed](#what-will-be-changed)
  - [Additional Information](#additional-information)
  - [Translation Status](#translation-status)

<!-- mdformat-toc end -->

______________________________________________________________________

### What will be removed?<a name="what-will-be-removed"></a>

- Generator name and version number `<meta name="generator" content="WordPress x.y.z" />`
- Blog Client Link `<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://link.net/xmlrpc.php?rsd" />`
- Live Writer Manifest `<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://link.net/wp-includes/wlwmanifest.xml" />`
- Rest API Link `<link rel='https://api.w.org/' href='http://link.net/wp-json/' />`
- oEmbed, so your own site cannot be embedded any longer
- X-Pingback (XMLRPC will still work)
- Emojis
- Relational next/prev links
- Shortlinks
- RSS Feed
- Version strings from all enqueued CSS and JavaScripts
- Debug output from Enfold Theme (really, no one should have that stuff in his generated HTML ...)
- WooCommerce Generator Tag
- Canonical Links

### What will be changed<a name="what-will-be-changed"></a>

- Youtube Embed gets a no cookie domain
- Replacing the default login error message with something not so revealing

### Additional Information<a name="additional-information"></a>

- [License](LICENSE)
- [Discord](https://discord.gg/YymuCZa)

### Translation Status<a name="translation-status"></a>

[![Translation status](https://weblate.ppfeufer.de/widget/wordpress-plugins/pp-wp-basic-security/multi-auto.svg)](https://weblate.ppfeufer.de/engage/wordpress-plugins/)

Do you want to help translate this app into your language or improve the existing
translation? - [Join our team of translators][weblate engage]!

<!-- Links -->

[weblate engage]: https://weblate.ppfeufer.de/engage/wordpress-plugins/ "Weblate Translations"
