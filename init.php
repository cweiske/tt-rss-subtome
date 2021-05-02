<?php
/**
 * Allows user to register their Tiny Tiny RSS instance at subtome.com,
 * so that they can subscribe to feeds with a few clicks.
 *
 * PHP version 5
 *
 * @author  Christian Weiske <cweiske@cweiske.de>
 * @license AGPLv3 or later
 * @link    http://docs.subtome.com/developers/
 * @link    https://tt-rss.org/redmine/projects/tt-rss/wiki/FrequentlyAskedQuestions#I-need-a-URL-I-can-call-to-subscribe-to-feed-to-integrate-with-some-third-party-browser-extensionapplication
 */
class SubToMe extends Plugin
{
    public function about()
    {
        return array(
            0.2,
            'Add Tiny Tiny RSS to SubToMe.com',
            'cweiske',
            false
        );
    }

    public function init($host)
    {
        $host->add_hook($host::HOOK_PREFS_TAB, $this);
    }

    public function hook_prefs_tab($args)
    {
        if ($args != "prefPrefs") {
            return;
        }
        $name = 'Tiny Tiny RSS @ '
            . parse_url(get_self_url_prefix(), PHP_URL_HOST);

        $ttSubscribeUrl = get_self_url_prefix()
            . '/public.php?op=bookmarklets--subscribe&feed_url={url}';
        $regUrl = 'https://www.subtome.com/register-no-ui.html'
            . '?name=' . urlencode($name)
            . '&url=' . urlencode($ttSubscribeUrl);
        $hRegUrl = htmlspecialchars($regUrl);

        $jRegUrl = json_encode($regUrl);

        echo <<<HTM
<div dojoType="dijit.layout.AccordionPane" title="SubToMe">
 <iframe style="display:none;" src="$hRegUrl"></iframe>
 <p>
  Tiny Tiny RSS has been added to subtome.com automatically
  by visiting the Tiny Tiny RSS preferences.
 </p>
 <p>
  Try the "Subscribe" button on
  <a href="http://blog.superfeedr.com/">blog.superfeedr.com</a>.
 </p>
</div>
HTM;
    }

    public function api_version()
    {
        return 2;
    }
}
?>
