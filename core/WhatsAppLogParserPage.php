<?php

class WhatsAppLogParserPage extends Page
{
    /**
     * @return string html page body content
     */
    protected function printPageContents()
    {
        date_default_timezone_set('UTC');

        $files = glob("*.txt");
        $logs = [];
        foreach ($files as $file) {
            $logs[str_replace(".txt", "", $file)] = file_get_contents($file);
        }
        ?>
        <div class="container">
        <ul class="nav nav-tabs">
            <?php
            foreach ($logs as $name => $log) {
                print '<li><a data-toggle="tab" href="#' . $name . '">' . $name . '</a></li>';
            }
            ?>
        </ul>
        <div class="tab-content">
            <?php
            $class = " in active";
            foreach ($logs as $name => $log) {
                ?>
                <div id="<?= $name ?>" class="tab-pane fade <?= $class ?>">
                    <h3><?= $name ?></h3>
                    <?php
                    // To ensure only one is active
                    $class = "";
                    $messageLines = explode("\n", $log);

                    $previousDate = null;
                    $messageLineFactory = new MessageLineFactory();

                    foreach ($messageLines as $messageLine) {
                        $messageLineFactory->handle($messageLine, $name);
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}