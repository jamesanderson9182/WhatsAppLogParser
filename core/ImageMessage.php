<?php

class ImageMessage extends MessageLine
{
    /**
     * @var string $tabName
     */
    private $tabName;

    /**
     * ImageMessage constructor.
     * @param string $tabName
     */
    public function __construct(string $tabName)
    {
        $this->tabName = $tabName;
    }

    /**
     * @param string $line
     * @return string
     */
    protected function handleMessageContents(string $line): string
    {
        $imageMessage = "";
        $image = trim(explode("<‎attached>", $line)[0]);
        $imagePath = "/" . $this->tabName . "/" . $image;
        if (file_exists(__DIR__ . str_replace($imagePath, "/", DIRECTORY_SEPARATOR))) {
            $imageMessage = '<a href="' . $imagePath . '"><img src="' . $imagePath . '" alt="' . $image . '"></a>';
        }

        return $imageMessage;
    }
}