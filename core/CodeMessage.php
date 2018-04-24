<?php

class CodeMessage extends MessageLine
{
    /**
     * @param string $line
     * @return string
     * text between ``` put it into code tags
     */
    protected function handleMessageContents(string $line): string
    {
        $line = preg_replace("/```(.*?)```/", '<code>\1</code>', $line);
        return preg_replace("/`(.*?)`/", '<code>\1</code>', $line);
    }
}