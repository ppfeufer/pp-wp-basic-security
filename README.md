# WordPress Basic Security<a name="wordpress-basic-security"></a>

![License](https://img.shields.io/badge/license-GPLv3-green "License")
[![pre-commit.ci status](https://results.pre-commit.ci/badge/github/ppfeufer/pp-wp-basic-security/master.svg)](https://results.pre-commit.ci/latest/github/ppfeufer/pp-wp-basic-security/master)

**Provides some basic security by removing WordPress's tendency to talk too much**

> \[!IMPORTANT\]
>
> This plugin has been replaced by a more comprehensive solution.\
> Use [pp-wordpress-tweaks](https://github.com/ppfeufer/pp-wordpress-tweaks) instead.

______________________________________________________________________

<!-- mdformat-toc start --slug=github --maxlevel=6 --minlevel=1 -->

- [WordPress Basic Security](#wordpress-basic-security)
  - [What Will Be Removed](#what-will-be-removed)
  - [What Will Be Changed](#what-will-be-changed)
  - [Minimum Requirements](#minimum-requirements)

<!-- mdformat-toc end -->

______________________________________________________________________

### What Will Be Removed<a name="what-will-be-removed"></a>

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
- Debug output from Enfold Theme (really, no one should have that stuff in their
  generated HTML ...)
- WooCommerce Generator Tag
- Canonical Links

### What Will Be Changed<a name="what-will-be-changed"></a>

- Youtube Embed gets a no cookie domain
- Replacing the default login error message with something not so revealing

### Minimum Requirements<a name="minimum-requirements"></a>

- WordPress 6.0
- PHP 8.2
