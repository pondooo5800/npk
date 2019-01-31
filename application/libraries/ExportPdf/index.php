<form id="form1" name="form1" method="get" action="html2pdf.service2.php">
<input name="filename" type="hidden" value="test" />
  <table width="80%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td width="32%">&nbsp;</td>
      <td width="68%">&nbsp;</td>
    </tr>
    
    <tr>
      <td align="right">format :</td>
      <td><label for="Format"></label>
        <select name="Format" id="select">
        <option value="A4" sselected="selected">A4</option>
      </select></td>
    </tr>
    <tr>
      <td align="right">Orientation :</td>
      <td><input type="radio" name="Orientation" id="radio" value="P" checked="checked" />
        Portrait
<label for="orientation"></label>
      <input type="radio" name="Orientation" id="radio2" value="L" />
      <label for="orientation">Landscape</label></td>
    </tr>
    <tr>
      <td align="right">URL :</td>
      <td><input name="HtmlFile" type="text" id="url" value="" size="100" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Submit" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
