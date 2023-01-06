# Ignore block name in search

Modifies the native search to ignore block editor comments

## Why?

This plugin modifies the native wordpress search function to ignore block names in post and page content.

With this plugin activated the unexpected search results are fixed which are reported in [#3739](WordPress/gutenberg#3739)

## Frequently Asked Questions

### I don't see any changes.

This plugin has no settings page, it modifies the internal search to ignore HTML comments in the post markup. 

Imagine a law development blog using a syntaxhighlighting block. If you search on this blog to find posts with the term "syntaxhighlighting" you will get every post with code and not only those post which are really about syntax highlighting.

### Can I help you?

Thanks for asking! Yes, I'm very interested in edge cases and imcompatibilities (other plugins or server configurations).
Please open a [new issue](https://github.com/Zodiac1978/wp-search-ignore-block-names/issues) for this.


## Thanks

Based on "Search Ignore HTML Tags" by [Pramod Sivadas](https://profiles.wordpress.org/pramodsivadas/)

https://wordpress.org/plugins/wp-search-ignore-html-tags/

## Changelog

### 1.0.0

* Initial public release
