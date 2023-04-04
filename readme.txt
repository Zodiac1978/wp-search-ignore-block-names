=== Ignore block name in search ===
Contributors: zodiac1978
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LCH9UVV7RKDFY
Tags: search, better search, gutenberg, editor
Requires at least: 5.0.0
Tested up to: 6.2
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Modifies the native search to ignore block editor comments and HTML markup

== Description ==

This plugin modifies the native wordpress search function to ignore block names in post and page content.

With this plugin activated the unexpected search results are fixed which are reported in [#3739](https://github.com/WordPress/gutenberg/issues/3739) and in [#56294](https://core.trac.wordpress.org/ticket/56294)

Based on [Search Ignore HTML Tags](https://wordpress.org/plugins/wp-search-ignore-html-tags/) by [Pramod Sivadas](https://profiles.wordpress.org/pramodsivadas/)

== Installation ==

1. Upload the zip file from this plugin on your plugins page or search for `Ignore block name in search` and install it directly from the plugin directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Done!

== Frequently Asked Questions ==

= I don't see any changes. =

This plugin has no settings page, it modifies the internal search to ignore HTML comments in the post markup. 

Imagine a development blog using a syntaxhighlighting block. If you search on this blog to find posts with the term "syntaxhighlighting" you will get every post with code and not only those post which are really about syntax highlighting.

= I need more features! =

This plugin just wants to solve this particular problem without too much overhead. If you need more customizations to your search, then please have a look at [Relevanssi](https://wordpress.org/plugins/relevanssi/)

It is building up an index from your content and is therefore solving the underlying issue in another way with much more ways to customize it. And it will be even faster.

= Can I help you? =

Thanks for asking! Yes, I'm very interested in edge cases and imcompatibilities (other plugins or server configurations).
Please report on the [Github page](https://github.com/Zodiac1978/wp-search-ignore-block-names/issues).

== Screenshots ==

n/a

== Changelog ==

= 1.1.0 =
* Changed approach to remove the markup (now requires MySQL 8.0.4+ or MariaDB 10.0.5+)

= 1.0.0 =
* Initial release
