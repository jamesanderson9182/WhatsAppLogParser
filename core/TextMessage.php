<?php

class TextMessage extends MessageLine
{
    /**
     * @param string $line
     * @return string
     */
    protected function handleMessageContents(string $line): string
    {
        return (new CodeMessage())
            ->formatMessage((new LinkMessage())
                ->formatMessage($line));
    }
}