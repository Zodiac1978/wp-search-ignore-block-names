# Ignore block name in search

Modifies the native search to ignore block editor comments and HTML markup

## Why?

This plugin modifies the native wordpress search function to ignore block names in post and page content.

With this plugin activated the unexpected search results are fixed which are reported in [#3739](WordPress/gutenberg#3739) and in [#56294](https://core.trac.wordpress.org/ticket/56294)

## Frequently Asked Questions

### I don't see any changes.

This plugin has no settings page, it modifies the internal search to ignore HTML and HTML comments in the post markup. 

Imagine a development blog using a syntaxhighlighting block. If you search on this blog to find posts with the term "syntaxhighlighting" you will get every post with code and not only those post which are really about syntax highlighting.

### I need more features!

This plugin just wants to solve this particular problem without too much overhead. If you need more customizations to your search, then please have a look at [Relevanssi](https://wordpress.org/plugins/relevanssi/).

It is building up an index from your content and is therefore solving the underlying issue in another way with much more ways to customize it. And it will be even faster.

### Can I help you?

Thanks for asking! Yes, I'm very interested in edge cases and incompatibilities (other plugins or server configurations).
Please open a [new issue](https://github.com/Zodiac1978/wp-search-ignore-block-names/issues) for this.


## Thanks

Props for helping to fix this go to [espiat](https://profiles.wordpress.org/espiat), [l1nuxjedi](https://profiles.wordpress.org/l1nuxjedi), [mustafauysal](https://profiles.wordpress.org/mustafauysal/), [ravishaheshan](https://profiles.wordpress.org/ravishaheshan), and [websupporter](https://profiles.wordpress.org/websupporter/)!

## Changelog

### 1.1.0

* Changed approach to remove the markup (now requires MySQL 8.0.4+ or MariaDB 10.0.5+)

### 1.0.0

* Initial public release
