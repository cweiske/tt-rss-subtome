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
            0.1,
            'Add TT-RSS to SubToMe.com',
            'cweiske',
            false//not a system plugin
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

        $ttSubscribeUrl = get_self_url_prefix()
            . '/public.php?op=subscribe&feed_url={url}';

        $regUrl = 'https://www.subtome.com/register-no-ui.html'
            . '?name=##NAME##'
            . '&url=' . urlencode($ttSubscribeUrl);
        $jRegUrl = json_encode($regUrl);

        echo <<<HTM
<div dojoType="dijit.layout.AccordionPane" title="SubToMe">
 <form dojoType="dijit.form.Form" id="subtome_reg_form">
  <script type="dojo/method" event="onSubmit" args="evt">
    evt.preventDefault();
    if (this.validate()) {
        var regUrl = $jRegUrl.replace(
            '##NAME##', document.getElementById("subtome_name").value
        );
        var me = document.getElementById('subtome_reg_form');
        me.insertAdjacentHTML(
            'afterend',
            '<iframe style="display:none;" src="' + regUrl + '" />'
        );
        document.getElementById("subtome_done").style = "";
    }
  </script>

  <table width="100%" class="prefPrefsList">
   <tr><td colspan="2"><h3>Configure SubToMe</h3></td></tr>
   <tr>
    <td width="40%" class="prefName">
     <label for="subtome_name">Name</label>
    </td>
    <td class="prefValue">
     <input name="subtome_name" id="subtome_name" type="text" size="20" value="Tiny Tiny RSS" dojoType="dijit.form.TextBox"/>
    </td>
   </tr>
  </table>
  <p>
   <input type="submit" value="Add TT-RSS to SubToMe.com"/>
   <span id="subtome_done" style="display: none">
    <input type="checkbox" checked="checked" value="1"
           dojoType="dijit.form.CheckBox" />
    Registration finished!
   </span>
  </p>
 </form>

 <h3>Testing</h3>
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
