<?php

abstract class MessageLine
{
    public function formatMessage(string $line): string
    {
        return $this->handleMessageContents($line);
    }

    protected abstract function handleMessageContents(string $line): string;
}