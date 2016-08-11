<?php

namespace app\helper;


use app\UserAuth;
use yapf\View;

class Html
{
    /**
     * @param array $data
     */
    public static function exampleLink($href = 'http://google.com')
    {
        View::createHtmlElement('a', 'click here', ['href' => $href]);
    }
    //Funkcja wspomagająca dla funkcji bbcode_to_html().
    //Tworzy dropdown-menu z bbcode.

    public static function bbcode_decode($bbtext)
    {
        $bbtext = static::makeDropdownMenus($bbtext);

        $bbextended = array
        (
            "/\[url](.*?)\[\/url]/i" => "<a href=\"http://$1\" title=\"$1\">$1</a>",
            "/\[url=(.*?)\](.*?)\[\/url\]/i" => "<a href=\"$1\" title=\"$1\">$2</a>",
            "/\[email=(.*?)\](.*?)\[\/email\]/i" => "<a href=\"mailto:$1\">$2</a>",
            "/\[mail=(.*?)\](.*?)\[\/mail\]/i" => "<a href=\"mailto:$1\">$2</a>",
            "/\[img\]([^[]*)\[\/img\]/i" => "<img src=\"$1\" alt=\" \" />",
            "/\[image\]([^[]*)\[\/image\]/i" => "<img src=\"$1\" alt=\" \" />",
            "/\[image_left\]([^[]*)\[\/image_left\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_left\" />",
            "/\[image_right\]([^[]*)\[\/image_right\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_right\" />",
            "/\[list=1\](.*?)\[\/list\]/i" => "<ol>$1</ol>"
            //TODO Youtube nie działa poprawnie w danej chwili - zawartość strony za filmem zostaje usunięta. Warto by to jakoś poprawić.
            //"/\[video\](.*?)\[\/video\]/i" => "<iframe src=\"http://www.youtube.com/embed/$1\" width=\"640\" height=\"480\" frameborder=\"0\""
        );
        foreach ($bbextended as $match => $replacement) {
            $bbtext = preg_replace($match, $replacement, $bbtext);
        }

        $bbtags = array
        (
            '[heading1]' => '<h1>', '[/heading1]' => '</h1>',
            '[heading2]' => '<h2>', '[/heading2]' => '</h2>',
            '[heading3]' => '<h3>', '[/heading3]' => '</h3>',
            '[h1]' => '<h1>', '[/h1]' => '</h1>',
            '[h2]' => '<h2>', '[/h2]' => '</h2>',
            '[h3]' => '<h3>', '[/h3]' => '</h3>',

            '[paragraph]' => '<p>', '[/paragraph]' => '</p>',
            '[para]' => '<p>', '[/para]' => '</p>',
            '[p]' => '<p>', '[/p]' => '</p>',
            '[left]' => '<p style="text-align:left;">', '[/left]' => '</p>',
            '[right]' => '<p style="text-align:right;">', '[/right]' => '</p>',
            '[center]' => '<p style="text-align:center;">', '[/center]' => '</p>',
            '[justify]' => '<p style="text-align:justify;">', '[/justify]' => '</p>',

            '[bold]' => '<span style="font-weight:bold;">', '[/bold]' => '</span>',
            '[italic]' => '<span style="font-weight:bold;">', '[/italic]' => '</span>',
            '[underline]' => '<span style="text-decoration:underline;">', '[/underline]' => '</span>',
            '[b]' => '<span style="font-weight:bold;">', '[/b]' => '</span>',
            '[i]' => '<span style="font-weight:bold;">', '[/i]' => '</span>',
            '[u]' => '<span style="text-decoration:underline;">', '[/u]' => '</span>',
            '[break]' => '<br />',
            '[br]' => '<br />',
            '[newline]' => '<br />',
            '[nl]' => '<br />',

            '[unordered_list]' => '<ul>', '[/unordered_list]' => '</ul>',
            '[list]' => '<ul>', '[/list]' => '</ul>',
            '[ul]' => '<ul>', '[/ul]' => '</ul>',

            '[ordered_list]' => '<ol>', '[/ordered_list]' => '</ol>',
            '[ol]' => '<ol>', '[/ol]' => '</ol>',
            '[list_item]' => '<li>', '[/list_item]' => '</li>',
            '[li]' => '<li>', '[/li]' => '</li>',

            '[*]' => '<li>', '[/*]' => '</li>',
            '[code]' => '<code>', '[/code]' => '</code>',
            '[preformatted]' => '<pre>', '[/preformatted]' => '</pre>',
            '[pre]' => '<pre>', '[/pre]' => '</pre>',

            '[sup]' => '<sup>', '[/sup]' => '</sup>',
            '[sub]' => '<sub>', '[/sub]' => '</sub>',
            '[br /]' => '<br />',
            '[s]' => '<span style="text-decoration:line-through">', '[/s]' => '</span>',
        );
        $bbtext = str_ireplace(array_keys($bbtags), array_values($bbtags), $bbtext);
        return $bbtext;
    }

