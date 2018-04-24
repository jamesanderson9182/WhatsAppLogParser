<?php

class MessageLineFactory
{
    private $previousDate;

    public function handle(string $messageLine, string $tabName)
    {
        preg_match("/\[(.*)\] ([\p{L}* ?]*):/", $messageLine, $dateAndName);

        if (sizeof($dateAndName) > 0) {
            $messageAndDateParts = explode($dateAndName[0], $messageLine);
            $message = $messageAndDateParts[1];
            $userName = explode(']', $dateAndName[0])[1];
            $date = $this->getDate($dateAndName);

            if ($date) {
                $date->modify('midnight');
                $dateString = $date == $this->previousDate ? "" : "<h1>" . $date->format('D jS M') . "</h1>";
                $this->previousDate = $date;

                $messageType = new TextMessage();
                if (strpos($message, "<‎attached>") > 0) {
                    $messageType = new ImageMessage($tabName);
                }
                $message = $messageType->formatMessage($message);

                preg_match_all('/[A-Z]+/', $userName, $initials);
                $initialsString = implode('', $initials[0]);
                ?>
                <?= $dateString ?>
                <p><b><?= $initialsString . "</b> " . $message ?></p>
                <?php
            }
        }
    }

    /**
     * @param $messageAndDateParts
     * @return bool|DateTime|mixed
     */
    private function getDate($messageAndDateParts)
    {
        $date = $messageAndDateParts[0];
        $date = str_replace('[', '', $date);
        $date = explode(',', $date)[0];
        $date = DateTime::createFromFormat('d/m/Y', $date);
        return $date;
    }
}