
<div class="grid_14 push_1">
    <div id="regex_header">


    </div>

    <div id="options">
      <ul>
        <li><input id="flagG" type="checkbox" checked="checked"/><label for="flagG">Global</label> <span class="flag">(g)</span></li>
        <li><input id="flagI" type="checkbox"/><label for="flagI">Case insensitive</label> <span class="flag">(i)</span></li>
        <li><input id="flagM" type="checkbox"/><label for="flagM">Multiline anchors</label> <span class="flag">(m)</span></li>
        <li><input id="flagS" type="checkbox"/><label for="flagS">Dot matches all</label> <span class="flag">(s)</span></li>
        <li class="optGroup" id="quickReferenceDropdown">Quick Reference</li>
        <li class="optGroup" id="optionsDropdown">Options
          <ul>
            <li><input id="highlightSyntax" type="checkbox" checked="checked"/><label for="highlightSyntax">Highlight regex syntax</label></li>
            <li><input id="highlightMatches" type="checkbox" checked="checked"/><label for="highlightMatches">Highlight matches</label></li>
            <li class="hidden"><input id="invertMatches" type="checkbox"/><label for="invertMatches" title="Match any text not matched by the regex">Invert results</label></li>
          </ul>
        </li>
      </ul>
    </div>

    <div id="quickReference" class="hidden">
      <h2>JavaScript Regex Quick Reference</h2>
      <img src="../images/regex/pin.gif" class="pin" alt="pin" title="pin"/>
      <img src="../images/regex/close.gif" class="close" alt="close" title="close"/>
      <table cellspacing="0" summary="Regular expressions reference">
        <tbody>
          <tr>
            <td><regex_code>.</regex_code></td>
            <td>Any character except newline.</td>
          </tr>
          <tr class="altBg">
            <td><regex_code>\.</regex_code></td>
            <td>A period (and so on for <regex_code>\*</regex_code>, <regex_code>\(</regex_code>, <regex_code>\\</regex_code>, etc.)</td>
          </tr>
          <tr>
            <td><regex_code>^</regex_code></td>
            <td>The start of the string.</td>
          </tr>
          <tr class="altBg">
            <td><regex_code>$</regex_code></td>
            <td>The end of the string.</td>
          </tr>
          <tr>
            <td><regex_code>\d</regex_code>,<regex_code>\w</regex_code>,<regex_code>\s</regex_code></td>
            <td>A digit, word character <regex_code>[A-Za-z0-9_]</regex_code>, or whitespace.</td>
          </tr>
          <tr class="altBg">
            <td><regex_code>\D</regex_code>,<regex_code>\W</regex_code>,<regex_code>\S</regex_code></td>
            <td>Anything except a digit, word character, or whitespace.</td>
          </tr>
          <tr>
            <td><regex_code>[abc]</regex_code></td>
            <td>Character a, b, or c.</td>
          </tr>
          <tr class="altBg">
            <td><regex_code>[a-z]</regex_code></td>
            <td>a through z.</td>
          </tr>
          <tr>
            <td><regex_code>[^abc]</regex_code></td>
            <td>Any character except a, b, or c.</td>
          </tr>
          <tr class="altBg">
            <td><regex_code>aa|bb</regex_code></td>
            <td>Either aa or bb.</td>
          </tr>
          <tr>
            <td><regex_regex_code>?</regex_regex_code></td>
            <td>Zero or one of the preceding element.</td>
          </tr>
          <tr class="altBg">
            <td><regex_regex_code>*</regex_regex_code></td>
            <td>Zero or more of the preceding element.</td>
          </tr>
          <tr>
            <td><regex_regex_code>+</regex_regex_code></td>
            <td>One or more of the preceding element.</td>
          </tr>
          <tr class="altBg">
            <td><regex_regex_code>{<em>n</em>}</regex_regex_code></td>
            <td>Exactly <em>n</em> of the preceding element.</td>
          </tr>
          <tr>
            <td><regex_code>{<em>n</em>,}</regex_code></td>
            <td><em>n</em> or more of the preceding element.</td>
          </tr>
          <tr class="altBg">
            <td><regex_code>{<em>m</em>,<em>n</em>}</regex_code></td>
            <td>Between <em>m</em> and <em>n</em> of the preceding element.</td>
          </tr>
          <tr>
            <td><regex_code>??</regex_code>,<regex_code>*?</regex_code>,<regex_code>+?</regex_code>,<br/><regex_code>{<em>n</em>}?</regex_code>, etc.</td>
            <td>Same as above, but as few times as possible.</td>
          </tr>
          <tr class="altBg">
            <td><regex_code>(</regex_code><em>expr</em><regex_code>)</regex_code></td>
            <td>Capture <em>expr</em> for use with <regex_code>\1</regex_code>, etc.</td>
          </tr>
          <tr>
            <td><regex_code>(?:</regex_code><em>expr</em><regex_code>)</regex_code></td>
            <td>Non-capturing group.</td>
          </tr>
          <tr class="altBg">
            <td><regex_code>(?=</regex_code><em>expr</em><regex_code>)</regex_code></td>
            <td>Followed by <em>expr</em>.</td>
          </tr>
          <tr>
            <td><regex_code>(?!</regex_code><em>expr</em><regex_code>)</regex_code></td>
            <td>Not followed by <em>expr</em>.</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div id="regex_body">
      <div id="search" class="smartField">
        <textarea cols="30" rows="3" tabindex="1" spellcheck="false">Enter regex here</textarea>
      </div>
      <div id="input" class="smartField">
        <textarea cols="30" rows="6" tabindex="2" spellcheck="false">Enter test data here</textarea>
      </div>
    </div>



    <script type="text/javascript" src="../js/regex/xregexp.js"></script>
    <script type="text/javascript" src="../js/regex/helpers.js"></script>
    <script type="text/javascript" src="../js/regex/regexpal.js"></script>

</div>
