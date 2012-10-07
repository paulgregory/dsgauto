=== Plugin Name ===

Contributors: Matthias Vandermaesen
Donate link: http://www.mollom.com
Tags: comments, spam, mollom, captcha, text analysis, moderation, comment, blocking
Requires at least: 2.5.0
Tested up to: 2.9.0
Stable tag: 0.7.5

A plugin that brings the power of Mollom (http://www.mollom.com) to Wordpress and makes your website spamfree!

== Description ==

<a href="http://www.mollom.com">Mollom</a> protects your website against comment and trackback spam. Mollom differs from other spam deterring services because it takes care of everything. The idea is to relieve you, the administrator, editor, maintainer,... of any moderation or clean up tasks you would normally need to perform in order to keep your blog spamfree.

Mollom combines the power of intelligent text analysis to automatically filter spam with the efficiency of a safe
CAPTCHA test. If Mollom is unsure if a comment is spam or not, it will present the visitor with a CAPTCHA test.
Unless the test was completed succesfully, the comment will never be stored on your blog. Fallback on an automated
CAPTCHA test allows Mollom to block up to 99,7% of all spam messages.

Developed by <a href="http://www.colada.be">Colada</a>.

== Installation ==

Installation

* Register your website at http://mollom.com
* Disable akismet or other spamdeterring plugins you are currently using
* Drop the wp-mollom/ folder in /wp-content/plugins.
* Activate the plugin in your dashboard.
* Go to the 'Mollom configuration' panel which you will find through the 'Settings' menu.
* Enter the public/private key combination you got after registering with Mollom.
  with the Mollom service. You can can create an account and register your website at http://www.mollom.com
* All comments posted to your blogs should now go through the Mollom service.

== Configuration ==

After you have set the public/private key combination, Mollom will automatically protect your blog. The plugin takes
care of everything. You don't have to worry about moderation, false positives,... and you can focus on what's really
important: creating great content and interact with your visitors in a proper fashion.

Extra options in the configuration panel:

* User roles: By default, Mollom will check every comment from any user. Even if he/she is logged into a registered
  account. Users can be excluded from this check. You assign users to a certain role and exclude that role from checking
  by selecting that role. By default, all roles present on installation are exempted. If you create new roles after the installation
  of wp-mollom, you will have to select these here as well if you want to exempt them.
* Policy mode: if enabled, all comments/trackbacks will be blocked if the Mollom services are not available. If 
  you have a high traffic site, this might be useful if you can't respond right away.
* Restore mode (deprecated since 2.7!): if enabled, the 'mollom' table which contains mollom related information (session id's) and all
  mollom options will be deleted from your database upon deactivation.
* Reverse proxy: This is option is important to determine the IP address
  of a visitor if your WP installation runs behind a 'reverse proxy' (Squid,...). If you know the IP address(es) of the 
  proxy your host runs, you should enable this option and enter them as a comma-seperated list. This isn't mandatory 
  though, but it improves accuracy of the plugin. Please refer to the <a href="http://www.mollom.com/support">Support
  section</a> for detailed information.

== Usage ==

Mollom takes care of everything. If a comment is flagged as spam it will be blocked. If the comment is ham, it will
 just be treated as any other valid comment. Only if Mollom is unsure user action is required: a CAPTCHA will be shown
to the commenter. If he/she succeeds in solving the CAPTCHA, the comment is saved. In the other case Mollom will just
reject the comment and regenerate a new CAPTCHA for the commenter to try again.

== Moderation ==

So we lied a bit...

Moderation is still possible. You can moderate comments through the Mollom Manage Module. You can find the module
in the 'Comments' menu of your Wordpress administration board. The default Wordpress moderation queue is still 
available, but usage of the Mollom moderation queue is encouraged as it will send feedback to the Mollom services
each time you moderate a comment/trackback.

There are four basic types of moderation:

* Spam: if the comment seems to be spam nonetheless.
* Profanity: if the comment contains swearing
* Low Quality: if the comment isn't really consistent or doesn't make much sense
* Unwanted: if the comment was i.e. posted by a particular person or bot.


Using these will send feedback to Mollom AND delete the comment permanently afterwards. You can also approve or 
unapprove a comment. Using these functions, you can hide or show a comment from your website. These two options 
don't send feedback to Mollom nor delete the comment. Use them if you are not sure what to do with a comment.

If a CAPTCHA was shown and completed succesfully, this will also be indicated in the Mollom Manage module through
differend header colors for the comment. Consult the legend for the meaning of each statuscolor.

Moderation is encouraged in case of a false positive. Mollom will learn from the feedback you send through moderation.

== Theme functions ==

WP Mollom comes with handy theme functions which you can use in your theme.

* mollom_moderate_comment()
  This function makes the mollom moderate links directly available in your theme so you don't have to go through the Mollom
  Manage Module. Just make sure you are logged in as a user with administrative powers. Use this code in your theme:
  `<?php mollom_moderate_comment($comment->Comment_ID); ?>` Make sure it's within the Comment Loop!!
* mollom_graphs()
  This function prints a nice bar graph with statistics of the performance of the plugin your site. This function is used
  in the Mollom Manage Module. The graph itself is CSS based and the function will add some in line CSS to your theme. If you 
  pass 'false' as an argument to the function, you can override this behavior and provide your own CSS.
  Use this code in your theme:
  `<?php mollom_graphs(); ?>`

== Notes ==

* Although this plugin can be used on Wordpress MU, it is not designed nor supported to do so. Wordpress MU will
  be fully supported in future versions.
* The backend handling and storing of data has been significantly changed since version 0.4.0. The plugin will try to convert the
  existing data if you used an earlier version of the plugin.
* If you don't set policy mode, comments will not  pass through the Mollom filter yet they are treated in the default fashion. This means a Mollom session ID will not be assigned to them. This ID is necessary for moderation. As a result, these comments will not show up in the mollom moderation queue.
* The plugin works with Wordpress 2.6 but doesn't yet support the new SSL extensions released with Wordpress 2.6 yet.
* The plugin is compatible with version 2.2.2 (and up) of WP OpenID.

== Credits ==

Thank you very much for supporting this project! These people contributed to the plugin with translations,
pointing out bugs and helpful suggestions.

* Dries Buytaert (http://buytaert.net)
* DonaldZ (http://zuoshen.com)
* Alexander Langer (http://webseiter.de)
* Gianni Diurno (http://www.gidibao.net)
* Pascal Van Hecke (http://pascal.vanhecke.info/)
* John Eckman (http://www.openparenthesis.org/)
* Paul Maunders (http://www.pyrosoft.co.uk/blog)
* Petko Stoyanov
* 9el (http://lenin9l.wordpress.com/)
* Minh-Quân Tran

== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png
3. screenshot-3.png
4. screenshot-4.png
5. screenshot-5.png
5. screenshot-6.png

== Changelog ==

* 2009/12/20 - 0.7.5
 * fixed: wrong character encoding when comment is fed to wordpress after a CAPTCHA
 * fixed: url was also truncated in href if > 32 chars in the management module
 * fixed: changed 2 strings against typo's
 * improved: added pagination on the bottom of the management module
 * changed: contact details of plugin author
* 2009/04/18 - 0.7.4
 * added: vietnamese (vi) translation
 * added: bulgarian (bg_BG) translation
 * added: bangla (bn_BD) translation
* 2009/03/16 - 0.7.3
 * fixed: multiple moderation would incorrectly state 'moderation failed' due to incorrect set boolean.
 * added: german (de_DE) translation
 * added: italian (it_IT) translation
* 2009/02/12 - 0.7.2
 * fixed: closing a gap that allowed bypassing checkContent through spoofing $_POST['mollom_sessionid']
 * fixed: if mb_convert_encoding() is not available, the CAPTCHA would generate a PHP error. Now falls back to htmlentities().
 * improved: the check_trackback_content and check_comment_content are totally rewritten to make them more secure.
 * added: user roles capabilities. You can now exempt roles from a check by Mollom
 * added: simplified chinese (zh_CN) translation
* 2008/12/27 - 0.7.1
 * fixed: all plugin panels now show in the new WP 2.7 administration interface
 * fixed: non-western character sets are now handled properly in the captcha form
 * fixed: handles threaded comments properly now
 * fixed: handling multiple records in the manage module not correctly handled
 * improved: extra - non standard- fields added to the comment form don't get dropped anymore
 * improved: revamped the administration panel
 * improved: various smaller code improvements
 * added: the plugin is now compatible with the new plugin uninstall features in Wordpress 2.7
 * added: the 'quality' of 'spaminess' of a comment is now logged and shown as an extra indicator
* 2008/11/27 - 0.7.0
 * fixed: hover over statistics bar graph wouldn't yield numerical data
 * added: localization/internationalisation (i8n) support. Now you can translate wp-mollom through POEdit and the likes.
* 2008/11/10 - 0.6.2
 * fixed: wrong feedback qualifiers (spam, profanity, unwanted, low-quality) were transmitted to Mollom upon moderation
* 2008/09/24 - 0.6.1
 * fixed: division by 0 error on line 317
 * fixed: if 'unsure' but captcha was filled in correctly, HTML attributes in comment content would sometimes be eaten by kses.
 * improved: the mollom function got an overhaul to reflect the september 15 version of the Mollom API documentation
 * changed: mollom statistics are now hooked in edit-comments.php instead of plugins.php
 * added: _mollom_retrieve_server_list() function now handles all getServerList calls
* 2008/08/24 - 0.6.0
 * fixed: html is preserved in a comment when the visitor is confronted with the captcha
 * fixed: handling of session id's in show_captcha() en check_captcha() follows the API flow better.
 * fixed: broken bulk moderation of comments is now fixed
 * fixed: the IP adress was incorrectly passed to the 'mollom.checkCaptcha' call 
 * fixed: the session_id is now passed correctly to _save_session() after the captcha is checked.
 * improved: more verbose status messages report when using the Mollom Manage module
 * improved: cleaned up some deprecated functions
 * improved: handling of Mollom feedback in _mollom_send_feedback() function 
 * added: approve and unapprove options in the Mollom Manage module 
 * added: link to the originating post in the Mollom Manage module 
 * added: if a comment had to pass a CAPTCHA, it will be indicated in the Mollom Manage module 
 * added: plugin has it's own HTTP USER AGENT string which will be send with XML RPC calls to the API 
 * added: detailed statistics. You can find these under Plugins > Mollom
* 2008/07/20 - 0.5.2
 * fixed: passing $comment instead of $_POST to show_captcha() in check_captcha()
 * improved: implemented wpdb->prepare() in vunerable queries
 * improved: mollom_activate() function now more robust
 * changed: mollom_author_ip() reflects changes in the API documentation. This function is now 'reverse proxy aware'
* 2008/06/30 - 0.5.1
 * fixed: issues with the captcha page not being rendered correctly
 * added: mollom_manage_wp_queue() function which deals with Mollom feedback from the default WP moderation queue
 * improved: legacy code when activating the plugin (needed for upgrading from < 0.5.0 (testversions!)
* 2008/06/26 - 0.5.0
 * Added: installation/activation can contain legacy code and versioning for handling old (test)configurations
 * Added: PHPDoc style documentation of functions
 * Added: mollom_moderate_comment() template function. Allows moderation from your theme.
 * Removed: 'moderation mode'. Moderation should only be configured through the proper wordpress interface.
 * fixed: compatibility issues with the WP-OpenID plugin
 * Improved: the plugin relies far less on global variables now.
 * Improved: all mollom data is now saved to it's own seprerate, independent table.
 * Improved: SQL revision
 * Improved: error handling is now more verbose
 * Improved: status messages in the configuration/moderation panels now only show when relevant 
 * Improved: handling of mollom servers not being available or unreachable
* 2008/06/03 - 0.4
 * Changed: 'configuration' now is under WP 'settings' menu instead of 'plugins'
 * Added: show_mollom_plugincount() as a template function to show off your mollom caught
* 2008/05/27 - 0.3
 * Added: trackback support. If ham: passed. If unsure/spam: blocked.
 * Added: 'moderation mode' mollom approved comments/trackbacks still need to be moderated
 * Added: 'Restore' When the plugin is deactivated, optionally purge all mollom related data
 * Changed: moderation isn't mandatory anymore, only optional. Comments aren't saved to the  database until the CAPTCHA is filled out correctly. Otherwise: never registered.
 * Improved: Error handling now relies on WP Error handling (WP_Error object)
* 2008/05/22 - 0.2
 * Added: bulk moderation of comments
 * Added: 'policy mode' disables commenting if the Mollom service is down
 * Improved: moderation interface is more userfriendly
 * Improved: only unmoderated messages with a mollom session id can be moderated
 * Improved: deactivation restores database to previous state. Removal of stored option values and deletion of the mollom_session_id column in $prefix_comments
 * Fixed: persistent storage of the mollom session id in the database
 * Fixed: no messages shown in the configuration screen triggers a PHP error
* 2008/05/12 - 0.1
 * Initial release to testers