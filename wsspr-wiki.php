<?php

/* 
    Term to URL dictionaries
*/

// English easy-read dictionary
$GLOBALS["en_easy_urls"] = array(
    "Action Planning" => "/wiki/action-planning-easy/",
    "Blue Referral" => "/wiki/blue-referral-easy/",
    "Buddy System" => "/wiki/buddy-system-easy/",
    "Community Assets" => "/wiki/community-assets-easy/",
    "Community Support Hubs" => "/wiki/community-support-hubs-easy/",
    "Co-Production" => "/wiki/co-production-easy/",
    "Creative Referral" => "/wiki/creative-referral-easy/",
    "Education on Referral" => "/wiki/education-on-referral-easy/",
    "Exercise Referral" => "/wiki/exercise-referral-easy/",
    "Green Referral" => "/wiki/green-referral-easy/",
    "Holistic" => "/wiki/holistic-easy/",
    "Nature-Based Interventions" => "/wiki/nature-based-interventions-easy/",
    "Person-Centred Approach" => "/wiki/person-centred-approach-easy/",
    "Referral" => "/wiki/referral-easy/",
    "Signposting & Active Signposting" => "/wiki/signposting-active-signposting-easy/",
    "Social Cafes" => "/wiki/social-cafes-easy/",
    "Social Prescribing Pathway" => "/wiki/social-prescribing-practitioner-easy/",
    "Social Prescribing Practitioner" => "/wiki/social-prescribing-practitioner-easy/",
    "Social Prescribing" => "/wiki/social-prescribing-easy/",
    "Welfare Support Referral" => "/wiki/welfare-support-referral-easy/",
    "Wellbeing" => "/wiki/well-being-easy/",
    "What Matters Conversation" => "/wiki/what-matters-conversation-easy/"
);



/*
    Functions needed for WSSPR Wiki to operate
*/

/**
 * Checks if a string contains a word.
 * @param $str string to check
 * @param $word string to find
 * @return bool true if found, false if not found
 */
function contains_word($str, $word)
{
    if (strpos($str, $word) !== false) return true;
    else return false;
}

/**
 * Creates a HTML anchor (<a></a>)
 * @param $str Text to go inside anchor
 * @param $href Hyperlink for the anchor
 * @return string Text with anchor surrounding it
 */
function a($str, $href = "")
{
    return "<a href=\"".$href."\">".$str."</a>";
}

/**
 * Creates span with colour
 * @param $str Text to go inside span
 * @param $col Colour to use
 * @return string Text with colour span surrounding it
 */
function col($str, $col = "")
{
    return "<span style=\"color: ".$col.";\">".$str."</span>";
}

/**
 * Simple markdown to HTML intepreter
 * @param $markdown Markdown raw text to intepret to HTML
 * @return string HTML intepreted from markdown
 */
function intepret_markdown($markdown)
{
    // Passes for bold text
    $markdown = preg_replace_callback('/\*\*/', function($m) use (&$count) { ++$count; return $count % 2 ? '<strong>' : '</strong>'; }, $markdown);
    $markdown = preg_replace_callback('/__/', function($m) use (&$count) { ++$count; return $count % 2 ? '<strong>' : '</strong>'; }, $markdown);

    // Pass for colour declarations (CUSTOM)
    preg_match_all('/\$\[(.*?)\]\((.*?)\)/', $markdown, $out, PREG_PATTERN_ORDER);
    for ($i = 0; $i < count($out[0]); $i++)
    {
        if (!contains_word($out[1][$i], "<") && !contains_word($out[1][$i], "$["))
        {
            $pos = strpos($markdown, $out[0][$i]);
            if (($pos - 1) < 0) continue;
            $prev_char = $markdown[$pos - 1];
            if ($prev_char != " ") continue;

            $markdown = str_replace($out[0][$i], col($out[1][$i], $out[2][$i]), $markdown);
        }
    }

    // Pass for hyperlinks/anchors
    preg_match_all('/\[(.*?)\]\((.*?)\)/', $markdown, $out, PREG_PATTERN_ORDER);
    for ($i = 0; $i < count($out[0]); $i++)
    {
        if (!contains_word($out[1][$i], "<") && !contains_word($out[1][$i], "["))
        {
            $pos = strpos($markdown, $out[0][$i]);
            if (($pos - 1) < 0) continue;
            $prev_char = $markdown[$pos - 1];
            if ($prev_char != " ") continue;

            $markdown = str_replace($out[0][$i], a($out[1][$i], $out[2][$i]), $markdown);
        }
        else if (contains_word($out[0][$i], " ["))
        {
            preg_match_all('/\ \[(.*?)\]\((.*?)\)/', $out[0][$i], $out_3, PREG_PATTERN_ORDER);
            for ($j = 0; $j < count($out_3[0]); $j++)
            {
                $markdown = str_replace($out_3[0][$j], " ".a($out_3[1][$j], $out_3[2][$j]), $markdown);
            }
        }
        else if (contains_word($out[0][$i], "[["))
        {
            preg_match_all('/\[\[(.*?)\]\((.*?)\)/', $out[0][$i], $out_3, PREG_PATTERN_ORDER);
            for ($j = 0; $j < count($out_3[0]); $j++)
            {
                $markdown = str_replace($out_3[0][$j], "[".a($out_3[1][$j], $out_3[2][$j]), $markdown);
            }
        }
        else
        {
            preg_match_all('/\|\[(.*?)\]\((.*?)\)/', $out[0][$i], $out_2, PREG_PATTERN_ORDER);
            for ($j = 0; $j < count($out_2[0]); $j++)
            {
                $markdown = str_replace($out_2[0][$j], "|".a($out_2[1][$j], $out_2[2][$j]), $markdown);
            }
        }
    }
    
    $doing_bullets = false;

    // Pass for line-by-line stuff
    $markdown_arr = explode("\n", $markdown);
    foreach ($markdown_arr as &$line)
    {
        if (strlen($line) > 2)
        {
            // Handle bullet points
            if ($line[0] == "*" && $line[1] == " ")
            {
                $line = "<li>".substr($line, 2, strlen($line))."</li>";
                if (!$doing_bullets)
                {
                    $line = "<ul>".$line;
                    $doing_bullets = true;
                }
            }
        }
        else
        {
            if ($doing_bullets)
            {
                $doing_bullets = false;
                $line = "</ul>".$line;
            }
        }
    }

    // Catch any loose ends from line-by-line processing
    if ($doing_bullets) $line .= "</ul>";

    $markdown = implode("\n", $markdown_arr);

    return $markdown;
}

