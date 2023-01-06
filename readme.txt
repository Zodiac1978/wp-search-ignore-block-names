=== Ignore block name in search ===
Contributors: zodiac1978
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LCH9UVV7RKDFY
Tags: search, better search, gutenberg, editor
Requires at least: 5.0.0
Tested up to: 6.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Modifies the native search to ignore block editor comments

== Description ==

This plugin modifies the native wordpress search function to ignore block names in post and page content.

With this plugin activated the unexpected search results are fixed which are reported in [#3739](https://github.com/WordPress/gutenberg/issues/3739)

Based on [Search Ignore HTML Tags](https://wordpress.org/plugins/wp-search-ignore-html-tags/) by [Pramod Sivadas](https://profiles.wordpress.org/pramodsivadas/)

== Installation ==

1. Upload the zip file from this plugin on your plugins page or search for `Ignore block name in search` and install it directly from the plugin directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Done!

== Frequently Asked Questions ==

= I don't see any changes. =

This plugin has no settings page, it modifies the internal search to ignore HTML comments in the post markup. 

Imagine a development blog using a syntaxhighlighting block. If you search on this blog to find posts with the term "syntaxhighlighting" you will get every post with code and not only those post which are really about syntax highlighting.

= Can I help you? =

Thanks for asking! Yes, I'm very interested in edge cases and imcompatibilities (other plugins or server configurations).
Please report on the [Github page](https://github.com/Zodiac1978/wp-search-ignore-block-names/issues).

== Screenshots ==

n/a

== Changelog ==

= 1.0.0 =
* Initial release