    //Źródło oryginalnej funkcji: http://stackoverflow.com/questions/23247662/wysibb-text-editor-uses-tag-instead-of-tag

    private static function makeDropdownMenus($text)
    {
        $begin = stripos($text, "[dropdown]");
        $end = stripos($text, "[/dropdown]");
        while ($begin !== false && $end !== false) {
            //if there is only header
            if (stripos(substr($text, $begin, $end - $begin), "[br /]") == 0) {
                $text = substr_replace($text, "<li>", $begin, 0);
                $end += 4;
                $text = substr_replace($text, "</li>", $end, 0);
            } else {
                $text = substr_replace($text, "<li>", $begin, 0);
                $end += 4;
                $text = substr_replace($text, "</li></ul></li>", $end, 0);

                $br = stripos($text, "[br /]", $begin);
                if ($br === false)
                    $br = $end;
                $text = substr_replace($text, "<ul><li>", $br, -(strlen($text) - ($br + 6)));
                $end += 2;

                $br = stripos($text, "[br /]", $begin);
                while ($br !== false) {
                    if ($br >= $end)
                        break;
                    if ($br >= $begin) {
                        $text = substr_replace($text, "</li><li>", $br, -(strlen($text) - ($br + 6)));
                        $end += 3;
                    }
                    $br = stripos($text, "[br /]", $begin);
                }
            }

            $text = static::str_replace_first("[dropdown]", "", $text);
            $text = static::str_replace_first("[/dropdown]", "", $text);
            $begin = stripos($text, "[dropdown]");
            $end = stripos($text, "[/dropdown]");
        }
        return $text;
    }

    //Źródło funkcji: http://stackoverflow.com/questions/1252693/using-str-replace-so-that-it-only-acts-on-the-first-match
    //Podmienia poerwsze wystompienie $from w $dubiect na $to.
    private static function str_replace_first($from, $to, $subject)
    {
        $from = '/'.preg_quote($from, '/').'/';
        return preg_replace($from, $to, $subject, 1);
    }
    //Wyświetla przycisk edycji o wielkości $Size pikseli, jeżeli użytkownik ma prawo do edycji posta w sekcji $Section.
    //Dodatkowo strona edycji będzie umożliwiała edycję tagów ($Tags), Zdjęcia ($Picture) o rozmiarach $Width x $Height, Tytułu ($Title), Głównej treści (Content)
    //jeżeli wartości tych argumentów będą true.
    //Dodatkowo, jeżeli parametry $Width lub $Height są równe 0, to zdjęcie może być dowolnych rozmiarów.

    public static function dropEdit(UserAuth $user, $Section, $Id, $Tags = true, $Picture = true, $Title = true, $Content = true, $Width = 0, $Height = 0, $nextPage = "index.php")
    {
        if (!$user->checkPostRights($Section))
            return;
        echo '<form action="' . wwwroot . 'editPost.php?Next=' . $nextPage . '" method="post">
            <input type="hidden" name="Id" value="' . $Id . '">';
        if ($Tags)
            echo '<input type="hidden" name="Tags" value="true">';
        if ($Picture) {
            echo '<input type="hidden" name="Picture" value="true">';
            echo '<input type="hidden" name="Width" value="' . $Width . '">';
            echo '<input type="hidden" name="Height" value="' . $Height . '">';
        }
        if ($Title)
            echo '<input type="hidden" name="Title" value="true">';
        if ($Content)
            echo '<input type="hidden" name="Content" value="true">';
        echo '<input type="image" src="' . wwwroot . 'images/edit.png" alt="Submit" width="24" height="24">
        </form>';
    }



}