/**
 * Creates hyperlinks for terms within a connected terms
 * string
 * @param $str CSV terms to process
 * @param $dict Term to URL dictionary to use
 * @return string CSV terms with anchors applied
 */
function process_connected_terms($str, $dict)
{
    // Clean the string by removing double spaces
    // or replacing no-break spaces (U+00a0) with real spaces
    $str = str_replace(" ", " ", $str);
    $str = str_replace("  ", " ", $str);
    $terms = explode(", ", $str);
    asort($terms, SORT_NATURAL);
    
    foreach ($terms as &$term)
    {
        foreach ($dict as $k => $v)
        {
            if (strtolower($k) == strtolower($term))
            {
                $term = a($term, $v);
                break;
            }
        }
    }

    return implode(", ", $terms);
}



/*
    WSSPR Wiki meta box processing
*/

/*
    * Meta box processing code for WSSPR Wiki. This will alter the page based on metabox
    * values saved from Yada Wiki posts.
    * 
    * Meta box types:
    *    * ww_en_title - English title
    *    * ww_en_mindmap - English mindmap
    *    * ww_en_desc - English term description
    *    * ww_en_alt - English alternative terms
    *    * ww_en_connected - English connected terms
    *    * ww_cy_title - Welsh title
    *    * ww_cy_mindmap - Welsh mindmap PDF
    *    * ww_cy_desc - Welsh term description
    *    * ww_cy_alt - Welsh alternative terms
    *    * ww_cy_connected - Welsh connected terms
*/
function wsspr_wiki(&$title, &$content)
{
    // Get English meta boxes as the default/fallback
    if (get_post_meta(get_the_ID(), "ww_en_title", true) != "")
        $title = get_post_meta(get_the_ID(), "ww_en_title", true);
    $mindmap = get_post_meta(get_the_ID(), "ww_en_mindmap", true);
    $desc = get_post_meta(get_the_ID(), "ww_en_desc", true);
    $alt = get_post_meta(get_the_ID(), "ww_en_alt", true);
    $connected = get_post_meta(get_the_ID(), "ww_en_connected", true);
    
    if (contains_word($_SERVER['REQUEST_URI'], "-easy"))
    {
        $desc_header = "";
        $alt_header = "<span class='ww-subheading'>Also sometimes called:</span> ";
        $connected_header = "<span class='ww-subheading'>Connected terms:</span> ";
        $connected = process_connected_terms($connected, $GLOBALS["en_easy_urls"]);
    }
    else
    {
        $desc_header = "<span class='ww-subheading'>Description:</span> ";
        $alt_header = "<span class='ww-subheading'>Alternative terms:</span> ";
        $connected_header = "<span class='ww-subheading'>Connected terms:</span> ";

        // If alt or connected are empty, - to indicate to end-user this is normal
        if ($alt == "") $alt = "-";
        if ($connected == "") $connected = "-";
    }

    // If locale is Welsh, replace what we can
    // with Welsh versions
    if (get_locale() == "cy")
    {
        if (get_post_meta(get_the_ID(), "ww_cy_title", true) != "")
            $title = get_post_meta(get_the_ID(), "ww_cy_title", true);
        $mindmap = get_post_meta(get_the_ID(), "ww_cy_mindmap", true);
        $desc = get_post_meta(get_the_ID(), "ww_cy_desc", true);
        $alt = get_post_meta(get_the_ID(), "ww_cy_alt", true);
        $connected = get_post_meta(get_the_ID(), "ww_cy_connected", true);

        if (contains_word($_SERVER['REQUEST_URI'], "-easy"))
        {
            $desc_header = "";
            $alt_header = "<span class='ww-subheading'>Mae hyn weithiau yn cael ei alw yn:</span> ";
            $connected_header = "<span class='ww-subheading'>Connected terms:</span> ";
        }
        else
        {
            $desc_header = "<span class='ww-subheading'>Description:</span> ";
            $alt_header = "<span class='ww-subheading'>Alternative terms:</span> ";
            $connected_header = "<span class='ww-subheading'>Connected terms:</span> ";

            // If alt or connected are empty, - to indicate to end-user this is normal
            if ($alt == "") $alt = "-";
            if ($connected == "") $connected = "-";
        }
    }

    if ($desc != "")
    {
        $content = $desc_header.intepret_markdown($desc)."\n\n";
        if ($alt != "") $content .= $alt_header.$alt."\n\n";
        if ($connected != "") $content .= $connected_header.$connected."\n\n";

        if ($mindmap != "")
        {
            $content .= "[pdfviewer width=\"100%\" height=\"720px\"]".$mindmap."[/pdfviewer]";
        }
    }
}