# Ignore block names in search

[![Build status](https://github.com/Zodiac1978/wp-search-ignore-block-names/actions/workflows/ci.yml/badge.svg)](https://github.com/Zodiac1978/wp-search-ignore-block-names/actions/workflows/ci.yml) [![Current plugin version](https://img.shields.io/wordpress/plugin/v/ignore-block-name-in-search.svg)](https://wordpress.org/plugins/ignore-block-name-in-search/) [![Number of downloads](https://img.shields.io/wordpress/plugin/dt/ignore-block-name-in-search.svg)](https://wordpress.org/plugins/ignore-block-name-in-search/advanced/) [![Number of active installs](https://img.shields.io/wordpress/plugin/installs/ignore-block-name-in-search.svg)](https://wordpress.org/plugins/ignore-block-name-in-search/advanced/) [![WordPress plugin rating](https://img.shields.io/wordpress/plugin/r/ignore-block-name-in-search.svg)](https://wordpress.org/plugins/ignore-block-name-in-search/#reviews) [![Donate with PayPal](https://img.shields.io/badge/PayPal-Donate-yellow.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LCH9UVV7RKDFY)

Modifies the native search to ignore block editor metadata.

## Why?

This plugin modifies the native WordPress search feature to ignore block editor comments and generated block class names in your content.

With this plugin activated the unexpected search results are fixed which are reported in [#3739](WordPress/gutenberg#3739) and in [#56294](https://core.trac.wordpress.org/ticket/56294)

**Works only for MySQL 8.0.4+ and MariaDB 10.0.5+**

## Frequently Asked Questions

### I don't see any changes.

This plugin has no settings page. It modifies the internal search to ignore HTML comments and generated `wp-block-*` class names in the post markup.

Imagine a development blog using a syntaxhighlighting block. If you search on this blog to find posts with the term "syntaxhighlighting" you will get every post with code and not only those post which are really about syntax highlighting.

### What about HTML attributes, captions, and shortcodes?

The plugin no longer strips HTML tags or shortcodes. Visible content, HTML attributes, captions, filenames, and shortcodes remain searchable.

### I need more features!

This plugin just wants to solve this particular problem without too much overhead. If you need more customizations to your search, then please have a look at [Relevanssi](https://wordpress.org/plugins/relevanssi/) or [Better Search](https://wordpress.org/plugins/better-search/).

These plugins are building up an index from your content and are therefore solving the underlying issue in another way with much more ways to customize it. And they will be even faster.

### Can I help you?

Thanks for asking! Yes, I'm very interested in edge cases and incompatibilities (other plugins or server configurations).
Please open a [new issue](https://github.com/Zodiac1978/wp-search-ignore-block-names/issues) for this.


## Thanks

Props for helping to fix this go to [espiat](https://profiles.wordpress.org/espiat), [l1nuxjedi](https://profiles.wordpress.org/l1nuxjedi), [mustafauysal](https://profiles.wordpress.org/mustafauysal/), [ravishaheshan](https://profiles.wordpress.org/ravishaheshan), and [websupporter](https://profiles.wordpress.org/websupporter/)!

## Changelog

### 1.3.1
* Ignore generated `wp-block-*` class names in addition to block editor comments

### 1.3.0
* Limit filtering to block editor comments to avoid hiding visible content when markup contains unescaped `<` or `>` characters
* Keep shortcodes and HTML attributes searchable

### 1.2.0
* Fixed broken search for title and excerpt
* Ignore shortcodes additionally to markup
* Rename plugin

### 1.1.1

* Added back link to error message, if REGEXP_REPLACE is not supported
* Fixed some typos

### 1.1.0

* Changed approach to remove the markup (now requires MySQL 8.0.4+ or MariaDB 10.0.5+)

### 1.0.0

* Initial public release
