<?php
defined('_JEXEC') or die('Restricted access');
?>

<form class="adminForm" actions="" method="post" name="adminForm">

<fieldset class="adminform"><legend>Parameters</legend>


<table class="admintable">
	<tbody>
<tr><td class="key">Quantity mailto/max-3</td>
            <td>
           <select id="pdf_mailto" name="pdf_mailto">
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
           </select>
            </td></tr>
<tr><td class="key">Show to Capcha</td>
          <td>
            <input id="paramsshow_capcha0" type="radio" value="0" name="params[show_capcha]"/>
            <label for="paramsshow_capcha0">Hide</label>
            <input id="paramsshow_capcha1" type="radio" checked="checked" value="1" name="params[show_capcha]"/>
            <label for="paramsshow_capcha1">Show</label>
      </select>
          </td>
      </tr>

<tr><td class="key">
            <span class="editlinktip">
            <label id="foot_and_head" class="hasTip">FOOTER AND HEADER IN THE FIELD MESSAGE</label>
            </span>
          </td>
           <td>
               <input id="foot_and_head_no" type="radio" value="0" name="paramsvalidate_session"/>
               <label>No</label>
               <input id="foot_and_head_yes" type="radio" checked="checked" value="1" name="paramsvalidate_session"/>
               <label>Yes</label>
           </td>
      </tr>

<tr>
<td class="key" valign="top">
	<label for="address">  HEADER: </label>
</td>
<td>
	<textarea id="pdf2email_header" class="inputbox" cols="45" rows="5" name="address"></textarea>
</td>
</tr>
<tr>
<td class="key" valign="top">
	<label for="address">  FOOTER: </label>
</td>
<td>
	<textarea id="pdf2email_footer" class="inputbox" cols="45" rows="5" name="address"></textarea>
</td>
</tr>

	</tbody>
</table>
</fieldset>

</form>