<?php

class LinkMessage extends MessageLine
{
    /**
     * @param string $line
     * @return string message into <a> tags
     */
    protected function handleMessageContents(string $line): string
    {
        // https://stackoverflow.com/questions/161738/what-is-the-best-regular-expression-to-check-if-a-string-is-a-valid-url
        if (preg_match_all("/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/",
            $line, $url)) {
            $line = str_replace($url[0][0], '<a href="' . $url[0][0] . '">' . $url[0][0] . '</a>', $line);
        }
        return $line;
    }
}