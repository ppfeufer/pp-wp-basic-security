# WordPress Basic Security

**Provides some basic security by removing WordPress's tendency to talk to much**

### What will be removed?
- Generator name and version number ```<meta name="generator" content="WordPress x.y.z" />```
- Blog Client Link ```<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://link.net/xmlrpc.php?rsd" />```
- Live Writer Manifest ```<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://link.net/wp-includes/wlwmanifest.xml" />```
- Rest API Link ```<link rel='https://api.w.org/' href='http://link.net/wp-json/' />```
- oEmbed, so your own site cannot be embedded any longer
- X-Pingback (XMLRPC will still work)
- Emojis
- Relational next/prev links
- Shortlinks
- RSS Feed
- Version strings from all enqueued CSS and JavaScripts
- Debug outpuf from Enfold Theme (really, no one should have that stuff in his generated HTML ...)
